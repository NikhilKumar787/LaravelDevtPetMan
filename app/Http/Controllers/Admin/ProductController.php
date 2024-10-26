<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\GST;
use App\Models\Product;
use App\Models\User;
use App\Models\Company;
use App\Models\AssignedTask;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $filter_company_id = $request->input('company_id');
            if($filter_company_id == 'company'){
                $query = Product::with(['account_type', 'account_name', 'categories', 'team'])->select(sprintf('%s.*', (new Product())->table));
            }else{
                $query = Product::with(['account_type', 'account_name', 'categories', 'team'])->where('company_id',$filter_company_id)->select(sprintf('%s.*', (new Product())->table));
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';

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
            $table->editColumn('tax_type', function ($row) {
                return $row->tax_type ? Product::TAX_TYPE_RADIO[$row->tax_type] : '';
            });
            $table->editColumn('gst', function ($row) {
                return $row->gst ? Product::GST_SELECT[$row->gst] : '';
            });
            $table->editColumn('cess', function ($row) {
                return $row->cess ? $row->cess : '';
            });
            $table->editColumn('cess_type', function ($row) {
                return $row->cess_type ? Product::CESS_TYPE_SELECT[$row->cess_type] : '';
            });
            $table->editColumn('purchase_price', function ($row) {
                return $row->purchase_price ? $row->purchase_price : '';
            });
            $table->editColumn('price_type', function ($row) {
                return $row->price_type ? Product::PRICE_TYPE_SELECT[$row->price_type] : '';
            });
            $table->editColumn('item_type', function ($row) {
                return $row->item_type ? Product::ITEM_TYPE_RADIO[$row->item_type] : '';
            });
            $table->editColumn('wholesale_price', function ($row) {
                return $row->wholesale_price ? $row->wholesale_price : '';
            });
            $table->editColumn('item_code', function ($row) {
                return $row->item_code ? $row->item_code : '';
            });
            $table->editColumn('income_account_type', function ($row) {
                return $row->income_account_type ? Product::INCOME_ACCOUNT_TYPE_SELECT[$row->income_account_type] : '';
            });
            $table->editColumn('account_group', function ($row) {
                return $row->account_group ? Product::ACCOUNT_GROUP_SELECT[$row->account_group] : '';
            });
            $table->addColumn('account_type_type', function ($row) {
                return $row->account_type ? $row->account_type->type : '';
            });

            $table->addColumn('account_name_name', function ($row) {
                return $row->account_name ? $row->account_name->name : '';
            });

            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'account_type', 'account_name', 'category']);

            return $table->make(true);
        }

        $company_list = Company::pluck('company_name','id');

        return view('admin.products.index',compact('company_list'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gsts = GST::all();

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        return view('admin.products.create', compact('account_names', 'account_types', 'categories', 'companies', 'gsts'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->update([
            'created_by_id' => auth()->user()->id,
        ]);
        $product->categories()->sync($request->input('categories', []));
        if(isset(auth()->user()->team))
        {
            $product->update(['team_id' => auth()->user()->team->id]);
        }
        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gsts = GST::all();

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $product->load('account_type', 'account_name', 'categories', 'team');

        return view('admin.products.edit', compact('account_names', 'account_types', 'categories', 'product', 'gsts'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        
        // if($request->product_approval == 1){
        //     $product->update(['is_employee_approved' => '1']);
        //     $assignedtask = AssignedTask::where('company_id',$request->company_id)->get();
            
        //     $assignedtask->update(['customer_request_status' => '2']);
        // }
        // $product->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('account_type', 'account_name', 'categories', 'team', 'productInvoiceDetails');

        return view('admin.products.show', compact('product'));
    }

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

        $products = Product::where('name', 'LIKE', "%$term%")->get();


        $products = $products->toArray();
        if(empty($products)){
            $products[] = [
                'id' => 0,
                'name' => 'Add New Product',
            ];
        }
        echo json_encode($products);
    }

    public function productStore(Request $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->input('categories', []));
        if(isset(auth()->user()->team))
        {
            $product->update(['team_id' => auth()->user()->team->id]);

        }

        return $product ;
    }
}
