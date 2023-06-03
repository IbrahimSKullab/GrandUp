<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use Illuminate\Support\Facades\Log;
use App\Datatables\ProductDatatables;
use App\Services\Seller\SellerServices;
use App\Services\Product\ProductServices;
use App\Services\Category\CategoryServices;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.products.index');
    }

    public function create()
    {
        return view('frontend.products.index')->with([
            'sellers' => $this->sellerServices->get(),
            'categories' => $this->categoryServices->get(),
        ]);
    }

    public function store(SellerProductRequest $request)
    {
        try {
            $this->productServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Added Successfully'));
    }

    public function show($id)
    {
        $product = $this->productServices->findById($id);

        return view('frontend.products.index')->with([
            'product' => $product,
        ]);
    }

    public function edit($id)
    {

        return view('frontend.products.index')->with([
            'product' => $this->productServices->findById($id),
            'sellers' => $this->sellerServices->get(),
            'categories' => $this->categoryServices->get(),
        ]);
    }

    public function update(SellerProductRequest $request, $id)
    {
        try {
            $this->productServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Updated Successfully'));
    }

    public function destroy($id)
    {
        try {
            $this->productServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Deleted Successfully'));
    }

    public function approveProduct($id)
    {
        try {
            $this->productServices->approveProduct($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Approved Successfully'));
    }

    public function rejectProduct(Request $request, $id)
    {
        $this->validate($request, [
            'rejection_reason' => 'required|string',
        ]);

        try {
            $this->productServices->rejectProduct($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Product Rejected'));
    }

    public function loadProducts(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required|exists:sellers,id',
        ]);
        $products = SellerProduct::query()
            ->where('admin_approval', 1)
            ->where('status', 1)
            ->where('seller_id', $request->seller_id)
            ->get();
        $products = Helper::getHtmlOptions($products);

        return $this::sendSuccessResponse([
            'html' => $products,
        ]);
    }

  

}
