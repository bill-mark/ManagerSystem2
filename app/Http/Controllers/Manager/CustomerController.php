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
use App\Entity\CustomerListFilter;
use App\Entity\CustomerLog;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mail;
use Excel;

class CustomerController extends Controller
{

    public function exportAllCustomers()
    {
        $Customer = Customer::all();

        $customers = array();

        $title = ['客户ID', '客户名称', '客户公司', '电话', '介绍', '来源', '负责人', '状态', '优先级'];
        array_push($customers, $title);

        //要手动构造一个二维数组
        foreach ($Customer as $item) {
            $arr = array();
            array_push($arr, $item['id'], $item['name'], $item['company'], $item['phone'], $item['description'],
                $item['source'], $item['principal'], $item['status'], $item['priority']);
            array_push($customers, $arr);
        }

        $footer = ['注意:优先级的值2,1,0分别代表:高,中,低'];
        array_push($customers, $footer);
        Excel::create('客户表', function ($excel) use ($customers) {
            $excel->sheet('score', function ($sheet) use ($customers) {
                $sheet->rows($customers);
            });
        })->export('xls');

    }

    public static $customers = array();
    public static $customers_hold = array();

    public function toList(Request $request)
    {

        $salers = Admin::where('role', '=', '销售人员')->get();

        $source_counts = array();
        $customers_all = Customer::all();
        $source_all = array();

        foreach ($customers_all as $item) {
            array_push($source_all, $item->source);
        }

        sort($source_all);

        for ($i = 0; $i < sizeof($source_all);) {

            $count = 0;

            for ($j = $i; $j < sizeof($source_all); $j++) {

                if ($source_all[$i] == $source_all[$j]) {
                    $count++;
                }
            }
            array_push($source_counts, [$source_all[$i], $count]);
            $i += $count;
        }

        self::$customers = Customer::all();

        $col = $request->input('col', '');
        $sort = $request->input('sort', '');

        $customer_list_filter = CustomerListFilter::find(1);
        $filter = $customer_list_filter->filter;
        $filter_value = $customer_list_filter->value;
        if ($request->get('reset')) {
            $filter = 'all';
        }
        

        if ($filter === 'all') {

            self::$customers = Customer::all();

        } else {

            self::$customers = Customer::where($filter, '=', $filter_value)->get();
        }

        switch ($col) {
            case "id":
                if ($sort == "desc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::orderBy('id', 'DESC')->get();
                    } else {
                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('id', 'DESC')->get();
                    }
                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));

                } else if ($sort == "asc") {
                    if ($filter === 'all') {

                        self::$customers = Customer::orderBy('id', 'ASC')->get();
                    } else {

                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('id', 'ASC')->get();
                    }

                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));

                }
                break;
            case "priority":
                if ($sort == "desc") {
                    if ($filter === 'all') {

                        self::$customers = Customer::orderBy('priority', 'DESC')->get();

                    } else {

                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('priority', 'DESC')->get();
                    }

                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));

                } else if ($sort == "asc") {


                    if ($filter === 'all') {

                        self::$customers = Customer::orderBy('priority', 'ASC')->get();

                    } else {

                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('priority', 'ASC')->get();
                    }

                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));
                }
                break;
            case "created_time":
                if ($sort == "desc") {
                    if ($filter === 'all') {

                        self::$customers = Customer::orderBy('created_at', 'DESC')->get();
                    } else {

                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('created_at', 'DESC')->get();
                    }

                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));

                } else if ($sort == "asc") {

                    if ($filter === 'all') {

                        self::$customers = Customer::orderBy('created_at', 'ASC')->get();
                    } else {

                        self::$customers = Customer::where($filter, '=', $filter_value)->orderBy('created_at', 'ASC')->get();
                    }
                    return view('manager.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all',$customers_all)
                        ->with('query_value', $request->get('value'))
                        ->with('filter_name', $request->get('filter_name'));
                }
                break;
        }

        $filter_name = $request->input('filter_name', '');
        $value = $request->input('value', '');
        $export = $request->input('export', '');

        if ($filter_name != null) {

            self::$customers = Customer::where($filter_name, '=', $value)->get();

            $customer_list_filter = CustomerListFilter::find(1);

            $customer_list_filter->filter = $filter_name;
            $customer_list_filter->value = $value;
            $customer_list_filter->save();

            return view('manager.customer_list')->with('customers', self::$customers)
                ->with('sort', $sort)
                ->with('salers', $salers)
                ->with('source_counts', $source_counts)
                ->with('customers_all',$customers_all)
                ->with('query_value', $request->get('value'))
                ->with('filter_name', $request->get('filter_name'));

        } elseif ($export != null && $export === 'true') {

            $customer_list_filter = CustomerListFilter::find(1);
            $filter = $customer_list_filter->filter;

            if ($filter === 'all') {

                $data = Customer::all();

            } else {
                $filter_value = $customer_list_filter->value;
                $data = Customer::where($filter, '=', $filter_value)->get();
            }

            $Customers = array();

            $title = ['客户ID', '客户名称', '客户公司', '电话', '介绍', '来源', '负责人', '状态', '优先级'];
            array_push($Customers, $title);

            //要手动构造一个二维数组
            foreach ($data as $item) {
                $arr = array();
                array_push($arr, $item['id'], $item['name'], $item['company'], $item['phone'], $item['description'],
                    $item['source'], $item['principal'], $item['status'], $item['priority']);
                array_push($Customers, $arr);
            }

            $footer = ['注意:优先级的值2,1,0分别代表:高,中,低'];
            array_push($Customers, $footer);
            Excel::create('客户表', function ($excel) use ($Customers) {
                $excel->sheet('score', function ($sheet) use ($Customers) {
                    $sheet->rows($Customers);
                });
            })->export('xls');

        } else {

            $customer_list_filter = CustomerListFilter::find(1);
            $customer_list_filter->filter = 'all';
            $customer_list_filter->value = '';
            $customer_list_filter->save();
            return view('manager.customer_list')->with('customers', self::$customers)
                ->with('sort', $sort)
                ->with('salers', $salers)
                ->with('source_counts', $source_counts)
                ->with('customers_all',$customers_all)
                ->with('query_value', $request->get('value'))
                ->with('filter_name', $request->get('filter_name'));

        }
    }

    public function toItemContent(Request $request)
    {

        $project_id = $request->input('id', '');

        $project = Project::find($project_id);

        
        $customer_id = $request->input('customer_id', null);

        $from = $request->input('from', '');

        if ($customer_id) {
            $customer = Customer::find($customer_id);
            $customer_name = $customer->name;
        } else {
            $customer_name = $request->input('customer_name', '');
            $customer = Customer::where('name', '=', $customer_name)->first();
        }

//       $log = (CustomerLog::where('id', $id)->get())[0];

        $id = $customer ? $customer->id : null;
        $salers = Admin::where('role', '=', '销售人员')->get();

        $projects = Project::where('customer_name', '=', $customer_name)->get();

     

        $logs = $id ? CustomerLog::where('customer_id', '=', $id)->get() : [];

        $source_counts = array();
        $customers = Customer::all();
        $source_all = array();

        foreach ($customers as $item) {
            array_push($source_all, $item->source);
        }

        sort($source_all);

        for ($i = 0; $i < sizeof($source_all);) {

            $count = 0;

            for ($j = $i; $j < sizeof($source_all); $j++) {

                if ($source_all[$i] == $source_all[$j]) {
                    $count++;
                }
            }
            array_push($source_counts, [$source_all[$i], $count]);
            $i += $count;
        }

        $submitter_array = $request->session()->get('admin');
        $role_now = $submitter_array->role;
        return view('manager.customer_content')->with('projects', $projects)
            ->with('customer', $customer)
            ->with('logs', $logs)
            ->with('salers', $salers)
            ->with('id', $id)
            ->with('from', $from)
            ->with('project_id', $project_id)
            ->with('project', $project)
            ->with('source_counts', $source_counts)
            ->with('role_now', $role_now);
    }

    public function test()
    {
        return self::$customers;
    }

    public function query(Request $request)
    {
        $sort = '';

        $filter_name = $request->input('filter_name', '');
        $value = $request->input('value', '');
        $customers = Customer::where($filter_name, '=', $value)->get();

        return view('manager.customer_list_query')->with('customers', $customers)
            ->with('sort', $sort);
    }

    public function toAddLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_log')->with('id', $id);
    }

    public function addLog(Request $request)
    {
        $content = $request->input('content', '');

        $submitter_array = $request->session()->get('admin');
        $submitter = $submitter_array->username;

        $id = $request->input('id', '');
        $new_log = new CustomerLog;
        $new_log->content = $content;
        $new_log->submitter = $submitter;
        $new_log->customer_id = $id;
        $new_log->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function addCustomer(Request $request)
    {
        $name = $request->input('name', '');
        $company = $request->input('company', '');
        $phone = $request->input('phone', '');
        $description = $request->input('description', '');
        $source = $request->input('source', '');
        $principal = $request->input('principal', '');
        $status = $request->input('status', '');
        $priority = $request->input('priority', '');
        $isSourceArray = $request->input('isSourceArray','');

        $new_customer = new Customer;

        $new_customer->name = $name;
        $new_customer->company = $company;
        $new_customer->phone = $phone;
        $new_customer->description = $description;
        $new_customer->source = $source;
        $new_customer->principal = $principal;
        $new_customer->status = $status;
        $new_customer->priority = $priority;

        $new_customer->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();

    }

    public function toAdd()
    {
        $salers = Admin::where('role', '=', '销售人员')->get();
        $source_counts = array();
        $customers = Customer::all();
        $source_all = array();

        foreach ($customers as $item) {
            array_push($source_all, $item->source);
        }

        sort($source_all);

        for ($i = 0; $i < sizeof($source_all);) {
            $count = 0;

            for ($j = $i; $j < sizeof($source_all); $j++) {

                if ($source_all[$i] == $source_all[$j]) {
                    $count++;
                }
            }
            array_push($source_counts, [$source_all[$i], $count]);

            $i += $count;
        }

        return view('manager.add_customer')->with('salers', $salers)
            ->with('source_counts', $source_counts);
    }

    public function edit(Request $request)
    {
        $id = $request->input('id', '');
        $name = $request->input('name', '');
        $company = $request->input('company', '');
        $phone = $request->input('phone', '');
        $description = $request->input('desc', '');
        $status = $request->input('status', '');
        $priority = $request->input('priority', '');
        $source = $request->input('source', '');
        $principal = $request->input('principal', '');

        $new_customer = Customer::find($id);

        $new_customer->name = $name;
        $new_customer->company = $company;
        $new_customer->phone = $phone;
        $new_customer->description = $description;
        $new_customer->source = $source;
        $new_customer->principal = $principal;
        $new_customer->status = $status;
        $new_customer->priority = $priority;

        $new_customer->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();

    }

    public function exportCustomerSta()
    {

        $customer_statistic = array();

//各状态客户数量
        $status_counts = array();
        $uncommunicate_count = count(Customer::where('status', '=', '未联系')->get());
        $communicating_count = count(Customer::where('status', '=', '沟通中')->get());
        $reject_count = count(Customer::where('status', '=', '拒绝')->get());
        $follow_count = count(Customer::where('status', '=', '跟进')->get());
        $success_count = count(Customer::where('status', '=', '已转化')->get());
        array_push($status_counts, $uncommunicate_count, $communicating_count, $reject_count, $follow_count, $success_count);
        array_push($customer_statistic, ['各状态客户数量:']);
        array_push($customer_statistic, ['未联系', '沟通中', '拒绝', '跟进', '已转化']);
        array_push($customer_statistic, $status_counts);

        array_push($customer_statistic, ['']);
        array_push($customer_statistic, ['']);
        array_push($customer_statistic, ['各来源客户数量:']);
//各来源客户数量(这里涉及到一个小算法)
        $source_counts = array();
        $customers = Customer::all();
        $source_all = array();

        foreach ($customers as $item) {
            array_push($source_all, $item->source);
        }

        sort($source_all);

        for ($i = 0; $i < sizeof($source_all);) {
            $count = 0;

            for ($j = $i; $j < sizeof($source_all); $j++) {

                if ($source_all[$i] == $source_all[$j]) {
                    $count++;
                }
            }
            array_push($source_counts, [$source_all[$i], $count]);
            array_push($customer_statistic, [$source_all[$i], $count]);
            $i += $count;
        }


        array_push($customer_statistic, ['']);
        array_push($customer_statistic, ['']);

//最近一周新增客户数量
        $time = time() - 3600 * 24 * 7;
        $new_counts = 0;
        foreach ($customers as $item) {
            if (strtotime($item->created_at) > $time) {
                $new_counts += 1;
            }
        }

        array_push($customer_statistic, ['最近一周新增客户数量:']);
        array_push($customer_statistic, [$new_counts]);


        Excel::create('客户统计信息表', function ($excel) use ($customer_statistic) {
            $excel->sheet('score', function ($sheet) use ($customer_statistic) {
                $sheet->rows($customer_statistic);
            });
        })->export('xls');
    }

    public function deleteLog(Request $request)
    {
        $id = $request->input('id','');
        DB::table('customer_log')->where('id','=',$id)->delete();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function toLogEdit(Request $request)
    {
        $id = $request->input('id', '');
        $log = CustomerLog::where('id', $id)->get()[0];
        return view('manager.edit_customer_log')->with('log', $log);
    }

    public function logEdit(Request $request)
    {

        $id = $request->input('id', '');
        $content = $request->input('content', '');
        $submitter_array = $request->session()->get('admin');
        $submitter = $submitter_array->username;

        $log = CustomerLog::find($id);
        $log->submitter = $submitter;
        $log->content = $content;
        $log->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();

    }
}
