<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\QrCode;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class QrCodeDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'code_number' => ['code_number'],
            'qr_category' => ['qr_category'],
            'is_used',
            'used_at',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return DataTables::of($this->query($request))
            ->addColumn('is_used', function (QrCode $qrCode) {
                $usedBy = '';
                if ($qrCode->is_used) {
                    if ($qrCode->user_id) {
                        $usedBy = "<a href='" . route('admin.user.show', $qrCode->user_id) . "'>" . $qrCode->user?->name . '</a>';
                    }
                }

                return $qrCode->is_used ? DataTableActions::bgColor('success', __('Yes By') . ' (' . $usedBy . ')') : DataTableActions::bgColor('info', __('No'));
            })
            ->addColumn('qr_category', function (QrCode $qrCode) {
                return $qrCode->qrCategory->title;
            })
            ->addColumn('created_at', function (QrCode $qrCode) {
                return Helper::formatDate($qrCode->created_at);
            })
            ->addColumn('action', function (QrCode $qrCode) {
                return (new DataTableActions())
                    ->print(route('admin.qr-code.print', $qrCode->id))
                    ->make();
            })
            ->rawColumns(['action', 'is_used'])
            ->make();
    }

    public function query(Request $request)
    {
        return QrCode::query()->latest()->where('admin_id', Auth::id())->select('*');
    }
}
