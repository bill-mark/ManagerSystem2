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
                <button onclick="edit_project_quote_log();"
                        class="btn btn-primary radius mt-20 ml-5">
                    保存
                </button>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">

        function edit_project_quote_log() {
            //提交人, 内容
            var textarea_project_log_content = document.getElementById("textarea_project_log").value;

            if(textarea_project_log_content == ""){
                alert("不能为空");
                return ;
            }

            $.ajax({
                type: 'post', // 提交方式 get/post
                url: '/manager/edit_project_log', // 需要提交的 url
                dataType: 'json',
                data: {
                    id: "{{$log->id}}",
                    stage: "{{$log->stage}}",
                    project_id: "{{$log->project_id}}",
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
                    var clicked = '';
                    var stage_default = "{{$log->stage}}";
                    switch (stage_default) {
                      case '沟通':
                        clicked = 'info_tab';
                        break;
                      case '见面/量房':
                        clicked = 'project_tab';
                        break;
                      case '平图':
                        clicked = 'log_tab';
                        break;
                      case '合同':
                        clicked = 'contract_tab';
                        break;
                      case '设计图':
                        clicked = 'designPic_tab';
                        break;
                      case '打款':
                        clicked = 'money_tab';
                        break;
                      case '开工':
                        clicked = 'begin_tab';
                        break;
                    }
                    parent.location.href = parent.location.href+'&'+clicked+"=1"
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
