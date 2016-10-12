@extends('master')

@section('content')

    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray">
            <button class="btn btn-success radius" onclick="addAccount();"><i class="Hui-iconfont">&#xe600;</i>添加成员
            </button>
        </div>

        <div class="panel panel-default" style="margin-top: 6px">
            <div class="panel-header">管理员</div>
            <div class="panel-body">
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="33%">帐号ID</th>
                        <th width="33%">用户名</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($admins as $item)
                        <tr class="">
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <a title="重置密码" href="javascript:;"
                                   onclick="edit_password('重置密码','/manager/update_password?id={{$item->id}}')" class="ml-5"
                                   style="text-decoration:none;color: #0a6999">重置密码</a>
                                {{--<a title="重置密码" href="javascript:;"--}}
                                {{--onclick="delete_password('{{$item->id}}')" class="ml-5"--}}
                                {{--style="text-decoration:none;color: #c00">删除帐号</a>--}}
                                <a title="" href="javascript:;"
                                  onclick="delete_account('/manager/delete_account/?id={{$item->id}}')"
                                   class="ml-5"
                                   style="text-decoration:none;color: #c00">删除帐号</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-header">项目经理</div>
            <div class="panel-body">
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="33%">帐号ID</th>
                        <th width="33%">用户名</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($pms as $item)
                        <tr class="">
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <a title="重置密码" href="javascript:;"
                                   onclick="edit_password('重置密码','/manager/update_password?id={{$item->id}}')" class="ml-5"
                                   style="text-decoration:none;color: #0a6999">重置密码</a>
                                <a title="" href="javascript:;"
                                  onclick="delete_account('/manager/delete_account/?id={{$item->id}}')"
                                   class="ml-5"
                                   style="text-decoration:none;color: #c00">删除帐号</a>
                            </td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-header">销售人员</div>
            <div class="panel-body">

                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="33%">帐号ID</th>
                        <th width="33%">用户名</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($salers as $item)
                        <tr class="">
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <a title="修改密码" href="javascript:;"
                                   onclick="edit_password('重置密码','/manager/update_password?id={{$item->id}}')" class="ml-5"
                                   style="text-decoration:none;color: #0a6999">重置密码</a>
                                <a title="" href="javascript:;"
                                  onclick="delete_account('/manager/delete_account/?id={{$item->id}}')"
                                   class="ml-5"
                                   style="text-decoration:none;color: #c00">删除帐号</a>
                            </td>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-header">设计师</div>
            <div class="panel-body">

                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="33%">帐号ID</th>
                        <th width="33%">用户名</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($designers as $item)
                        <tr class="">
                            <td>{{$item->id}}</td>
                            <td>{{$item->username}}</td>
                            <td>
                                <a title="重置密码" href="javascript:;"
                                   onclick="edit_password('重置密码','/manager/update_password?id={{$item->id}}')" class="ml-5"
                                   style="text-decoration:none;color: #0a6999">重置密码</a>
                                <a title="" href="/manager/delete_account/?id={{$item->id}}"
                                   class="ml-5"
                                   style="text-decoration:none;color: #c00">删除帐号</a>
                            </td>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('my-js')
    <script type="text/javascript">

        //转到修改密码界面
        function edit_password(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['100%', '100%']
            });
        }

        //转到添加帐号界面
        function addAccount() {
            var index = layer.open({
                type: 2,
                title: "添加帐号",
                content: "/manager/account_add",
                area: ['100%', '100%']
            });

        }

        function delete_password(id) {
            $.ajax({
                type: 'get', // 提交方式 get/post
                url: "delete_account",
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
        function delete_account(url) {
            if (window.confirm('确认删除该账号？')) {
                window.location.href= url;
            }
        }
    </script>
@endsection
