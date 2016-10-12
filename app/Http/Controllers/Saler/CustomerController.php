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
use App\Entity\CustomerListFilter;
use App\Entity\CustomerLog;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use \Mail;

class CustomerController extends Controller
{
    public static $customers = array();
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

        $admin = $request->session()->get('admin');
        $username = $admin->username;

        self::$customers = Customer::where('principal', '=', $username)->get();

        $col = $request->input('col', '');
        $sort = $request->input('sort', '');

        $customer_list_filter = CustomerListFilter::find(1);
        $filter = $customer_list_filter->filter;
        $filter_value = $customer_list_filter->value;

        if ($request->get('reset')) {
            $filter = 'all';
        }

        if ($filter === 'all') {

            self::$customers = Customer::where('principal', '=', $username)->get();

        } else {

            self::$customers = Customer::where('principal', '=', $username)->where($filter, '=', $filter_value)->get();
        }

        switch ($col) {
            case "id":
                if ($sort == "desc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('id', 'DESC')->get();
                    } else {
                        self::$customers = Customer::where('principal', '=', $username)->where($filter, '=', $filter_value)->orderBy('id', 'DESC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);

                } else if ($sort == "asc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('id', 'ASC')->get();
                    } else {
                        self::$customers = Customer::where('principal','=',$username)->where($filter ,'=', $filter_value)->orderBy('id', 'ASC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);
                }
                break;
            case "priority":
                if ($sort == "desc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('id', 'DESC')->get();
                    } else {
                        self::$customers = Customer::where('principal', '=', $username)->where($filter, '=', $filter_value)->orderBy('priority', 'DESC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);
                } else if ($sort == "asc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('priority', 'ASC')->get();
                    } else {
                        self::$customers = Customer::where(['principal' => $username, $filter => $filter_value])->orderBy('priority', 'ASC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);
                }
                break;
            case "created_time":
                if ($sort == "desc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('created_at', 'DESC')->get();
                    } else {
                        self::$customers = Customer::where('principal', '=', $username)->where($filter, '=', $filter_value)->orderBy('created_at', 'DESC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);
                } else if ($sort == "asc") {
                    if ($filter === 'all') {
                        self::$customers = Customer::where('principal', '=', $username)->orderBy('created_at', 'ASC')->get();
                    } else {
                        self::$customers = Customer::where(['principal' => $username, $filter => $filter_value])->orderBy('created_at', 'ASC')->get();
                    }
                    return view('saler.customer_list')->with('customers', self::$customers)
                        ->with('sort', $sort)
                        ->with('salers', $salers)
                        ->with('source_counts', $source_counts)
                        ->with('customers_all', $customers_all);
                }
                break;
        }

        $filter_name = $request->input('filter_name', '');
        $value = $request->input('value', '');
        $export = $request->input('export', '');

        if ($filter_name != null) {

            self::$customers = Customer::where($filter_name, '=', $value)->where('principal', '=', $username)->get();

            $customer_list_filter = CustomerListFilter::find(1);

            $customer_list_filter->filter = $filter_name;
            $customer_list_filter->value = $value;
            $customer_list_filter->save();

            return view('saler.customer_list')->with('customers', self::$customers)
                ->with('sort', $sort)
                ->with('salers', $salers)
                ->with('source_counts', $source_counts)
                ->with('customers_all',$customers_all);

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
            return view('saler.customer_list')->with('customers', self::$customers)
                ->with('sort', $sort)
                ->with('salers', $salers)
                ->with('source_counts', $source_counts)
                ->with('customers_all',$customers_all);
        }
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


    public function toItemContent(Request $request)
    {
        $project_id = $request->input('id', '');

        $project = Project::find($project_id);

        $customer_name = $request->input('customer_name', '');
        $from = $request->input('from', '');

        $id_array = Customer::where('name', '=', $customer_name)->get();
        $id = $id_array[0]->id;

        $salers = Admin::where('role', '=', '销售人员')->get();

        $projects = Project::where('customer_name', '=', $customer_name)->get();

        $customer = Customer::find($id);

        $logs = CustomerLog::where('customer_id', '=', $id)->get();

        return view('manager.customer_content')->with('projects', $projects)
            ->with('customer', $customer)
            ->with('logs', $logs)
            ->with('salers', $salers)
            ->with('id', $id)
            ->with('from', $from)
            ->with('project_id', $project_id)
            ->with('project', $project);
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
        $principal_array = $request->input('principal', '');
        $principal = $principal_array[0];
        $status = $request->input('status', '');
        $priority = $request->input('priority', '');

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
        return view('manager.add_customer')->with('salers', $salers);
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
        $principal_array = $request->input('principal', '');
        $principal = $principal_array[0];

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
}
