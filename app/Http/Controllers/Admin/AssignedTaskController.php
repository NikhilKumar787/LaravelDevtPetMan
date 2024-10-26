<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAssignedTaskRequest;
use App\Http\Requests\StoreAssignedTaskRequest;
use App\Http\Requests\UpdateAssignedTaskRequest;
use App\Models\AssignedTask;
use App\Models\AssignedTaskDetail;
use App\Models\Company;
use App\Models\Department;
use App\Models\DepartmentHead;
use App\Models\InvoiceDetail;
use App\Models\Task;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Group;
use App\Models\Term;
use App\Models\Country;
use App\Models\UserAddress;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AssignedTaskController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('assigned_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $filter_customer_id = $request->input('customer_id');
            $filter_date_id= $request->input('date_id');
            $filter_status_id= $request->input('status_id');
            if(auth()->user()->roles[0]->id == 3){
                if($request->comp_id == 0){
                    $query = AssignedTask::with(['sub_task','assigned_to', 'company', 'user', 'status','assignedTaskDetails'])
                    ->where('assigned_to_id',auth()->user()->id)->select(sprintf('%s.*', (new AssignedTask())->table));
                }else{
                    $query = AssignedTask::with(['assigned_to', 'company', 'user', 'status','assignedTaskDetails'])
                    ->where('assigned_to_id',auth()->user()->id)->where('company_id',$request->comp_id)->select(sprintf('%s.*', (new AssignedTask())->table));
                }
            } else {
                $query = AssignedTask::with(['assigned_to', 'company', 'user', 'status','assignedTaskDetails'])->select(sprintf('%s.*', (new AssignedTask())->table));
            }
            if ($filter_customer_id == 'customer' && $filter_date_id == 'date' && $filter_status_id == 'status') {
                $query->select(sprintf('%s.*', (new AssignedTask())->table))->get();
            } else {
                if ($filter_customer_id != 'customer') {
                    $query->where('customer_id', $filter_customer_id)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                }
                if ($filter_status_id != 'status') {
                    $query->where('status_id', $filter_status_id)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                }
                if ($filter_date_id != 'date') {
                    switch ($filter_date_id) 
                    {
                        case 'today':
                            $query->whereDate('created_at', Carbon::today())->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'yesterday':
                            $query->whereDate('created_at', Carbon::yesterday())->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'this_week':
                            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'last_week':
                            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'this_month':
                            $query->whereMonth('created_at', Carbon::now()->month)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'last_month':
                            $query->whereMonth('created_at', Carbon::now()->subMonth()->month)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'this_year':
                            $query->whereYear('created_at', Carbon::now()->year)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                        case 'last_year':
                            $query->whereYear('created_at', Carbon::now()->subYear()->year)->select(sprintf('%s.*', (new AssignedTask())->table))->get();
                            break;
                    }  
                }
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
           

            $table->editColumn('actions', function ($row) {
                $assignedTaskGate = 'assigned_task_access';
                $viewGate = 'assigned_task_show';
                $editGate = 'assigned_task_edit';
                $deleteGate = 'assigned_task_delete';
                $crudRoutePart = 'assigned-tasks';
                $invoice_details = Invoice::where('id',$row->model_id)->first();
                $customer_details = Customer::where('id',$row->customer_id)->first();
                $company_details = Company::where('id',$row->company_id)->first();
                if($row->dependence == 0 && $row->dependence == null){
                    $assigned_tasks = null;
                }else{
                    $assigned_tasks = AssignedTask::where('dependence',$row->dependence)->get();
                    foreach($assigned_tasks as $dependent_task){
                        $assigned_task_data = AssignedTask::with('assignedTaskDetails')->where('sub_task_id',$dependent_task->dependence)->first(); 
                        if($assigned_task_data != null){
                            $assigned_tasks = $assigned_task_data->status_id;
                        }
                    }                   
                }
                return view('partials.datatablesActions', compact(
                'assignedTaskGate',
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'invoice_details',
                'customer_details',
                'company_details',
                'assigned_tasks',
                'row',
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
            });

            $table->addColumn('subtask_name', function ($row){
                if($row->sub_task != ''){
                    $subtask_name = $row->sub_task ? $row->sub_task->name : '';
                }else{
                    $subtask_name = $row->task ? $row->task->name : '';
                }
                return $subtask_name;
            });

            $table->addColumn('customer_name', function ($row) {
                $customer = Customer::where('id',$row->customer_id)->first();
                if(isset($customer)){
                    return $customer->first_name.' '.$customer->middle_name.' '.$customer->last_name ? $customer->first_name.' '.$customer->middle_name.' '.$customer->last_name : ''; 
                }
            });
            
            $table->addColumn('assigned_to_name', function ($row) {
                return $row->assigned_to ? $row->assigned_to->name : '';
            });

            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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

            $table->addColumn('hours_estimation', function ($row) {
                return $row->hours_estimation ? $row->hours_estimation : '';
            });

            $table->editColumn('is_approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_approved ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'task', 'assigned_to', 'company', 'user', 'requirement', 'proof_of_work', 'status', 'is_approved']);

            return $table->make(true);
           
        }
              
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $company_id = isset($_COOKIE['comp_name']) ? $_COOKIE['comp_name']: 0;
        if($company_id == 0){
            $customer_details = AssignedTask::with('customer')->where('assigned_to_id',auth()->user()->id)->get();
        }else{
            $customer_details = AssignedTask::with('customer')->where('assigned_to_id',auth()->user()->id)->where('company_id',$company_id)->get();
        }
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::pluck('name','id')->prepend(trans('global.pleaseSelect'),'');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedTasks.index',compact('statuses','customer_details','states','cities','groups','countries','terms','company_id'));
    }

    public function create()
    {
        abort_if(Gate::denies('assigned_task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $departments = Department::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.assignedTasks.create', compact('assigned_tos', 'companies', 'statuses', 'tasks', 'users','departments'));
    }

    public function agents(Request $request){
       $users =  User::join('department_user','department_user.user_id','=','users.id')->where('department_user.department_id',$request->department_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
       $assigned_to_users = []; 
       foreach($users as $key =>$user){
            $assigned_to_users[] = ['id'=>$key,'text'=>$user];
        }
       return response()->json($assigned_to_users);
    } 

    public function users(Request $request){
        $company =  Company::where('id',$request->company_id)->first();
        $company->load('users');
        if($company->users){
            $users = $company->users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        $company_users = []; 
        foreach($users as $key =>$user){
             $company_users[] = ['id'=>$key,'text'=>$user];
         }
        return response()->json($company_users);
    } 

    public function store(StoreAssignedTaskRequest $request)
    {
        $assignedTask = AssignedTask::create($request->all());

        foreach ($request->input('requirement', []) as $file) {
            $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
        }

        foreach ($request->input('proof_of_work', []) as $file) {
            $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $assignedTask->id]);
        }

        return redirect()->route('admin.assigned-tasks.index');
    }

    public function edit(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedTask->load('task', 'assigned_to', 'company', 'user', 'status');

        return view('admin.assignedTasks.edit', compact('assignedTask', 'assigned_tos', 'companies', 'statuses', 'tasks', 'users'));
    }

    public function update(UpdateAssignedTaskRequest $request, AssignedTask $assignedTask)
    {
        $assignedTask->update($request->all());

        if (count($assignedTask->requirement) > 0) {
            foreach ($assignedTask->requirement as $media) {
                if (!in_array($media->file_name, $request->input('requirement', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedTask->requirement->pluck('file_name')->toArray();
        foreach ($request->input('requirement', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('requirement');
            }
        }

        if (count($assignedTask->proof_of_work) > 0) {
            foreach ($assignedTask->proof_of_work as $media) {
                if (!in_array($media->file_name, $request->input('proof_of_work', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assignedTask->proof_of_work->pluck('file_name')->toArray();
        foreach ($request->input('proof_of_work', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assignedTask->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('proof_of_work');
            }
        }

        return redirect()->route('admin.assigned-tasks.index');
    }

    public function show(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTask->load('task', 'assigned_to', 'company', 'user', 'status','assignedTaskAssignedSubTasks');

        return view('admin.assignedTasks.show', compact('assignedTask'));
    }

    public function destroy(AssignedTask $assignedTask)
    {
        abort_if(Gate::denies('assigned_task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignedTask->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssignedTaskRequest $request)
    {
        AssignedTask::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('assigned_task_create') && Gate::denies('assigned_task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AssignedTask();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function tracker(Request $request){
        $carbon = Carbon::now();
        $data['date'] = date('Y-m-d');
        $data['assigned_task_id'] = $request->assigned_task_id;
        $data['user_id'] = auth()->user()->id;
        $data['team_id'] = auth()->user()->team_id;
        $data['start_time'] = $carbon->format('Y-m-d H:i:s');
        $assignedTask = AssignedTask::where('id',$request->assigned_task_id)->first();
        $data['task_id'] = $assignedTask->task_id;
        $data['company_id'] = $assignedTask->company_id;

        if($request->tracker_id){
            $assignedTaskDetail = AssignedTaskDetail::where('id',$request->tracker_id)->first();
            $assignedTaskDetail = $assignedTaskDetail->update([
                'date' => date('Y-m-d'),
                'end_time' => $carbon->format('Y-m-d H:i:s'),
                'description' => $request->description,
                'status_id' => $request->status,
            ]);
            
            if($request->status == 4){
                $assignedTask->completed_date = $carbon->format('Y-m-d');
                $assignedTaskDetails = AssignedTaskDetail::where('assigned_task_id',$assignedTask->id)->get();
                $diff = 0;
                foreach($assignedTaskDetails as $atd){
                    $to = Carbon::createFromFormat('Y-m-d H:i:s', $atd->start_time);
                    $from = Carbon::createFromFormat('Y-m-d H:i:s', $atd->end_time);
                    $diff += $to->diffInMinutes($from);
                    
                }
                $hours = floor($diff / 60).':'.($diff -   floor($diff / 60) * 60);
                $assignedTask->hours_estimation = $hours;
                $assignedTask->save();
            }
            $response = ['status'=>1];
        }else{
            $assignedTaskDetail = AssignedTaskDetail::create($data);
            $response = ['status'=>2,'tracker_id'=>$assignedTaskDetail->id];
        }
        return response()->json($response);
    }
    
    public function getCustomer(Request $request){
       
        $customer = Customer::where('id',$request->cust_id)->first();
        $customer_address = UserAddress::where('customer_id',$request->cust_id)->first();
        // dd($customer_address);
        $data =[
            'customer' => $customer,
            'customer_address' => $customer_address,
        ];

        return $data;
    }
    
    public function customerUpdate(Request $request)
    {
        $customer = Customer::where('id',$request->cust_id)->first();
        $params = array();
        parse_str($request->data, $params);
        $customer->update($params);
        if($request->term_id != ''){
            $customer->update(['term_id' => $request->term_id]);
        }
        $request = json_decode(json_encode($params), FALSE);
        $assignedtask = AssignedTask::where('customer_id',$request->cust_id)->get();
        foreach($assignedtask as $data){
            $data->update(['customer_request_status' => '2']);
        }
        return $customer;
    }
}