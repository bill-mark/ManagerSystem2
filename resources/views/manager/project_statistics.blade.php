@extends('manager.master')

@section('content')

    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray">
                  <span class="l">
                    <a href="javascript:;" onclick="export_excel_projects_statistics();"
                       class="btn btn-primary radius">导出列表(Excel)</a>
                  </span>
        </div>
        <div class="panel panel-default" style="margin-top: 20px">
            <div class="panel-header">各个阶段的项目数量统计</div>
            <div class="panel-body">
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">阶段</th>
                        <th width="20%">数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="">
                        <th>沟通</th>
                        <td>
                            {{$counts[0]}}
                        </td>
                    </tr>
                    <tr class="">
                        <th>见面/量房</th>
                        <td> {{$counts[1]}}</td>
                    </tr>
                    <tr class="">
                        <th>平图</th>
                        <td>{{$counts[2]}}</td>
                    </tr>
                    <tr class="">
                        <th>合同</th>
                        <td>{{$counts[3]}}</td>
                    </tr>
                    <tr class="">
                        <th>设计图</th>
                        <td>{{$counts[4]}}</td>
                    </tr>
                    <tr class="">
                        <th>打款</th>
                        <td>{{$counts[5]}}</td>
                    </tr>
                    <tr class="">
                        <th>开工</th>
                        <td>{{$counts[6]}}</td>
                    </tr>
                    </tbody>
                </table>
        
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-header">各面积项目数量统计</div>
            <div class="panel-body">
                {{--$area_counts--}}
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">面积(平米)</th>
                        <th width="20%">数量</th>
                    </tr>
                    </thead>
        
                    <tbody>
                    <tr class="">
                        <th>0-500</th>
                        <td>
                            {{$area_counts[2]}}
                        </td>
                    </tr>
                    <tr class="">
                        <th>501-1000</th>
                        <td> {{$area_counts[1]}}</td>
                    </tr>
                    <tr class="">
                        <th>大于1001</th>
                        <td>{{$area_counts[0]}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-header">各套餐项目数量统计</div>
            <div class="panel-body">
                {{--$mealtype_counts--}}
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">套餐</th>
                        <th width="20%">数量</th>
                    </tr>
                    </thead>
        
                    <tbody>
                    <tr class="">
                        <th>标准</th>
                        <td>
                            {{$mealtype_counts[0]}}
                        </td>
                    </tr>
                    <tr class="">
                        <th>非标准</th>
                        <td> {{$mealtype_counts[1]}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-header">总报价</div>
            <div class="panel-body">
                {{--$mealtype_counts--}}
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">报价总和</th>
                        <th width="20%">{{$quoteSum}}</th>
                    </tr>
                    </thead>
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
                area: ['80%', '80%'],
            });
        }

        //转到添加帐号界面
        function addAccount() {
            var index = layer.open({
                type: 2,
                title: "添加帐号",
                content: "account_add",
                area: ['80%', '80%']
            });

        }

        function export_excel_projects_statistics() {
            location.href = "export_excel_projects_statistics";
        }
    </script>
@endsection
