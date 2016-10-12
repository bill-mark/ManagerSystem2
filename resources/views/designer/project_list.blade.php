@extends('master')

@section('content')
    <div class="pd-20">
        <div class="cl pd-5 bg-1 bk-gray">
  		<span class="l">
  		</span>
            {{--            <span class="r">共有数据：<strong>{{count($products)}}</strong> 条</span>--}}
            <div id="sort_mark" hidden>{{$sort}}</div>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="40" onclick="name_sort();">ID</th>
                    <th width="" onclick="company_sort();">项目名称</th>
                    <th width="" onclick="description_sort();">面积</th>
                    <th width="160" onclick="source_sort();">地址</th>
                    <th width="" onclick="principal_sort();">套餐类型</th>
                    <th width="" onclick="status_sort();">优先级</th>
                    <th width="" onclick="time_sort();">现报价</th>
                    <th width="" onclick="time_sort();">进度</th>
                    <th width="" onclick="priority_sort();">客户</th>
                    <th width="" onclick="priority_sort();">销售人员</th>
                    <th width="" onclick="priority_sort();">项目经理</th>
                    <th width="" onclick="priority_sort();">预期完成时间</th>
                    {{--<th width="" onclick="">操作</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $item)
                    <tr class="text-c">
                        <td>{{$item->id}}</td>
                        <td>
                            <a title="测试" href="javascript:;"
                               onclick="customer_content('查看详情','/manager/project_detail?id={{$item->id}}&from=designer')" class="ml-5"
                               style="text-decoration:none;color: #0a6999;">{{$item->name}}</a>
                        </td>
                        {{--<td>--}}
                        {{--@if(value($item->status) === 2)--}}
                        {{--完成--}}
                        {{--@elseif(value($item->status) === 1)--}}
                        {{--进行中--}}
                        {{--@elseif(value($item->status) === 0)--}}
                        {{--未开始--}}
                        {{--@endif--}}
                        {{--</td>--}}
                        <td>{{$item->area}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->meal_type}}</td>
                        <td>
                            @if(value($item->priority) === 1)
                                中
                            @elseif(value($item->priority) === 2)
                                高
                            @elseif(value($item->priority) === 0)
                                低
                            @endif
                        </td>
                        <td>{{$item->quote}}</td>
                        <td>{{$item->stage}}</td>
                        <td>
                            <div class="label label-primary radius">{{$item->customer_name}}</div>
                        </td>
                        <td>
                            <div class="label label-secondary radius">{{$item->saler_name}}</div>
                        </td>
                        <td>
                            <div class="label label-success radius">{{$item->pm_name}}</div>
                        </td>
                        <td>{{$item->completion_time}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">
        //动态指定 tag 的宽度
        //        var tag_content = $(".tag").innerHTML;
        //        var length = tag_content.length;
        //        $(".tag").style.width = 10 * length;

        $(".tag").each(function () {
            if (this.innerHTML == "") {
                this.style.backgroundColor = "white";
                this.style.height = "0px";
                this.style.width = "0px";
            } else {
                var length = this.innerHTML.length;
                this.style.width = length * 12 + "px";
            }
        });

        function project_add(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['100%', '100%']
            });
        }

        function customer_content(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['100%', '100%']
            });
        }

        //导出项目表格
        function export_excel_all_projects() {
            location.href = "export_excel_all_projects";
        }
    </script>
@endsection
