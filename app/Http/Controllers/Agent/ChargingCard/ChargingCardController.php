<?php

namespace App\Http\Controllers\Agent\ChargingCard;

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
        private readonly TransactionServices    $transactionServices,
        private readonly ChargingCardDatatables $chargingCardDatatables,
        private readonly CardServices $cardServices
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->chargingCardDatatables->datatables($request);
        }

        return view('admin.agent.charging-cards.index')->with([
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
        $card = ChargingCard::query()->where('agent_id', Auth::id())->findOrFail($id);

        return view('admin.agent.charging-cards.print')->with([
            'card' => $card,
            'single_card' => true,
        ]);
    }

    public function printUnusedCards()
    {
        $cards = ChargingCard::query()->where('agent_id', Auth::id())->where('is_used', 0)->latest()->get();

        return view('admin.agent.charging-cards.print')->with([
            'cards' => $cards,
            'single_card' => false,
        ]);
    }

    public function store(ChargingCardRequest $request)
    {
        try {
            $this->transactionServices->createCardsForAgents(Auth::id(), $request->card_id, $request->count);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Cards Created Successfully'));
    }
}
