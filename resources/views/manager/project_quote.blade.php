@extends('master')

@section('content')


    <div class="page-container">
        <div id="tabs" class="tabs">
            <div id="tabbar_content" class="tabBar cl">
                <a href="project_edit?id={{$id}}"><span class="normal_span">基本信息</span></a>
                <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$id}}"><span
                            class="normal_span">客户信息</span></a>
                <a href="project_stage?id={{$id}}"><span class="normal_span">项目进度</span></a>
                <a href="project_quote?id={{$id}}"><span class="clicked_span">报价</span></a>
                <a href="project_designer?id={{$id}}"><span class="normal_span">设计</span></a>
                <a href="project_construction?id={{$id}}"><span class="normal_span">施工</span></a>
            </div>
        </div>

        <div id="tab01" class="tabcon">
            <div class="cl pd-5 bg-1 bk-gray mb-20 mt-20">
                <label class="form-label"
                       style="display: inline;">现报价：</label>
                <input name="log_quote_now" type="number" class="select input-text" id="log_quote_now"
                       style="width: 160px;display: inline">
                </input>
                <button onclick="project_stage_edit();" class="btn btn-primary radius" style="margin-right: 45px">
                    更新
                </button>

                <label class="form-label"
                       style="display: inline;">成本：</label>
                <input name="cost_input" type="number" class="select input-text" id="log_quote_now"
                       style="width: 160px;display: inline" value="{{$project->cost}}">
                </input>
                <button onclick="project_cost_edit();" class="btn btn-primary radius" style="margin-right: 45px">
                    更新
                </button>

                <label class="form-label"
                       style="display: inline;">利润：</label>
                <input name="profit_input" type="number" class="select input-text" id="log_quote_now"
                       style="width: 160px;display: inline" value="{{$project->profit}}">
                </input>
                <button onclick="project_profit_edit();" class="btn btn-primary radius">
                    更新
                </button>
            </div>


            <div class="cl pd-5 bg-1 bk-gray" style="margin-bottom: 20px">
                <label style="margin-right: 40px">OwnClound链接</label>
                <input name="ownclound_input" type="text" class="select input-text"
                       style="width: 260px;display: inline;" value="{{$project->ownclound}}">
                </input>
                <button onclick="project_ownclound_edit();" class="btn btn-primary radius">
                    更新
                </button>
            </div>

            <div style="margin-top: 15px">
                <div>
                    <div class="cl pd-5 bg-1 bk-gray">
                        <button onclick="project_log_add();" class="btn btn-success radius">
                            <i class="Hui-iconfont">&#xe600;</i>添加
                        </button>
                    </div>
                    <table class="table table-border table-bg">
                        <thead>
                        <tr>
                            <th width="10%">提交人</th>
                            <th width="10%">提交时间</th>
                            <th width="70%">内容</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $item)
                            @if($item->stage === '报价')
                                <tr class="">
                                    <td>
                                        {{$item->submitter}}
                                    </td>
                                    <td>
                                        {{$item->updated_at}}
                                    </td>
                                    <td style="white-space: pre-line">
                                        {{$item->content}}
                                    </td>
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
    </div>

@endsection
@section('my-js')
    <script>
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


        //去小数点
        var td_commit_ats = document.getElementsByClassName('td_commit_at');
        for (var i = 0; i < td_commit_ats.length; i++) {
            var old_value = td_commit_ats[i].innerHTML.toString();
            var new_val = old_value.substring(0, 10);
            var arr = old_value.match(/./g);
            console.log(arr);
            td_commit_ats[i].innerHTML = new_val;
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
                    window.location.reload();
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


        $("#log_quote_now").val("{{$quote_now}}");

        //添加 log
        function project_log_add() {
            var index = layer.open({
                type: 2,
                title: "添加log",
                content: "project_add_quote_log?id=" + "{{$id}}",
                area: ['80%', '70%']
            });
        }

        function project_stage_edit() {
            $.ajax({
                type: 'post',
                url: 'project_quote_edit', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$id}}",
                    quote: $("input[name=log_quote_now]").val(),
                    cost: $("input[name=cost_input]").val(),
                    profit: $("input[name=profit_input]").val(),
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
            });
        }

        function project_cost_edit() {
            $.ajax({
                type: 'post',
                url: 'project_quote_edit', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$id}}",
                    quote: $("input[name=log_quote_now]").val(),
                    cost: $("input[name=cost_input]").val(),
                    profit: $("input[name=profit_input]").val(),
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
            });
        }

        function project_profit_edit() {
            $.ajax({
                type: 'post',
                url: 'project_quote_edit', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$id}}",
                    quote: $("input[name=log_quote_now]").val(),
                    cost: $("input[name=cost_input]").val(),
                    profit: $("input[name=profit_input]").val(),
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
            });
        }

    </script>
@endsection
