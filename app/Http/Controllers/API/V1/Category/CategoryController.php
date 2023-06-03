<?php

namespace App\Http\Controllers\API\V1\Category;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryServices;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    public function __construct(private CategoryServices $categoryServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(CategoryResource::collection($this->categoryServices->getEnabledCategories(true)));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(CategoryResource::make($this->categoryServices->findById($id)));
    }
}
