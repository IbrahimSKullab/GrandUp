<?php

namespace App\Http\Controllers\API\V1\Pos;

use DB;
use App\Services\Pos\PosServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pos\PosResource;

class PosController extends Controller
{
    public function __construct(private readonly PosServices $posServices)
    {
    }

    public function index()
    {
        $pos = $this->posServices->getEnabledPos();

        return $this::sendSuccessResponse([
            'count' => DB::table('admins')->where('is_staff', 0)
                ->where('is_agent', 0)
                ->where('is_pos', 1)
                ->where('status', 1)
                ->count(),
            'data' => PosResource::collection($pos),
        ]);
    }

    public function show($id)
    {
        $pos = $this->posServices->findById($id, true);

        return $this::sendSuccessResponse(PosResource::make($pos));
    }
}
