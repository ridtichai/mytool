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


        if (isset($request->code)) {

            $url = "https://auth.rmutt.ac.th/oauth2";
            // กำหนดข้อมูลไว้ด้านนอกฟังก์ชัน
            $data = [
                "grant_type"    => "authorization_code",
                "client_id"     => "xxxxxx", // เปลี่ยนเป็น client_id ของคุณ
                "client_secret" => "xxxxxx", // เปลี่ยนเป็น client_secret ของคุณ
                "code"          => $request->code,
                "redirect_uri"  => "http://127.0.0.1:8080/callback"  // เปลี่ยนเป็น url callback ของคุณ
            ];

            // ส่ง $data เข้าไปในฟังก์ชัน
            $tokenData = exchangeCodeForToken($url, $data);


            if (isset($tokenData['error'])) {
                //   echo "Error : " . $tokenData['error'];
                return redirect()->route('login')->withErrors("Error : " . $tokenData['error']);
            } else if (isset($tokenData['access_token'])) {
                $userInfo = getUserInfo($url, $tokenData['access_token']);
                echo "<pre>";
                print_r($userInfo);
                echo "</pre>";

                //   dd(trim($userInfo->username));
                $checkuser = User::where('username', trim($userInfo->username))->first();

                if (!$checkuser) {
                    // ถ้าไม่พบผู้ใช้ในฐานข้อมูล ให้สร้างผู้ใช้ใหม่
                    $checkuser = new User();
                    $checkuser->username = trim($userInfo->username);
                    $checkuser->name     = trim($userInfo->name);
                    $checkuser->lastname = trim($userInfo->lastname);
                    $checkuser->countlogin = 0;
                    $checkuser->lastlogin  = date("Y-m-d H:i:s");
                    $checkuser->timestamps = false;

                    $checkuser->save();
                }

                if (Auth::loginUsingId($checkuser->id)) {

                    $model             = User::find($checkuser->id);
                    $model->countlogin = $model->countlogin + 1;
                    $model->lastlogin  = date("Y-m-d H:i:s");
                    $model->timestamps = false;

                    $model->save();

                    return redirect()->route('home');
                } else {

                    return redirect()->route('login')->withErrors('คุณไม่มีสิทธิ์เข้าถึงระบบ กรุณาติดต่อผู้ดูแลระบบ');
                }
            } else {
                //  echo "Unexpected response from token endpoint.";
                //  dd($tokenData);
                return redirect()->route('login')->withErrors('Unexpected response from token endpoint.');
            }
        } else {
            // ถ้าไม่มี code แสดงว่าผู้ใช้ปฏิเสธการเข้าถึง
            return redirect()->route('login')->withErrors('คุณปฏิเสธ ที่จะให้แอปพลิเคชันเข้าถึงข้อมูลของคุณ');
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
