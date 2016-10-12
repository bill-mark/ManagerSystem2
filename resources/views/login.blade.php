@extends('master')

@section('content')
    <style>

        .btn-primary {
            background-color: #00B83F;
            line-height: 26px;
            font-size: 16px;
            height: 40px;
            width: 95px;
        }

        .btn-default {
            line-height: 26px;
            font-size: 16px;
            height: 40px;
            width: 95px;
        }

        .btn-success {
            background-color: #00B83F;
        }

        a.btn, a.btn.size-M, span.btn, span.btn.size-M {
            line-height: 26px;
        }

        input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
            background-color: white;
            background-image: none;
            color: rgb(0, 0, 0);
        }


    </style>
    <link href="css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <div class=""></div>
    <div class="loginWraper" style="background: url('');">
        <div id="loginform" class="loginBox" style="background: url();">
            <form class="form form-horizontal" action="" method="post">
                {{ csrf_field() }}


                <div class="row cl" style="margin-top: -100px;">
                    <div class="formControls" style="text-align: center">
                        <h2>你好, 欢迎!</h2>
                    </div>
                </div>

                {{--<div class="row cl">--}}
                    {{--<div class="formControls col-8 col-offset-3">--}}

                        {{--<div class="btn-group" id="role-group">--}}
                            {{--<span id="manager-btn" class="btn btn-primary radius" onclick="chooseRole(this);">管理员</span>--}}
                            {{--<span class="btn btn-default radius" id="saler-btn" onclick="chooseRole(this);">销售人员</span>--}}
                            {{--<span class="btn btn-default radius" id="pm-btn" onclick="chooseRole(this);">项目经理</span>--}}
                            {{--<span class="btn btn-default radius" id="designer-btn"--}}
                                  {{--onclick="chooseRole(this);">设计师</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="row cl">
                    <label class="form-label col-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                    <div class="formControls col-8">
                        <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
                    </div>
                </div>


                <div class="row cl">
                    <label class="form-label col-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                    <div class="formControls col-8">
                        <input id="input_password" name="password" type="password" placeholder="密码" class="input-text size-L">
                    </div>
                </div>
                <div class="row">
                    <div class="formControls" style="text-align: center">
                        <input onclick="onLogin();" name="" id="btn_login" type="button" class="btn btn-success radius size-L"
                               value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">

                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--<div class="footer" style="background-color: black">Copyright InGongZhuang</div>--}}

    <div class="footer" style="background-color: black">Copyright <a href="https://github.com/audeSt">@aude</a></div>
@endsection
@section('my-js')
    <script type="text/javascript">
        var role = "管理员";
        function chooseRole(obj) {
            role = obj.innerHTML;

            //先清楚掉所有的 btn-primary
            document.getElementById("manager-btn").className = 'btn btn-default radius';
            document.getElementById("saler-btn").className = 'btn btn-default radius';
            document.getElementById("pm-btn").className = 'btn btn-default radius';
            document.getElementById("designer-btn").className = 'btn btn-default radius';
            obj.className = 'btn btn-primary radius';
        }

        function onLogin() {

            var username = $('input[name=username]').val();
            var password = $('input[name=password]').val();

            $.ajax({
                type: 'post', // 提交方式 get/post
                url: '/service/login', // 需要提交的 url
                dataType: 'json',
                data: {
                    username: username,
                    password: password,
//                    role: role,
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

                    role = data.message;
                    if (role == "管理员") {
                        location.href = '/manager/index';
                    }

                    switch (role) {
                        case "管理员":
                            location.href = "/manager/index";
                            break;
                        case "销售人员":
                            location.href = "/saler/index";
                            break;
                        case "项目经理":
                            location.href = "/pm/index";
                            break;
                        case "设计师":
                            location.href = "/designer/index";
                            break;
                    }

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

        $("#input_password").bind("keydown" , function(e){
            var theEvent = e || window.event;
            var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
            if (code == 13) {
                //回车执行查询
                $("#btn_login").click();
            }
        });

    </script>
@endsection
