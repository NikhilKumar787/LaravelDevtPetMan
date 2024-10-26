<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\BankDetail;
use App\Models\Customer;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\AssignedSubTask;
use App\Models\AssignedTask;
use App\Models\Category;
use App\Models\GST;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\State;
use App\Models\City;
use App\Models\Term;
use App\Models\Group;
use App\Models\Product;
use App\Models\Company;
use App\Models\Task;
use App\Models\CustomFields;
use App\Models\Team;
use App\Models\TermsAndcondition;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Gate;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\CustomFieldMapping;
use App\Models\CustomFieldValue;
use App\Models\DepartmentHead;
use App\Models\InvoicePayment;
use App\Models\SubTask;
use App\Models\TaskEmployeeListing;
use App\Models\UserAlert;
use Mockery\Undefined;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use function GuzzleHttp\Promise\all;

class InvoicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $filter_customer_id = $request->input('customer_id');
            $filter_date_id = $request->input('date_id');
            $filter_status_id = $request->input('status_id');
            $gettype = $request->input('type');
            $company = \DB::table('company_role_user')->where('user_id', auth()->user()->id)->first();
            if ($company == null) {
                $user = User::where('id', auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id', $user->team_id)->first();
                $company_id = $company_role_user->company_id;
            } else {
                $company_id = $company->company_id;
            }
            if ($gettype == 'myrequests') {
                $user = User::where('id', auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id', $user->id)->first();
                if ($company_role_user->role_id != 0) {
                    $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_request', 1)->where('company_id', $company_id);
                } elseif ($company_role_user->role_id == 0) {
                    $user_role = \DB::table('role_user')->where('user_id',$company_role_user->user_id)->first();
                    if($user_role->role_id == 4){
                        $head_team_members = \DB::table('team_head_team_members_listing')->where('team_head',$user_role->user_id)->get();
                        foreach($head_team_members as $team_member){
                            $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_request', 1)->where('company_id', $company_id)->whereIn('created_by_id', [$user_role->user_id,$team_member->team_member]);
                        }
                    }else{
                        $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_request', 1)->where('company_id', $company_id)->where('created_by_id', auth()->user()->id);
                    }
                }
            } elseif ($gettype == 'paid') {
                $user = User::where('id', auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id', $user->id)->first();
                if ($company_role_user->role_id != 0) {
                    $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 1)->where('company_id', $company_id);
                } elseif ($company_role_user->role_id == 0) {
                    $user_role = \DB::table('role_user')->where('user_id',$company_role_user->user_id)->first();
                    if($user_role->role_id == 4){
                        $head_team_members = \DB::table('team_head_team_members_listing')->where('team_head',$user_role->user_id)->get();
                        foreach($head_team_members as $team_member){
                            $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 1)->where('company_id', $company_id)->whereIn('created_by_id', [$user_role->user_id,$team_member->team_member]);
                        }
                    }else{
                        $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 1)->where('company_id', $company_id)->where('created_by_id', auth()->user()->id);
                    }
                }            
            } elseif ($gettype == 'unpaid') {
                $user = User::where('id', auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id', $user->id)->first();
                if ($company_role_user->role_id != 0) {
                    $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 0)->where('company_id', $company_id);
                } elseif ($company_role_user->role_id == 0) {
                    $user_role = \DB::table('role_user')->where('user_id',$company_role_user->user_id)->first();
                    if($user_role->role_id == 4){
                        $head_team_members = \DB::table('team_head_team_members_listing')->where('team_head',$user_role->user_id)->get();
                        foreach($head_team_members as $team_member){
                            $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 0)->where('company_id', $company_id)->whereIn('created_by_id', [$user_role->user_id,$team_member->team_member]);
                        }
                    }else{
                        $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status', 0)->where('company_id', $company_id)->where('created_by_id', auth()->user()->id);
                    }
                }
            } else {
                $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('company_id', $company_id)->select(sprintf('%s.*', (new Invoice())->table))->get();
            }

            // Apply Filters here!;
            if ($filter_customer_id == 'customer' && $filter_date_id == 'date' && $filter_status_id == 'status') {
                $query->select(sprintf('%s.*', (new Invoice())->table))->get();
            } else {
                if($filter_customer_id != 'customer') {
                    $query->where('customer_id', $filter_customer_id)->select(sprintf('%s.*', (new Invoice())->table))->get();
                }
                if($filter_status_id != 'status') {
                    $query->where('is_employee_approved', $filter_status_id)->select(sprintf('%s.*', (new Invoice())->table))->get();
                }
                if($filter_date_id != 'date') {
                    switch ($filter_date_id) {
                        case 'today':
                            $query->whereDate('created_at', Carbon::today())->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'yesterday':
                            $query->whereDate('created_at', Carbon::yesterday())->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'this_week':
                            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'last_week':
                            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'this_month':
                            $query->whereMonth('created_at', Carbon::now()->month)->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'last_month':
                            $query->whereMonth('created_at', Carbon::now()->subMonth()->month)->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'this_year':
                            $query->whereYear('created_at', Carbon::now()->year)->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                        case 'last_year':
                            $query->whereYear('created_at', Carbon::now()->subYear()->year)->select(sprintf('%s.*', (new Invoice())->table))->get();
                            break;
                    }
                   
                }
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $invoice_main_id = $row->id;
                $user_alert = UserAlert::where('model_id', $row->id)->first();
                $read_id = 1;
                if ($user_alert != null) {
                    $read = \DB::table('user_user_alert')->where('user_alert_id', $user_alert->id)->first();
                    if ($read != null) {
                        $read_id = $read->read;
                    }
                }
                $assigned_task = AssignedTask::where('model_type','invoice_creation')->where('model_id', $row->id)->first();
                    if ($assigned_task != null) {
                        $invoice_status = $assigned_task->status_id;
                        $request_type = 'myrequest';
                    } else {
                        // unpaid
                        $invoice_status = '';
                        $request_type = 'unpaid';
                    }

                $approveGate = 'invoice_approve';
                $viewGate = 'invoice_show';
                $editGate = 'invoice_edit';
                $deleteGate = 'invoice_delete';
                $crudRoutePart = 'invoices';

                return view('partials.customer_datatablesActions', compact(
                    'approveGate',
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'invoice_status',
                    'request_type',
                    'row',
                    'read_id',
                )
                );
            });

            $table->editColumn('invoice_no', function ($row) {
                return $row->invoice_no ? $row->invoice_no : '';
            });

            $table->addColumn('customer_name', function ($row) {
                return $row->customer->company ? $row->customer->company : '';
            });
            $table->editColumn('total_payable_amount', function ($row) {
                return $row->total_payable_amount ? $row->total_payable_amount : '';
            });

            $table->editColumn('invoice_request_status', function ($row) {
                $assigned_task = AssignedTask::with('status')->where('model_type','invoice_creation')->where('model_id', $row->id)->first();
                    if ($assigned_task != null) {
                        return $assigned_task->status->name ? $assigned_task->status->name : '';
                    }
            });

            $table->editColumn('payment_status', function ($row) {
                if ($row->total_payable_amount == $row->remaining_payable_amount) {
                    $payment_status = "Payment Fully Due";
                } elseif ($row->remaining_payable_amount == 0.00) {
                    $payment_status = "Payment Deposited";
                } else {
                    $payment_status = "Parially Paid ₹" . $row->total_payable_amount - $row->remaining_payable_amount ." Due Amount  ₹".  $row->remaining_payable_amount;
                }
                return $payment_status ? $payment_status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer']);

            return $table->make(true);
        }
        // Get the values of Progress Bar here.
        $total_amount_deposited = 0.00;
        $total_amount_overdue_invoices = 0.00;
        $total_amount_notdue_invoices = 0.00;
        $total_amount_unpaid_invoices = 0.00;
        $total_invoices_amount = 0.00;
        $total_undeposited_amount = 0.00;

        $company = \DB::table('company_role_user')->where('user_id', auth()->user()->id)->first();
            if ($company == null) {
                $user = User::where('id', auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id', $user->team_id)->first();
                $company_id = $company_role_user->company_id;
            } else {
                $company_id = $company->company_id;
            }

        if ($company != null) {
            $user = User::where('id',auth()->user()->id)->first();
            if($user->team_id == null){
                $total_amount_for_paid = Invoice::where('company_id', $company->company_id)->get();
                foreach ($total_amount_for_paid as $total_amount) {
                    $total_invoices_amount += $total_amount->total_payable_amount;
                }
                $deposited_amount = InvoicePayment::where('company_id', $company->company_id)->get();
                if ($deposited_amount != '') {
                    foreach ($deposited_amount as $deposit_amount) {
                        $total_amount_deposited += $deposit_amount->received_amount;
                    }
                }
                $unpaid_invoices = Invoice::where('company_id', $company->company_id)->get();
                foreach ($unpaid_invoices as $unpaid_amount) {
                    $total_amount_unpaid_invoices += $unpaid_amount->remaining_payable_amount;
                }
                $notdue_invoices = Invoice::where('company_id', $company->company_id)->where('created_at', '>=', Carbon::now()->subdays(15))->get();
                foreach ($notdue_invoices as $notdue_amount) {
                    $total_amount_notdue_invoices += $notdue_amount->remaining_payable_amount;
                }
                $total_amount_overdue_invoices = $total_amount_unpaid_invoices - $total_amount_notdue_invoices;
                $total_undeposited_amount = $total_invoices_amount - $total_amount_deposited;
            }
            elseif($user->team_id != null){ 
                $user_role = \DB::table('role_user')->where('user_id',$user->id)->first();
                if($user_role->role_id == 4){
                    $head_team_members = \DB::table('team_head_team_members_listing')->where('team_head',$user_role->user_id)->get();
                        foreach($head_team_members as $team_member){
                            $total_amount_for_paid = Invoice::where('company_id', $company->company_id)->whereIn('created_by_id',[$user_role->user_id,$team_member->team_member])->get();
                            $deposited_amount = InvoicePayment::where('company_id', $company->company_id)->whereIn('deposited_by_id',[$user_role->user_id,$team_member->team_member])->get();
                            $unpaid_invoices = Invoice::where('company_id', $company->company_id)->whereIn('created_by_id',[$user_role->user_id,$team_member->team_member])->get();
                            $notdue_invoices = Invoice::where('company_id', $company->company_id)->whereIn('created_by_id',[$user_role->user_id,$team_member->team_member])->where('created_at', '>=', Carbon::now()->subdays(15))->get();
                        }
                    foreach ($total_amount_for_paid as $total_amount) {
                        $total_invoices_amount += $total_amount->total_payable_amount;
                    }
                    if ($deposited_amount != '') {
                        foreach ($deposited_amount as $deposit_amount) {
                            $total_amount_deposited += $deposit_amount->received_amount;
                        }
                    }
                    foreach ($unpaid_invoices as $unpaid_amount) {
                        $total_amount_unpaid_invoices += $unpaid_amount->remaining_payable_amount;
                    }
                    foreach ($notdue_invoices as $notdue_amount) {
                        $total_amount_notdue_invoices += $notdue_amount->remaining_payable_amount;
                    }
                    $total_amount_overdue_invoices = $total_amount_unpaid_invoices - $total_amount_notdue_invoices;
                    $total_undeposited_amount = $total_invoices_amount - $total_amount_deposited;

                }else{
                    $total_amount_for_paid = Invoice::where('company_id', $company->company_id)->where('created_by_id',auth()->user()->id)->get();
                    foreach ($total_amount_for_paid as $total_amount) {
                        $total_invoices_amount += $total_amount->total_payable_amount;
                    }
                    $deposited_amount = InvoicePayment::where('company_id', $company->company_id)->where('deposited_by_id',auth()->user()->id)->get();
                    if ($deposited_amount != '') {
                        foreach ($deposited_amount as $deposit_amount) {
                            $total_amount_deposited += $deposit_amount->received_amount;
                        }
                    }
                    $unpaid_invoices = Invoice::where('company_id', $company->company_id)->where('created_by_id',auth()->user()->id)->get();
                    foreach ($unpaid_invoices as $unpaid_amount) {
                        $total_amount_unpaid_invoices += $unpaid_amount->remaining_payable_amount;
                    }
                    $notdue_invoices = Invoice::where('company_id', $company->company_id)->where('created_by_id',auth()->user()->id)->where('created_at', '>=', Carbon::now()->subdays(15))->get();
                    foreach ($notdue_invoices as $notdue_amount) {
                        $total_amount_notdue_invoices += $notdue_amount->remaining_payable_amount;
                    }
                    $total_amount_overdue_invoices = $total_amount_unpaid_invoices - $total_amount_notdue_invoices;
                    $total_undeposited_amount = $total_invoices_amount - $total_amount_deposited;
                }
            }

        // Deside the Role of Team and Customer. 
        if ($company == null) {
            $user = User::where('id', auth()->user()->id)->first();
            $company_role_user = \DB::table('company_role_user')->where('user_id', $user->team_id)->first();
            $company_id = $company_role_user->company_id;

        } else {
            $company_id = $company->company_id;
        }
        if ($company->role_id != 0) {
            $customer_details = Customer::where('company_id', $company_id)->get();
        } elseif ($company->role_id == 0) {
            $user_role = \DB::table('role_user')->where('user_id',$company->user_id)->first();
            if($user_role->role_id == 4){
                $head_team_members = \DB::table('team_head_team_members_listing')->where('team_head',$user_role->user_id)->get();
                    foreach($head_team_members as $team_member){
                        $customer_details = Customer::where('company_id', $company_id)->whereIn('created_by_id', [$user_role->user_id,$team_member->team_member])->get();
                    }
            }else{
                $customer_details = Customer::where('company_id', $company_id)->where('created_by_id', auth()->user()->id)->get();
            }
        }
    }

    return view('customer.invoices.index', compact('customer_details', 'total_amount_deposited', 'total_amount_unpaid_invoices', 'total_amount_notdue_invoices', 'total_amount_overdue_invoices', 'total_invoices_amount', 'total_undeposited_amount'));
     
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $current_user_id = auth()->user()->id;
        $company = \DB::table('company_role_user')->where('user_id', $current_user_id)->first();
        if ($company == null) {
            $user = User::where('id', auth()->user()->id)->first();
            $company_role_user = \DB::table('company_role_user')->where('user_id', $user->team_id)->first();
            $company = $company_role_user->company_id;
        } else {
            $company = $company->company_id;
        }
        $gsts = GST::all();
        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $place_of_supplies = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::pluck('name','id')->prepend(trans('global.pleaseSelect'),'');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::pluck('name', 'id');
        $company = Company::with('state','city')->where('id', $company)->first();
        $invoice = Invoice::where('company_id', $company)->first();
        $terms_and_conditions = TermsAndcondition::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $banks = BankDetail::where('company_id',$company->id)->get();
        return view('customer.invoices.create', compact('invoice','customers', 'place_of_supplies','states','groups','terms','products','countries','account_names', 'account_types', 'categories','company','terms_and_conditions','cities','banks', 'gsts'));
    }

    public function store(StoreInvoiceRequest $request)
    { 
        $current_user_id = auth()->user()->id;
        $total_amount = 0;
        $total_tax_amount = 0;
        $invoice = Invoice::create($request->all());

        $invoice->update([
            'created_by_id' => $current_user_id,
            'company_id' => $request->comp_id,
            'customer_id' => $request->customer_id,
            'task_due_date' =>$request->task_due_date,
        ]);

        $user_alert = UserAlert::create([
            'alert_text' => 'You have a new invoice request',
            'alert_link' => 'https://dev.taxtube.in/customer/invoices?type=myrequests',
            'model_type' => 'invoice',
            'model_id' => $invoice->id,
        ]);
        $user_user_alert = \DB::table('user_user_alert')->insert([
            'user_alert_id' => $user_alert->id,
            'user_id' => $current_user_id,
            'read' => '0',

        ]);
        // if (isset(auth()->user()->team_id)) {
        //     $invoice->update([
        //         'team_id' => auth()->user()->team_id,
        //     ]);
        // }

        if ($request->product_id != '') {
            for ($i = 0; $i < count($request->product_id); $i++) {
                $product[$i]['qty'] = $request->quantity[$i];
                $product[$i]['rate'] = $request->rate[$i];
                $product[$i]['amount'] = $request->amount_inv[$i];
                $product[$i]['tax'] = $request->tax_gst[$i];
                $product[$i]['invoice_id'] = $invoice->id;
                $product[$i]['product_id'] = $request->product_id[$i];
                if (isset(auth()->user()->team)) {
                    $product[$i]['team_id'] = auth()->user()->team->id;
                }
            }
            $invoice_detail = InvoiceDetail::insert($product);

        }

        $invoicedetails = InvoiceDetail::where('invoice_id', $invoice->id)->get();
        foreach ($invoicedetails as $data) {
            $total_amount += $data->amount;
            $total_tax_amount += $data->amount * ($data->tax / 100);
        }
        $invoice->update([
            'invoice_request' => '1',
            'total_amount' => $total_amount,
            'total_tax_amount' => $total_tax_amount,
            'remaining_payable_amount' => $total_tax_amount + $total_amount,
            'total_payable_amount' => $total_tax_amount + $total_amount,
        ]);

        // foreach($request->custom_field_id as $key => $data)
        // {
        //     $custom_field_mapping = CustomFieldMapping::where('custom_field_id', $key)->where('custom_field_request_type','invoice')->first();
        //     $custom_field['custom_field_id'] = $key;
        //     $custom_field['custom_field_request_id'] = $invoice->id;
        //     $custom_field['custom_field_map_id'] = $custom_field_mapping->id;
        //     $custom_field['custom_field_value'] = $data; 

        //     $custom_field_invoice = CustomFieldValue::create($custom_field);
        // }

        $customer = Customer::where('id', $request->customer_id)->first();
        if ($customer->is_employee_approved == 0) {
            $customer_request_status = '1';
        } else {
            $customer_request_status = '2';
        }
        $company = \DB::table('company_role_user')->where('user_id', auth()->user()->id)->first();
        if (isset($company)) {
            $assigned_task_employee = TaskEmployeeListing::where('task_id',1)->where('company_id', $company->company_id)->first();
            if(isset($assigned_task_employee)){
                $assigned_task = AssignedTask::create([
                    'description' => 'Invoice request genrate through the user please Check and Approve it',
                    'task_id' => '1',
                    'target_date' => $request->target_date,
                    'department_id' => '1',
                    'assigned_to_id' => $assigned_task_employee->assigned_to_id,
                    'company_id' => $company->company_id,
                    'customer_id' => $request->customer_id,
                    'model_type' => 'invoice_creation',
                    'model_id' => $invoice->id,
                    'user_id' => auth()->user()->id,
                    'status_id' => '2',
                    'customer_request_status' => $customer_request_status,
                    'customer_id' =>$request->customer_id,
                ]);
            }else{
                $assigned_subtasks = SubTask::where('task_id',1)->where('company_id',$company->company_id)->get();
                foreach($assigned_subtasks as $sub_task){
                    $assigned_subtasks = AssignedTask::create([
                        'description' => $sub_task->description,
                        'target_date' => $request->target_date,
                        'task_id' => $sub_task->task_id,
                        'department_id' => '1',
                        'sub_task_id' => $sub_task->id,
                        'assigned_to_id' => $sub_task->assigned_id,
                        'dependence' => $sub_task->dependence,
                        'company_id' => $sub_task->company_id,
                        'customer_id' => $request->customer_id,
                        'model_type' => 'invoice_creation',
                        'model_id' => $invoice->id,
                        'user_id' => auth()->user()->id,
                        'status_id' => '2',
                        'customer_request_status' => $customer_request_status,
                        'customer_id' =>$request->customer_id,
                    ]);
                }
            }
        }
        return redirect()->route('customer.invoices.index', ['type' => 'myrequests']);
    }

    public function edit(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $place_of_supplies = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gsts = GST::all();

        $invoice->load('customer', 'place_of_supply', 'team');

        return view('customer.invoices.edit', compact('customers', 'invoice', 'place_of_supplies','gsts'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('customer.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('customer', 'place_of_supply', 'team', 'invoiceInvoiceDetails');

        return view('customer.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        Invoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function allInvoices(Request $request)
    {
        return view('customer.invoices.all-invoices');
    }
    public function products(Request $request)
    {
        return view('customer.invoices.products');
    }

    public function accept_invoice_request(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $update_invoice = Invoice::where('id', $invoice_id)->update(['invoice_request' => 2]);
        $invoice = Invoice::where('id', $invoice_id)->first();
        return $invoice;

    }

    public function pdf(Request $request)
    {
        $pan_no = '';
        $total_amount = 0;
        $invoice_id = $request->invoice;
        $data['invoice'] = Invoice::with(['customer', 'place_of_supply', 'bank_details'])->where('id', $invoice_id)->first();
        $company_id = $data['invoice']->company_id;
        $data['CustomFieldValues'] = CustomFieldValue::with(['custom_field_map','custom_fields' => function($cust_id)use($company_id){
            $cust_id->where('company_id',$company_id)->where('active_status',1)->withTrashed();
        }])->where('custom_field_request_id',$invoice_id)->get();
        $data['invoiceDetail'] = InvoiceDetail::with('product')->where('invoice_id', $invoice_id)->get();
        $data['customer'] = Customer::with('customerUserAddresses', 'city', 'state')->where('id', $invoice_id)->first();
        $data['company'] = Company::with(['city', 'state'])->where('id', $data['invoice']->company_id)->first();
        $company_owner = \DB::table('company_role_user')->where('company_id', $data['invoice']->company_id)->first();
        $data['company_user_details'] = User::where('id', $company_owner->user_id)->first();
        $gst_no = str_split($data['company']->gstin,true);
        if(isset($gst_no[11])){
            for($i=2;$i<12;$i++){
                $pan_no = $pan_no.$gst_no[$i];
            }
        }else{
           $pan_no = $data['company']->gstin; 
        }
        $data['pan_no'] = $pan_no;
        $tax_value = null;
        foreach ($data['invoiceDetail'] as $products) {
            $total_amount += $products->amount;
            $tax_value += $products->amount * ($products->tax / 100);
        }
        $data['tax_value'] = $tax_value;
        $data['total_amount'] = $total_amount;
        $data['total_payable_amount'] = $this->getIndianCurrency($total_amount + $tax_value);
        $data['tax_in_words'] = $this->getIndianCurrency($tax_value);
        $data['amount_in_words'] = $this->getIndianCurrency($total_amount);
        $pdf = PDF::loadView('customer.invoices.invoicePdf', $data)->setPaper('a4', 'portrait');
        return $pdf->stream($invoice_id . '.pdf');
    }

    public function getIndianCurrency(int $number)
    {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            100000 => 'lakh',
            10000000 => 'crore'
        );

        if (!is_numeric($number)) {
            return false;
        }

        // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        //     // overflow
        //     trigger_error(
        //         'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
        //         E_USER_WARNING
        //     );
        //     return false;
        // }

        if ($number < 0) {
            return $negative . $this->getIndianCurrency(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 100000:
                $thousands = ((int) ($number / 1000));
                $remainder = $number % 1000;

                $thousands = $this->getIndianCurrency($thousands);

                $string .= $thousands . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 10000000:
                $lakhs = ((int) ($number / 100000));
                $remainder = $number % 100000;

                $lakhs = $this->getIndianCurrency($lakhs);

                $string = $lakhs . ' ' . $dictionary[100000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 1000000000:
                $crores = ((int) ($number / 10000000));
                $remainder = $number % 10000000;

                $crores = $this->getIndianCurrency($crores);

                $string = $crores . ' ' . $dictionary[10000000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->getIndianCurrency($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->getIndianCurrency($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    // public function getCompanies(Request $request){
    //     $term = $request->q['term'];



    //     $companies = Company::where(function ($query) use($term) {
    //         $query->where('company_name', 'LIKE', "%$term%");
    //     })->select('companies.*', 'companies.company_name as name')
    //     ->get();

    //     $companies = $companies->toArray();
    //     if(empty($companies)){
    //         // $companies[] = [
    //         //     'id' => 0,
    //         //     'name' => 'Add New Company',
    //         // ];
    //         $companies = [];
    //     }
    //     echo json_encode($companies);
    // }

    public function getInvoice(Request $request)
    {
        if ($request->invoice_prefix) {
            $lastInvoice = Invoice::where([
                'company_id' => $request->comp_id,
                'invoice_prefix' => $request->invoice_prefix,
            ])->orderBy('id', 'desc')->first();
        } else {
            $lastInvoice = Invoice::where([
                'company_id' => $request->comp_id,
            ])->orderBy('id', 'desc')->first();
        }
        if (isset($lastInvoice->id)) {
            $invoiceNo = $lastInvoice->invoice_no + 1;
            $invoiceNo = str_pad($invoiceNo, 6, "0", STR_PAD_LEFT);
            $data = [
                'invoice_no' => $invoiceNo,
                'prefix' => $lastInvoice->invoice_prefix
            ];
        } else {
            $data = [
                'invoice_no' => '000001',
                'prefix' => ''
            ];
        }

        return $data;
    }

    public function getProductDetail(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        return $product;
    }

    public function getCustomer(Request $request)
    {
        $customer = Customer::leftjoin('terms', 'terms.id', '=', 'customers.term_id')
            ->select('customers.*', 'terms.credit_period', 'terms.credit_period_days')
            ->where('customers.id', $request->cust_id)
            ->first();
        return $customer;
    }

    public function getCustomFields(Request $request)
    {

        $custom_fields_data = CustomFields::where('company_id', $request->company_id)->get();
        $custom_fields_count = CustomFields::where('company_id', $request->company_id)->count();
        return view('admin.custom_fields.custom_fields_index', compact('custom_fields_data'));
    }

    public function countCustomFields(Request $request)
    {

        $custom_field_count = CustomFields::where('company_id', $request->company_id)->count();
        return $custom_field_count;

    }

    public function invoicePosted(Request $request){
        if($request->invoice != null){
            $invoices = Invoice::where('id',$request->invoice)->first();
            if($request->invoice_posted == 1){

                $invoices->update(['posted' => '1']);
            }else{
                $invoices->update(['posted' => '0']);
            }
        }
        return redirect()->route('customer.invoices.index',['type' => 'myrequests']);
    }

}