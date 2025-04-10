<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index($page = null, Request $request)
    {
        if (!$page) {
            return redirect()->route('general', 'home');
        }

        $generalMenus = config('myconfig.menus');
        $allowedPages = array_column($generalMenus, 'key');


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
