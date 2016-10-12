@extends('manager.master')

@section('content')

    <div class="pd-20">
        <div class="mt-20" style="width: 100%;float: left">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="50" onclick="id_sort();">客户ID
                        <i
                                class="Hui-iconfont"
                                style="margin-left: 6px;">
                            &#xe675;</i>
                    </th>
                    <th width="50">客户名称</th>
                    <th width="60">客户公司</th>
                    <th width="50">联系方式</th>
                    <th width="80">介绍</th>
                    <th width="50">来源</th>
                    <th width="40">负责人</th>
                    <th width="40">状态</th>
                    <th width="40" onclick="time_sort();">添加时间<i class="Hui-iconfont" style="margin-left: 6px;">
                            &#xe675;</i></th>
                    <th width="40" onclick="priority_sort();">优先级<i class="Hui-iconfont" style="margin-left: 6px;">
                            &#xe675;</i></th>
                    <th width="90" onclick="">操作<i class="Hui-iconfont" style="margin-left: 6px;">&#xe675;</i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $item)
                    <tr class="text-c">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->company}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->source}}</td>
                        <td>{{$item->principal}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            @if(value($item->priority) === 1)
                                中
                            @elseif(value($item->priority) === 2)
                                高
                            @elseif(value($item->priority) === 0)
                                低
                            @endif
                        </td>
                        <td class="td-manage">
                            <a title="详情" href="javascript:;"
                               onclick="customer_content('客户详情','customer_content?customer_name={{$item->name}}')" class="ml-5"
                               style="text-decoration:none">客户详情</a>
                            <a title="编辑" href="javascript:;"
                               onclick="product_edit('编辑产品','/admin/product_edit?id={{$item->id}}')" class="ml-5"
                               style="text-decoration:none">删除</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        function customer_content(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['80%', '100%']
            });
        }
        function id_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=desc";
            }
        }
        function time_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=desc";
            }
        }

        function priority_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "http://192.168.99.100/manager/customer_list?col=id&sort=desc";
            }
        }


    </script>
@endsection
