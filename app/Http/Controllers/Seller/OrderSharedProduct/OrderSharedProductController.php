<?php

namespace App\Http\Controllers\Seller\OrderSharedProduct;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Datatables\OrderSharedProductDatatables;
use App\Services\SellerSharedProduct\SellerSharedProductServices;

class OrderSharedProductController extends Controller
{
    public function __construct(
        private OrderSharedProductDatatables $OrderSharedProductDatatables,
        private SellerSharedProductServices   $OrderSharedProductServices,
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->OrderSharedProductDatatables->datatables($request);
        }

        return view('seller.pages.product-shared.index')->with([
            'columns' => $this->OrderSharedProductDatatables::columns(),
        ]);
    }

    public function show($id)
    {
        $shared_product = $this->OrderSharedProductServices->findById($id);

        return view('seller.pages.product-shared.show')->with([
            'shared_product' => $shared_product ,
        ]);
    }

//    public function destroy($id)
//    {
//        try {
//            $this->OrderSharedProductServices->destroy($id);
//        } catch (Exception | Throwable $exception) {
//            Log::error($exception->getMessage());
//
//            return $this::sendFailedResponse($exception->getMessage());
//        }
//
//        return $this::sendSuccessResponse([], __('Number Special Deleted Successfully'));
//    }

    public function accept($id)
    {
        try {
            $this->OrderSharedProductServices->changeStatus($id, 'accepted');
        } catch (Exception | Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Shared Product Accepted Successfully'));
    }

    public function reject(Request $request, $id)
    {
        $this->validate($request, [
            'rejection_reason' => 'required|string|max:255',
        ]);

        try {
            $this->OrderSharedProductServices->changeStatus($id, 'rejected');
        } catch (Exception | Throwable $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Shared Product Rejected'));
    }
}
