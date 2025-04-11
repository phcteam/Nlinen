<?php

use App\Http\Controllers\NewLinenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified']);


Route::view('profile', 'auth.profile.index')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::get('/api/user', function (Request $request) {
    $user = Auth::user();
    return response()->json($user);
});

Route::get('/{any}', function () {
    return view('vue');
})
    ->middleware(['auth', 'verified'])
    // ->where('any', '.*');
    ->where('any', '^(?!api).*$');
