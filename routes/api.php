<?php

use Illuminate\Http\Request;
use App\Http\Middleware\VerifyToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::middleware(VerifyToken::class)->prefix('posts')->controller(PostController::class)->group(function () {
    
    Route::post('/', 'storePost');   
    Route::get('/', 'getPosts');
    Route::get('/user/{user}', 'getUserPosts');
    Route::get('/{post}', 'getPost');
    Route::get('/lastpost/user/{user}', 'getUserLastPost'); 

});

Route::middleware(VerifyToken::class)->controller(CommentController::class)->group(function () {
    
    Route::post('/posts/{post}/comment', 'storeComment');
    Route::get('/comments/search', 'searchComments');
    Route::get('/comments', 'getComments');   

});

Route::middleware(VerifyToken::class)->prefix('role/user')->controller(RoleController::class)->group(function () {
    
 Route::post('/{user}', 'assignRole'); 
 Route::get('/{user}', 'getRoles'); 

});

Route::middleware(VerifyToken::class)->group(function () {
    
    Route::get('users/search', [UserController::class, 'searchUsers']);
    Route::get('users/{user:name}', [UserController::class, 'getUserByName']);
    Route::delete('/users/{user}', [UserController::class, 'deleteUser']);    
});

