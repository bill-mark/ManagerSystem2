@extends('admin.master')

@section('content')

    <style>
        .row.cl {
            margin: 20px 0;
        }
    </style>

    <header class="Hui-header cl" style="position: relative"><a class="Hui-logo l" title="Fenzotech后台"
                                                                href="/admin/index">预订信息</a>
        <a href="/admin/booking_allundone"
           class="btn btn-success radius"
           style="border-color:black;width: 168px;margin: 6.5px 0 0 0px;">查看所有未处理</a>

        <ul class="Hui-userbar">
            <li><a href="/admin/index">回到主页</a></li>
            <li><a href="/admin/exit">退出</a></li>
        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>

    <table class="table table-border table-bordered table-striped">
        <thead>
        <tr>
            <th width="20%">序号</th>
            <th width="30%">预约电话</th>
            <th width="30%">提交时间</th>
            <th width="20%">状态</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Booking as $item)
            <tr>
                <th>{{$item->id}}</th>
                <th>{{$item->phone_number}}</th>
                <th>{{$item->created_at}}</th>
                <th>
                    @if($item->status == 0)

                        未处理
                        <a href="javascript:;" onclick="toggle({{$item->id}})" class="btn btn-success radius"
                           style="width: 168px;margin: 14px 0 0 0px;">标记为已处理</a></th>


                @else
                    已处理
                    <a href="javascript:;" onclick="toggle({{$item->id}})"
                       class="btn btn-success radius"
                       style="border-color:black;width: 168px;margin: 14px 0 0 0px;background-color: #0b0b0b">标记为未处理</a></th>

                @endif
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