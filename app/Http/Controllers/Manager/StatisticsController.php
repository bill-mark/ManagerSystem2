<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午7:01
 */


namespace App\Http\Controllers\Manager;

use App\Entity\Customer;
use App\Entity\Project;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use \Mail;

class StatisticsController extends Controller
{
    public function toCRM()
    {
//各状态客户数量
        $status_counts = array();
        $uncommunicate_count = count(Customer::where('status', '=', '未联系')->get());
        $communicating_count = count(Customer::where('status', '=', '沟通中')->get());
        $reject_count = count(Customer::where('status', '=', '拒绝')->get());
        $follow_count = count(Customer::where('status', '=', '跟进')->get());
        $success_count = count(Customer::where('status', '=', '已转化')->get());
        array_push($status_counts, $uncommunicate_count, $communicating_count, $reject_count, $follow_count, $success_count);

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

            $i += $count;
        }

//最近一周新增客户数量
        $time = time() - 3600 * 24 * 7;
        $new_counts = 0;
        foreach ($customers as $item) {
            if (strtotime($item->created_at) > $time) {
                $new_counts += 1;
            }
        }
        return view('manager.crm_statistics')->with('status_counts', $status_counts)
            ->with('source_counts', $source_counts)
            ->with('new_counts', $new_counts);
    }

    public function toProject()
    {

//各阶段数量
        $counts = array();
        $communicate_count = count(Project::where('stage', '=', '沟通')->get());
        $meet_count = count(Project::where('stage', '=', '见面/量房')->get());
        $floorplan_count = count(Project::where('stage', '=', '平图')->get());
        $contract_count = count(Project::where('stage', '=', '合同')->get());
        $design_count = count(Project::where('stage', '=', '设计图')->get());
        $money_count = count(Project::where('stage', '=', '打款')->get());
        $begin_count = count(Project::where('stage', '=', '开工')->get());

        array_push($counts, $communicate_count, $meet_count, $floorplan_count, $contract_count, $design_count, $money_count, $begin_count);

//各面积数量
        $area_counts = array();
        $projects = Project::all();

        $scope01 = 0;//0-500
        $scope02 = 0;//501-1000
        $scope03 = 0;//1000+
        $quoteSum = 0;

        foreach ($projects as $item) {

            $quoteSum += $item->quote;

            if (0 < intval($item->area) && intval($item->area) < 501) {
                $scope01 += 1;
            } else if (intval($item->area) > 500 && intval($item->area) < 1001) {
                $scope02 += 1;
            } else {
                $scope03 += 1;
            }
        }

        array_push($area_counts, $scope03, $scope02, $scope01);

//总报价金额

//        foreach ($customers as $item) {
//            array_push($source_all, $item->source);
//        }

//各套餐数量
        $mealtype_counts = array();
        $standard_count = count(Project::where('meal_type', '=', '标准')->get());
        $unstandard_count = count(Project::where('meal_type', '=', '非标准')->get());

        array_push($mealtype_counts, $standard_count, $unstandard_count);

//        $array_encode = json_encode($communicate);//转成json
//        $array_decode = json_decode($communicate);//转化为PHP对象,获取值可以通过$array_decode->name
//        $customers = Customer::orderBy('id', 'DESC')->get();
//
        return view('manager.project_statistics')->with('counts', $counts)
            ->with('area_counts', $area_counts)
            ->with('mealtype_counts', $mealtype_counts)
            ->with('quoteSum', $quoteSum);

    }

}
