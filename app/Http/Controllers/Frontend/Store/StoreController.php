<?php

namespace App\Http\Controllers\Frontend\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Seller;
use App\Models\SellerCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    
    public function index()
    {
        $sellers = Seller::get();
        return view('frontend.store.index',['sellers'=>$sellers]);
    } 
    public function storePage(Request $request,$id)
    {   
        $seller = Seller::find($id);
        $cat = $request->input('cat');
        if($cat){  
            $products = $seller->categoryProducts($cat)->get(); 
            $newProducts = $seller->categoryNewProducts($cat)->get();
            $productPoints = $seller->categoryProductPoints($cat)->get();
        }else{
            $products = $seller->products;
            $newProducts = $seller->newProducts;
            $productPoints = $seller->productPoints;
        }
        $categories = $seller->classifications;
        $subCategories = $seller->subCategories;
        $friendRequest = $seller->friendRequest;
        $offerProducts = $seller->offerProducts;
        return view('frontend.store.show',['id'=>$id,'seller'=>$seller, 'categories'=>$categories, 'subCategories'=>$subCategories,'products'=>$products,'newProducts'=>$newProducts,'productPoints'=>$productPoints,'offerProducts'=>$offerProducts,'friendRequest'=>$friendRequest]);
    }

}
