<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AssignedTask;
use App\Models\AssignedTaskDetail;
use App\Models\Company;
use App\Models\Department;
use App\Models\InvoiceDetail;
use App\Models\Task;
use App\Models\Customer;
use App\Models\DepartmentHead;
use App\Models\Invoice;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


use function PHPUnit\Framework\returnSelf;
class ManageTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('assigned_task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $department  = $request->department;
        $department = DepartmentHead::where('id',$request->department)->first();

        if ($request->ajax()) {
            if(auth()->user()->roles[0]->id == 3){
                $query = AssignedTask::with(['task', 'assigned_to', 'company', 'user', 'status','assignedTaskDetails'])
                ->where('assigned_to_id',auth()->user()->id)
                ->select(sprintf('%s.*', (new AssignedTask())->table));
            } else {
                $department_id = $department->department_id;
                $query = AssignedTask::with(['assigned_to', 'company', 'user', 'status','assignedTaskDetails'])->where('department_id',$department_id)->where('company_id',$department->company_id)->select(sprintf('%s.*', (new AssignedTask())->table));
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
           

            $table->editColumn('actions', function ($row) {
                $viewGate = 'assigned_task_show';
                $editGate = 'assigned_task_edit';
                $deleteGate = 'assigned_task_delete';
                $crudRoutePart = 'assigned-tasks';
                $invoice_details = Invoice::where('id',$row->model_id)->first();
                $customer_details = Customer::where('id',$row->customer_id)->first();
                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'invoice_details',
                'customer_details',
                'row',
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('task_name', function ($row) {
                return $row->task ? $row->task->name : '';
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

            $table->addColumn('company_username_for_pan_tan', function ($row) {
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

            $table->rawColumns(['actions', 'placeholder','assigned_to', 'company', 'user', 'requirement', 'proof_of_work', 'status', 'is_approved']);

            return $table->make(true);
           
        }

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.manageTask.index',compact('statuses','department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
