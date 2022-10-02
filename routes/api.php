<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Arrendador\ContractController;
use App\Http\Controllers\Api\Arrendador\PropertyController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function(){
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('logout', [AuthController::class, 'logout']);

    // Arrendador -> Contracts
    Route::prefix('arrendador/contracts')->group(function () {
        Route::get('/', [ContractController::class, 'index']);
        Route::post('/', [ContractController::class, 'store']);
    });

    // Arrendador -> Properties
    Route::prefix('arrendador/properties')->group(function () {
        Route::get('/', [PropertyController::class, 'index']);
        Route::post('/', [PropertyController::class, 'store']);
    });
});
