<?php

namespace App\Http\Controllers\API\V1\Page;

use App\Models\GeneralSetting;
use App\Services\Page\PageServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Page\ContactResource;

class PageController extends Controller
{
    public function __construct(private PageServices $pageServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(PageResource::collection($this->pageServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(PageResource::make($this->pageServices->findById($id, true)));
    }

    public function contact()
    {
        $gs = GeneralSetting::query()->first();

        $data = new ContactResource($gs);

        return $this::sendSuccessResponse($data);
    }
}
