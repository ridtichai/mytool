<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view("pages.login.index");
    }


    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        //   dd($request->all());

        $check_user = User::where('username', trim($request->username))->first();

        if (Auth::loginUsingId($check_user->id)) {

            $model             = User::find($check_user->id);
            $model->countlogin = $model->countlogin + 1;
            $model->lastlogin  = date("Y-m-d H:i:s");
            $model->timestamps = false;

            $model->save();

            return redirect()->route('index');
        } else {

            return redirect()->route('login')->withErrors('เกิดข้อผิดพลาด');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
