<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssignedSubTaskRequest;
use App\Http\Requests\StoreAssignedSubTaskRequest;
use App\Http\Requests\UpdateAssignedSubTaskRequest;
use App\Models\AssignedSubTask;
use App\Models\AssignedSubTaskDetail;
use App\Models\AssignedTask;
use App\Models\Company;
use App\Models\SubTask;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssignedSubTaskController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('assigned_sub_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            $query = AssignedSubTask::with(['task', 'assigned_to', 'company', 'user', 'status', 'assigned_task', 'team'])->where('assigned_to_id',auth()->user()->id)->select(sprintf('%s.*', (new AssignedSubTask())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $assignedSubTaskGate = 'assigned_sub_task_access';
                $viewGate = 'assigned_sub_task_show';
                $editGate = 'assigned_sub_task_edit';
                $deleteGate = 'assigned_sub_task_delete';
                $crudRoutePart = 'assigned-sub-tasks';

                return view('partials.datatablesActions', compact(
                'assignedSubTaskGate',
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
                return $row->company ? $row->company->company_name : '';
            });
            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('assigned_to_name', function ($row) {
                return $row->assigned_to ? $row->assigned_to->name : '';
            });
            $table->editColumn('hours_estimation', function ($row) {
                return $row->hours_estimation ? $row->hours_estimation : '';
            });
            $table->editColumn('requirement', function ($row) {
                if (!$row->requirement) {
                    return '';
                }
                $links = [];
                foreach ($row->requirement as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('proof_of_work', function ($row) {
                if (!$row->proof_of_work) {
                    return '';
                }
                $links = [];
                foreach ($row->proof_of_work as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->editColumn('is_approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_approved ? 'checked' : null) . '>';
            });

            $table->addColumn('assigned_task_description', function ($row) {
                return $row->assigned_task ? $row->assigned_task->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'task', 'assigned_to', 'company', 'user', 'requirement', 'proof_of_work', 'status', 'is_approved', 'assigned_task']);

            return $table->make(true);
        }

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedSubTasks.index',compact('statuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_sub_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('username_for_pan_tan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_tasks = SubTask::pluck('name','id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedSubTasks.create', compact('sub_tasks', 'assigned_tasks', 'assigned_tos', 'companies', 'statuses', 'tasks', 'users'));
    }

    public function store(StoreAssignedSubTaskRequest $request)
    {
        $assignedSubTask = AssignedSubTask::create($request->all());

        foreach ($request->input('requirement', []) as $file) {
            $assignedSubTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
        }

        foreach ($request->input('proof_of_work', []) as $file) {
            $assignedSubTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assignedSubTask->id]);
        }

        return redirect()->route('admin.assigned-sub-tasks.index');
    }

    public function edit(AssignedSubTask $assignedSubTask)
    {
        abort_if(Gate::denies('assigned_sub_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    
        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sub_tasks = SubTask::pluck('name','id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tasks = AssignedTask::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedSubTask->load('task', 'assigned_to', 'company', 'user', 'status', 'assigned_task', 'team');

        return view('admin.assignedSubTasks.edit', compact('sub_tasks', 'assignedSubTask', 'assigned_tasks', 'assigned_tos', 'companies', 'statuses', 'tasks', 'users'));
    }

    public function update(UpdateAssignedSubTaskRequest $request, AssignedSubTask $assignedSubTask)
    {
        $assignedSubTask->update($request->all());

        if (count($assignedSubTask->requirement) > 0) {
            foreach ($assignedSubTask->requirement as $media) {
                if (!in_array($media->file_name, $request->input('requirement', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedSubTask->requirement->pluck('file_name')->toArray();
        foreach ($request->input('requirement', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedSubTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
            }
        }

        if (count($assignedSubTask->proof_of_work) > 0) {
            foreach ($assignedSubTask->proof_of_work as $media) {
                if (!in_array($media->file_name, $request->input('proof_of_work', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedSubTask->proof_of_work->pluck('file_name')->toArray();
        foreach ($request->input('proof_of_work', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedSubTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
            }
        }

        return redirect()->route('admin.assigned-sub-tasks.index');
    }

    public function show(AssignedSubTask $assignedSubTask)
    {
        abort_if(Gate::denies('assigned_sub_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedSubTask->load('task', 'assigned_to', 'company', 'user', 'status', 'assigned_task', 'team');

        return view('admin.assignedSubTasks.show', compact('assignedSubTask'));
    }

    public function destroy(AssignedSubTask $assignedSubTask)
    {
        abort_if(Gate::denies('assigned_sub_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedSubTask->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignedSubTaskRequest $request)
    {
        AssignedSubTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('assigned_sub_task_create') && Gate::denies('assigned_sub_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AssignedSubTask();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function tracker(Request $request){
        $carbon = Carbon::now();
        $data['date'] = date('Y-m-d');
        $data['assigned_sub_task_id'] = $request->assigned_sub_task_id;
        $data['user_id'] = auth()->user()->id;
        $data['team_id'] = auth()->user()->team_id;
        $data['start_time'] = $carbon->format('Y-m-d H:i:s');
        $assignedSubTask = AssignedSubTask::where('id',$request->assigned_sub_task_id)->first();
        $data['sub_task_id'] = $assignedSubTask->sub_task_id;

        if($request->tracker_id){
            $assignedSubTaskDetail = AssignedSubTaskDetail::where('id',$request->tracker_id)->first();
            $assignedSubTaskDetail = $assignedSubTaskDetail->update([
                'date' => date('Y-m-d'),
                'end_time' => $carbon->format('Y-m-d H:i:s'),
                'description' => $request->description,
                'status_id' => $request->status
            ]);
            
            if($request->status == 4){
                $assignedSubTask->completed_date = $carbon->format('Y-m-d');
                $assignedSubTaskDetails = AssignedSubTaskDetail::where('assigned_task_id',$assignedSubTask->id)->get();
                $diff = 0;
                foreach($assignedSubTaskDetails as $atd){
                    $to = Carbon::createFromFormat('Y-m-d H:i:s', $atd->start_time);
                    $from = Carbon::createFromFormat('Y-m-d H:i:s', $atd->end_time);
                    $diff += $to->diffInMinutes($from);
                    
                }
                $hours = floor($diff / 60).':'.($diff -   floor($diff / 60) * 60);
                $assignedSubTask->hours_estimation = $hours;
                $assignedSubTask->save();
            }
            $response = ['status'=>1];
        }else{
            $assignedSubTaskDetail = AssignedSubTaskDetail::create($data);
            $response = ['status'=>2,'tracker_id'=>$assignedSubTaskDetail->id];
        }
        return response()->json($response);
    }
}
