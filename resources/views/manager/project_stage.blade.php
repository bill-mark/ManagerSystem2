@extends('master')

@section('content')
    <div class="page-container">
        <div id="tabs" class="tabs">
            <div id="tabbar_content" class="tabBar cl">
                <a href="project_edit?id={{$id}}"><span class="normal_span">基本信息</span></a>
                <a href="customer_content?customer_name={{$project->customer_name}}&from=project_list&id={{$id}}"><span
                            class="normal_span">客户信息</span></a>
                <a href="project_stage?id={{$id}}"><span class="clicked_span">项目进度</span></a>
                <a href="project_quote?id={{$id}}"><span class="normal_span">报价</span></a>
                <a href="project_designer?id={{$id}}"><span class="normal_span">设计</span></a>
                <a href="project_construction?id={{$id}}"><span class="normal_span">施工</span></a>
            </div>
        </div>
        <div class="tabcon">
            <div>
                <div class="cl pd-5 bg-1 bk-gray mb-20 mt-20">
                    <label class="form-label" style="display:inline-block">最新进度：</label>
                    <select name="log_stage_edit" class="select" id="select_stage" style="width: 160px;display: inline">
                        <option value="沟通">沟通</option>
                        <option value="见面/量房">见面/量房</option>
                        <option value="平图">平图</option>
                        <option value="合同">合同</option>
                        <option value="设计图">设计图</option>
                        <option value="打款">打款</option>
                        <option value="开工">开工</option>
                    </select>
                    <button onclick="project_stage_edit();" class="btn btn-primary radius">
                        保存
                    </button>
                </div>

                <div id="tab01" class="tabcon">
                    <div class="cl pd-5 bg-1 bk-gray">
                        <button onclick="project_log_add('沟通');"
                                class="btn btn-success radius">
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
                            @if($item->stage != "日报" && $item->stage != "进度图")
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
                                window.location.reload();
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

                //        $stage_now
                var stage_now = "{{$stage_now}}";
                $("#select_stage option[value='" + stage_now + "']").attr("selected", true);
                var tab01 = document.getElementById("tab01");
                var tab02 = document.getElementById("tab02");
                var tab03 = document.getElementById("tab03");
                var tab04 = document.getElementById("tab04");
                var tab05 = document.getElementById("tab05");
                var tab06 = document.getElementById("tab06");
                var tab07 = document.getElementById("tab07");
                var tabbar_content = document.getElementById("tabbar_content");
                function info_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "block";
                    tab02.style.display = "none";
                    tab03.style.display = "none";
                    tab04.style.display = "none";
                    tab05.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "none";
                }
                function project_tab(obj) {

                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";

                    obj.className = "clicked_span";
                    tab02.style.display = "block";
                    tab01.style.display = "none";
                    tab03.style.display = "none";
                    tab04.style.display = "none";
                    tab05.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "none";

                }
                function log_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "none";
                    tab03.style.display = "block";
                    tab04.style.display = "none";
                    tab05.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "none";

                }

                function contract_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "none";
                    tab03.style.display = "none";
                    tab04.style.display = "block";
                    tab05.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "none";

                }

                function designPic_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "none";
                    tab03.style.display = "none";
                    tab05.style.display = "block";
                    tab04.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "none";

                }
                function money_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";
                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "none";
                    tab03.style.display = "none";
                    tab04.style.display = "none";
                    tab05.style.display = "none";
                    tab06.style.display = "block";
                    tab07.style.display = "none";

                }

                function begin_tab(obj) {
                    document.getElementById("span_project").className = "normal_span";
                    document.getElementById("span_log").className = "normal_span";
                    document.getElementById("span_info").className = "normal_span";
                    document.getElementById("span_contract").className = "normal_span";
                    document.getElementById("span_designPic").className = "normal_span";
                    document.getElementById("span_money").className = "normal_span";
                    document.getElementById("span_begin").className = "normal_span";

                    obj.className = "clicked_span";
                    tab01.style.display = "none";
                    tab02.style.display = "none";
                    tab03.style.display = "none";
                    tab04.style.display = "none";
                    tab05.style.display = "none";
                    tab06.style.display = "none";
                    tab07.style.display = "block";
                }

                //添加 log
                function project_log_add(stage) {

                    var index = layer.open({
                        type: 2,
                        title: "添加log",
                        content: "project_add_log?id=" + "{{$id}}" + "&stage=" + stage + "",
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
                            stage: $("select[name=log_stage_edit] option:selected").val(),
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
                        }
                        ,
                        error: function (xhr, status, error) {
                            layer.msg('ajax error', {icon: 2, time: 5000});
                        }
                        ,
                        beforeSend: function (xhr) {
                        }
                    })
                    ;
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
