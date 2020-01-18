<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }


    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'username' => 'required|max:12',
            'password' => 'required|max:255'
        ]);

        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password'], 'status' => '1'], true)) {
            return response()->json(['success' => '1'], 200);
        }else{
            return response()->json(['success' => '0'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
