@extends('manager.master')

@section('content')

    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mb-20">
                  <span class="l">
                    <a href="javascript:;" onclick="export_excel_customer_statistics();"
                       class="btn btn-primary radius">导出列表(Excel)</a>
                  </span>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-header">各个状态的用户数量统计</div>
            <div class="panel-body">
                {{--$status_counts--}}
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">状态</th>
                        <th width="20%">数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="">
                        <th>未联系</th>
                        <td>
                            {{$status_counts[0]}}
                        </td>
                    </tr>
                    <tr class="">
                        <th>沟通中</th>
                        <td> {{$status_counts[1]}}</td>
                    </tr>
                    <tr class="">
                        <th>拒绝</th>
                        <td>{{$status_counts[2]}}</td>
                    </tr>
                    <tr class="">
                        <th>跟进</th>
                        <td>{{$status_counts[3]}}</td>
                    </tr>
                    <tr class="">
                        <th>已转化</th>
                        <td>{{$status_counts[4]}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <div class="panel panel-default">
            <div class="panel-header">最近一周新增客户数量统计</div>
            <div class="panel-body">
                {{--$new_counts--}}
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">最近一周新增</th>
                        <th width="20%">{{$new_counts}}个</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-header">各个来源客户数量统计</div>
            <div class="panel-body">
                {{--$area_counts--}}
        
                <table class="table table-border table-bg">
                    <thead>
                    <tr>
                        <th width="">来源</th>
                        <th width="20%">数量</th>
                    </tr>
                    </thead>
        
                    <tbody>
                    @foreach($source_counts as $item)
        
                        <tr class="">
                            <th>{{$item[0]}}</th>
                            <td>
                                {{$item[1]}}
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

        function export_excel_customer_statistics() {
            location.href = "export_excel_customer_statistics";
        }
    </script>
@endsection
