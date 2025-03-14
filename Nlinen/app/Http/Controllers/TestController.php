<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $users = User::get();

        $permissions = Permission::get();



        foreach ($permissions as $key => $permission) {
            foreach ($permission->users as $key => $user) {
                echo $permission->permission . '|' . $user->UserName . "<br>";
            }
        }

        dd($users);
        return view('test');
    }
}
