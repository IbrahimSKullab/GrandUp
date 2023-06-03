<?php

namespace App\Services\QrCode;

use App\Models\Card;
use App\Models\Admin;
use App\Helper\Helper;
use App\Models\QrCode;
use App\Models\Seller;
use App\Models\QrCategory;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class QrCodeServices implements ServiceInterface
{
    public function get(): Collection
    {
        return QrCode::get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Card::query()->create([
                'title' => $request->title,
                'type' => $request->type,
                'points' => $request->points,
                'card_price' => $request->card_price,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $card = $this->findById($id);
            $card->update([
                'title' => $request->title,
                'type' => $request->type,
                'points' => $request->points,
                'card_price' => $request->card_price,
            ]);
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Card::query()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $card = $this->findById($id);
            $card->delete();
        });
    }

    public function payCard($seller_id, $id)
    {
        $seller = Seller::query()->find($seller_id);

        $card = Card::findOrFail($id);

        $seller->payCardOrderTransactions($card);
    }

    public function createQrCode($admin_id, $request)
    {
        return DB::transaction(function () use ($admin_id, $request) {
            $admin = Admin::query()->find($admin_id);
            $qr_category = QrCategory::create([
                'title' => $request->title,
            ]);
            foreach (range(1, $request->count) as $i) {
                $codeNumber = Helper::randomNDigitNumber();

                QrCode::create([
                    'admin_id' => $admin->id,
                    'code_number' => $codeNumber,
                    'qr_category_id' => $qr_category->id,
                    'is_used' => 0,
                ]);
            }
        });
    }
}
