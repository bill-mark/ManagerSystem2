@extends('admin.master')

@section('content')
    {{ csrf_field() }}
    <style>
        .row.cl {
            margin: 20px 0;
        }
    </style>

    <header class="Hui-header cl" style="position: relative"><a class="Hui-logo l" title="Fenzotech后台"
                                                                href="/admin/index">预订信息</a>
        <a href="/admin/booking"
           class="btn btn-success radius"
           style="border-color:black;width: 168px;margin: 6.5px 0 0 0px;">查看所有预订</a>

        <ul class="Hui-userbar">
            <li><a href="/admin/index">回到主页</a></li>
            <li><a href="/admin/exit">退出</a></li>
        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>

    <table class="table table-border table-bordered table-striped">
        <thead>
        <tr>
            <th width="23%">序号</th>
            <th width="33%">预约电话</th>
            <th width="33%">提交时间</th>
            <th width="10%">选择框</th>
        </tr>
        </thead>
        <tbody>
        @foreach($Booking as $item)
            @if($item->status == 0)

                <tr>
                    <th class="index">{{$item->id}}</th>
                    <th>{{$item->phone_number}}</th>
                    <th>{{$item->created_at}}</th>
                    {{--<th>--}}
                    {{--未处理--}}
                    {{--<a href="javascript:;" onclick="toggle({{$item->id}})" class="btn btn-success radius"--}}
                    {{--style="width: 168px;margin: 14px 0 0 0px;">标记为已处理</a></th>--}}
                    <th><input type="checkbox" onclick="toggle({{$item->id}} , this);" name="toggle" class="toggle">已处理则请勾选
                    </th>
                </tr>

            @endif
        @endforeach
        </tbody>
    </table>

    <a href="javacript:;"
       onclick="batch();"
       class="btn btn-success radius"
       style="border-color:black;width: 168px;margin: 6.5px 0 0 0px;">将选择的预约全部修改为已处理</a>

@endsection
@section('my-js')
    <script>
        var list = [];

        Array.prototype.indexOf = function (val) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == val) return i;
            }

            return -1;
        };

        Array.prototype.remove = function (val) {
            var index = this.indexOf(val);
            if (index > -1) {
                this.splice(index, 1);
            }
        };
        function toggle(id, obj) {
            if (obj.checked) {
                list.push(id);
                console.log(list);
            } else {
                list.remove(id);
                console.log(list);
            }
        }


        function batch() {
            $.ajax({
                type: 'post',
                url: 'booking/allundoneBatch',
                dataType: 'json',
                data: {
                    list:list,
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {
                    if (data) {
                        layer.msg('批量修改成功!', {icon: 1, time: 2000});
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                    layer.msg('ajax error', {icon: 2, time: 2000});
                },
            });
        }
    </script>
@endsection