<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\IntroImages;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class IntroImagesDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'image',
            'title' => ['title->ar'],
            'status',
            'type',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (IntroImages $introImages) {
                return (new DataTableActions())
                    ->model($introImages)
                    ->modelId($introImages->id)
                    ->checkStatus($introImages->status)
                    ->switcher();
            })
            ->addColumn('type', function (IntroImages $introImages) {
                if ($introImages->for_seller == 'seller') {
                    return __('For Seller');
                } elseif ($introImages->for_seller == 'user') {
                    return __('For User');
                } elseif ($introImages->for_seller == 'general_store') {
                    return __('For General Store');
                } elseif ($introImages->for_seller == 'pos') {
                    return __('Pos');
                } elseif ($introImages->for_seller == 'delivery') {
                    return __('Delivery');
                }
            })
            ->addColumn('image', function (IntroImages $introImages) {
                return DataTableActions::image($introImages->image, 200);
            })
            ->addColumn('created_at', function (IntroImages $introImages) {
                return Helper::formatDate($introImages->created_at);
            })
            ->addColumn('action', function (IntroImages $introImages) {
                return (new DataTableActions())
                    ->edit(route('admin.intro-image.edit', $introImages->id))
                    ->delete(route('admin.intro-image.destroy', $introImages->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status', 'for_seller', 'for_user'])
            ->make();
    }

    public function query(Request $request)
    {
        return IntroImages::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->select('*');
    }
}
