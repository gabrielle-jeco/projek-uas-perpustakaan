<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function(){
    return response()->json([
        'success'=>true,
        'data'=>'Test OK',
        'message'=>'Test success'
    ], 200);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/show-all', [BukuController::class, 'showAll']);
    Route::get('/show/{judul}', [BukuController::class, 'show']);
    Route::post('/store', [BukuController::class, 'store']);
    Route::post('/edit/{judul}', [BukuController::class, 'update']);
    Route::get('/delete/{judul}', [BukuController::class, 'destroy']);
});
