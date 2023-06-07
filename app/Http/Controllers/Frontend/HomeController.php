<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SellerCategory;
use App\Models\SellerProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    } 
     public function about()
    {
        return view('frontend.home.about');
    } 
     public function contact()
    {
        return view('frontend.home.contact');
    } 
     public function search()
    {
        return view('frontend.home.search');
    }
    public function category($id)
    {
        $category = Category::find($id);
        $products = $category->products;
        $sellers = $category->sellers;
        $subCategories = $category->subCategories;
        $image = $category->image;
        return view('frontend.home.category',['category'=>$category, 'products'=>$products, 'sellers'=>$sellers]);
    }
    public function offer()
    {
        return view('frontend.home.offer');
    }
    

}
