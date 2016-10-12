@extends('manager.master')

@section('content')

    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-order-edit">
            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
            {{--客户需求--}}
            <div class="row cl">
                <label class="form-label col-sm-2"><span class="c-red"></span>log:</label>
                <div class="formControls col-sm-8">
                    <textarea cols="5" rows="3" class="textarea"
                              id="textarea_customer_log" placeholder="记录日志..."></textarea>
                </div>
            </div>
        </form>
            <div class="row cl">
                <div class="col-sm-6 col-sm-offset-2">
                    <button onclick="save_customer_log();" class="btn btn-primary radius mt-20 ml-5">保存</button>
                </div>
            </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        function save_customer_log() {
            //提交人, 内容
            var textarea_customer_log_content = document.getElementById("textarea_customer_log").value;

            if(textarea_customer_log_content == ""){
                alert("不能为空");
                return ;
            }

            $.ajax({
                type: 'post', // 提交方式 get/post
                url: '/manager/customer_log_add', // 需要提交的 url
                dataType: 'json',
                data: {
                    id:"{{$id}}",
                    content: textarea_customer_log_content,
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
                    // var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.location.reload(true);
                    // parent.document.onload = function() {
                    //     var $logElement = parent.$('#tabbar_content').children().last();
                    //     $logElement.prop('class', 'clicked_span').end().not($logElement).prop('class', 'normal_span');
                    // }
                    
                    // parent.layer.close(index);
                },
                error: function (xhr, status, error) {
                    layer.msg('ajax error', {icon: 2, time: 5000});
                },
                beforeSend: function (xhr) {
                    layer.load(0, {shade: false});
                }
            });


        }

    </script>
@endsection
