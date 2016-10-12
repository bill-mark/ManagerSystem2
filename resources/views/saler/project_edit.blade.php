@extends('master')

@section('content')

    <style>


        /*margin-left: -20%;*/
        label {
            margin-left: 5%;
            font-weight: bold;
        }
    </style>

    {{--<div class="cl pd-5 bg-1 bk-gray mt-20">--}}
    {{--<span class="l">--}}
    {{--<a href="javascript:;" onclick="product_add('添加产品','/admin/product_add')" class="btn btn-primary radius" style="margin-left: 750%">保存</a>--}}
    {{--</span>--}}
    {{--</div>--}}

    <div style="border: solid 2px black ;width: 90%; height: 90% ; margin: 50px auto 0 auto">

        <button style="width: 90px ; height: 40px;background-color: black ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center">
            保存
        </button>

        <form action="" method="post" class="form form-horizontal" id="form-order-edit"
              style="margin: 28px auto 80px auto">

            {{--id--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>项目ID:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_id" type="number" value="{{$project->id}}" readonly>
                </div>
            </div>

            {{--1项目名称--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>项目名称:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_name" type="text" value="{{$project->name}}">
                </div>
            </div>

            {{--2地址--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>地址:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_address" type="text" value="{{$project->address}}">
                </div>
            </div>


            {{--3面积--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>项目面积(单位:平米):</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_area" type="number" value="{{$project->area}}">
                </div>
            </div>

            {{--4房屋现状--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>房屋现状:</label>
                <div class="formControls col-4 col-offset-1">
                    <input id="input_houseSituation" type="text" value="{{$project->houseSituation}}">
                </div>
            </div>

            {{--5户型--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>户型：</label>
                <div class="formControls col-2 col-offset-1">
                    <select name="" class="select" id="select_houseType">
                        <option value="商铺">商铺</option>
                        <option value="写字楼">写字楼</option>
                        <option value="商住两用">商住两用</option>
                        <option value="复式">复式</option>
                        <option value="自建房">自建房</option>
                    </select>
                </div>
            </div>

            {{--6套餐--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>套餐：</label>
                <div class="formControls col-2 col-offset-1">
                    <select name="" class="select" id="select_mealtype">
                        <option value="标准">标准</option>
                        <option value="非标准">非标准</option>
                    </select>
                </div>
            </div>


            {{--7公司人员规模--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>公司人员规模:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_workforce" type="number" value="{{$project->workforce}}">
                </div>
            </div>


            {{--8客户需求--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>客户需求:</label>
                <div class="formControls col-5 col-offset-1">
                    <textarea id="input_requirements" type="text" class="textarea">{{$project->requirements}}
                        </textarea>
                </div>
            </div>

            {{--9阶段--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>阶段：</label>
                <div class="formControls col-2 col-offset-1">
                    <select name="" class="select" id="select_stage">
                        <option value="沟通">沟通</option>
                        <option value="见面/量房">见面/量房</option>
                        <option value="平图">平图</option>
                        <option value="合同">合同</option>
                        <option value="设计图">设计图</option>
                        <option value="打款">打款</option>
                        <option value="开工">开工</option>
                    </select>
                </div>
            </div>

            {{--10优先级--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>优先级：</label>
                <div class="formControls col-2 col-offset-1">
                    <select name="" class="select" id="select_priority">
                        <option value="2">高</option>
                        <option value="1">中</option>
                        <option value="0">低</option>
                    </select>
                </div>
            </div>

            {{--11负责人--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>负责人:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_pm" type="text" value="{{$project->pm_name}}">
                </div>
            </div>

            {{--12销售--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>销售:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_saler" type="text" value="{{$project->saler_name}}">
                </div>
            </div>

            {{--13预计完成时间--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>预计完成时间:</label>
                <div class="formControls col-2 col-offset-1">
                    <input type="text" value="{{$project->completion_time}}}" name="completion_time">
                </div>
            </div>

            {{--14设计师--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>设计师:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_designer" type="text" value="{{$project->designer_name}}">
                </div>
            </div>

            {{--15装修预算--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>装修预算:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_budget" type="number" value="{{$project->budget}}">
                </div>
            </div>


            {{--16现报价--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>现报价:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_quote" type="number" value="{{$project->quote}}">
                </div>
            </div>


            {{--17客户名称--}}
            <div class="row cl">
                <label class="form-label col-4"><span class="c-red"></span>客户名称:</label>
                <div class="formControls col-2 col-offset-1">
                    <input id="input_customer_name" type="text" value="{{$project->customer_name}}">
                </div>
            </div>


            {{--<div class="row cl">--}}
            {{--<div class="col-9 col-offset-4">--}}
            {{--<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">--}}
            {{--</div>--}}
            {{--</div>--}}

        </form>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">

        //负责人 tag

        var pms = [];

        @foreach($pms as $item)
            pms.push("{{$item->username}}");
        @endforeach

        $("#input_pm").tagEditor({
            autocomplete: {
                delay: 0,
                position: {collision: 'flip'},
//                source: ['ActionScript', 'AppleScript', 'Asp', 'BASIC', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'Python', 'Ruby', 'Scala', 'Scheme'],
                source:pms
            },
            maxTags: 1,
            forceLowercase: false,
            initialTags: ["{{$project->pm_name}}"],
            placeholder: '项目经理'
        });

        var house_type_default = "{{$project->houseType}}";
        $("#select_houseType option[value='" + house_type_default + "']").attr("selected", true);

        var stage_default = "{{$project->stage}}";
        $("#select_stage option[value='" + stage_default + "']").attr("selected", true);

        var priority_default = "{{$project->priority}}";
        $("#select_priority option[value='" + priority_default + "']").attr("selected", true);

        var meal_type_default = "{{$project->mealType}}";
        $("#select_mealtype option[value='" + meal_type_default + "']").attr("selected", true);

    </script>
@endsection
