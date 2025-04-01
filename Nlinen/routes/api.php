<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', function () {
    return response()->json([
        ['id' => 1, 'name' => 'iPhone 15', 'price' => 35000],
        ['id' => 2, 'name' => 'Samsung S24', 'price' => 32000],
        ['id' => 3, 'name' => 'Xiaomi 14', 'price' => 25000]
    ]);
});

