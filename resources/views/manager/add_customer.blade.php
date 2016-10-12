@extends('master')

<style type="text/css">
    .Validform_checktip{
    margin-left:8px;
    line-height:20px;
    height:20px;
    overflow:hidden;
    color:#999;
    font-size:12px;
    margin-top: 0;
}
.form-horizontal .Validform_checktip{
    margin-top: 0!important;
}
.Validform_right{
    color:#71b83d;
    padding-left:20px;
    background:url(images/right.png) no-repeat left center;
}
.Validform_wrong{
    color:red;
    padding-left:20px;
    white-space:nowrap;
    background:url(images/error.png) no-repeat left center;
}
.Validform_loading{
    padding-left:20px;
    background:url(images/onLoad.gif) no-repeat left center;
}
.Validform_error{
    background-color:#ffe7e7;
}
#Validform_msg{color:#7d8289; font: 12px/1.5 tahoma, arial, \5b8b\4f53, sans-serif; width:280px; -webkit-box-shadow:2px 2px 3px #aaa; -moz-box-shadow:2px 2px 3px #aaa; background:#fff; position:absolute; top:0px; right:50px; z-index:99999; display:none;filter: progid:DXImageTransform.Microsoft.Shadow(Strength=3, Direction=135, Color='#999999'); box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.1);}
#Validform_msg .iframe{position:absolute; left:0px; top:-1px; z-index:-1;}
#Validform_msg .Validform_title{line-height:25px; height:25px; text-align:left; font-weight:bold; padding:0 8px; color:#fff; position:relative; background-color:#999;
background: -moz-linear-gradient(top, #999, #666 100%); background: -webkit-gradient(linear, 0 0, 0 100%, from(#999), to(#666)); filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#999999', endColorstr='#666666');}
#Validform_msg a.Validform_close:link,#Validform_msg a.Validform_close:visited{line-height:22px; position:absolute; right:8px; top:0px; color:#fff; text-decoration:none;}
#Validform_msg a.Validform_close:hover{color:#ccc;}
#Validform_msg .Validform_info{padding:8px;border:1px solid #bbb; border-top:none; text-align:left;}
</style>

@section('content')
    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-customer-add" data-toggle="validator">
            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>客户名称:</label>
                <div class="formControls col-sm-4">
                    <input id="input_name" type="text" value="" name="name" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>客户公司:</label>
                <div class="formControls col-sm-4">
                    <input id="input_company" type="text" value="" name="company" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>联系方式:</label>
                <div class="formControls col-sm-4">
                    <input id="input_name" type="text" value="" name="phone" class="input-text" datatype="*">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>介绍:</label>
                <div class="formControls col-sm-4">
                    <textarea id="input_name" class="textarea" type="text" value="" name="description" datatype="*"></textarea>
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>来源:</label>
                <div class="formControls col-sm-4">
                    <select name="source" class="select" id="select_source"
                            onchange="source_change(this.options[this.options.selectedIndex].value);" datatype="*">
                        <option value="请选择">请选择</option>
                        @foreach($source_counts as $item)
                            @if(value($item[0]) == "")
                                <option value="{{$item[0]}}">空</option>
                            @else
                                <option value="{{$item[0]}}">{{$item[0]}}</option>
                            @endif
                        @endforeach
                        <option value="other">其他(自定义)</option>
                    </select>
                    <input id="customer_input_source" name="customer_input_source" type="text" value=""
                           style="display: none">
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>销售:</label>
                <div class="formControls col-sm-4">
                    <select name="principal" class="select" id="" datatype="*">
                        <option value="请选择">请选择</option>
                        @foreach($salers as $item)
                            <option value="{{$item->username}}">
                                {{$item->username}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="Validform_checktip"></div>
            </div>

            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>状态：</label>
                <div class="formControls col-sm-4">
                    <span class="select-box">
                        <select name="status" class="select" id="customer_select_priority" datatype="*">
                            <option value="请选择">请选择</option>
                            <option value="未联系">未联系</option>
                            <option value="沟通中">沟通中</option>
                            <option value="拒绝">拒绝</option>
                            <option value="跟进">跟进</option>
                            <option value="已转化">已转化</option>
                        </select>
                    </span>
                    <div class="Validform_checktip"></div>
                </div>
            </div>

            {{--优先级--}}
            <div class="row cl" style="height: 38px">
                <label class="form-label col-sm-2"><span class="c-red"></span>优先级：</label>
                <div class="formControls col-sm-4">
                    <select name="priority" class="select" id="customer_select_priority" datatype="*">
                        <option value="请选择">请选择</option>
                        <option value="2">高</option>
                        <option value="1">中</option>
                        <option value="0">低</option>
                    </select>
                    <div class="Validform_checktip"></div>
                </div>
            </div>
            {{--<div class="row cl">--}}
            {{--<div class="col-9 col-offset-4">--}}
            {{--<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">--}}
            {{--</div>--}}
            {{--</div>--}}
        </form>

        <div class="row cl">
            <div class="col-sm-8 col-sm-offset-2">
                <button onclick="add_customer_query();" class="btn btn-secondary radius mt-15 ml-10">
                    保存
                </button>
            </div>
        </div>

    </div>
@endsection
@section('my-js')
    <script>
        $(".form").Validform({
            tiptype:2
        });

        var source = $('select[name=source] option:selected').val();

        function source_change(value) {
            if (value == "other") {
                $('#customer_input_source').tagEditor({
                    autocomplete: {
                        delay: 0,
                        position: {collision: 'flip'}
                    },
                    maxTags: 1,
                    forceLowercase: false,
                    placeholder: ''
                });

                document.getElementById("select_source").style.display = "none";
                document.getElementById("customer_input_source").style.display = "block";
                document.getElementsByClassName("tag-tag-editor ui-sortable").style.display = "block";
            }
        }

        function add_customer_query() {

            source = $('select[name=source] option:selected').val();

            if ($('input[name=name]').val() == "" || $('input[name=company]').val() == "" || $('input[name=phone]').val() == "" ||
                    $('textarea[name=description]').val() == "" || $('input[name=principal]').val() == "" || $('input[name=status]').val() == "" ||
                    $('input[name=priority]').val() == ""
            ) {
                alert("对不起,表单没有填写完整");
                return;
            }

//            alert(($('input[name=customer_input_source]').val()));

            //这里只能多传一个字段过去做讨论
//            var isSourceArray = 0;

            if ( $('input[name=customer_input_source]').val()!== "") {
                source = $('input[name=customer_input_source]').val();
//                isSourceArray = 1;
            }

            var principal = $('select[name=principal] option:selected').val();
            var status = $('select[name=status] option:selected').val();
            var priority = $('select[name=priority] option:selected').val();

            if (principal == "请选择" || status == "请选择" || priority == "请选择" || source == "请选择") {
                alert("对不起,表单没有填写完整");
                return;
            }

            $('#form-customer-add').ajaxSubmit({
                type: 'post', // 提交方式 get/post
                url: '/manager/customer_add', // 需要提交的 url
                dataType: 'json',
                data: {
                    name: $('input[name=name]').val(),
                    company: $('input[name=company]').val(),
                    phone: $('input[name=phone]').val(),
                    description: $('input[name=description]').val(),
                    source: source,
                    principal: principal,
                    status: status,
                    priority: priority,
//                    isSourceArray:isSourceArray,
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