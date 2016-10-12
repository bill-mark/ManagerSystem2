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
use App\Entity\ProjectLog;
use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mail;
use Excel;

class ProjectController extends Controller
{
    public function toList(Request $request)
    {

        $projects = Project::all();

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

        return view('manager.project_list')->with('projects', $projects)
            ->with('sort', $sort);
    }

    public function toEdit(Request $request)
    {
        $from = $request->input('from', '');
        $id = $request->input('id', '');
        $project = Project::find($id);
        $salers = Admin::where('role', '=', '销售人员')->get();
        $designers = Admin::where('role', '=', '设计师')->get();
        $pms = Admin::where('role', '=', '项目经理')->get();
        $customers = Customer::all();

        return view('manager.project_edit')->with('project', $project)
            ->with('pms', $pms)
            ->with('salers', $salers)
            ->with('designers', $designers)
            ->with('customers', $customers)
            ->with('id', $id)
            ->with('from', $from);

    }

    public function toAdd()
    {
        $pms = Admin::where('role', '=', '项目经理')->get();
        $salers = Admin::where('role', '=', '销售人员')->get();
        $designers = Admin::where('role', '=', '设计师')->get();
        $customers = Customer::all();

        return view('manager.project_add')->with('pms', $pms)
            ->with('salers', $salers)
            ->with('designers', $designers)
            ->with('customers', $customers);
    }

    public function addProject(Request $request)
    {
        $quote = $request->input('quote', '');
        $budget = $request->input('budget', '');

        $designer = $request->input('designer', '');
        $pm = $request->input('pm', '');
        $saler = $request->input('saler', '');
        $customer_name = $request->input('customer_name', '');
        $address = $request->input('address', '');
        $workforce = $request->input('workforce', '');
        $area = $request->input('area', '');
        $name = $request->input('name', '');
        $requirements = $request->input('requirements', '');
        $completion_time = $request->input('completion_time', '');
        $houseType = $request->input('houseType', '');
        $mealType = $request->input('mealType', '');
        $stage = $request->input('stage', '');
        $priority = $request->input('priority', '');
        $houseSituation = $request->input('houseSituation', '');
        $status = $request->input('status', '');

        $project = new Project;
        $project->customer_name = $customer_name;
        $project->houseSituation = $houseSituation;
        $project->quote = $quote;
        $project->budget = $budget;
        $project->designer_name = $designer;
        $project->pm_name = $pm;
        $project->address = $address;
        $project->workforce = $workforce;
        $project->area = $area;
        $project->name = $name;
        $project->saler_name = $saler;
        $project->requirements = $requirements;
        $project->completion_time = $completion_time;
        $project->houseType = $houseType;
        $project->meal_type = $mealType;
        $project->stage = $stage;
        $project->priority = $priority;
        $project->status = $status;

        $project->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    //项目进度
    public function toStage(Request $request)
    {
        $id = $request->input('id', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $stage_now_array = Project::where('id', '=', $id)->first();
        $stage_now = $stage_now_array ? $stage_now_array->stage : null;
        $submitter_array = $request->session()->get('admin');
        $role_now = $submitter_array->role;
        return view('manager.project_stage')->with('logs', $logs)
            ->with('stage_now', $stage_now)
            ->with('id', $id)
            ->with('project', $project)
            ->with('role_now', $role_now);
    }

    //报价
    public function toQuote(Request $request)
    {
        $id = $request->input('id', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $quote_now_array = Project::where('id', '=', $id)->get();
        $quote_now = $quote_now_array[0]->quote;
        //添加当前用户,来处理删除按钮的显示与隐藏
        $submitter_array = $request->session()->get('admin');
        $role_now = $submitter_array->role;
//        $admin_now = Admin::where('username',  '=' ,$username_now)->get();
//        $role_now = $admin_now->role;
        return view('manager.project_quote')->with('logs', $logs)
            ->with('quote_now', $quote_now)
            ->with('id', $id)
            ->with('project', $project)
            ->with('role_now', $role_now);
    }

    //设计log
    public function toDesigner(Request $request)
    {
        $id = $request->input('id', '');
        $from = $request->input('from', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $quote_now_array = Project::where('id', '=', $id)->get();
        $quote_now = $quote_now_array[0]->quote;
        //添加当前用户,来处理删除按钮的显示与隐藏
        $submitter_array = $request->session()->get('admin');
        $role_now = $submitter_array->role;
        return view('manager.project_designer')->with('logs', $logs)
            ->with('quote_now', $quote_now)
            ->with('id', $id)
            ->with('project', $project)
            ->with('from', $from)
            ->with('role_now', $role_now);
    }

    public function toConstruction(Request $request)
    {
        $id = $request->input('id', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $quote_now_array = Project::where('id', '=', $id)->get();
        $quote_now = $quote_now_array[0]->quote;
        //添加当前用户,来处理删除按钮的显示与隐藏
        $submitter_array = $request->session()->get('admin');
        $role_now = $submitter_array->role;
//        $admin_now = Admin::where('username',  '=' ,$username_now)->get();
//        $role_now = $admin_now->role;
        return view('manager.project_construction')->with('logs', $logs)
            ->with('quote_now', $quote_now)
            ->with('id', $id)
            ->with('project', $project)
            ->with('role_now', $role_now);
    }

    public function toAddLog(Request $request)
    {
        $id = $request->input('id', '');
        $stage = $request->input('stage', '');
        return view('manager.add_project_log')->with('id', $id)
            ->with('stage', $stage);
    }

    public function toAddQuoteLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_quote_log')->with('id', $id);
    }

    public function toAddDailyLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_daily_report_log')->with('id', $id);
    }

    public function toAddStagePicLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_stage_pic_log')->with('id', $id);
    }

    public function toAddDesignerLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_designer_log')->with('id', $id);
    }

    public function addLog(Request $request)
    {
        $content = $request->input('content', '');
        $project_id = $request->input('project_id', '');
        $stage = $request->input('stage', '');
        $submitter_array = $request->session()->get('admin');
        $submitter = $submitter_array->username;

        $log = new ProjectLog;
        $log->project_id = $project_id;
        $log->stage = $stage;
        $log->submitter = $submitter;
        $log->content = $content;

        $log->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function addQuoteLog(Request $request)
    {
        $content = $request->input('content', '');
        $project_id = $request->input('project_id', '');
        $stage = $request->input('stage', '');
        $submitter_array = $request->session()->get('admin');
        $submitter = $submitter_array->username;

        $log = new ProjectLog;
        $log->project_id = $project_id;
        $log->stage = $stage;
        $log->submitter = $submitter;
        $log->content = $content;

        $log->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function projectStageEdit(Request $request)
    {
        $id = $request->input('id', '');
        $stage = $request->input('stage', '');
        $project = Project::find($id);

        $project->stage = $stage;
        $project->save();
        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function porjectQuoteEdit(Request $request)
    {
        $id = $request->input('id', '');
        $quote = $request->input('quote', '');
        $cost = $request->input('cost', '');
        $profit = $request->input('profit', '');
        $project = Project::find($id);

        $project->quote = $quote;
        $project->cost = $cost;
        $project->profit = $profit;
        $project->save();
        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function projectOwncloundEdit(Request $request)
    {
        $id = $request->input('id', '');
        $url = $request->input('url', '');
        $project = Project::find($id);

        $project->ownclound = $url;
        $project->save();
        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();
    }

    public function edit(Request $request)
    {
        $id = $request->input('id', '');
        $quote = $request->input('quote', '');
        $budget = $request->input('budget', '');
        $designer = $request->input('designer', '');
        $pm = $request->input('pm', '');
        $saler = $request->input('saler', '');
        $customer_name = $request->input('customer_name', '');
        $address = $request->input('address', '');
        $workforce = $request->input('workforce', '');
        $area = $request->input('area', '');
        $name = $request->input('name', '');
        $requirements = $request->input('requirements', '');
        $completion_time = $request->input('completion_time', '');
        $houseType = $request->input('houseType', '');
        $mealType = $request->input('mealType', '');
        $stage = $request->input('stage', '');
        $priority = $request->input('priority', '');
        $houseSituation = $request->input('houseSituation', '');
        $status = $request->input('status', '');

        $project = Project::find($id);
        $project->customer_name = $customer_name;
        $project->houseSituation = $houseSituation;
        $project->quote = $quote;
        $project->budget = $budget;
        $project->designer_name = $designer;
        $project->pm_name = $pm;
        $project->address = $address;
        $project->workforce = $workforce;
        $project->area = $area;
        $project->name = $name;
        $project->saler_name = $saler;
        $project->requirements = $requirements;
        $project->completion_time = $completion_time;
        $project->houseType = $houseType;
        $project->meal_type = $mealType;
        $project->stage = $stage;
        $project->priority = $priority;
        $project->status = $status;
        $project->save();
        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';
        return $m3_result->toJson();
    }

    public function exportAllProjects()
    {
        $Projects = Project::all();

        $projects = array();

        $title = ['项目ID', '项目名称', '创建时间', '客户名称', '面积', '地址', '套餐', '优先级', '报价', '阶段', '销售人员', '负责人', '完工时间', '房屋现状', '房屋类型', '公司规模', '项目需求', '设计师', '预算'];
        array_push($projects, $title);

        //要手动构造一个二维数组
        foreach ($Projects as $item) {
            $arr = array();
            array_push($arr, $item['id'], $item['name'], $item['created_at'], $item['customer_name'], $item['area'],
                $item['address'], $item['meal_type'], $item['priority'], $item['quote'], $item['stage'], $item['saler_name'], $item['pm_name'], $item['completion_time']
                , $item['houseSituation'], $item['houseType'], $item['workforce'], $item['requirements']
                , $item['designer_name'], $item['budget']);
            array_push($projects, $arr);
        }

        $footer = ['注意:优先级的值2,1,0分别代表:高,中,低'];
        array_push($projects, $footer);
        Excel::create('项目表', function ($excel) use ($projects) {
            $excel->sheet('score', function ($sheet) use ($projects) {
                $sheet->rows($projects);
            });
        })->export('xls');
    }

    public function exportProjectSta()
    {
        $project_statistic = array();

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


        $title_stage = ['各个阶段的项目数量统计:'];
        array_push($project_statistic, $title_stage);
        $title = ['沟通', '见面/量房', '平图', '合同', '设计图', '打款', '开工'];
        array_push($project_statistic, $title);
        array_push($project_statistic, $counts);
        array_push($project_statistic, ['']);
        array_push($project_statistic, ['']);

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

        $title_area = ['各个面积项目数量统计:'];
        array_push($project_statistic, $title_area);
        $title_area_second = ['0-500平米', '501-1000平米', '>1001平米'];
        array_push($project_statistic, $title_area_second);
        array_push($project_statistic, $area_counts);
        array_push($project_statistic, ['']);
        array_push($project_statistic, ['']);
//总报价金额

//        foreach ($customers as $item) {
//            array_push($source_all, $item->source);
//        }

//各套餐数量
        $mealtype_counts = array();
        $standard_count = count(Project::where('meal_type', '=', '标准')->get());
        $unstandard_count = count(Project::where('meal_type', '=', '非标准')->get());

        array_push($mealtype_counts, $standard_count, $unstandard_count);

        $title_mealtype = ['各个套餐项目数量统计:'];
        array_push($project_statistic, $title_mealtype);
        $title_area_third = ['标准', '非标准'];
        array_push($project_statistic, $title_area_third);
        array_push($project_statistic, $mealtype_counts);
        array_push($project_statistic, ['']);
        array_push($project_statistic, ['']);
        array_push($project_statistic, ['总报价:']);
        array_push($project_statistic, [$quoteSum]);

        Excel::create('项目统计信息表', function ($excel) use ($project_statistic) {
            $excel->sheet('score', function ($sheet) use ($project_statistic) {
                $sheet->rows($project_statistic);
            });
        })->export('xls');
    }

    public function deleteLog(Request $request)
    {
        $id = $request->input('id', '');
        DB::table('project_log')->where('id', '=', $id)->delete();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';
        return $m3_result->toJson();
    }

    public function toLogEdit(Request $request)
    {
        $id = $request->input('id', '');
//        $log = DB::table('project_log')->where('id', '=', $id)->get();
        $log = ProjectLog::where('id', $id)->get()[0];
        return view('manager.edit_project_log')->with('log', $log);
    }

    public function logEdit(Request $request)
    {

        $id = $request->input('id', '');
        $content = $request->input('content', '');
        $submitter_array = $request->session()->get('admin');
        $submitter = $submitter_array->username;

        $log = ProjectLog::find($id);
        $log->submitter = $submitter;
        $log->content = $content;
        $log->save();

        $m3_result = new M3Result();
        $m3_result->status = 0;
        $m3_result->message = '添加成功';

        return $m3_result->toJson();

    }

}
