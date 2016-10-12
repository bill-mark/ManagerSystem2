@extends('master')

@section('content')

    <div class="page-container">
        <div id="tabs" class="tabs">
            @if($from === "saler")
                <div id="tabbar_content" class="tabBar cl">
                    <a href="/manager/project_detail?id={{$id}}&from=saler"><span class="clicked_span">基本信息</span></a>
                    <a href="/manager/customer_content?customer_name={{$project->customer_name}}&from=saler&id={{$id}}"><span
                                class="normal_span">客户信息</span></a>
                </div>
            @elseif($from === "designer")
                <div id="tabbar_content" class="tabBar cl">
                    <a href="/manager/project_detail?id={{$id}}&from=designer"><span class="clicked_span">基本信息</span></a>
                    <a href="/manager/project_designer?id={{$id}}&from=designer"><span class="normal_span">设计</span></a>
                </div>
            @else
                <div id="tabbar_content" class="tabBar cl">
                    <a href="project_edit?id={{$id}}"><span class="clicked_span">基本信息</span></a>
                    <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$id}}"><span
                                class="normal_span">客户信息</span></a>
                    <a href="project_stage?id={{$id}}"><span class="normal_span">项目进度</span></a>
                    <a href="project_quote?id={{$id}}"><span class="normal_span">报价</span></a>
                    <a href="project_designer?id={{$id}}"><span class="normal_span">设计</span></a>
                    <a href="project_construction?id={{$id}}"><span class="normal_span">施工</span></a>

                </div>
            @endif
        </div>
        <div id="tab01" class="tabcon">
            <div>
                <form action="" method="post" class="form form-horizontal" id="form-project-edit" style="display:none" data-toggle="validator">
                    {{--id--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>项目ID:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_id" type="" name="id" value="{{$project->id}}" readonly class="input-text">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--1项目名称--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>项目名称:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_name" name="name" type="text" value="{{$project->name}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--17客户名称--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>客户名称:</label>
                        <div class="formControls col-sm-4">
                            <select name="customer" class="select" id="select_customer">
                                <option value="请选择">请选择</option>
                                @foreach($customers as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--2地址--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>地址:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_address" name="address" type="text" value="{{$project->address}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>


                    {{--3面积--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>项目面积(单位:平米):</label>
                        <div class="formControls col-sm-4">
                            <input id="input_area" name="area" type="number" value="{{$project->area}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--4房屋现状--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>房屋现状:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_houseSituation" name="houseSituation" type="text"
                                   value="{{$project->houseSituation}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--5户型--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>户型：</label>
                        <div class="formControls col-sm-4">
                            <select name="houseType" class="select" id="select_houseType">
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
                        <label class="form-label col-sm-2"><span class="c-red"></span>套餐：</label>
                        <div class="formControls col-sm-4">
                            <select name="mealType" class="select" id="select_mealtype">
                                <option value="标准">标准</option>
                                <option value="非标准">非标准</option>
                            </select>
                        </div>
                    </div>

                    {{--7公司人员规模--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>公司人员规模:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_workforce" type="" name="workforce" value="{{$project->workforce}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--15装修预算--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>装修预算:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_budget" type="number" value="{{$project->budget}}" name="budget" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--8客户需求--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>客户需求:</label>
                        <div class="formControls col-sm-4">
                            <textarea id="input_requirements" type="text" name="requirements"
                                      class="textarea" datatype="*">{{$project->requirements}}</textarea>
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>



                    {{--18状态--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>状态：</label>
                        <div class="formControls col-sm-4">
                            <select name="status" class="select" id="select_status">
                                <option value="0">未开始</option>
                                <option value="1">进行中</option>
                                <option value="2">完成</option>
                            </select>
                        </div>
                    </div>

                    {{--9阶段--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>阶段：</label>
                        <div class="formControls col-sm-4">
                            <select name="stage" class="select" id="select_stage">
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
                        <label class="form-label col-sm-2"><span class="c-red"></span>优先级：</label>
                        <div class="formControls col-sm-4">
                            <select name="priority" class="select" id="select_priority">
                                <option value="2">高</option>
                                <option value="1">中</option>
                                <option value="0">低</option>
                            </select>
                        </div>
                    </div>



                    {{--11负责人--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>项目经理:</label>
                        <div class="formControls col-sm-4">
                            <select name="principal" class="select" id="select_principal">
                                <option value="请选择">请选择</option>
                                @foreach($pms as $item)
                                    <option value="{{$item->username}}">{{$item->username}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--12销售--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>销售人员:</label>
                        <div class="formControls col-sm-4">
                            <select name="saler" class="select" id="select_saler">
                                <option value="请选择">请选择</option>
                                @foreach($salers as $item)
                                    <option value="{{$item->username}}">{{$item->username}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--14设计师--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>设计师:</label>
                        <div class="formControls col-sm-4">
                            <select name="designer" class="select" id="select_designer">
                                <option value="请选择">请选择</option>
                                @foreach($designers as $item)
                                    <option value="{{$item->username}}">{{$item->username}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--13预计完成时间--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>预计完成时间:</label>
                        <div class="formControls col-sm-4">
                            <input type="text" name="completion_time" id="editProject_completion_time" class="input-text" datatype="*">
                            {{--<input data-toggle="datepicker" id="test">--}}
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    {{--16现报价--}}
                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>现报价:</label>
                        <div class="formControls col-sm-4">
                            <input id="input_quote" type="number" value="{{$project->quote}}" name="quote" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>
                </form>
                @if($from === "saler")
                @elseif($from === "designer")
                @else
                   <div class="row cl" style="margin-top: 15px">
                    <div class="col-sm-8">
                            <button onclick="save_project_edit(this);" class="btn btn-primary radius mt15 ml10" id="save-btn">编辑</button>
                        </div>
                    </div>
                @endif

                <style type="text/css">
                    .panel{
                        margin:20px 0;
                    }
                    /*#form-project tr :last-child{
                        text-align: right;
                    }*/
                </style>
                
                <div id="form-project">                        
                        <div class="panel panel-default">
                    
                            <div class="panel-header">项目简介</div>
                            <div class="panel-body">
                            <table class="table table-border table-bg">
                                 <thead>
                                <!-- <tr>
                                    <th width="40%" onclick="name_sort();">项目</th>
                                    <th width="60%" onclick="company_sort();">值</th>
                                </tr> -->
                                </thead>
                                <tr>
                                    <td>项目ID</td>
                                    <td>{{$project->id}}</td>
                                </tr>
                                <tr>
                                    <td width="40%">项目名称</td>
                                    <td width="60%">{{$project->name}}</td>
                                </tr>
                                <tr>
                                    <td>客户名称</td>
                                    <td>{{$project->customer_name}}</td>
                                </tr>
                                
                                <tr>
                                    <td>地址</td>
                                    <td>{{$project->address}}</td>
                                </tr>
                                
                                <tr>
                                    <td>项目面积(单位:平米)</td>
                                    <td>{{$project->area}}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    
                    
                        <div class="panel panel-default">
                            <div class="panel-header">户型简介</div>
                            <div class="panel-body">
                            <table class="table table-border table-bg ">
                                <tr>
                                    <td>房屋现状</td>
                                    <td width="60%">{{$project->houseSituation}}</td>
                                </tr>
                                <tr>
                                    <td>户型</td>
                                    <td>{{$project->houseType}}</td>
                                </tr>
                                <tr>
                                    <td>套餐</td>
                                    <td>{{$project->meal_type}}</td>
                                </tr>
                                <tr>
                                    <td>公司人员规模</td>
                                    <td>{{$project->workforce}}</td>
                                </tr>
                    
                                <tr>
                                    <td>装修预算</td>
                                    <td>{{$project->budget}}</td>
                                </tr>
                    
                                <tr>
                                    <td>客户需求</td>
                                    <td style="white-space: pre-wrap;">{{$project->requirements}}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    
                    
                    
                         <div class="panel panel-default">
                            <div class="panel-header">优先级</div>
                            <div class="panel-body">
                            <table class="table table-border table-bg ">
                                <tr>
                                    <td>状态</td>
                                    <td width="60%">
                                        @if ($project->status == '0')
                                            未开始
                                        @elseif ($project->status == '1')
                                            进行中
                                        @elseif ($project->status == '2')
                                            已结束
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>阶段</td>
                                    <td>{{$project->stage}}</td>
                                </tr>
                    
                                <tr>
                                    <td>优先级</td>
                                    <td>
                                        @if(value($project->priority) === 1)
                                            中
                                        @elseif(value($project->priority) === 2)
                                            高
                                        @elseif(value($project->priority) === 0)
                                            低
                                        @endif
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    
                    
                        <div class="panel panel-default">
                            <div class="panel-header">项目人员</div>
                            <div class="panel-body">
                            <table class="table table-border table-bg ">
                                <tr>
                                    <td>项目经理</td>
                                    <td width="60%">{{$project->pm_name}}</td>
                                </tr>
                                <tr>
                                    <td>销售人员</td>
                                    <td>{{$project->saler_name}}</td>
                                </tr>
                                
                                <tr>
                                    <td>设计师</td>
                                    <td>{{$project->designer_name}}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    
                    
                        <div class="panel panel-default">
                            <div class="panel-header">工期报价</div>
                            <div class="panel-body">
                            <table class="table table-border table-bg ">
                                <tr>
                                    <td>预计完成时间</td>
                                    <td width="60%">{{$project->completion_time}}</td>
                                </tr>
                                
                                <tr>
                                    <td>现报价</td>
                                    <td>{{$project->quote}}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
         $(".form").Validform({
            tiptype:2
        });
        $('#save-btn').click(function(){
            $(this).parent().addClass('col-sm-offset-2')
        })

        $("#editProject_completion_time").jcDate({
            Default: '请选择日期',
            Class: "", //为input注入自定义的class类（默认为空）
            Event: "click", //设置触发控件的事件，默认为click
            Speed: 50,    //设置控件弹窗的速度，默认100（单位ms）
            Left: 0,       //设置控件left，默认0
            Top: 22,       //设置控件top，默认22
            Format: "-",   //设置控件日期样式,默认"-",效果例如：XXXX-XX-XX
            DoubleNum: false, //设置控件日期月日格式，默认true,例如：true：2015-05-01 false：2015-5-1
            Timeout: 100,   //设置鼠标离开日期弹窗，消失时间，默认100（单位ms）
            OnChange: function () { //设置input中日期改变，触发事件，默认为function(){}
                console.log('num change');
            }
        });

        var principal = "{{$project->pm_name}}";
        $("#select_principal option[value='" + principal + "']").attr("selected", true);

        var designer = "{{$project->designer_name}}";
        $("#select_designer option[value='" + designer + "']").attr("selected", true);

        var saler = "{{$project->saler_name}}";
        $("#select_saler option[value='" + saler + "']").attr("selected", true);

        var customer = "{{$project->customer_name}}";
        $("#select_customer option[value='" + customer + "']").attr("selected", true);

        $("#editProject_completion_time").jcDate({
            Class: "", //为input注入自定义的class类（默认为空）
            Default: "{{$project->completion_time}}", //设置默认日期（默认为当天）
            Event: "click", //设置触发控件的事件，默认为click
            Speed: 100,    //设置控件弹窗的速度，默认100（单位ms）
            Left: 0,       //设置控件left，默认0
            Top: 22,       //设置控件top，默认22
            Format: "-",   //设置控件日期样式,默认"-",效果例如：XXXX-XX-XX
            DoubleNum: true, //设置控件日期月日格式，默认true,例如：true：2015-05-01 false：2015-5-1
            Timeout: 100,   //设置鼠标离开日期弹窗，消失时间，默认100（单位ms）
            OnChange: function () { //设置input中日期改变，触发事件，默认为function(){}
                console.log('num change');
            }
        });

        function save_project_edit(obj) {

            var content = obj.innerHTML;

            if (content == "编辑") {
                obj.innerHTML = "保存";

                document.getElementById("form-project").style.visibility = "hidden";
                document.getElementById("form-project-edit").style.display = "block";

            } else if (content == "保存") {
                if ($('input[name=quote]').val() == '' ||
                    $('input[name=budget]').val() == '' ||
                    $('input[name=address]').val() == '' ||
                    $('input[name=houseSituation]').val() == '' ||
                    $('input[name=workforce]').val() == '' ||
                    $('input[name=area]').val() == '' ||
                    $('input[name=name]').val() == '' ||
                    $('select[name=principal] option:selected').val() == '' ||
                    $('select[name=customer] option:selected').val() == '' ||
                    $('select[name=designer] option:selected').val() == '' ||
                    $('select[name=saler] option:selected').val() == '' ||
                    $('textarea[name=requirements]').val() == '' ||
                    $('select[name=houseType] option:selected').val() == '' ||
                    $('select[name=mealType] option:selected').val() == '' ||
                    $('select[name=stage] option:selected').val() == '' ||
                    $('select[name=priority] option:selected').val() == '' ||
                    $('select[name=status] option:selected').val() == '')
                {
                    alert("未填写完整,请填写完整再提交");
                    return;
                }

                $('#form-project-edit').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: 'project/edit', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        id: $('input[name=id]').val(),
                        quote: $('input[name=quote]').val(),
                        budget: $('input[name=budget]').val(),
                        address: $('input[name=address]').val(),
                        houseSituation: $('input[name=houseSituation]').val(),
                        workforce: $('input[name=workforce]').val(),
                        area: $('input[name=area]').val(),
                        name: $('input[name=name]').val(),
                        pm: $('select[name=principal] option:selected').val(),
                        customer_name: $('select[name=customer] option:selected').val(),
                        designer: $('select[name=designer] option:selected').val(),
                        saler: $('select[name=saler] option:selected').val(),
                        requirements: $('textarea[name=requirements]').val(),
                        completion_time: $('input[name=completion_time]').val(),
                        houseType: $('select[name=houseType] option:selected').val(),
                        mealType: $('select[name=mealType] option:selected').val(),
                        stage: $('select[name=stage] option:selected').val(),
                        priority: $('select[name=priority] option:selected').val(),
                        status: $('select[name=status] option:selected').val(),
                        _token: "{{csrf_token()}}"
                    },

                    success: function (data) {
                        if (data == null) {
                            layer.msg('服务端错误', {icon: 2, time: 2000});
                            return;
                        }
                        if (data.status != 0) {
                            layer.msg(data.message, {icon: 2, time: 2000});
                            return;
                        }

                        layer.close()
                     
                        parent.location.reload()
                       
                    },
                    error: function (xhr, status, error) {
                        layer.msg('ajax error', {icon: 2, time: 2000});
                    },
                    beforeSend: function (xhr) {
                        
                    }
                });
            }
        }

        var status_default = "{{$project->status}}";
        $("#select_status option[value='" + status_default + "']").attr("selected", true);

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
