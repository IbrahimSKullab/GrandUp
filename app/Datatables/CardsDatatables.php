<?php

namespace App\Datatables;

use App\Models\Card;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class CardsDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'card_price' => ['price'],
            'points' => ['points'],
            'type' => ['type'],
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('card_price', function (Card $card) {
                return Helper::price($card->card_price);
            })
            ->addColumn('title', function (Card $card) {
                return $card->title;
            })
            ->addColumn('type', function (Card $card) {
                if ($card->type == 1) {
                    return __('Admin');
                } elseif ($card->type == 2) {
                    return __('Store');
                } elseif ($card->type == 3) {
                    return __('Admin && Store');
                } elseif ($card->type == 4) {
                    return __('Shipping Companies');
                }
            })
            ->addColumn('created_at', function (Card $card) {
                return Helper::formatDate($card->created_at);
            })
            ->addColumn('updated_at', function (Card $card) {
                return Helper::formatDate($card->updated_at);
            })
            ->addColumn('action', function (Card $card) {
                return (new DataTableActions())
                    ->edit(route('admin.cards.edit', $card->id))
                    ->delete(route('admin.cards.destroy', $card->id))
                    ->make();
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function query(Request $request)
    {
        return Card::query()->latest()->select('*');
    }
}
