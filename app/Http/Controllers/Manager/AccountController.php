<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午7:01
 */

namespace App\Http\Controllers\Manager;

use App\Entity\Admin;
use App\Entity\Customer;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mail;

class AccountController extends Controller
{
    public function toList(Request $request)
    {
        $accounts = Admin::all();

        //接受 get 参数
        $col = $request->input('col', '');
        $sort = $request->input('sort', '');

        switch ($col) {
            case "id":
                if ($sort == "desc") {
                    $customers = Customer::orderBy('id', 'DESC')->get();

                } else if ($sort == "asc") {
                    $customers = Customer::orderBy('id', 'ASC')->get();
                }
                break;
        }
        //看起来只能在这里面来做拆分
        $designers = Admin::where('role', '=', '设计师')->get();
        $admins = Admin::where('role', '=', '管理员')->get();
        $pms = Admin::where('role', '=', '项目经理')->get();
        $salers = Admin::where('role', '=', '销售人员')->get();

        return view('manager.account_list')->with('accounts', $accounts)
            ->with('sort', $sort)
            ->with('designers', $designers)->with('salers', $salers)->with('pms', $pms)->with('admins', $admins);
    }

    public function toUpdate(Request $request)
    {

        $id = $request->input('id', '');
//      Album::where('artist', '=', 'Something Corporate')->get(array('id','title'));
        $account = Admin::find($id);
        return view('manager.account_edit')->with('account', $account);

    }

    public function toAdd()
    {
        return view('manager.account_add');
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
        $m3_result->message = '添加成功';

        return $m3_result->toJson();

    }

    public function add(Request $request)
    {

        $username = $request->input('username', '');
        $role = $request->input('role', '');
        $password = $request->input('password', '');

        $account = new Admin;
        $account->username = $username;
        $account->password = $password;
        $account->role = $role;
        $account->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function delete(Request $request)
    {
        $id = $request->input('id', '');
        DB::table('admins')->where('id', '=', $id)->delete();
        $accounts = Admin::all();

        $designers = Admin::where('role', '=', '设计师')->get();
        $admins = Admin::where('role', '=', '管理员')->get();
        $pms = Admin::where('role', '=', '项目经理')->get();
        $salers = Admin::where('role', '=', '销售人员')->get();

        return view('manager.account_list')->with('accounts', $accounts)
            ->with('designers', $designers)->with('salers', $salers)->with('pms', $pms)->with('admins', $admins);
    }


//    public function deleteLog(Request $request)
//    {
//        $id = $request->input('id', '');
//        DB::table('project_log')->where('id', '=', $id)->delete();
//
//        $m3_result = new M3Result();
//        $m3_result->status = 0;
//        $m3_result->message = '添加成功';
//
//        return $m3_result->toJson();
//    }

}
