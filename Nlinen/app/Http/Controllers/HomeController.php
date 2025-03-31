<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // return view('home');
        return redirect()->to('general/home');  

    }


    public function logout(Request $request)
    {
        $username = Auth::user()->userName; // ดึง Username ก่อน Logout
        Auth::logout();

        // ล้าง Session และ Redirect พร้อมตั้งค่า Cookie
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withCookie(cookie('remembered_username', $username, 60 * 24 * 30)); // 30 วัน
    }

    public function adminHome()
    {
        return view('home');
    }
}
