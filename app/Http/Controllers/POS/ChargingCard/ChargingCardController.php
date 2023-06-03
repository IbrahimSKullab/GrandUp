<?php

namespace App\Http\Controllers\POS\ChargingCard;

use Log;
use Exception;
use App\Models\ChargingCard;
use Illuminate\Http\Request;
use App\Services\Card\CardServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Datatables\ChargingCardDatatables;
use App\Http\Requests\POS\ChargingCardRequest;
use App\Services\Transaction\TransactionServices;

class ChargingCardController extends Controller
{
    public function __construct(
        private TransactionServices    $transactionServices,
        private ChargingCardDatatables $chargingCardDatatables,
        private CardServices           $cardServices
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->chargingCardDatatables->datatables($request);
        }

        return view('admin.pos.charging-cards.index')->with([
            'columns' => [
                'transaction_id',
                'points' => ['points'],
                'price',
                'is_used',
                'created_at',
            ],
            'cards' => $this->cardServices->get(),
        ]);
    }

    public function print($id)
    {
        $card = ChargingCard::query()->where('pos_id', Auth::id())->findOrFail($id);

        return view('admin.pos.charging-cards.print')->with([
            'card' => $card,
            'single_card' => true,
        ]);
    }

    public function printUnusedCards()
    {
        $cards = ChargingCard::query()->where('pos_id', Auth::id())->where('is_used', 0)->latest()->get();

        return view('admin.pos.charging-cards.print')->with([
            'cards' => $cards,
            'single_card' => false,
        ]);
    }

    public function store(ChargingCardRequest $request)
    {
        try {
            $cards = $this->transactionServices->createCardsForPos(Auth::id(), $request->card_id, (int)$request->count);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return view('admin.pos.charging-cards.print')->with([
            'cards' => $cards,
            'single_card' => false,
        ]);

        // return back()->with("success", __("Cards Created Successfully"));
    }
}
