<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthApiController::class, 'register']);
Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', static fn() => Auth::user());
    Route::get('logout', [AuthApiController::class, 'logout']);
});


Route::apiResource('/vehiculos', VehiculoController::class)
     ->except('create', 'edit')
     ->names('vehiculo');

Route::apiResource('/users', UserController::class)
     ->except('create', 'edit')
     ->names('user');
