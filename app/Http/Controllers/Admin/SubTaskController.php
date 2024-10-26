<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubTaskRequest;
use App\Http\Requests\StoreSubTaskRequest;
use App\Http\Requests\UpdateSubTaskRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\DepartmentHead;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\TaskEmployeeListing;
use App\Models\TaskTag;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubTaskController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sub_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $company_id = $_COOKIE['comp_name'];
            if($company_id == 0){
                $query = SubTask::with(['department', 'task', 'team'])->where('created_by_id',auth()->user()->id)->select(sprintf('%s.*', (new SubTask())->table));
            }else{
                $query = SubTask::with(['department', 'task', 'team'])->where('company_id',$company_id)->where('created_by_id',auth()->user()->id)->select(sprintf('%s.*', (new SubTask())->table));
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sub_task_show';
                $editGate = 'sub_task_edit';
                $deleteGate = 'sub_task_delete';
                $crudRoutePart = 'sub-tasks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->company_name : '' ;
            });

            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->editColumn('assigned_to', function ($row) {
                return $row->assigned_employee ? $row->assigned_employee->name : '';
            });

            // $table->editColumn('tag', function ($row) {
            //     $labels = [];
            //     foreach ($row->tags as $tag) {
            //         $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
            //     }

            //     return implode(' ', $labels);
            // });

            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->editColumn('frequency', function ($row) {
                return $row->frequency ? SubTask::FREQUENCY_SELECT[$row->frequency] : '';
            });

            $table->editColumn('due_date', function ($row) {
                return $row->due_date ? $row->due_date : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'department', 'attachment', 'task']);

            return $table->make(true);
        }

        return view('admin.subTasks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sub_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subTasks.create', compact('departments', 'tags', 'tasks'));
    }

    public function store(StoreSubTaskRequest $request)
    {
        $subTask = SubTask::create($request->all());
        $subTask->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            $subTask->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $subTask->id]);
        }

        return redirect()->route('admin.sub-tasks.index');
    }

    public function edit(SubTask $subTask)
    {
        abort_if(Gate::denies('sub_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subTask->load('department', 'tags', 'task', 'team');

        return view('admin.subTasks.edit', compact('departments', 'subTask', 'tags', 'tasks'));
    }

    public function update(UpdateSubTaskRequest $request, SubTask $subTask)
    {
        $subTask->update($request->all());
        $subTask->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            if (!$subTask->attachment || $request->input('attachment') !== $subTask->attachment->file_name) {
                if ($subTask->attachment) {
                    $subTask->attachment->delete();
                }
                $subTask->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($subTask->attachment) {
            $subTask->attachment->delete();
        }

        return redirect()->route('admin.sub-tasks.index');
    }

    public function show(SubTask $subTask)
    {
        abort_if(Gate::denies('sub_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subTask->load('department', 'tags', 'task', 'team');

        return view('admin.subTasks.show', compact('subTask'));
    }

    public function destroy(SubTask $subTask)
    {
        abort_if(Gate::denies('sub_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subTask->delete();

        return back();
    }

    public function massDestroy(MassDestroySubTaskRequest $request)
    {
        SubTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sub_task_create') && Gate::denies('sub_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubTask();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    //Here we Mange Sub-Task New module.. 
    public function createSubTasks(Request $request)
    {
        $company_id = isset($_COOKIE['comp_name']) ? $_COOKIE['comp_name']: 0;    
        $total_created_subtasks = 0;
        if($request->task_id != null ){
            if($company_id == 0){
                $companies = DepartmentHead::with('company')->where('head_of_department_id',auth()->user()->id)->get();
                $subtasks = SubTask::with('assigned_employee')->where('task_id',$request->task_id)->where('company_id',$company_id)->where('created_by_id',auth()->user()->id)->get();
                $assignedTaskEmployee = TaskEmployeeListing::with('assigned_employee')->where('company_id',$company_id)->where('task_id',$request->task_id)->first();
            }   
            elseif($company_id != null){
                $companies = Company::where('id',$company_id)->first();
                $subtasks = SubTask::with('assigned_employee')->where('task_id',$request->task_id)->where('company_id',$company_id)->where('created_by_id',auth()->user()->id)->get();
                $assignedTaskEmployee = TaskEmployeeListing::with('assigned_employee')->where('company_id',$company_id)->where('task_id',$request->task_id)->first();
            }
        }
        if($subtasks->count()<1){
            $subtasks = "empty";
        }else{
            if($subtasks->count()>=1){
                $total_created_subtasks = $subtasks->count();
            }
        }
        $task = Task::with('department')->where('id',$request->task_id)->first();
        $tags = TaskTag::all();
        $taxtube_employees = User::join('role_user','role_user.user_id','=','users.id')
            ->whereIn('role_id',[3])->where('id', '!=', auth()->user()->id)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.subTasks.create2',compact('subtasks', 'total_created_subtasks', 'companies','task','tags','taxtube_employees','company_id','assignedTaskEmployee'));
    }

    public function storeSubTasks(Request $request)
    {
        foreach($request->sub_task_id as $key => $id){
            if($id != null )
            {
                $subtask_update = SubTask::where('id',$id)->first();
                if($subtask_update != null){
                    $subtask_update->update([
                        'name' => $request->name[$key],
                        'department_id' => $request->department_id,
                        'task_id' => $request->task_id,
                        'company_id' => $request->company_id,
                        'created_by_id' => auth()->user()->id,
                        'description' => $request->description[$key] ?? null,
                        'assigned_id' => $request->assigned_id[$key] ?? null,
                        'frequency' => $request->frequency[$key] ?? null,
                        'due_date' => $request->due_date[$key] ?? null,
                    ]);
                }

            }elseif($id == null){
                
                $subtasks['name'] = $request->name[$key];
                $subtasks['department_id'] = $request->department_id;
                $subtasks['task_id'] = $request->task_id;
                $subtasks['company_id'] = $request->company_id;
                $subtasks['created_by_id'] = auth()->user()->id;
                $subtasks['description'] = $request->description[$key] ?? null;
                $subtasks['assigned_id'] = $request->assigned_id[$key] ?? null;
                $subtasks['frequency'] = $request->frequency[$key] ?? null;
                $subtasks['due_date'] = $request->due_date[$key] ?? null;

                SubTask::create($subtasks);
            }
        }
        return redirect()->route('admin.sub-tasks.index');   
    }

    public function editSubTasks(Request $request)
    {
        if($request->subtask_id != null){
            $subtask = SubTask::with('assigned_employee','task','department','company')->where('id',$request->subtask_id)->first();
            $all_Subtasks = SubTask::where('company_id',$subtask->company_id)->first();
            if($subtask->id == $all_Subtasks->id){
                $notice_of_subtask = 1;
            }else{
                $notice_of_subtask = 0;
            }
            $dependent_subtasks = SubTask::where('task_id',$subtask->task_id)->where('company_id',$subtask->company_id)->where('id','!=',$subtask->id)->pluck('name','id')->prepend(trans('global.pleaseSelect'), '');
            $tags = TaskTag::all();
            $taxtube_employees = User::join('role_user','role_user.user_id','=','users.id')
            ->whereIn('role_id',[3])->where('id', '!=', auth()->user()->id)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        return view('admin.subTasks.edit2',compact('subtask','tags','taxtube_employees','dependent_subtasks','notice_of_subtask'));
    }

    public function updateSubTasks(Request $request)
    {
        if($request->sub_task_id != null){
            $subtask = SubTask::where('id',$request->sub_task_id)->first();
            $subtask->update($request->all());
            if($request->dependence == 'First Sub-Task Not Dependent'){
                $subtask->update(['dependence' => 0]); 
            }
        }
        return redirect()->route('admin.sub-tasks.index');   
    }

    public function showSubTasks(Request $request)
    {
       if($request->subtask_id != null){
        $subTask = SubTask::with('task','department','assigned_employee','company')->where('id',$request->subtask_id)->first();
       }
       return view('admin.subTasks.show2',compact('subTask'));
    }
}
