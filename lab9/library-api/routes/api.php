<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;



Route::get('/books', [BooksController::class, 'getAll']);
Route::get('/authors', [AuthorsController::class, 'getAll']);
Route::get('/genres', [GenresController::class, 'getAll']);

Route::get('/books/{id}', [BooksController::class, 'getById']);
Route::get('/authors/{id}', [AuthorsController::class, 'getById']);
Route::get('/genres/{id}', [GenresController::class, 'getById']);

Route::post('/books', [BooksController::class, 'store']);
Route::post('/authors', [AuthorsController::class, 'store']);
Route::post('/genres', [GenresController::class, 'store']);

Route::put('/books/{id}', [BooksController::class, 'update']);
Route::put('/authors/{id}', [AuthorsController::class, 'update']);
Route::put('/genres/{id}', [GenresController::class, 'update']);

Route::delete('/books/{id}', [BooksController::class, 'delete']);
Route::delete('/authors/{id}', [AuthorsController::class, 'delete']);
Route::delete('/genres/{id}', [GenresController::class, 'delete']);




