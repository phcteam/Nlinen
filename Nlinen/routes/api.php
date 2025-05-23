<?php

use App\Http\Controllers\NewLinenController;
use App\Http\Controllers\SignatureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/product', function (Request $request) {
    $user = Auth::user();
    return response()->json($user);
});


Route::get('/newlinen', [NewLinenController::class, 'index']);
Route::post('/newlinen', [NewLinenController::class, 'store']);
Route::put('/newlinen/{id}', [NewLinenController::class, 'update']);
Route::delete('/newlinen/{id}', [NewLinenController::class, 'destroy']);


Route::post('/save-signature', [SignatureController::class, 'store']); // บันทึก ลายเซ็น
