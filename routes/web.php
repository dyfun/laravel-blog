<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/dashboard/posts', PostController::class, ['names' => [
    'index'     => 'posts.all',
    'create'    => 'posts.add',
    'store'     => 'posts.store',
    'edit'      => 'posts.edit',
    'update'    => 'posts.update',
    'destroy'   => 'posts.destroy'

]])->middleware('role:1|2');
Route::get('/yazi/{slug}', [PostController::class, 'show']);

Route::resource('/dashboard/categories', CategoryController::class, ['names' => [
    'index'     => 'categories.all',
    'create'    => 'categories.add',
    'store'     => 'categories.store',
    'edit'      => 'categories.edit',
    'update'    => 'categories.update',
    'destroy'   => 'categories.destroy'

]])->middleware('role:1|2');
Route::get('/kategori/{slug}', [CategoryController::class, 'show']);

Route::resource('/dashboard/users', UserController::class, ['names' => [
    'index'     => 'users.all',
    'create'    => 'users.add',
    'store'     => 'users.store',
    'edit'      => 'users.edit',
    'update'    => 'users.update',
    'destroy'   => 'users.destroy'

]])->middleware('role:2');

Route::post('/comments/store', [HomeController::class, 'comment_store'])->name('comment_store')->middleware('auth');
Route::get('/ara', [HomeController::class, 'search'])->name('search');

