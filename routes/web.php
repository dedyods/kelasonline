<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

Route::match(['get', 'post'], '/register', function () {
    return redirect("/login");
})->name("register");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('template', 'layouts.bootstrap');
Route::resource('users', UserController::class);

Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
Route::get('category/{id}/restore',[CategoryController::class,'restore'])->name('category.restore');
Route::resource('category',CategoryController::class);


