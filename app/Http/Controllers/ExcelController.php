<?php

namespace App\Http\Controllers;

use App\Entity\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;


class ExcelController extends Controller
{
    public function export()
    {
        $Customer = Customer::all();

        $customers = array();

        //要手动构造一个二维数组
        foreach ($Customer as $item) {
            $arr = array();

            array_push($arr, $item['id'], $item['name'], $item['company'], $item['phone'], $item['description'],
                $item['source'], $item['principal'], $item['status'], $item['priority']);

            array_push($customers, $arr);
        }

        $title = [];

        Excel::create('客户表', function ($excel) use ($customers) {
            $excel->sheet('score', function ($sheet) use ($customers) {
                $sheet->rows($customers);
            });
        })->export('xls');

    }
}


