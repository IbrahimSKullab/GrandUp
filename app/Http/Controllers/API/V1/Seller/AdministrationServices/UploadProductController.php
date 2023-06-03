<?php

namespace App\Http\Controllers\API\V1\Seller\AdministrationServices;

use App\Models\Seller;
use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Administration\AdministrationServices;

class UploadProductController extends Controller
{
    public function __construct(private AdministrationServices $administrationServices)
    {
    }

    public function __invoke(Request $request)
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $this->validate($request, [
            'product_excelsheet' => 'nullable|mimetypes:application/csv,application/excel,application/vnd.ms-excel, application/vnd.msexcel,,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'product_zip_file' => 'nullable|mimes:zip,rar',
        ]);

        try {
            $this->administrationServices->uploadProduct($seller->id, $request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Product Submitted Successfully'));
    }
}
