<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    // cusntructor
    public function __cosntructor()
    {
        $this->middleware('guest:admin');
    }

    // show login form
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // login function
    public function login(Request $req)
    {
        // return true;
        // validasi form
        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // attemt to admin log in
        if (Auth::guard('admin')->attempt([
            'email' => $req->email,
            'password' => $req->password,
        ], $req->remeber)) {
            return redirect()->intended(route('adminadmin.dashboard'));
        }

        // jika salah
        return redirect()->back()->withInput($req->only('email', 'remember'));
    }
}
