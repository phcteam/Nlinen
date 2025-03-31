<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home'); //ทุกคนเข้าได้ แต่ต้อง login 
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::middleware([IsAdminMiddleware::class . ':1, 6'])->group(function () { //PmID 1 และ 6 เข้าได้เท่านั้น
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
});
 

Route::get('/general/{page?}', [GeneralController::class, 'index'])->name('general');


