<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Department;
use App\Models\DepartmentFuncation;
use App\Models\DepartmentHead;
use App\Models\Task;
use App\Models\TaskEmployeeListing;
use App\Models\TaskTag;
use Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $company_id = $_COOKIE['comp_name'];
            if($company_id == 0){
                    $department_head = DepartmentHead::where('head_of_department_id',auth()->user()->id)->get();
                    $head_departments = [];
                    foreach($department_head as $data){ 
                        $head_departments[] = $data->department_id; 
                    }
                    $query = Task::with(['department', 'tags'])->whereIn('department_id',$head_departments)->select(sprintf('%s.*', (new Task())->table));
            }else{
                if(auth()->user()->id == 1){
                    $query = Task::with(['department', 'tags'])->select(sprintf('%s.*', (new Task())->table));
                }else{
                    $department_head = DepartmentHead::where('company_id',$company_id)->where('head_of_department_id',auth()->user()->id)->get();
                    $head_departments = [];
                    foreach($department_head as $data){ 
                        $head_departments[] = $data->department_id; 
                    }
                    $query = Task::with(['department', 'tags'])->whereIn('department_id',$head_departments)->select(sprintf('%s.*', (new Task())->table));
                }
            }
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'task_show';
                $editGate = 'task_edit';
                $deleteGate = 'task_delete';
                $crudRoutePart = 'tasks';
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
            $table->addColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('frequency', function ($row) {
                return $row->frequency ? Task::FREQUENCY_SELECT[$row->frequency] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'department', 'tag', 'attachment']);

            return $table->make(true);
        }
        $assigned_employees = User::join('role_user','role_user.user_id','=','users.id')
        ->whereIn('role_id',[3])->where('id', '!=', auth()->user()->id)
        ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.index',compact('assigned_employees'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        return view('admin.tasks.create', compact('departments','tags'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $department_funcation = DepartmentFuncation::where('id',$task->funcation_id)->pluck('funcation_name','id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $task->load('department','departmentFuncation', 'tags');

        return view('admin.tasks.edit', compact('departments', 'department_funcation','tags', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            if (!$task->attachment || $request->input('attachment') !== $task->attachment->file_name) {
                if ($task->attachment) {
                    $task->attachment->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($task->attachment) {
            $task->attachment->delete();
        }

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('department', 'tags','taskSubTasks');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function getFuncation(Request $request){
        $departmentFuncation = DepartmentFuncation::where('department_id',$request->type_id)->pluck('funcation_name','id');
        return $departmentFuncation;
    }

    public function assignedTaskEmployee(Request $request)
    {
        if($request->company_id != null && $request->assigned_to_id != null){
            if($request->assigned_employee_id != null){
                $task_employee_listing = TaskEmployeeListing::where('id',$request->assigned_employee_id)->first();
                $task_employee_listing->update([
                    'department_id' => $request->department_id,
                    'task_id' => $request->task_id,
                    'company_id' => $request->company_id,
                    'assigned_to_id' => $request->assigned_to_id,
                ]); 
            }elseif($request->assigned_employee_id == null){
                $task_employee_listing = TaskEmployeeListing::create([
                    'department_id' => $request->department_id,
                    'task_id' => $request->task_id,
                    'company_id' => $request->company_id,
                    'assigned_to_id' => $request->assigned_to_id,
                ]);

            }
        }
        return back();
    }
}
