    @extends('manager.master')

@section('content')
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mb-20 mt-20" style="visibility: hidden">
            <label class="form-label"
                   style="display: inline;">请选择进度：</label>
            <select name="stage_projectlog" class="select" id="select_stage_projectlog"
                    style="width: 160px;display: inline">
                <option value="沟通">沟通</option>
                <option value="见面/量房">见面/量房</option>
                <option value="平图">平图</option>
                <option value="合同">合同</option>
                <option value="设计图">设计图</option>
                <option value="打款">打款</option>
                <option value="开工">开工</option>
            </select>
        </div>

        <form action="" method="post" class="form form-horizontal" id="form-order-edit">
            {{--客户需求--}}
            <div class="row cl">
                <label class="form-label col-sm-1"><span class="c-red"></span>log:</label>
                <div class="formControls col-sm-6">
                    {{--<input id="input_log" type="textarea" cols="5" rows="3" class="text" style="width: 100%;height: 180px;word-break:break-all" value="">--}}

                    <textarea cols="5" rows="3" style="width: 100%;height: 180px;"
                              id="textarea_project_log" class="textarea"></textarea>

                </div>
            </div>
        </form>
        <div class="row cl">
            <div class="col-sm-6 col-sm-offset-1">
                <button onclick="save_project_log();"
                    class="btn btn-primary radius mt-20 ml-5">
                保存
            </button>
            </div>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        var stage_default = "{{$stage}}";
        $("#select_stage_projectlog option[value='" + stage_default + "']").attr("selected", true);

        function save_project_log() {
            //提交人, 内容
            var textarea_project_log_content = document.getElementById("textarea_project_log").value;

            if(textarea_project_log_content == ""){
                alert("不能为空");
                return ;
            }

            $.ajax({
                type: 'post', // 提交方式 get/post
                url: 'project_log_add', // 需要提交的 url
                dataType: 'json',
                data: {
                    stage: $("select[name=stage_projectlog] option:selected").val(),
                    project_id: "{{$id}}",
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

                    layer.msg("添加成功", {icon: 1, time: 2000});
                    var clicked = '';
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


                    parent.location.href = "project_stage?id={{ $id }}&" + clicked + "=1";
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
