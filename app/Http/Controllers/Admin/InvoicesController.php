<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Models\BankDetail;
use App\Models\Customer;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\AssignedTask;
use App\Models\Category;
use App\Models\CustomFieldMapping;
use App\Models\CustomFieldValue;
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
use App\Models\TermsAndcondition;
use PDF;
use Gate;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\CustomFields;
use App\Models\InvoiceCustomization;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $gettype=$request->input('type');

            if($gettype=='myrequests'){
                $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_request',1)->select(sprintf('%s.*', (new Invoice())->table));
            }
            elseif($gettype=='paid'){
                $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status',1)->select(sprintf('%s.*', (new Invoice())->table)); 
            }
            elseif($gettype=='unpaid'){
                $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('invoice_status',0)->select(sprintf('%s.*', (new Invoice())->table)); 
            }
            else{
                $query = Invoice::with(['customer', 'place_of_supply', 'team'])->select(sprintf('%s.*', (new Invoice())->table));
            }
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $invoice_id = AssignedTask::where('model_id', $row->id)->first();
                $approveGate = 'invoice_approve';
                $viewGate = 'invoice_show';
                $editGate = 'invoice_edit';
                $deleteGate = 'invoice_delete';
                $crudRoutePart = 'invoices';

                return view('partials.datatablesActions', compact(
                'approveGate',
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'invoice_id',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Invoice::TYPE_RADIO[$row->type] : '';
            });

            $table->editColumn('invoice_no', function ($row) {
                return $row->invoice_no ? $row->invoice_no : '';
            });
            $table->addColumn('customer_first_name', function ($row) {
                return $row->customer ? $row->customer->first_name : '';
            });

            $table->editColumn('customer_email', function ($row) {
                return $row->customer_email ? $row->customer_email : '';
            });
            $table->editColumn('send_later', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->send_later ? 'checked' : null) . '>';
            });

            $table->addColumn('place_of_supply_state', function ($row) {
                return $row->place_of_supply ? $row->place_of_supply->state : '';
            });

            $table->editColumn('type_of_supply', function ($row) {
                return $row->type_of_supply ? Invoice::TYPE_OF_SUPPLY_SELECT[$row->type_of_supply] : '';
            });
            $table->editColumn('message_on_invoice', function ($row) {
                return $row->message_on_invoice ? $row->message_on_invoice : '';
            });
            $table->editColumn('message_on_statement', function ($row) {
                return $row->message_on_statement ? $row->message_on_statement : '';
            });
            $table->editColumn('discount_type', function ($row) {
                return $row->discount_type ? Invoice::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
            });
            $table->editColumn('discount_amount', function ($row) {
                return $row->discount_amount ? $row->discount_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer', 'send_later', 'place_of_supply']);

            return $table->make(true);
        }

        return view('admin.invoices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        $gsts = GST::all();
        $company = Company::where('team_id',null)->first();
        $terms_and_conditions = TermsAndcondition::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.invoices.create', compact('customers', 'place_of_supplies','states','groups','terms','products','countries','account_names', 'account_types', 'categories','company','terms_and_conditions','cities', 'gsts'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create($request->all());

        if($request->custom_field_id != '')
        {
            foreach($request->custom_field_id as $key => $data)
            {
                $custom_field_mapping = CustomFieldMapping::where('custom_field_id', $key)->where('custom_field_request_type','invoice')->withTrashed()->first();
                $custom_field['custom_field_id'] = $key;
                $custom_field['custom_field_request_id'] = $invoice->id;
                $custom_field['custom_field_map_id'] = $custom_field_mapping->id;
                $custom_field['custom_field_value'] = $data; 

                $custom_field_invoice = CustomFieldValue::create($custom_field);
            }
        }
      
        if(isset(auth()->user()->team))
        {
            $invoice->update(['team_id' => auth()->user()->team->id]);

        }
        for($i=0;$i<count($request->product_id);$i++)
        {
            $product[$i]['qty'] = $request->quantity[$i];
            $product[$i]['rate'] = $request->rate[$i];
            $product[$i]['amount'] = $request->amount_inv[$i];
            $product[$i]['tax'] = $request->tax_gst[$i];
            $product[$i]['invoice_id'] = $invoice->id;
            $product[$i]['product_id'] = $request->product_id[$i];
            if(isset(auth()->user()->team))
            {
                $product[$i]['team_id'] = auth()->user()->team->id;
            }
        }

        $invoice_detail  = InvoiceDetail::insert($product);

        return redirect()->route('admin.invoices.index');
    }

    public function edit(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $place_of_supplies = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::pluck('name', 'id');
        $terms_and_conditions = TermsAndcondition::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $invoiceDetails = InvoiceDetail::with('product')->where('invoice_id',$invoice->id)->get();
        $gsts = GST::all();
        $company_id = $invoice->company_id;
        $company = Company::with('state','city')->where('id', $company_id)->first();
        $invoice->load('customer', 'place_of_supply', 'team','terms_and_condition','bank_details');
        // $invoice_id = $invoice->id;  
        // $custom_fields_with_values = CustomFields::with(['custom_field_values' => function($cust_value) use($invoice_id){
        //     $cust_value->where('custom_field_request_id', $invoice_id);
        // }, 'custom_field_map' => function($cust_map){
        //     $cust_map->where('custom_field_request_type','invoice')->withTrashed();
        // }])->withTrashed()->where('company_id',$company_id)->get();
        
        return view('admin.invoices.edit', compact('invoiceDetails','company','terms_and_conditions','categories','account_names','account_types','customers', 'invoice', 'place_of_supplies','terms','groups','products','states','countries', 'gsts'));    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {   
        $invoice = Invoice::where('id',$invoice->id)->first();
        $invoice->update($request->all());

        if($request->custom_field_id != ''){
            $custom_field_invoice = CustomFieldValue::where('custom_field_request_id',$invoice->id)->delete();

            foreach($request->custom_field_id as $key => $data)
            {
                if($data != null){
                $custom_field_mapping = CustomFieldMapping::withTrashed()->where('custom_field_id', $key)->where('custom_field_request_type','invoice')->first();
                $custom_field['custom_field_id'] = $key;
                $custom_field['custom_field_request_id'] = $invoice->id;
                $custom_field['custom_field_map_id'] = $custom_field_mapping->id;
                $custom_field['custom_field_value'] = $data;

                $custom_field_invoice = CustomFieldValue::create($custom_field);    
                }
            }
        }

        $approvaltype = $request->invoice_approval_request;
            $AssignedTask = AssignedTask::where('model_type','invoice_creation')->where('model_id',$invoice->id)->first();
                if($AssignedTask != null){
                    $AssignedTaskType = $AssignedTask->assigned_to_id;
                    $user_id = auth()->user()->id;
                    if($user_id == $AssignedTaskType){

                        if($approvaltype == 1){
                            $invoice->update(['is_employee_approved' => '1']);
                            
                            $AssignedTask->update([
                                'status_id'=>'4' ,
                                'completed_date' => $request->completed_date,
                            ]);
            
                        }
                       
                    }
                }
                        
            if($request->hidden_invoice_type == ''){
                $url = route('admin.invoices.index');
            }elseif($request->hidden_invoice_type == 'assigned_task'){
                $url = route('admin.assigned-tasks.index');
            }else{
               $url = route('admin.invoices.index',['type'=>$request->hidden_invoice_type]);
            }
           return redirect()->away($url);
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('customer', 'place_of_supply', 'team', 'invoiceInvoiceDetails');

        return view('admin.invoices.show', compact('invoice'));
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
        return view('admin.invoices.all-invoices');
    }
    public function products(Request $request)
    {
        return view('admin.invoices.products');
    }

    public function accept_invoice_request(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $update_invoice = Invoice::where('id',$invoice_id)->update(['invoice_request' => 2]);
        $invoice = Invoice::where('id',$invoice_id)->first();
        return $invoice;

    }

    public function pdf(Request $request)
    {
        $pan_no = '';
        $total_amount = 0;
        $invoice_id = $request->invoice;
        $data['invoice'] = Invoice::with(['customer','bank_details','template'])->where('id',$invoice_id)->first();
        $data['deposit'] = $data['invoice']->total_payable_amount-$data['invoice']->remaining_payable_amount;
        $data['template_properties'] = json_decode($data['invoice']->template->template_properties);
        $company_id = $data['invoice']->company_id;
        $data['CustomFieldValues'] = CustomFieldValue::with(['custom_field_map','custom_fields' => function($cust_id)use($company_id){
            $cust_id->where('company_id',$company_id)->where('active_status',1)->withTrashed();
        }])->where('custom_field_request_id',$invoice_id)->get();
        $data['invoiceDetail'] = InvoiceDetail::with('product')->where('invoice_id',$invoice_id)->get();
        $data['customer'] = Customer::with('customerUserAddresses','city','state')->where('id',$invoice_id)->first();
        $data['company'] = Company::with(['city','state'])->where('id',$data['invoice']->company_id)->first();
        $tax_value = 0;
        foreach($data['invoiceDetail'] as $products)
        {
            $total_amount += $products->amount;
            $tax_value += $products->amount*($products->tax/100); 
        }
        $data['tax_value'] = $tax_value;
        $data['total_amount'] = $total_amount;
        $data['total_payable_amount'] = $this->getIndianCurrency($total_amount+$tax_value);
        $data['tax_in_words'] = $this->getIndianCurrency($tax_value);
        $data['amount_in_words'] = $this->getIndianCurrency($total_amount);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.invoices.invoicePdf',$data)->setPaper('a4', 'portrait');
        return $pdf->stream($invoice_id.'.pdf');
    }

    public function getIndianCurrency(int $number) {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            100000             => 'lakh',
            10000000          => 'crore'
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
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 100000:
                $thousands   = ((int) ($number / 1000));
                $remainder = $number % 1000;

                $thousands = $this->getIndianCurrency($thousands);

                $string .= $thousands . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 10000000:
                $lakhs   = ((int) ($number / 100000));
                $remainder = $number % 100000;

                $lakhs = $this->getIndianCurrency($lakhs);

                $string = $lakhs . ' ' . $dictionary[100000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 1000000000:
                $crores   = ((int) ($number / 10000000));
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

    public function getCompanies(Request $request){
        $term = $request->q['term'];

        $companies = Company::where(function ($query) use($term) {
            $query->where('company_name', 'LIKE', "%$term%");
        })->select('companies.*', 'companies.company_name as name')
        ->get();

        $companies = $companies->toArray();
        if(empty($companies)){
            // $companies[] = [
            //     'id' => 0,
            //     'name' => 'Add New Company',
            // ];
            $companies = [];
        }
        echo json_encode($companies);
    }

    public function getInvoice(Request $request){
        if($request->invoice_prefix){
            $lastInvoice = Invoice::where([
                'company_id' => $request->company_id,
                'invoice_prefix' => $request->invoice_prefix,
            ])->orderBy('id','desc')->first();
        } else {
            $lastInvoice = Invoice::where([
                'company_id' => $request->company_id, 
            ])->orderBy('id','desc')->first();
        }
        if(isset($lastInvoice->id)){
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

    public function getProductDetail(Request $request){
        $product = Product::where('id',$request->id)->first();
        return $product;
    }

    public function getCustomer(Request $request){
        $customer = Customer::leftjoin('terms','terms.id','=','customers.term_id')
        ->select('customers.*','terms.credit_period','terms.credit_period_days')
        ->where('customers.id',$request->cust_id)
        ->first();
        return $customer;
    }

    public function addgroup(StoreGroupRequest $request){

        $group = Group::create($request->all());
        return $group;
    }

    public function getCustomFields(Request $request){
        
        $custom_fields_data = CustomFields::where('company_id',$request->company_id)->where('active_status',1)->get();
        return view('admin.custom_fields.custom_fields_index',compact('custom_fields_data'));
        
    }

    public function countCustomFields(Request $request){

        $custom_field_count = CustomFields::where('company_id',$request->company_id)->count();
        return $custom_field_count;
        
    }

    public function editCustomFields(Request $request)
    {
        $company_id = $request->company_id;
        $invoice_id = $request->invoice_id;
        $custom_fields_with_values = CustomFields::with(['custom_field_values' => function($cust_value) use($invoice_id){
            $cust_value->where('custom_field_request_id', $invoice_id);
        }, 'custom_field_map' => function($cust_map){
            $cust_map->where('custom_field_request_type','invoice');
        }])->withTrashed()->where('company_id',$company_id)->get();

        return view('admin.custom_fields.custom_fields_edit',compact('custom_fields_with_values'));
    }
    public function getAllInactiveCustomField(Request $request){
        $request_type = $request->input('type');
        $custom_field_inactive = CustomFields::where('company_id',$request->company_id)->count();
        $custom_field_active = CustomFields::where('company_id',$request->company_id)->where('active_status',1)->count();
        if($request_type == "invoice_create"){
            if($request->include_inactve_status == 0){
                $custom_fields = CustomFields::where('company_id',$request->company_id)->where('active_status',1)->get();
            }else{
                $custom_fields = CustomFields::where('company_id',$request->company_id)->get();                
            }
        }elseif($request_type == "invoice_edit"){
            if($request->include_inactve_status == 0){
                $custom_fields = CustomFields::withTrashed()->where('company_id',$request->company_id)->where('active_status',1)->get();
            }else{
                $custom_fields = CustomFields::withTrashed()->where('company_id',$request->company_id)->get();                
            }
        }
        return view('admin.custom_fields.custom_fields_list',compact('custom_fields','custom_field_active','custom_field_inactive'));
    }

    public function getReviewProducts(Request $request){
        if($request->invoice_id != ''){
            if($request->product_id != ''){
                $products = Product::where('id',$request->product_id)->first();
                $invoice_details = InvoiceDetail::where('invoice_id',$request->invoice_id)->where('product_id',$products->id)->first();
                $category_product = \DB::table('category_product')->where('product_id',$products->id)->first();
                $category = Category::where('id',$category_product->category_id)->first();
            }
        }
        $data = [
            'products' => $products,
            'category' => $category,
            'invoice_details' => $invoice_details,
        ];
        return $data;
    }

    public function getUpdateReviewProducts(Request $request){
        if($request->product_id != null){
            $products = Product::where('id',$request->product_id)->first();
            $products->update($request->all());
            if($request->product_approvel == 1){
                $products->update(['is_employee_approved'=>'1']);
            }
        }
        return $products;
    }
}
