<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index($page = null, Request $request)
    {
        // ถ้าไม่มี page ให้ Redirect ไป /general/home
        if (!$page) {
            return redirect()->route('general', 'home');
        }

        $generalMenus = config('myconfig.menus');
        $allowedPages = array_column($generalMenus, 'key');

        // dd($allowedPages);
        // $allowedPages = ['home', 'about', 'contact'];

        if (!in_array($page, $allowedPages)) {
            abort(404);
        }

        if ($request->ajax()) {
            return view("pages.$page");
        }

        $content = view("pages.$page")->render();
        return view('layouts.app', compact('content'));
    }
}
