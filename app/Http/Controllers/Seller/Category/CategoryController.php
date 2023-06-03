<?php

namespace App\Http\Controllers\Seller\Category;

use App\Helper\Helper;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function loadSubCategories(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
        ]);

        $category = Category::find($request->category_id);

        $subCategories = $category->subCategories()->get();

        $html = Helper::getHtmlOptions($subCategories);

        return $this::sendSuccessResponse($html);
    }
}
