<?php

use App\Http\Controllers\NovaPoshtaController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/cities', [NovaPoshtaController::class, 'getCities']);
Route::get('/post_offices', [NovaPoshtaController::class, 'getPostOffices']);
