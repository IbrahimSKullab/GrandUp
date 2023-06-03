<?php


use App\Models\User;
use App\Models\Seller;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Store\StoreController;
use App\Http\Controllers\Frontend\Product\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route::redirect('/', '/home');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.home');
});



//Route::get('/home', [HomeController::class, 'index']);

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/categoty', [HomeController::class, 'category'])->name('category');
Route::get('/offer', [HomeController::class, 'offer'])->name('offer');

Route::get('/store', [StoreController::class, 'storePage'])->name('store');
Route::get('/allstores', [StoreController::class, 'index'])->name('allstores');