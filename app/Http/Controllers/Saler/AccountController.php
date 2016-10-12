<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午7:01
 */

namespace App\Http\Controllers\Saler;

use App\Entity\Admin;
use App\Entity\Customer;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use \Mail;

class AccountController extends Controller
{
    public function toIndex(Request $request)
    {

        $admin = $request->session()->get('admin');

        return view('saler.account')->with('admin', $admin);
    }

    public function edit(Request $request)
    {

        $id = $request->input('id', '');
        $password = $request->input('password', '');

        $account = Admin::find($id);
        $account->password = $password;
        $account->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '修改成功';

        return $m3_result->toJson();
    }
}
