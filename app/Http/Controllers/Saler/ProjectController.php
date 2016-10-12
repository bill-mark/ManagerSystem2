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

class ProjectController extends Controller
{
    public function toList(Request $request)
    {

        $account = $request->session()->get('admin');
        $username = $account->username;
        $projects = Project::where('saler_name', $username)->get();

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

        return view('saler.project_list')->with('projects', $projects)
            ->with('sort', $sort);
    }

    public function toEdit(Request $request)
    {

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
            ->with('id', $id);

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


//一共17个字段

    public function addProject(Request $request)
    {
        $quote = $request->input('quote', '');
        $budget = $request->input('budget', '');

        $designer_array = $request->input('designer', '');
        $designer = $designer_array[0];
        $pm_array = $request->input('pm', '');
        $pm = $pm_array[0];
        $saler_array = $request->input('saler', '');
        $saler = $saler_array[0];
        $customer_name_array = $request->input('customer_name', '');
        $customer_name = $customer_name_array[0];

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
        $stage_now_array = Project::where('id', '=', $id)->get();
        $stage_now = $stage_now_array[0]->stage;
        return view('manager.project_stage')->with('logs', $logs)
            ->with('stage_now', $stage_now)
            ->with('id', $id)
            ->with('project', $project);
    }

    //报价
    public function toQuote(Request $request)
    {


        $id = $request->input('id', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $quote_now_array = Project::where('id', '=', $id)->get();
        $quote_now = $quote_now_array[0]->quote;
        return view('manager.project_quote')->with('logs', $logs)
            ->with('quote_now', $quote_now)
            ->with('id', $id)
            ->with('project', $project);
    }

    //设计log
    public function toDesigner(Request $request)
    {
        $id = $request->input('id', '');
        $project = Project::find($id);
        $logs = ProjectLog::where('project_id', '=', $id)->get();
        $quote_now_array = Project::where('id', '=', $id)->get();
        $quote_now = $quote_now_array[0]->quote;
        return view('manager.project_designer')->with('logs', $logs)
            ->with('quote_now', $quote_now)
            ->with('id', $id)
            ->with('project', $project);
    }

    public function toAddLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_log')->with('id', $id);
    }

    public function toAddQuoteLog(Request $request)
    {
        $id = $request->input('id', '');
        return view('manager.add_project_quote_log')->with('id', $id);
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
        $project = Project::find($id);

        $project->quote = $quote;
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

        $designer_array = $request->input('designer', '');
        $designer = $designer_array[0];
        $pm_array = $request->input('pm', '');
        $pm = $pm_array[0];
        $saler_array = $request->input('saler', '');
        $saler = $saler_array[0];
        $customer_name_array = $request->input('customer_name', '');
        $customer_name = $customer_name_array[0];

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

}