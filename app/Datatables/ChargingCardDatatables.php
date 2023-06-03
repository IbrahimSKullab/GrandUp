<?php

namespace App\Datatables;

use Auth;
use DataTables;
use App\Helper\Helper;
use App\Models\ChargingCard;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;

class ChargingCardDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'transaction_id',
            'card_number' => ['card_number'],
            'points' => ['points'],
            'price',
            'is_used',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('price', function (ChargingCard $chargingCard) {
                return Helper::price($chargingCard->price);
            })
            ->addColumn('is_used', function (ChargingCard $chargingCard) {
                $usedBy = '';
                if ($chargingCard->is_used) {
                    if ($chargingCard->user_id) {
                        $usedBy = "<a href='" . route('admin.user.show', $chargingCard->user_id) . "'>" . $chargingCard->user?->name . '</a>';
                    }
                    if ($chargingCard->seller_id) {
                        $usedBy = "<a href='" . route('admin.seller.show', $chargingCard->seller_id) . "'>" . $chargingCard->seller?->name . '</a>';
                    }
                }

                return $chargingCard->is_used ? DataTableActions::bgColor('success', __('Yes By') . ' (' . $usedBy . ')') : DataTableActions::bgColor('info', __('No'));
            })
            ->addColumn('created_at', function (ChargingCard $chargingCard) {
                return Helper::formatDate($chargingCard->created_at);
            })
            ->addColumn('action', function (ChargingCard $chargingCard) {
                if (Auth::user()->is_pos) {
                    return (new DataTableActions())
                        ->print(route('admin.admin-pos.charging-card.print', $chargingCard->id))
                        ->make();
                }
                if (Auth::user()->is_agent) {
                    return (new DataTableActions())
                        ->print(route('admin.admin-agent.charging-card.print', $chargingCard->id))
                        ->make();
                }
                if (Auth::user()->is_staff) {
                    return (new DataTableActions())
                        ->print(route('admin.charging-card.print', $chargingCard->id))
                        ->make();
                }
            })
            ->rawColumns(['action', 'is_used'])
            ->make();
    }

    public function query(Request $request)
    {
        return ChargingCard::query()
            ->latest()
            ->when(Auth::user()->is_pos, function ($query) {
                return $query->where('pos_id', Auth::id());
            })
            ->when(Auth::user()->is_agent, function ($query) {
                return $query->where('agent_id', Auth::id());
            })
            ->when(Auth::user()->is_staff, function ($query) {
                return $query->where('admin_id', Auth::id());
            })
            ->select('*');
    }
}
