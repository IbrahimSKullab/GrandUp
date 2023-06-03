<?php

namespace App\Http\Controllers\API\V1\User\QrCode;

use App\Models\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QrCodeController extends Controller
{
    public function check(Request $request)
    {
        $user = Auth::user();

        $qr_code = QrCode::where('code_number', $request->code_number)->first();
        if (! $qr_code) {
            $data = [
                'check' => 1,
                'message' => __('Code Not Found'),
            ];
            return $this::sendSuccessResponse($data);
        }

        if ($qr_code && $qr_code->is_used == 1) {
            $data = [
                'check' => 1,
                'message' => __('Code Used'),
            ];

            return $this::sendSuccessResponse($data);
        }

        $qr_code->update([
            'is_used' => 1,
            'used_by' => $user->name,
            'used_by_phone' => $user->name,
            'user_id' => $user->id,
            'used_at' => now(),
        ]);

        $data = [
            'check' => 0,
            'message' => __('Code Check Successfully'),
        ];

        return $this::sendSuccessResponse($data);
    }
}
