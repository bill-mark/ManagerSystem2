@extends('master')

@section('content')
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

    <div class="page-container">
        @if($from === "saler")
            <div id="tabs" class="tabs mb-20">
                <div id="tabbar_content" class="tabBar cl">

                    <a href="/manager/project_edit?id={{$project_id}}&from=saler"><span class="normal_span">基本信息</span></a>
                    @if($project !== null)
                        <a href="/manager/customer_content?customer_name={{$project->customer_name}}&from=saler&id={{$project_id}}"><span
                                    class="clicked_span">客户信息</span></a>
                    @endif
                </div>
            </div>
            <div class="tabcon" style="display: block;">
                <div id="tabs" class="tabs mb-20">
                    <div id="tabbar_content" class="tabBar cl">
                        <span id="span_info" class="clicked_span" onclick="info_tab(this);"
                              style="cursor:pointer;">资料</span>
                        <span class="normal_span" id="span_project"
                              onclick="project_tab(this);" style="cursor:pointer;">相关项目</span>
                        <span class="normal_span" id="span_log" onclick="log_tab(this);"
                              style="cursor:pointer;">log</span>
                    </div>
                </div>
                <div id="tab01" class="tabcon" style="display: block;">
                    <table class="table table-border table-bordered table-hover table-bg table-sort"
                           id="form-customer-content">
                        <thead>
                        <tr class="text-c">
                            <th width="50" onclick="name_sort();">项目</th>
                            <th width="60" onclick="company_sort();">值</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="text-c">
                            <td>客户ID</td>
                            <td>{{$customer->id}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>客户名称</td>
                            <td>{{$customer->name}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>客户公司</td>
                            <td>{{$customer->company}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>联系方式</td>
                            <td>{{$customer->phone}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>介绍</td>
                            <td>{{$customer->description}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>来源</td>
                            <td>{{$customer->source}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>销售</td>
                            <td>{{$customer->principal}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>状态</td>
                            <td>{{$customer->status}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>优先级</td>
                            <td>
                                @if(value($customer->priority) === 1)
                                    中
                                @elseif(value($customer->priority) === 2)
                                    高
                                @elseif(value($customer->priority) === 0)
                                    低
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tab02" class="tabcon" style="display:none; ">
                    <table class="table table-border table-bg table-sort">
                        <thead>
                        <tr class="text-c">

                            <th width="50" onclick="name_sort();">项目ID</th>
                            <th width="60" onclick="company_sort();">项目名称</th>
                            <th width="60" onclick="company_sort();">面积</th>
                            <th width="50" onclick="source_sort();">地址</th>
                            <th width="40" onclick="time_sort();">报价</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $item)
                            <tr class="text-c">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->area}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->quote}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="tab03" class="tabcon" style="display:none;">
                    <div class="cl pd-5 bg-1 bk-gray">
                         <span class="l">
                         @if($from === "project_list")
                                 <button style="width: 90px ; height: 40px;background-color: white ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center;visibility: hidden">
                            </button>
                             @else
                                @if (session()->get('admin')->role != '销售人员')
                                 <button onclick="add_log();" class="btn btn-primary radius">
                                添加
                                @endif
                            </button>
                             @endif
                        </span>
                    </div>

                    <table class="table table-border table-bg"
                    style="margin-top:20px;">
                        <thead>
                        <tr class="text-c">

                            <!-- <th width="20" onclick="name_sort();">序号</th> -->
                            <th width="10%" onclick="company_sort();">提交人</th>
                            <th width="10%" onclick="company_sort();">提交时间</th>
                            <th width="80%" onclick="source_sort();">内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $item)
                            <tr class="text-c">
                                <!-- <td>{{$item->id}}</td> -->
                                <td>{{$item->submitter}}</td>
                                <td>{{$item->created_at}}</td>
                                <td style="white-space: pre-wrap">{{$item->content}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @elseif($from === "project_list")
            <div id="tabs" class="tabs mb-20">
                <div id="tabbar_content" class="tabBar cl">
                    <a href="project_edit?id={{$project_id}}&from=project_list"><span
                                class="normal_span">基本信息</span></a>
                    @if($project !== null)
                        <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$project_id}}"><span
                                    class="clicked_span">客户信息</span></a>
                    @endif
                    <a href="project_stage?id={{$project_id}}"><span class="normal_span">项目进度</span></a>
                    <a href="project_quote?id={{$project_id}}"><span class="normal_span">报价</span></a>
                    <a href="project_designer?id={{$project_id}}"><span class="normal_span">设计</span></a>
                    <a href="project_construction?id={{$project_id}}"><span class="normal_span">施工</span></a>
                </div>
            </div>
            <div class="tabcon" style="display: block ;">
                <div id="tabs" class="tabs">
                    <div id="tabbar_content" class="tabBar cl">
                        <span id="span_info" class="clicked_span" onclick="info_tab(this);"
                              style="cursor:pointer;">资料</span>
                        <span class="normal_span" id="span_project"
                              onclick="project_tab(this);" style="cursor:pointer;">相关项目</span>
                        <span class="normal_span" id="span_log" onclick="log_tab(this);"
                              style="cursor:pointer;">log</span>
                    </div>
                </div>
                <div id="tab01" class="tabcon" style="display: block ;">
                    <button
                            style="width: 90px ; height: 40px;background-color: white ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center;visibility: hidden;display:none">
                    </button>
                    <table class="table table-border table-bordered table-hover table-bg table-sort"
                           id="form-customer-content">
                        <thead>
                        <tr class="text-c">
                            <th width="50" onclick="name_sort();">项目</th>
                            <th width="60" onclick="company_sort();">值</th>
                        </tr>
                        </thead>
                        @if ($customer)
                        <tbody>
                        <tr class="text-c">
                            <td>客户ID</td>
                            <td>{{$customer->id}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>客户名称</td>
                            <td>{{$customer->name}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>客户公司</td>
                            <td>{{$customer->company}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>联系方式</td>
                            <td>{{$customer->phone}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>介绍</td>
                            <td>{{$customer->description}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>来源</td>
                            <td>{{$customer->source}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>销售</td>
                            <td>{{$customer->principal}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>状态</td>
                            <td>{{$customer->status}}</td>
                        </tr>

                        <tr class="text-c">
                            <td>优先级</td>
                            <td>
                                @if(value($customer->priority) === 1)
                                    中
                                @elseif(value($customer->priority) === 2)
                                    高
                                @elseif(value($customer->priority) === 0)
                                    低
                                @endif
                            </td>
                        </tr>
                        </tbody>
                        @endif
                    </table>
                </div>
                <div id="tab02" class="tabcon" style="display:none;">
                    <button
                            style="width: 90px ; height: 40px;background-color: white ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center;visibility: hidden;display:none">
                    </button>
                    <table class="table table-border table-bordered table-hover table-bg table-sort"
                    >
                        <thead>
                        <tr class="text-c">

                            <th width="50" onclick="name_sort();">项目ID</th>
                            <th width="60" onclick="company_sort();">项目名称</th>
                            <th width="60" onclick="company_sort();">面积</th>
                            <th width="50" onclick="source_sort();">地址</th>
                            <th width="40" onclick="time_sort();">报价</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $item)
                            <tr class="text-c">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->area}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->quote}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="tab03" class="tabcon" style="display:none;">
                    <div class="cl bg-1 bk-gray" style="display:none">
                         <span class="l">
                         @if($from === "project_list")
                                 <button style="width: 90px ; height: 40px;background-color: white ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center;visibility: hidden;display:none">
                            </button>
                             @else
                                 <button onclick="add_log();" class="btn btn-primary radius">
                                <i class="Hui-iconfont">&#xe600;</i> 添加
                            </button>
                             @endif
                        </span>
                    </div>

                    <table class="table table-border table-bg"
                    >
                        <thead>
                        <tr class="text-c">

                            <!-- <th width="20" onclick="name_sort();">序号</th> -->
                            <th width="10%" onclick="company_sort();">提交人</th>
                            <th width="10%" onclick="company_sort();">提交时间</th>
                            <th width="80%" onclick="source_sort();">内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $item)
                            <tr class="text-c">
                                <!-- <td>{{$item->id}}</td> -->
                                <td>{{$item->submitter}}</td>
                                <td>{{$item->created_at}}</td>
                                <td style="white-space: pre-wrap">{{$item->content}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div id="tabs" class="tabs mb-20">
                <div id="tabbar_content" class="tabBar cl">
                    <span id="span_info" class="clicked_span" onclick="info_tab(this);"
                          style="cursor:pointer;">资料</span>
                    <span class="normal_span" id="span_project"
                          onclick="project_tab(this);" style="cursor:pointer;">相关项目</span>
                    <span class="normal_span" id="span_log" onclick="log_tab(this);" style="cursor:pointer;">log</span>
                </div>
            </div>
            <div id="tab01" class="tabcon" style="display: block ;">


                <form action="" method="post" class="form form-horizontal mt-15" id="form-customer-content-edit"
                      style="display: none">
                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>客户ID:</label>
                        <div class="formControls col-sm-6">
                            <input id="input_id" type="" readonly value="{{$customer->id}}" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-sm-2"><span class="c-red"></span>客户名称:</label>
                        <div class="formControls col-sm-6">
                            <input id="input_name" type="text" name="customer_name" value="{{$customer->name}}"
                                   class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>


                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>客户公司:</label>
                        <div class="formControls col-sm-6">
                            <input id="input_company" name="customer_company" type="text"
                                   value="{{$customer->company}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>联系方式:</label>
                        <div class="formControls col-sm-6">
                            <input type="text" name="customer_phone" value="{{$customer->phone}}" class="input-text" datatype="*">
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>

                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>介绍:</label>
                        <div class="formControls col-sm-6">
                            <textarea type="textarea" class="textarea" id="customer_desc" name="customer_desc" datatype="*">{{$customer->description}}
                            </textarea>
                        </div>
                        <div class="Validform_checktip"></div>
                    </div>
                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>来源:</label>
                        <div class="formControls col-sm-6">
                            <select name="source" class="select" id="select_source"
                                    onchange="source_change(this.options[this.options.selectedIndex].value);">
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
                    </div>

                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>销售:</label>
                        <div class="formControls col-sm-6">
                            <select name="principal" class="select" id="principal_select">
                                @foreach($salers as $item)
                                    <option value="{{$item->username}}">
                                        {{$item->username}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>状态：</label>
                        <div class="formControls col-sm-6">
                            <select name="customer_status" class="select" id="customer_select_priority">
                                <option value="未联系">未联系</option>
                                <option value="沟通中">沟通中</option>
                                <option value="拒绝">拒绝</option>
                                <option value="跟进">跟进</option>
                                <option value="已转化">已转化</option>
                            </select>
                        </div>
                    </div>

                    <div class="row cl" style="height: 38px">
                        <label class="form-label col-sm-2"><span class="c-red"></span>优先级：</label>
                        <div class="formControls col-sm-6">
                            <select name="customer_priority" class="select" id="customer_select_priority">
                                <option value="2">高</option>
                                <option value="1">中</option>
                                <option value="0">低</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="row cl">
                    <div class="col-sm-8">
                        <button onclick="save_customer_content(this);" class="btn btn-primary radius mt-15 ml-10 mb-20" id="save-btn">编辑</button>
                    </div>
                </div>

                <table class="table table-border table-bordered table-hover table-bg table-sort"
                       id="form-customer-content">
                    <thead>
                    <tr class="text-c">
                        <th width="30%" onclick="name_sort();">项目</th>
                        <th width="70%" onclick="company_sort();">值</th>
                    </tr>
                    </thead>
                    @if ($customer)
                    <tbody>
                    <tr class="text-c">
                        <td>客户ID</td>
                        <td>{{$customer->id}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>客户名称</td>
                        <td>{{$customer->name}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>客户公司</td>
                        <td>{{$customer->company}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>联系方式</td>
                        <td>{{$customer->phone}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>介绍</td>
                        <td>{{$customer->description}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>来源</td>
                        <td>{{$customer->source}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>销售</td>
                        <td>{{$customer->principal}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>状态</td>
                        <td>{{$customer->status}}</td>
                    </tr>

                    <tr class="text-c">
                        <td>优先级</td>
                        <td>
                            @if(value($customer->priority) === 1)
                                中
                            @elseif(value($customer->priority) === 2)
                                高
                            @elseif(value($customer->priority) === 0)
                                低
                            @endif
                        </td>
                    </tr>
                    </tbody>
                    @endif
                </table>

            </div>
            <div id="tab02" class="tabcon" style="display:none;">
                <table class="table table-border table-bordered table-hover table-bg table-sort">
                    <thead>
                    <tr class="text-c">

                        <th width="50" onclick="name_sort();">项目ID</th>
                        <th width="60" onclick="company_sort();">项目名称</th>
                        <th width="60" onclick="company_sort();">面积</th>
                        <th width="50" onclick="source_sort();">地址</th>
                        <th width="40" onclick="time_sort();">报价</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $item)
                        <tr class="text-c">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->area}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->quote}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="tab03" class="tabcon" style="display:none;">
                <div class="cl pd-5 bg-1 bk-gray">
                     <span class="l">
                        @if($from === "project_list")
                             <button
                                     style="width: 90px ; height: 40px;background-color: white ; margin: 10px 0 0 88%;color:white; line-height: 40px;text-align: center;visibility: hidden">
                        </button>
                         @else
                             <button onclick="add_log();" class="btn btn-primary radius">
                            <i class="Hui-iconfont">&#xe600;</i> 添加
                        </button>
                         @endif
                    </span>
                </div>

                <table class="table table-border table-bg">
                    <thead>
                    <tr class="text-c">
                        <!-- <th width="10%" onclick="name_sort();">序号</th> -->
                        <th width="10%" onclick="company_sort();">提交人</th>
                        <th width="10%" onclick="company_sort();">提交时间</th>
                        <th width="70%" onclick="source_sort();">内容</th>
                        <th width="10%" onclick="source_sort();">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $item)
                        <tr class="text-c">
                            <!-- <td>{{$item->id}}</td> -->
                            <td>{{$item->submitter}}</td>
                            <td>{{$item->created_at}}</td>
                            <td style="white-space: pre-wrap">{{$item->content}}</td>
                            <td><a title=""
                                   onclick="customer_log_edit({{$item->id}});"
                                   class="ml-5"
                                   style="text-decoration:none;color: #0a6999">编辑</a>
                                @if($role_now == "管理员")
                                    <a title=""
                                       onclick="delete_customer_log({{$item->id}});"
                                       class="ml-5"
                                       style="text-decoration:none;color: #c00">删除</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
@section('my-js')
    <script>

        $(".form").Validform({
            tiptype:2
        });
        $('#save-btn').click(function(){
            $(this).parent().addClass('col-sm-offset-2')
        })

        function customer_log_edit(id) {
            var index = layer.open({
                type: 2,
                title: "修改log",
                content: "edit_customer_log?id=" + id,
                area: ['80%', '70%']
            });
        }

        function delete_customer_log(id) {
            if (window.confirm('确认删除吗？')) {
                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: 'delete_customer_log', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        id: id,
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
                        layer.msg("删除成功", {icon: 1, time: 2000});
                        window.location.href="customer_content?customer_name={{$customer ? $customer->name : ''}}&log_tab=1";
                    },
                    error: function (xhr, status, error) {
                        layer.msg('ajax error', {icon: 2, time: 2000});
                    },
                    beforeSend: function (xhr) {
                        layer.load(0, {shade: false});
                    }
                });
            }
        }

        var priority_default = "{{ $customer ? $customer->priority : ''}}";
        $("#customer_select_priority option[value='" + priority_default + "']").attr("selected", true);

        var status_default = "{{ $customer ? $customer->status : ''}}";
        $("#customer_select_status option[value='" + status_default + "']").attr("selected", true);

        var principal_default = "{{ $customer ? $customer->principal : ''}}";
        $("#principal_select option[value='" + principal_default + "']").attr("selected", true);

        var source_default = "{{ $customer ? $customer->source : ''}}";
        $("#select_source option[value='" + source_default + "']").attr("selected", true);

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



        var tab01 = document.getElementById("tab01");
        var tab02 = document.getElementById("tab02");
        var tab03 = document.getElementById("tab03");
        var tabbar_content = document.getElementById("tabbar_content");
        function info_tab(obj) {
            document.getElementById("span_project").className = "normal_span";
            document.getElementById("span_log").className = "normal_span";
            document.getElementById("span_info").className = "normal_span";
            obj.className = "clicked_span";
            tab01.style.display = "block";
            tab02.style.display = "none";
            tab03.style.display = "none";
        }
        function project_tab(obj) {

            document.getElementById("span_project").className = "normal_span";
            document.getElementById("span_log").className = "normal_span";
            document.getElementById("span_info").className = "normal_span";

            obj.className = "clicked_span";
            tab02.style.display = "block";
            tab01.style.display = "none";
            tab03.style.display = "none";
        }
        function log_tab(obj) {
            document.getElementById("span_project").className = "normal_span";
            document.getElementById("span_log").className = "normal_span";
            document.getElementById("span_info").className = "normal_span";
            obj.className = "clicked_span";
            tab01.style.display = "none";
            tab02.style.display = "none";
            tab03.style.display = "block";
        }

        //添加 log
        function add_log() {
            var index = layer.open({
                type: 2,
                title: "添加 log",
                content: "customer_add_log?id=" + "{{$id}}",
                area: ['80%', '70%']
            });
        }

        function save_customer_content(obj) {

            var content = obj.innerHTML;

            if (content == "编辑") {
                obj.innerHTML = "保存";

                document.getElementById("form-customer-content").style.display = "none";
                document.getElementById("form-customer-content-edit").style.display = "block";
                $(this).parent().addClass('.col-sm-offset-2');


            } else if (content == "保存") {

                $(this).parent().addClass('.col-sm-offset-2');

                if (($('input[name=customer_input_source]').val()) !== "") {
                    source = ($('input[name=customer_input_source]').val());
                } else {
                    source = $('select[name=source] option:selected').val();
                }

            if ($('select[name=principal] option:selected').val() == "" || source == "" || $('input[name=customer_name]').val() == ""
                    || $('input[name=customer_company]').val() == "" || $('input[name=customer_phone]').val() == "" || $('textarea[name=customer_desc]').val() == ""
                    || $('select[name=customer_status] option:selected').val() == "" || $('select[name=customer_priority] option:selected').val() === "")
            {
                console.log($('select[name=principal] option:selected').val(), source, $('input[name=customer_name]').val(), $('input[name=customer_company]').val(), $('input[name=customer_phone]').val(),  $('textarea[name=customer_desc]').val(), $('select[name=customer_status] option:selected').val(), $('select[name=customer_priority] option:selected').val());
                alert("未填写完整,请填写完整再提交ff");
                return;
            }

                //在提交包含 tag 的表单的时候,如果 tag 为空,就会有问题

                $('#form-customer-content-edit').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: '/manager/customer/edit', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        id: "{{$id}}",
                        principal: $('select[name=principal] option:selected').val(),
                        source: source,
                        name: $('input[name=customer_name]').val(),
                        company: $('input[name=customer_company]').val(),
                        phone: $('input[name=customer_phone]').val(),
                        desc: $('textarea[name=customer_desc]').val(),
                        status: $('select[name=customer_status] option:selected').val(),
                        priority: $('select[name=customer_priority] option:selected').val(),
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
                        layer.msg('ajax error', {icon: 2, time: 2000});
                    },
                    beforeSend: function (xhr) {
                        layer.load(0, {shade: false});
                    }
                });
            }

        }
        $(document).ready(function() {
            @if (Request::get('log_tab'))
                $('#span_log').trigger('click');
            @endif
            @if (Request::get('project_tab'))
                $('#span_project').trigger('click');
            @endif
        })
    </script>
@endsection
