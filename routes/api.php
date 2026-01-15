<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register', [AuthController::class, 'register']);

Route::get('category',[AuthController::class, 'categoryList'])->middleware('auth:sanctum');

//Posts
Route::get('allPostList',[PostController::class, 'getAllPost']);
Route::post('post/search', [PostController::class, 'postSearch']);
Route::post('post/details', [PostController::class, 'postDetails']);

//Category
Route::get('allCategoryList',[CategoryController::class, 'getAllCategory']);
Route::post('category/search', [CategoryController::class, 'categorySearch']);

//Action Log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
