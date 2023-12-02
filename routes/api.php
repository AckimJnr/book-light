<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResources([
//     'books' => BookController::class,
//     'users' => UserController::class,
//     'roles' => RoleController::class,
//     'book-accesses' => BookAccessController::class,
// ]);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('books', BookController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('book-accesses', BookAccessController::class);
});
