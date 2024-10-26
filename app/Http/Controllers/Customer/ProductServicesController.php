<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($request->ajax()){
            $filter_date_id = $request->input('date_id');
            $filter_approve_id = $request->input('approve_id');

            $company = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();
            if($company->role_id != 0){
                $query = Product::with(['account_type', 'account_name', 'categories', 'team'])->where('company_id',$company->company_id)->select(sprintf('%s.*', (new Product())->table));
            }elseif($company->role_id == 0){
                $query = Product::with(['account_type', 'account_name', 'categories', 'team'])->where('company_id',$company->company_id)->where('created_by_id',auth()->user()->id)->select(sprintf('%s.*', (new Product())->table));
            }
            // Apply Filters here!;
            if ($filter_date_id == 'date' && $filter_approve_id == 'product_approve') {
                $query->select(sprintf('%s.*', (new Product())->table))->get();
            } else {
                if($filter_date_id != 'date') {
                    switch ($filter_date_id) {
                        case 'today':
                            $query->whereDate('created_at', Carbon::today())->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'yesterday':
                            $query->whereDate('created_at', Carbon::yesterday())->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'this_week':
                            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'last_week':
                            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'this_month':
                            $query->whereMonth('created_at', Carbon::now()->month)->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'last_month':
                            $query->whereMonth('created_at', Carbon::now()->subMonth()->month)->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'this_year':
                            $query->whereYear('created_at', Carbon::now()->year)->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                        case 'last_year':
                            $query->whereYear('created_at', Carbon::now()->subYear()->year)->select(sprintf('%s.*', (new Product())->table))->get();
                            break;
                    }
                   
                }
                if($filter_approve_id != 'product_approve') {
                    $query->where('is_employee_approved', $filter_approve_id)->select(sprintf('%s.*', (new Product())->table))->get();
                }
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $approveGate  ='product_access';
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.customer_datatablesActions', compact(
                'viewGate',
                'approveGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('hsn', function ($row) {
                return $row->hsn ? $row->hsn : '';
            });
            $table->editColumn('unit', function ($row) {
                return $row->unit ? $row->unit : '';
            });
            $table->editColumn('sales_price', function ($row) {
                return $row->sales_price ? $row->sales_price : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        $user = User::where('id', auth()->user()->id)->first();
       
        $company_role_user = \DB::table('company_role_user')->where('user_id', $user->id)->first();
                
        $company = \DB::table('company_role_user')->where('user_id', auth()->user()->id)->first();
                if ($company_role_user->role_id != 0) {
                    $product_approved = Product::where('company_id',$company->company_id)->where('is_employee_approved',1)->count();
                    $product_pending = Product::where('company_id',$company->company_id)->where('is_employee_approved',0)->count();
                    $product_total = Product::where('company_id',$company->company_id)->count();

                } elseif ($company_role_user->role_id == 0) {
                    $product_approved = Product::where('company_id',$company->company_id)->where('is_employee_approved',1)->where('created_by_id',auth()->user()->id)->count();
                    $product_pending = Product::where('company_id',$company->company_id)->where('is_employee_approved',0)->where('created_by_id',auth()->user()->id)->count();
                    $product_total = Product::where('company_id',$company->company_id)->where('created_by_id',auth()->user()->id)->count();
                }
       
      

        return view('customer.products.index',compact('product_pending','product_approved','product_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        return view('customer.products.create', compact('account_names', 'account_types', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {  
        $product = Product::create($request->all());
       
        $product->categories()->sync($request->input('categories', []));

        return redirect()->route('customer.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('account_type', 'account_name', 'categories', 'team', 'productInvoiceDetails');

        return view('customer.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $product->load('account_type', 'account_name', 'categories', 'team');

        return view('customer.products.edit', compact('account_names', 'account_types', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        
        $product->update($request->all());
        $product->categories()->sync($request->input('categories', []));

        return redirect()->route('customer.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    
    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function getProduct(Request $request)
    {
        $term = $request->q['term'];
        $company_id = $request->company_id;

        $products = Product::where('company_id',$company_id)->where('name', 'LIKE', "%$term%")->get();
    
        $products = $products->toArray();

        //Here I have removed add Product Functionality on Invoice Creation Page on Customer End.
        // if(empty($products)){
        //     $products[] = [
        //         'id' => 0,
        //         'name' => 'Add New Product',
        //     ];
        // }
        
        echo json_encode($products);
    }
    public function productStore(Request $request)
    {
        if($request->company_id != ''){
            if($request->company_id == null){
                $user = User::where('id',auth()->user()->id)->first();
                $company_role_user = \DB::table('company_role_user')->where('user_id',$user->team_id)->first();
                $company_id = $company_role_user->company_id;
            }else{
                $company_id = $request->company_id; 
            }
        }
        $product = Product::create($request->all());
        $product->update([
            'company_id' => $company_id,
            'created_by_id' => auth()->user()->id,
        ]);
           
        $product->categories()->sync($request->input('categories', []));
        if(isset(auth()->user()->team))
        {
            $product->update(['team_id' => auth()->user()->team->id]);
        }
        return $product ;
    }
}
