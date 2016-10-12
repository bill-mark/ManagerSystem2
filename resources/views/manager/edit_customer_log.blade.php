@extends('manager.master')

@section('content')

    <div>
        <form action="" method="post" class="form form-horizontal" id="form-order-edit"
              style="margin-top: 80px;">
            {{--客户需求--}}
            <div class="row cl" style="margin-top: -43px;">
                <label class="form-label col-sm-2"><span class="c-red"></span>log:</label>
                <div class="formControls col-sm-6">
                    {{--<input id="input_log" type="textarea" cols="5" rows="3" class="text" style="width: 100%;height: 180px;word-break:break-all" value="">--}}
                    <textarea cols="5" rows="3" style="width: 100%;height: 180px;" id="textarea_project_log"
                              class="textarea">{{$log->content}}</textarea>
                </div>
            </div>
        </form>
        <div class="row cl">
            <div class="col-sm-6 col-sm-offset-2">
                <button onclick="edit_customer_quote_log();"
                        class="btn btn-primary radius mt-20 ml-5">
                    保存
                </button>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">

        function edit_customer_quote_log() {
            //提交人, 内容
            var textarea_project_log_content = document.getElementById("textarea_project_log").value;

            if(textarea_project_log_content == ""){
                alert("不能为空");
                return ;
            }

            $.ajax({
                type: 'post', // 提交方式 get/post
                url: '/manager/edit_customer_log', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$log->id}}",
                    content: textarea_project_log_content,
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
                    layer.msg("编辑成功", {icon: 1, time: 2000});
                    parent.location.href = "customer_content?customer_id={{ $log->customer_id }}&from=customer_list&log_tab=1"
                }
                ,
                error: function (xhr, status, error) {
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
