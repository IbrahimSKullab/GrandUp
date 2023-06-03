<?php

namespace App\Http\Controllers\Frontend\Store;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    
    public function index()
    {
        return view('frontend.store.index');
    } 
    public function storePage()
    {
        return view('frontend.store.show');
    }

}
