<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午7:01
 */

namespace App\Http\Controllers;


use App\Entity\Admin;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use \Mail;

class LoginController extends Controller
{
    public function toLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
//        $role = $request->input('role', '');

        $m3_result = new M3Result();

        if ($username == '' || $password == '') {
            $m3_result->status = 1;
            $m3_result->message = "帐号或密码不能为空!";
            return $m3_result->toJson();
        }

        $admin = Admin::where('username', $username)->where('password', $password)->first();

        if (!$admin) {
            $m3_result->status = 2;
            $m3_result->message = "帐号或密码错误!";
        } else {
            $m3_result->status = 0;
            $m3_result->message = $admin->role;

            $request->session()->put('admin', $admin);
        }

        return $m3_result->toJson();

    }

    public function toExit(Request $request)
{
    $request->session()->forget('admin');
    return view('login');
}
}
