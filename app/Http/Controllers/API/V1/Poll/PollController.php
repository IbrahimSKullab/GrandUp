<?php

namespace App\Http\Controllers\API\V1\Poll;

use App\Models\Poll;
use App\Models\User;
use App\Models\Seller;
use App\Models\PollAnswer;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\ShippingDelivery;
use Illuminate\Support\Facades\DB;
use App\Services\Poll\pollServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Poll\PollResource;

class PollController extends Controller
{
    public function __construct(private PollServices $pollServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(PollResource::collection($this->pollServices->getEnabled()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(PollResource::make($this->pollServices->findById($id, true)));
    }

    public function store(Request $request, $id)
    {
        $answer = DB::transaction(function () use ($request, $id) {
            $poll = Poll::query()->findOrFail($id);

            $question = $poll->questions()->findOrFail($request->poll_answer_id);

            if (Auth::user() instanceof Seller) {
                PollAnswer::query()->updateOrCreate([
                    'poll_id' => $poll->id,
                    'seller_id' => Auth::id(),
                ], [
                    'poll_question_id' => $question->id,
                ]);
            } elseif (Auth::user() instanceof User) {
                PollAnswer::query()->updateOrCreate([
                    'poll_id' => $poll->id,
                    'user_id' => Auth::id(),
                ], [
                    'poll_question_id' => $question->id,
                ]);
            } elseif (Auth::user() instanceof ShippingCompany) {
                PollAnswer::query()->updateOrCreate([
                    'poll_id' => $poll->id,
                    'shipping_company_id' => Auth::id(),
                ], [
                    'poll_question_id' => $question->id,
                ]);
            } elseif (Auth::user() instanceof ShippingDelivery) {
                PollAnswer::query()->updateOrCreate([
                    'poll_id' => $poll->id,
                    'shipping_delivery_id' => Auth::id(),
                ], [
                    'poll_question_id' => $question->id,
                ]);
            }
        });

        return $this::sendSuccessResponse([], __('Poll Answer Submitted Successfully'));
    }
}
