<?php

namespace App\Http\Controllers\API\V1\Gift;

use DB;
use App\Services\Gift\GiftServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\Gift\GiftResource;

class GiftController extends Controller
{
    public function __construct(private readonly GiftServices $giftServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse([
            'count' => DB::table('gifts')->where('status', 1)->count(),
            'data' => GiftResource::collection($this->giftServices->get()),
        ]);
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(GiftResource::make($this->giftServices->findById($id, true)));
    }
}
