<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Auth::routes();

// Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

// Route::middleware([IsAdminMiddleware::class . ':1, 6'])->group(function () { //PmID 1 และ 6 เข้าได้เท่านั้น
//     Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
// });


// API Routes (ดึงข้อมูล user)
Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return response()->json($request->user());
});

Route::get('/{any}', [HomeController::class, 'index'])->where('any', '.*'); 

// Route::get('/tem', function () {
//     return view('test');
// });