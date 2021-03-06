<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class);
Route::resource('category', CategoryController::class);
Route::resource('subcategory', SubCategoryController::class);

// SubCategory DropDown
Route::get('getSubCategory/{id}', function ($id) {
    $categories = Category::find($id);
    $subcategories = $categories->subcategory;    
     return response()->json($subcategories);
});

});

// Route::get('/getSubCategory/{id}', [SubCategoryController::class, 'getSubCategory']);
