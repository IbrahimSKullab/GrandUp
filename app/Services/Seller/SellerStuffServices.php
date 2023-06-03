<?php

namespace App\Services\Seller;

use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\UserEnum;
use App\Enums\SellerEnum;
use App\Models\Permission;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Endroid\QrCode\Color\Color;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;

class SellerStuffServices
{
    public function getAll()
    {
        if (Auth::user()->parent_id != 0) {
            $seller = Seller::where('id', Auth::user()->parent_id)->first();
        } else {
            $seller = auth()->user();
        }
//        dd($seller->id);
//        $parent_id = Auth::user()->parent_id != 0 ? Auth::user()->parent_id : Auth::user()->id;
        return Seller::where('parent_id', $seller->id)->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            if (Auth::user()->parent_id != 0) {
                $seller = Seller::where('id', Auth::user()->parent_id)->first();
            } else {
                $seller = auth()->user();
            }

            $seller = Seller::query()->create([
                'name' => $request->name,
                'phone' => $request->phone,
                'parent_id' => $seller->id,
                'hashed_login_otp' => null,
                'account_status' => SellerEnum::REQUIRE_APPROVAL->name,
                'governorate_id' => $request->governorate_id,
                'country_id' => $request->country_id,
                'app_version' => $request->app_version,
                'device_token' => $request->device_token,
                'device_type' => $request->device_type,
                'password' => $request->filled('password') ? Hash::make($request->password) : null,
            ]);

            if ($request->hasFile('profile_image')) {
                $seller->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

//            $permission_seller = Permission::where('guard_name', 'seller')->pluck('')->toArray();
//            dd($permission_seller->to);

            $seller->syncPermissions($request->permissions);

            $dynamicLink = Helper::createDynamicLink('seller', $seller->id, 'show_seller_screen');

            $seller->update([
                'seller_dynamic_link' => $dynamicLink,
            ]);

            $this->handleProductQrCode($seller);

            return $seller;
        });
    }

    public function handleProductQrCode($seller): void
    {
        $writer = new PngWriter();

        $qrCode = QrCode::create($seller->seller_dynamic_link)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(400)
            ->setMargin(5)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $result = $writer->write($qrCode);

        $image = Str::uuid() . '.png';

        $result->saveToFile(storage_path("app/temp/$image"));

        $qrCode = storage_path("app/temp/$image");

        $seller->addMedia($qrCode)->toMediaCollection(SellerEnum::QR_CODE->name);
    }

    public function update($request, $id)
    {
        $seller = Seller::findOrFail($id);

        $seller->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'hashed_login_otp' => null,
            'governorate_id' => $request->governorate_id,
            'country_id' => $request->country_id,
            'app_version' => $request->app_version,
            'device_token' => $request->device_token,
            'device_type' => $request->device_type,
            'password' => $request->filled('password') ? Hash::make($request->password) : null,
        ]);

        $seller->syncPermissions($request->permissions);

        if ($request->hasFile('profile_image')) {
            $seller->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
        }

        return $seller;
    }

    public function changeStatus($request, $id)
    {
        $seller = Seller::findOrFail($id);

        //   status ==> REQUIRE_APPROVAL, ACCEPTED

        $seller->update([
            'account_status' => $request->account_status,
        ]);

        return $seller;
    }

    public function delete($id)
    {
        $seller = Seller::findOrFail($id);

        $seller->delete();

        return 'deleted';
    }

    public function getAllPermissions()
    {
        return Permission::where('guard_name', 'seller')->get();
    }
}
