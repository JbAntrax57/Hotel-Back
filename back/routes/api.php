<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\sys\UsersController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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
Route::middleware('web')->group(function () {
    Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/logIn', 'logIn');
    Route::post('/logOut', 'logOut');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/users', 'getAll');
    Route::post('/users', 'create');
    Route::post('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
