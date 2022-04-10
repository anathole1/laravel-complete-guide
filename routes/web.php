<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
     $brands = DB::table('brands')->get();
     
    return view('home', compact('brands'));
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();, compact('users')
    return view('admin.index');
})->name('dashboard');
 
// __________view,delete,update,delete,restore,permanent delete category________ 
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);
// _____End_____view,delete,update,delete,restore,permanent delete category________ 

// brand
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/addBrand', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}',[BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//end brand

//multi Image
Route::get('/multi/image',[BrandController::class, 'MultiImage'])->name('multi.image');
Route::post('/multi/store_image',[BrandController::class, 'StoreImages'])->name('store.image');



// Admin All Route
Route::get('/home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::post('/slider/add',[HomeController::class, 'AddSlider'])->name('store.slider');


//logout route

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

