<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TraceController;

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


Auth::routes();

//Admin用
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/users_list', [AdminController::class, 'users_list'])->name('users_list');
        Route::get('/users_list/{id}', [AdminController::class, 'users_show'])->name('users_show');
        Route::get('/contents_list', [AdminController::class, 'contents_list'])->name('contents_list');
        Route::get('/contents_list/{id}', [AdminController::class, 'contents_show'])->name('contents_show');
});

//ログインユーザー用
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [ContentsController::class, 'index'])->name('index');

    Route::prefix("content")->group(function(){
        Route::get('/add_content', [ContentsController::class, 'add_content'])->name('content.add_content');
        Route::get('/add_content_success', [ContentsController::class, 'add_content_success'])->name('content.add_content_success');
        Route::post('/store', [ContentsController::class, 'add_content_store'])->name('content_store');
        Route::delete('/{id}', [ContentsController::class, 'content_delete'])->name('content_delete');
    });
    Route::prefix("trace")->group(function(){
        Route::get('/content_detail', [TraceController::class, 'content_detail'])->name('content_detail');
        Route::post('/content_detail_sotre', [TraceController::class, 'content_detail_store'])->name('content_detail_store');
    });
    Route::prefix("user")->group(function(){
        Route::get('/info', [UserController::class, 'user_info'])->name('user_info');
        Route::get('/logout', [UserController::class, 'user_logout'])->name('user_logout');
        Route::get('/info_edit', [UserController::class, 'user_info_edit'])->name('user_info_edit');
        Route::get('/info_edit_success', [UserController::class, 'user_info_edit_success'])->name('user_info_edit_success');
        Route::post('/updete', [UserController::class, 'user_updete'])->name('user_updete');

    });
});

//非ログインユーザー用
Route::get('/', [ContentsController::class, 'index'])->name('index');
Route::get('trace/content_detail', [TraceController::class, 'content_detail'])->name('content_detail');
