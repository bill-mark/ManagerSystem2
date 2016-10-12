@extends('master')

@section('content')
    <div class="page-container">
        <div id="tabs" class="tabs">
            <div id="tabbar_content" class="tabBar cl">
                <a href="project_edit?id={{$id}}"><span class="normal_span">基本信息</span></a>
                <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$id}}"><span
                            class="normal_span">客户信息</span></a>
                <a href="project_stage?id={{$id}}"><span class="normal_span">项目进度</span></a>
                <a href="project_quote?id={{$id}}"><span class="normal_span">报价</span></a>
                <a href="project_designer?id={{$id}}"><span class="normal_span">设计</span></a>
                <a href="project_construction?id={{$id}}"><span class="clicked_span">施工</span></a>
            </div>
        </div>
        <div class="tabcon">
            <div>
                <div class="cl pd-5 bg-1 bk-gray" style="margin-bottom: 20px">
                    <label style="margin-right: 40px">OwnClound链接</label>
                    <input name="ownclound_input" type="text" class="select input-text"
                           style="width: 260px;display: inline;" value="{{$project->ownclound}}">
                    </input>
                    <button onclick="project_ownclound_edit();" class="btn btn-primary radius">
                        更新
                    </button>
                </div>

                <div id="tabs" class="tabs mb-20">
                    <div id="tabbar_content" class="tabBar cl">
                        <span id="span_daily_report" class="clicked_span" onclick="daily_report_tab(this);"
                              style="cursor:pointer;">日报</span>
                        <span class="normal_span" id="span_stage_pic"
                              onclick="stage_pic_tab(this);" style="cursor:pointer;">进度图</span>
                    </div>
                </div>
                {{--沟通、见面/量房、平图、合同、设计图、打款、开工--}}
                <div id="tab01" class="tabcon">
                    <div class="cl pd-5 bg-1 bk-gray">
                        <button onclick="project_log_add('日报');" class="btn btn-success radius">
                            <i class="Hui-iconfont">&#xe600;</i>添加
                        </button>
                    </div>

                    <table class="table table-border table-bg">
                        <thead>
                        <tr class="text-c">
                            <!-- <th width="20" onclick="name_sort();">序号</th> -->
                            <th width="10%" onclick="company_sort();">提交人</th>
                            <th width="10%" onclick="company_sort();">提交时间</th>
                            <th width="70%" onclick="source_sort();">内容</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $item)
                            @if($item->stage === "日报")
                                <tr class="text-c">
                                <!-- <td>{{$item->id}}</td> -->
                                    <td>{{$item->submitter}}</td>
                                    <td class="td_commit_at">{{$item->updated_at}}</td>
                                    <td style="white-space: pre-wrap">{{$item->content}}</td>
                                    <td><a title=""
                                           onclick="project_log_edit({{$item->id}});"
                                           class="ml-5"
                                           style="text-decoration:none;color: #0a6999">编辑</a>
                                        @if($role_now == "管理员")
                                            <a title=""
                                               onclick="delete_project_log({{$item->id}});"
                                               class="ml-5"
                                               style="text-decoration:none;color: #c00">删除</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="tab02" class="tabcon" style="display: none">
                    <div class="cl pd-5 bg-1 bk-gray">
                        <button onclick="project_log_add('进度图');" class="btn btn-success radius">
                            <i class="Hui-iconfont">&#xe600;</i>添加
                        </button>
                    </div>

                    <table class="table table-border table-bg">
                        <thead>
                        <tr class="text-c">
                            <!-- <th width="20" onclick="name_sort();">序号</th> -->
                            <th width="10%" onclick="company_sort();">提交人</th>
                            <th width="10%" onclick="company_sort();">提交时间</th>
                            <th width="70%" onclick="source_sort();">内容</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $item)
                            @if($item->stage === "进度图")
                                <tr class="text-c">
                                <!-- <td>{{$item->id}}</td> -->
                                    <td>{{$item->submitter}}</td>
                                    <td class="td_commit_at">{{$item->updated_at}}</td>
                                    <td style="white-space: pre-wrap">{{$item->content}}</td>
                                    <td><a title=""
                                           onclick="project_log_edit({{$item->id}});"
                                           class="ml-5"
                                           style="text-decoration:none;color: #0a6999">编辑</a>
                                        @if($role_now == "管理员")
                                            <a title=""
                                               onclick="delete_project_log({{$item->id}});"
                                               class="ml-5"
                                               style="text-decoration:none;color: #c00">删除</a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endsection
        @section('my-js')
            <script>
                var tab01 = document.getElementById("tab01");
                var tab02 = document.getElementById("tab02");

                function daily_report_tab(obj) {
                    document.getElementById("span_daily_report").className = "clicked_span";
                    document.getElementById("span_stage_pic").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "block";
                    tab02.style.display = "none";
                }

                function stage_pic_tab(obj) {
                    document.getElementById("span_daily_report").className = "normal_span";
                    document.getElementById("span_stage_pic").className = "clicked_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "block";
                }

                function project_ownclound_edit() {
                    $.ajax({
                        type: 'post',
                        url: 'project_ownclound_edit', // 需要提交的 url
                        dataType: 'json',
                        data: {
                            id: "{{$id}}",
                            url: $("input[name=ownclound_input]").val(),
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data) {
                            if (data == null) {
                                layer.msg('服务端错误', {icon: 2, time: 2000});
                                return;
                            }
                            if (data.status != 0) {
                                layer.msg("修改成功", {icon: 2, time: 2000});
                                return;
                            }

                            layer.msg("修改成功", {icon: 1, time: 2000});
                            window.location.reload();
                        }
                        ,
                        error: function (xhr, status, error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                            layer.msg('ajax error', {icon: 2, time: 5000});
                        }
                        ,
                        beforeSend: function (xhr) {
                            layer.load(0, {shade: false});
                        }
                    })
                    ;
                }

                //编辑 log
                function project_log_edit(id) {
                    var index = layer.open({
                        type: 2,
                        title: "修改log",
                        content: "edit_project_log?id=" + id,
                        area: ['80%', '70%']
                    });
                }

                function delete_project_log(id) {
                    if (window.confirm('确认删除吗？')) {
                        $.ajax({
                            type: 'post', // 提交方式 get/post
                            url: 'delete_project_log', // 需要提交的 url
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
                                var clicked = $('#second_tabs').find('.clicked_span').attr('id').substring(5) + '_tab';
                                location.href = "project_stage?id={{$id}}&" + clicked + "=1";
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


                //去小数点
                var td_commit_ats = document.getElementsByClassName('td_commit_at');
                for (var i = 0; i < td_commit_ats.length; i++) {
                    var old_value = td_commit_ats[i].innerHTML.toString();

                    var new_val = old_value.substring(0, 10);

                    var arr = old_value.match(/./g);
                    td_commit_ats[i].innerHTML = new_val;
                }

                //添加 log
                function project_log_add(stage) {

                    switch (stage){
                        case "日报":
                            var index = layer.open({
                                type: 2,
                                title: "添加log",
                                content: "project_daily_report_log?id=" + "{{$id}}" + "&stage=" + stage + "",
                                area: ['80%', '70%']
                            });
                            break;
                        case "进度图":
                            var index = layer.open({
                                type: 2,
                                title: "添加log",
                                content: "project_stage_pic_log?id=" + "{{$id}}" + "&stage=" + stage + "",
                                area: ['80%', '70%']
                            });
                            break;

                    }
                }


                $(document).ready(function () {
                    @if (Request::get('span_info'))
                        $('#span_info').trigger('click');
                    @endif
                    @if (Request::get('project_tab'))
                        $('#span_project').trigger('click');
                    @endif
                    @if (Request::get('log_tab'))
                        $('#span_log').trigger('click');
                    @endif
                    @if (Request::get('contract_tab'))
                        $('#span_contract').trigger('click');
                    @endif
                    @if (Request::get('designPic_tab'))
                        $('#span_designPic').trigger('click');
                    @endif
                    @if (Request::get('project_tab'))
                        $('#span_project').trigger('click');
                    @endif
                    @if (Request::get('money_tab'))
                        $('#span_money').trigger('click');
                    @endif
                    @if (Request::get('begin_tab'))
                        $('#span_begin').trigger('click');
                    @endif
                })

            </script>
@endsection
