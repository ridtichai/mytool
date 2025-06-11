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


        if (isset($_GET['code'])) {

            // กำหนดข้อมูลไว้ด้านนอกฟังก์ชัน
            $data = [
                "grant_type"    => "authorization_code",
                "client_id"     => "xxxxx", // เปลี่ยนเป็น client_id ของคุณ
                "client_secret" => "xxxxx", // เปลี่ยนเป็น client_secret ของคุณ
                "code"          => $_GET['code'],
                "redirect_uri"  => "http://localhost/testoauth2/callback"  // เปลี่ยนเป็น url callback ของคุณ
            ];

            // ส่ง $data เข้าไปในฟังก์ชัน
            $tokenData = exchangeCodeForToken($data);

            if (isset($tokenData['error'])) {
                echo "Error : " . $tokenData['error'];
            } else if (isset($tokenData['access_token'])) {
                $userInfo = getUserInfo($tokenData['access_token']);
                echo "<pre>";
                print_r($userInfo);
                echo "</pre>";
            } else {
                echo "Unexpected response from token endpoint.";
            }
        } else {
            echo "คุณปฏิเสธ ที่จะให้แอปพลิเคชันเข้าถึงข้อมูลของคุณ";
        }


        //   dd($request->all());
/*
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
        }*/
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
