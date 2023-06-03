<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class CountryDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (Country $country) {
                return (new DataTableActions())
                    ->model($country)
                    ->modelId($country->id)
                    ->checkStatus($country->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Country $country) {
                return Helper::formatDate($country->created_at);
            })
            ->addColumn('updated_at', function (Country $country) {
                return Helper::formatDate($country->updated_at);
            })
            ->addColumn('title', function (Country $country) {
                return $country->title;
            })
            ->addColumn('action', function (Country $country) {
                return (new DataTableActions())
                    ->edit(route('admin.country.edit', $country->id))
                    ->delete(route('admin.country.destroy', $country->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return Country::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->latest()
            ->select('*');
    }
}
