<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\AccountName;
use App\Models\Category;
use App\Models\AccountType;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::with(['account_type', 'account_name', 'team'])->get();

        return view('frontend.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::pluck('name', 'id');

        return view('frontend.products.create', compact('account_names', 'account_types', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->input('categories', []));

        return redirect()->route('frontend.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id');

        $product->load('account_type', 'account_name', 'categories', 'team');

        return view('frontend.products.edit', compact('account_names', 'account_types', 'categories', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('frontend.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('account_type', 'account_name', 'team', 'productInvoiceDetails');

        return view('frontend.products.show', compact('product'));
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


        $products = Product::where('team_id',auth()->user()->team->id);


        $products = $products->where(function ($query) use($term) {
            $query->where('name', 'LIKE', "%$term%");
        })->get();

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
