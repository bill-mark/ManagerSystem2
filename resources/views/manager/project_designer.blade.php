@extends('master')

@section('content')
    <div class="page-container">
        <div id="tabs" class="tabs">
            @if($from === "designer")
                <div id="tabbar_content" class="tabBar cl">
                    <a href="project_edit?id={{$id}}&from=designer"><span class="normal_span">基本信息</span></a>
                    <a href="project_designer?id={{$id}}&from=designer"><span class="clicked_span">设计</span></a>
                </div>
            @else
                <div id="tabbar_content" class="tabBar cl">
                    <a href="project_edit?id={{$id}}"><span class="normal_span">基本信息</span></a>
                    <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$id}}"><span
                                class="normal_span">客户信息</span></a>
                    <a href="project_stage?id={{$id}}"><span class="normal_span">项目进度</span></a>
                    <a href="project_quote?id={{$id}}"><span class="normal_span">报价</span></a>
                    <a href="project_designer?id={{$id}}"><span class="clicked_span">设计</span></a>
                    <a href="project_construction?id={{$id}}"><span class="normal_span">施工</span></a>
                </div>
            @endif
        </div>

        <div id="tab01" class="tabcon">
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

                    <div class="cl pd-5 bg-1 bk-gray mb-20 mt-20">
                        <button onclick="project_log_designer_add();"
                                class="btn btn-success radius">
                            <i class="Hui-iconfont">&#xe600;</i>
                            添加
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
                            @if($item->stage === '设计')
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
                                    <td>
                                        <a title=""
                                           onclick="project_log_edit({{$item->id}})"
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
        function project_log_designer_add() {
            var index = layer.open({
                type: 2,
                title: "添加log",
                content: "project_add_designer_log?id=" + "{{$id}}",
                area: ['80%', '70%']
            });
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

        function project_stage_edit() {
            $.ajax({
                type: 'post',
                url: 'project_stage_edit', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$id}}",
                    stage: $("input[name=log_quote_now]").val(),
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
                    parent.location.reload();
                }
                ,
                error: function (xhr, status, error) {
                    layer.msg('ajax error', {icon: 2, time: 5000});
                }
                ,
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                }
            })
            ;
        }

    </script>
@endsection
