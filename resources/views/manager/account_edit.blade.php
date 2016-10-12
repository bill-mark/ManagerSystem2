@extends('manager.master')

@section('content')

    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-account-edit"
              style="margin-top: 80px">
            <div class="row cl" style="margin-top: -43px;">
                <label class="form-label col-sm-2"><span class="c-red"></span>ID:</label>
                <div class="formControls col-sm-6">
                    <input type="text" class="input-text" name="account_id_input" value="{{$account->id}}" readonly>
                </div>
            </div>
            <div class="row cl" style="">
                <label class="form-label col-sm-2"><span class="c-red"></span>用户名:</label>
                <div class="formControls col-sm-6">
                    <input type="text" class="input-text" value="{{$account->username}}" readonly>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>新密码:</label>
                <div class="formControls col-sm-6">
                    <input id="input_password" name="account_password_input" type="password" class="input-text" value="">
                </div>
                {{--<textarea  cols="5" rows="3" style="width: 100%;height: 180px;"></textarea>--}}
            </div>
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>确认新密码:</label>
                <div class="formControls col-sm-6">
                    <input id="input_password_confirm" type="password" class="input-text" value="">
                </div>
                {{--<textarea  cols="5" rows="3" style="width: 100%;height: 180px;"></textarea>--}}
            </div>
        </form>
        <div class="row cl">
            <div class="col-sm-8 col-sm-offset-2">
                 <button class="btn btn-danger radius ml-5 mt-15" 
                    onclick="resetPass();">重置密码
                </button>
            </div> 
        </div>
    </div>

@endsection

@section('my-js')
    <script type="text/javascript">

        //重置密码
        function resetPass() {
            var new_password = document.getElementById("input_password").value;
            var password_confirm = document.getElementById("input_password_confirm").value;

            if (new_password != "" && new_password == password_confirm) {

                $('#form-account-edit').ajaxSubmit({
                    type: 'post', // 提交方式 get/post
                    url: 'account/edit', // 需要提交的 url
                    dataType: 'json',
                    data: {
                        id: $('input[name=account_id_input]').val(),
                        password: $('input[name=account_password_input]').val(),
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


                        layer.msg("重置成功", {icon: 1, time: 3000});

                        var index = parent.layer.getFrameIndex(window.name);

                        var t = setTimeout(function () {

                            parent.layer.close(index)

                        }, 1000);
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
                alert("请确认密码是否输入错误");
            }

        }

    </script>
@endsection
