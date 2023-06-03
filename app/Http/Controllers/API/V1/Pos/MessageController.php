<?php

namespace App\Http\Controllers\API\V1\Pos;

use App\Models\Message;
use App\Events\NewMessageCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\POS\CreateMessageRequest;

class MessageController extends Controller
{
    public function index()
    {
        return $this::sendSuccessResponse(
            Message::where('from_id', '=', auth()->id())
                ->orWhere('to_id', '=', auth()->id())
                ->get()
        );
    }

    public function store(CreateMessageRequest $request)
    {
        $message = Message::create([
            'from_id' => $request->from_id,
            'to_id' => 1,
            'body' => $request->body,
        ]);

        NewMessageCreated::dispatch($message->body);

        return $this::sendSuccessResponse(__('Message Send Successfully'));
    }
}
