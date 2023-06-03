<?php

namespace App\Http\Controllers\API\V1\Pos;

use App\Models\Card;
use App\Helper\Helper;
use Illuminate\Support\Str;
use App\Models\ChargingCard;
use App\Enums\TransactionEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pos\PosCardResource;
use App\Http\Requests\API\POS\CheckCardRequest;
use App\Http\Requests\API\POS\CreateCardRequest;

class CardController extends Controller
{
    public function index()
    {
        return $this::sendSuccessResponse(Card::all());
    }

    public function check(CheckCardRequest $request)
    {
        $card = Card::where('id', $request->card_id)->first();

        return $this::sendSuccessResponse([
            'card' => PosCardResource::make($card),
            'phone' => auth()->user()->phone,
            'transaction_id' => Str::random(10),
            'account_type' => $request->account_type,
        ]);
    }

    public function store(CreateCardRequest $request)
    {
        $card = Card::where('id', $request->card_id)->first();

        $chargingCards = DB::transaction(function () use ($request, $card) {
            auth()->user()->posTransaction()->create([
                'admin_id' => auth()->user()->id,
                'txn_id' => $request->transaction_id,
                'points' => $card->points,
                'quantity' => $request->count,
                'is_added_points' => 0,
                'account_type' => $request->account_type,
                'transaction_type' => TransactionEnum::POS_CREATING_CARDS->name,
            ]);

            $chargingCards = collect(range(1, $request->count))
                ->map(function () use ($request, $card) {
                    return ChargingCard::query()->create([
                        'pos_id' => auth()->user()->id,
                        'card_number' => Helper::randomNDigitNumber(),
                        'points' => $card->points,
                        'is_used' => 0,
                        'transaction_id' => $request->transaction_id,
                        'price' => $card->card_price,
                    ]);
                });

            $totalPoints = $request->integer('count') * $card->points;

            $posCurrentPoint = auth()->user()->pos_current_points ?? 0;

            auth()->user()->update([
                'pos_current_points' => $posCurrentPoint - $totalPoints,
            ]);

            return $chargingCards;
        });

        return $this::sendSuccessResponse($chargingCards, __('Cards Created Successfully'));
    }
}
