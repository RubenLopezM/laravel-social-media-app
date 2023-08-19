<?php

use Illuminate\Http\Request;
use App\Http\Middleware\VerifyToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/getaccount', [AuthController::class, 'getaccount']);
});

Route::middleware(VerifyToken::class)->group(function () {
    
    Route::post('/posts',[PostController::class, 'storePost']);   
    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/posts/user/{user}', [PostController::class, 'getUserPosts']);
    Route::get('/posts/{post}', [PostController::class, 'getPost']);
    Route::get('/lastpost/user/{user}', [PostController::class, 'getUserLastPost']); 

});

Route::middleware(VerifyToken::class)->group(function () {
    
    Route::post('/posts/{post}/comment', [CommentController::class, 'storeComment']);
    Route::get('/comments',[CommentController::class, 'getComments']);   

});

Route::middleware(VerifyToken::class)->group(function () {
    
 Route::post('role/user/{user}', [RoleController::class, 'assignRole']); 

});

Route::middleware(VerifyToken::class)->group(function () {
    
    Route::delete('/users/{user}', [UserController::class, 'deleteUser']);    
});

