<?php

namespace App\Services\Card;

use App\Models\Card;
use App\Models\Seller;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CardServices implements ServiceInterface
{

    public function get(): Collection
    {
        if (request()->user('admin')) {
            return Card::query()->whereIn('type', [1, 3])->get();
        } else {
            return Card::query()->whereIn('type', [2, 3])->get();
        }
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
}
