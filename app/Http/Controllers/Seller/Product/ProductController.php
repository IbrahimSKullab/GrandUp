<?php

namespace App\Http\Controllers\Seller\Product;

use App\Helper\Helper;
use Exception;
use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Datatables\ProductDatatables;
use App\Services\Product\ProductServices;
use App\Services\Category\CategoryServices;
use App\Http\Requests\Product\ProductRequest;

class ProductController extends Controller
{
    public function __construct(
        private ProductServices        $productServices,
        private ProductDatatables      $productDatatables,
        private CategoryServices $categoryServices,
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->productDatatables->datatables($request);
        }

        return view('seller.pages.products.index')->with([
            'columns' => $this->productDatatables::sellerColumns(),
        ]);
    }

    public function create()
    {
        return view('seller.pages.products.create')->with([
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productServices->storeForSeller($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Added Successfully'));
    }

    public function show($id)
    {
        $product = $this->productServices->findSellerProductById($id);

        return view('seller.pages.products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit($id)
    {
        $product = $this->productServices->findSellerProductById($id);

        return view('seller.pages.products.edit')->with([
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            $this->productServices->updateForSeller($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Updated Successfully'));
    }

    public function destroy($id)
    {
        try {
            $this->productServices->destroyForSeller($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Deleted Successfully'));
    }

    public function sku_combination(Request $request)
    {
        $options = [];
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;

        $product_name = $request->title;


        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helper::combinations($options);

        return response()->json([
            'view' => view('admin.pages.products._sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'))->render(),
        ]);
    }
}
