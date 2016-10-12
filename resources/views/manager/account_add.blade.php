@extends('manager.master')

@section('content')
    <div class="page-container">

        <form action="" method="post" class="form form-horizontal" id="form-order-edit" style="margin-top: 80px">
            <div class="row cl" style="    margin-top: -43px;">
                <label class="form-label col-sm-2"><span class="c-red"></span>用户名:</label>
                <div class="formControls col-sm-6">
                    <input type="text" class="input-text" value="" id="input_username">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>角色:</label>
                <div class="formControls col-sm-6 ">
                    <span class="select-box">
                        <select name="" class="select" id="select_role">
                            <option value="管理员">管理员</option>
                            <option value="项目经理">项目经理</option>
                            <option value="销售人员">销售人员</option>
                            <option value="设计师"> 设计师</option>
                        </select>
                    </span>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>密码:</label>
                <div class="formControls col-sm-6">
                    <input id="input_password" type="password" class="input-text" value="">
                </div>
                {{--<textarea  cols="5" rows="3" style="width: 100%;height: 180px;"></textarea>--}}
            </div>

            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>确认密码:</label>
                <div class="formControls col-sm-6">
                    <input id="input_password_confirm" type="password" class="input-text" value="">
                </div>
                {{--<textarea  cols="5" rows="3" style="width: 100%;height: 180px;"></textarea>--}}
            </div>
        </form>
        <div class="row cl">
            <div class="col-sm-8 col-sm-offset-2">
                <button class="btn btn-secondary radius mt-15 ml-5" onclick="addAccountConfirm();">确认</button>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">

        //重置密码
        function addAccountConfirm() {
            var username = document.getElementById("input_username").value;
            var role = $('#select_role option:selected').val();
            var password = document.getElementById("input_password").value;
            var password_confirm = document.getElementById("input_password_confirm").value;

            if (username == '' || role == '' || password == '' || password_confirm == '') {
                alert('输入信息不完整！');
                return;
            }

            if (password != password_confirm) {
                alert('两次密码不一致！');
                return;
            }

            if (password == password_confirm) {
                //ajax 请求
                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: 'account_add', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        username: username,
                        role: role,
                        password: password,
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
            } else {
                alert("对不起,密码确认失败,请检查两次输入是否一致")
            }
        }

    </script>
@endsection
