<?php

namespace App\Http\Controllers\Seller\Profile;

use App\Http\Controllers\Controller;

class FirebaseController extends Controller
{
    public function init()
    {
        return response()->view('firebase.sw_firebase')->header('Content-Type', 'application/javascript');
    }
}
