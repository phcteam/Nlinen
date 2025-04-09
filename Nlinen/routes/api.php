<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/user', function (Request $request) {
//     $user = Auth::user();
//     return response()->json($user);
// });

 
Route::get('/products', function (Request $request) {
    return response()->json([
        [
            'id' => 1,
            'department' => 'แผนกกลาง',
            'name' => 'แผ่นเหล็ก',
            'unit' => 'แผ่น',
            'quantity' => 10,
            'weight' => 12.5
        ],
        [
            'id' => 2,
            'department' => 'ฝ่ายผลิต',
            'name' => 'เหล็กกล่อง',
            'unit' => 'ชิ้น',
            'quantity' => 5,
            'weight' => 8.2
        ],
        [
            'id' => 3,
            'department' => 'คลังสินค้า',
            'name' => 'ท่อเหล็ก',
            'unit' => 'เมตร',
            'quantity' => 20,
            'weight' => 30.0
        ]
    ]);
    
}) ;