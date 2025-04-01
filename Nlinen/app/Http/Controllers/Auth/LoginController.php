<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }



    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
    
        $remember = $request->has('remember'); // ตรวจสอบ Remember Me
    
        if (Auth::attempt(['userName' => $request->username, 'password' => $request->password], $remember)) {
            // สร้าง Cookie จำ Username ถ้ามี Remember Me
            if ($remember) {
                cookie()->queue('remembered_username', $request->username, 60 * 24 * 30); // 30 วัน
            } else {
                cookie()->queue(cookie()->forget('remembered_username')); // ลบ Cookie ถ้าไม่ Remember Me
            }
    
            $user = Auth::user();
            return $user->PmID == 1 ? redirect()->route('admin.home') : redirect()->to('/');
        }
    
        return redirect()->back()->with('error', 'ล็อกอินไม่สำเร็จ');
    }
    
}
