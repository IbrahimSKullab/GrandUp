<?php

namespace App\Datatables;

use App\Models\User;
use App\Helper\Helper;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Yajra\DataTables\Facades\DataTables;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UserDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'profile_image',
            'name',
            'phone',
            'current_points',
            'governorate' => ['governorate.title->' . LaravelLocalization::getCurrentLocale()],
            'contact',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn('profile_image', function (User $user) {
                return DataTableActions::image($user->profile_image);
            })
            ->addColumn('governorate', function (User $user) {
                return $user->governorate->title;
            })
            ->addColumn('name', function (User $user) {
                return $user->name . ' ' . $user->last_name;
            })
            ->addColumn('contact', function (User $user) {
                return 'ddddd';
            })
            ->addColumn('created_at', function (User $user) {
                return Helper::formatDate($user->created_at);
            })
            ->addColumn('updated_at', function (User $user) {
                return Helper::formatDate($user->updated_at);
            })
            ->addColumn('contact', function (User $user) {
                $html = "<button type='button' onclick=window.open('https://wa.me/" . $user->phone . "/?text=','_blank') class='btn p-3 py-2 btn-success'><i class='fab fa-whatsapp p-0'></i></button>";
                $html .= "<button type='button' data-url='" . route('admin.user.send-notification', $user->id) . "' data-bs-toggle='modal' data-bs-target='#notifications' class='btn btn-primary p-3 py-2 ms-2'><i class='far p-0 fa-bell'></i></button>";

                return $html;
            })
            ->addColumn('status', function (User $user) {
                return (new DataTableActions())
                    ->model($user)
                    ->modelId($user->id)
                    ->checkStatus($user->status)
                    ->switcher();
            })
            ->addColumn('action', function (User $user) {
                return (new DataTableActions())
                    ->edit(route('admin.user.edit', $user->id))
                    ->show(route('admin.user.show', $user->id))
                    ->delete(route('admin.user.destroy', $user->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'profile_image', 'contact'])
            ->make();
    }

    public function query(Request $request)
    {
        return User::query()
            ->with('governorate')
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->name, function ($query) use ($request) {
                return $query->where('status', 0);
            })
            ->when($request->filled('status') && $request->status == StatusEnum::ACTIVE->name, function ($query) use ($request) {
                return $query->where('status', 1);
            })
            ->latest()
            ->select('users.*');
    }
}
