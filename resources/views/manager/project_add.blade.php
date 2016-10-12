@extends('master')

@section('content')

    <div class="page-container" style="margin-bottom: 150px">
        <form action="" method="post" class="form form-horizontal" id="form-project-add">
            {{--1.项目名称--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>项目名称:</label>
                <div class="formControls col-sm-4">
                    <input id="input_name" type="text" name="name" value="" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--15.客户名称--}}
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

            {{--2.地址--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>地址:</label>
                <div class="formControls col-sm-4">
                    <input id="input_address" name="address" type="text" value="" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--3.面积--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>项目面积(单位:平米):</label>
                <div class="formControls col-sm-4">
                    <input id="input_area" name="area" type="number" value="" class="input-text" datatype="*" style="width: 100%">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--4.房屋现状--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>房屋现状:</label>
                <div class="formControls col-sm-4">
                    {{--<input id="input_houseSituation" name="houseSituation" type="text" value="" class="input-text" datatype="*">--}}
                    <textarea name="houseSituation" type="text" class="textarea"></textarea>
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--5.户型--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>户型：</label>
                <div class="formControls col-sm-4">
                    <select name="houseType" class="select" id="select_houseType">
                        <option value="请选择">请选择</option>
                        <option value="商铺">商铺</option>
                        <option value="写字楼">写字楼</option>
                        <option value="商住两用">商住两用</option>
                        <option value="复式">复式</option>
                        <option value="自建房">自建房</option>
                    </select>
                </div>
            </div>

            {{--6.套餐--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>套餐：</label>
                <div class="formControls col-sm-4">
                    <select name="mealType" class="select" id="select_mealType">
                        <option value="请选择">请选择</option>
                        <option value="标准">标准</option>
                        <option value="非标准">非标准</option>
                    </select>
                </div>
            </div>


            {{--7.公司人员规模--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>公司人员规模:</label>
                <div class="formControls col-sm-4">
                    <input id="input_workforce" type="" value="" name="workforce" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--13.装修预算--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>装修预算:</label>
                <div class="formControls col-sm-4">
                    <input id="input_budget" type="number"  style="width: 100%;" value="" name="budget" class="input-text" datatype="*">
                </div>
            </div>

            {{--8.客户需求--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>客户需求:</label>
                <div class="formControls col-sm-4">
                    <textarea name="requirements" type="text" class="textarea" datatype="*"></textarea>
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>状态：</label>
                <div class="formControls col-sm-4">
                    <select name="status" class="select" id="select_status">
                        <option value="请选择">请选择</option>
                        <option value="0">未开始</option>
                        <option value="1">进行中</option>
                        <option value="2">完成</option>
                    </select>
                </div>
            </div>

            {{--9.阶段--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>阶段：</label>
                <div class="formControls col-sm-4">
                    <select name="stage" class="select" id="select_stage">
                        <option value="请选择">请选择</option>
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

            {{--10.优先级--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>优先级：</label>
                <div class="formControls col-sm-4">
                    <select name="priority" class="select" id="select_priority">
                        <option value="请选择">请选择</option>
                        <option value="2">高</option>
                        <option value="1">中</option>
                        <option value="0">低</option>
                    </select>
                </div>
            </div>

            {{--11.负责人 , 这里的负责人是项目经理--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>项目经理:</label>
                {{--<div class="formControls col-sm-4">--}}
                {{--<input id="input_pm" type="text" value="" name="pm">--}}
                {{--</div>--}}
                <div class="formControls col-sm-4">
                    <select name="principal" class="select" id="select_principal">
                        <option value="请选择">请选择</option>
                        @foreach($pms as $item)
                            <option value="{{$item->username}}">{{$item->username}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--17销售--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>销售:</label>
                <div class="formControls col-sm-4">
                    <select name="saler" class="select" id="select_saler">
                        <option value="请选择">请选择</option>
                        @foreach($salers as $item)
                            <option value="{{$item->username}}">{{$item->username}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--12.设计师--}}
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

            {{--16.预计完成时间--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>预计完成时间:</label>
                <div class="formControls col-sm-4">
                    <input type="text" value="" name="completion_time" id="addProject_completion_time"
                           class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            {{--14.现报价--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>现报价:</label>
                <div class="formControls col-sm-4">
                    <input id="input_quote" type="number" value="" name="quote" class="input-text" datatype="*" style="width: 100%;">
                </div>
                <div class="Validform_checktip"></div>
            </div>
        </form>

        <div class="row cl">
            <div class="col-sm-8 col-sm-offset-2">
                <button class="btn btn-secondary radius mt-15 ml-10" onclick="addProjectConfirm();">确认</button>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        $(".form").Validform({
            tiptype:2
        });

        $("#addProject_completion_time").jcDate({
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

        function addProjectConfirm() {
            //在提交包含 tag 的表单的时候,如果 tag 为空,就会有问题
//            var customer_name = $('#input_customer_name').tagEditor('getTags')[0].tags;
//            if (customer_name == "") {
//                customer_name = [""];
//            } else {
//                if (customers.indexOf(customer_name[0]) == -1) {
//                    alert("对不起,您输入的客户不存在,请重新输入");
//                    return;
//                }
//            }
//
//            var pm = $('#input_pm').tagEditor('getTags')[0].tags;
//            if (pm == "") {
//                pm = [""];
//            } else {
//                if (pms.indexOf(pm[0]) == -1) {
//                    alert("对不起,您输入的项目经理不存在,请重新输入");
//                    return;
//                }
//            }
//
//            var designer = $('#input_designer').tagEditor('getTags')[0].tags;
//            if (designer == "") {
//                designer = [""];
//            } else {
//                if (designers.indexOf(designer) == -1) {
//                    alert("对不起,您输入的设计师不存在,请重新输入");
//                    return;
//                }
//            }
//
//            var saler = $('#input_saler').tagEditor('getTags')[0].tags;
//            if (saler == "") {
//                saler = [""];
//            } else {
//                if (salers.indexOf(saler[0]) == -1) {
//                    alert("对不起,您输入的销售人员不存在,请重新输入");
//                    return;
//                }
//            }

            if ($('input[name=quote]').val() == "" || $('input[name=budget]').val() == "" || $('input[name=address]').val() == "" ||
                    $('textarea[name=houseSituation]').val() == "" || $('input[name=workforce]').val() == "" || $('input[name=area]').val() == "" ||
                    $('input[name=name]').val() == "" || $('select[name=customer] option:selected').val() == "" || $('select[name=principal] option:selected').val() == "" ||
                    $('select[name=designer] option:selected').val() == "" || $('select[name=saler] option:selected').val() == "" || $('textarea[name=requirements]').val() == "" ||
                    $('select[name=houseType] option:selected').val() == "" || $('select[name=mealType] option:selected').val() == "" ||
                    $('select[name=stage] option:selected').val() == "" || $('select[name=priority] option:selected').val() == "" || $('select[name=status] option:selected').val() == "") {

                alert("对不起,表单没有填写完整");
                return;

            }

            var customer_name = $('select[name=customer] option:selected').val();
            var pm = $('select[name=principal] option:selected').val();
            var designer = $('select[name=designer] option:selected').val();
            var saler = $('select[name=saler] option:selected').val();
            var houseType = $('select[name=houseType] option:selected').val();
            var mealType = $('select[name=mealType] option:selected').val();
            var stage = $('select[name=stage] option:selected').val();
            var priority = $('select[name=priority] option:selected').val();
            var status = $('select[name=status] option:selected').val();

            if (customer_name == "请选择" || pm == "请选择" || designer == "请选择" || saler == "请选择" || houseType == "请选择"
                    || mealType == "请选择" || stage == "请选择" || priority == "请选择" || status == "请选择") {
                alert("对不起,表单没有填写完整");
                return;
            }

            $('#form-project-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: 'add', // 需要提交的 url
                dataType: 'json',
                data: {
                    quote: $('input[name=quote]').val(),
                    budget: $('input[name=budget]').val(),
                    address: $('input[name=address]').val(),
                    houseSituation: $('textarea[name=houseSituation]').val(),
                    workforce: $('input[name=workforce]').val(),
                    area: $('input[name=area]').val(),
                    name: $('input[name=name]').val(),
                    customer_name: customer_name,
                    pm: pm,
                    designer: designer,
                    saler: saler,
                    requirements: $('textarea[name=requirements]').val(),
                    completion_time: $('input[name=completion_time]').val(),
                    houseType: houseType,
                    mealType: mealType,
                    stage: stage,
                    priority: priority,
                    status: status,
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
                    layer.msg(data.message, {icon: 1, time: 2000});
                    parent.location.reload();
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                }
            });

        }

    </script>
@endsection
