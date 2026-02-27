<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;




Route::get('/products', [ProductController::class, 'getProducts']);

Route::post('/products/create', [ProductController::class, 'createProduct']);

Route::get('/products/{id}', [ProductController::class, 'firstProduct']);