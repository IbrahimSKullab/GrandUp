<?php

namespace App\Http\Controllers\API\V1\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Services\Category\SubCategoryServices;

class SubCategoryController extends Controller
{
    public function __construct(private SubCategoryServices $subCategoryServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(SubCategoryResource::collection($this->subCategoryServices->getEnabledSubCategories()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(SubCategoryResource::make($this->subCategoryServices->findById($id)));
    }


    public function getSubCategoryByCategoryId($category_id)
    {
        return $this::sendSuccessResponse(SubCategoryResource::collection($this->subCategoryServices->getSubCategoryByCategoryId($category_id)));
    }
}
