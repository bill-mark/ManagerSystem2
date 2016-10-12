@extends('admin.master')

@section('content')

    <style>
        .row.cl {
            margin: 20px 0;
        }
    </style>

    <header class="Hui-header cl" style="position: relative"><a class="Hui-logo l" title="Fenzotech后台"
                                                                href="/admin/index">预订信息</a><span
                class="Hui-subtitle l"></span>
        <ul class="Hui-userbar">
            <li><a href="/admin/index">回到主页</a></li>
            <li><a href="/admin/exit">退出</a></li>
        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>

    <table class="table table-border table-bordered table-striped">
        <thead>
        <tr>
            <th width="10%">序号</th>
            <th width="13%">反馈人</th>
            <th width="13%">反馈人联系方式</th>
            <th width="20%">时间</th>
            <th width="43%">反馈信息</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Feedback as $item)
            <tr>
                <th>{{$item->id}}</th>
                <th>{{$item->contact_name}}</th>
                <th>{{$item->contact_number}}</th>
                <th>{{$item->created_at}}</th>
                <th>{{$item->contact_content}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('my-js')
    <script>
        function toggle(id) {
            $.ajax({
                type: 'get',
                url: '/Manager/booking/toggle/' + id,
                success: function (data) {
                    if (data) {
                        layer.msg('修改状态成功!', {icon: 1, time: 2000});
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
//                beforeSend: function (xhr) {
//                    layer.load(0, {shade: false});
//                }
            });
        }
    </script>
@endsection