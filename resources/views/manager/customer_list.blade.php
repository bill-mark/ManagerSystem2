@extends('master')

@section('content')
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray mb-20">
            {{--<span class="l">--}}
            <a href="javascript:;" onclick="customer_add('添加客户','/manager/customer_add')" class="btn btn-success radius"><i
                        class="Hui-iconfont">&#xe600;</i> 添加客户</a>
            <a href="javascript:;" onclick="export_excel_all_customers()"
               class="btn btn-primary radius">导出列表(Excel)</a>
            <div style="margin-left: 300px;margin-top: -28px">

                <div class="display: inline" style="float: left">
                    <label for="select_customer_filter" style="margin-left: 23px">筛选条:</label>
                    <select name="" onchange="filter_change(this);" id="select_customer_filter" class="select"
                            style="width: 60%;margin-left: 15px;margin-top: -23px;float: left;margin-left: 100px;">
                        <option value="name" @if ($filter_name === 'name') selected="selected" @endif>客户名称</option>
                        <option value="status" @if ($filter_name === 'status') selected="selected" @endif>状态</option>
                        <option value="principal" @if ($filter_name === 'principal') selected="selected" @endif>负责人</option>
                        <option value="source" @if ($filter_name === 'source') selected="selected" @endif>来源</option>
                        <option value="priority" @if ($filter_name === 'priority') selected="selected" @endif>优先级</option>
                    </select>
                </div>

                {{--//优先级--}}
                <div id="value_priority" class=""
                     style="height: 30px;display: inline;float: left; @if (isset($filter_name) && $filter_name === 'priority') display: block; @else display:none; @endif">
                    {{--<label for="" style="margin-left: 50px">值:</label>--}}
                    <select name="" id="value_priority_select" class="select" style="width: 160px;margin-left: 15px">
                        <option value="2" @if ($query_value == '2') selected="selected" @endif>高</option>
                        <option value="1" @if ($query_value == '1') selected="selected" @endif>中</option>
                        <option value="0" @if ($query_value == '0') selected="selected" @endif>低</option>
                    </select>
                </div>
                {{--//状态--}}
                <div id="value_status" class=""
                     style="height: 30px;display: inline;float: left;@if (isset($filter_name) && $filter_name === 'status') display: block; @else display:none; @endif">
                    {{--<label for="" style="margin-left: 50px">值:</label>--}}
                    <select name="" id="value_status_select" class="select" style="width: 160px;margin-left: 15px">
                        <option value="未联系" @if ($query_value == '未联系') selected="selected" @endif>未联系</option>
                        <option value="沟通中" @if ($query_value == '沟通中') selected="selected" @endif>沟通中</option>
                        <option value="拒绝" @if ($query_value == '拒绝') selected="selected" @endif>拒绝</option>
                        <option value="跟进" @if ($query_value == '跟进') selected="selected" @endif>跟进</option>
                        <option value="已转化" @if ($query_value == '已转化') selected="selected" @endif>已转化</option>
                    </select>
                </div>
                {{--负责人--}}
                <div id="value_principal" class=""
                     style="height: 30px;display: inline;float: left;@if (isset($filter_name) && $filter_name === 'principal') display: block; @else display:none; @endif">
                    {{--<label for="" style="margin-left: 50px">值:</label>--}}
                    <select name="" id="value_principal_select" class="select" style="width: 160px;margin-left: 15px">
                        @foreach($salers as $item)
                            <option value="{{$item->username}}" @if ($query_value == $item->username) selected="selected" @endif>
                                {{$item->username}}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{--来源--}}
                <div id="value_source" class=""
                     style="height: 30px;display: inline;float: left;@if (isset($filter_name) && $filter_name === 'source') display: block; @else display:none; @endif">
                    <select name="" id="value_source_select" class="select" style="width: 160px;margin-left: 15px">
                        @foreach($source_counts as $item)
                            @if(value($item[0]) == "")
                                <option value="{{$item[0]}}" @if ($query_value == $item[0]) selected="selected" @endif>空</option>
                            @else
                                <option value="{{$item[0]}}" @if ($query_value == $item[0]) selected="selected" @endif>{{$item[0]}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{--输入文本--}}
                <div id="value_text" class="" style="height: 30px;display: inline;float: left;@if (isset($filter_name) && $filter_name !== 'name') display: none; @endif">
                    {{--<label for="" style="margin-left: 50px">值:</label>--}}
                    <input type="text" class="input input-text" style="width: 160px;margin-left: 15px" value="{{ $filter_name == 'name' && $query_value ? $query_value : '' }}"
                           id="value_text_input">
                </div>

                <a href="javascript:;" onclick="query_customer('query')" class="btn btn-success" id='start_query'
                   style="margin-left: 10px">查询</a>
                <a href="javascript:;" class="btn" id='reset_query'
                   style="margin-left: 10px">重置</a>

                {{--<a href="/manager/index" class="btn btn-success"--}}
                   {{--style="margin-left: 10px">清空</a>--}}

            </div>
            {{--</span>--}}
            <div id="sort_mark" hidden>{{$sort}}</div>
        </div>

        <table class="table table-border table-bordered table-hover table-bg table-sort">
            <thead>
            <tr class="text-c">
                <th width="40" onclick="id_sort();">ID
                    <i
                            class="Hui-iconfont"
                            style="margin-left: 6px;cursor: pointer">
                        &#xe675;</i>
                </th>
                <th width="">客户名称</th>
                <th width="">客户公司</th>
                <th width="">联系方式</th>
                <th width="200">介绍</th>
                <th width="">来源</th>
                {{--//这里要使用 tag--}}
                <th width="">负责人</th>
                <th width="">状态</th>
                <th width="90" onclick="time_sort();">添加时间<i class="Hui-iconfont"
                                                             style="margin-left: 6px;cursor: pointer">
                        &#xe675;</i></th>
                <th width="80" onclick="priority_sort();">优先级<i class="Hui-iconfont"
                                                                style="margin-left: 6px;cursor: pointer">
                        &#xe675;</i></th>
                {{--<th width="" onclick="">操作</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $item)
                <tr class="text-c">
                    <td>{{$item->id}}</td>
                    <td width="">
                        <a title="详情" href="javascript:;"
                           onclick="customer_content('客户详情','customer_content?customer_name={{$item->name}}&from=customer_list')"
                           class="ml-5"
                           style="text-decoration:none;color: #5A98DE">{{$item->name}}</a>
                    </td>
                    <td>{{$item->company}}</td>
                    <td>{{$item->phone}}</td>
                    <td style="white-space: pre-wrap;text-align: left">{{$item->description}}</td>
                    <td>
                        <div class="label label-primary radius">{{$item->source}}</div>
                    </td>
                    <td>
                        <div class="label label-secondary radius">{{$item->principal}}</div>
                    </td>
                    <td><span class="label label-success radius">{{$item->status}}</span></td>
                    <td class="td_created_at">
                        {{$item->created_at}}
                    </td>
                    <td>
                        @if(value($item->priority) === 1)
                            中
                        @elseif(value($item->priority) === 2)
                            高
                        @elseif(value($item->priority) === 0)
                            低
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('my-js')
    <script type="text/javascript">

        var td_created_ats = document.getElementsByClassName('td_created_at');
        for (var i = 0; i < td_created_ats.length; i++) {
            var old_value = td_created_ats[i].innerHTML.toString();

            var new_val = old_value.substring(25, 35);

            var arr = old_value.match(/./g);
            td_created_ats[i].innerHTML = new_val;
        }

        $(".tag").each(function () {
            if (this.innerHTML == "") {
                this.style.backgroundColor = "white";
                this.style.height = "0px";
                this.style.width = "0px";
            } else {
                var length = this.innerHTML.length;
                this.style.width = length * 15 + "px";
            }
        });

        var filter_name = "name";

        function query_customer() {

            var value_priority_final = $('#value_priority_select option:selected').val();

            var value_status_final = $('#value_status_select option:selected').val();

            var value_principal_final = $("#value_principal_select option:selected").val();

            var value_source_final = $("#value_source_select option:selected").val();

            var value_text_final = $('#value_text_input').val();

            var value = "";

            if (filter_name == "priority") {
                value = value_priority_final;
            } else if (filter_name == "status") {
                value = value_status_final
            } else if (filter_name == "principal") {
                value = value_principal_final;
            } else if(filter_name == "source"){
                value = value_source_final;
            } else if (filter_name == 'name') {
                value = value_text_final;
            }
            location.href = "customer_list?filter_name=" + filter_name + "&value=" + value + "";
        }

        //导出客户列表
        function export_excel_all_customers() {
            location.href = "customer_list?export=true";
        }

        function filter_change(obj) {

            var value_priority = document.getElementById("value_priority");
            var value_text = document.getElementById("value_text");
            var value_status = document.getElementById("value_status");
            var value_principal = document.getElementById("value_principal");
            var value_source = document.getElementById("value_source");

            filter_name = obj.value;

            switch (filter_name) {
                case "priority":
                    value_priority.style.display = "block";
                    value_text.style.display = "none";
                    value_status.style.display = "none";
                    value_principal.style.display = "none";
                    value_source.style.display = "none";
                    break;
                case "status":
                    value_priority.style.display = "none";
                    value_text.style.display = "none";
                    value_status.style.display = "block";
                    value_principal.style.display = "none";
                    value_source.style.display = "none";
                    break;
                case "name":
                    value_priority.style.display = "none";
                    value_text.style.display = "block";
                    value_status.style.display = "none";
                    value_principal.style.display = "none";
                    value_source.style.display = "none";
                    break;
                case "principal":
                    value_priority.style.display = "none";
                    value_text.style.display = "none";
                    value_principal.style.display = "block";
                    value_status.style.display = "none";
                    value_source.style.display = "none";
                    break;
                case "source":
                    value_priority.style.display = "none";
                    value_text.style.display = "none";
                    value_status.style.display = "none";
                    value_principal.style.display = "none";
                    value_source.style.display = "block";
                    break;
            }
        }

        function customer_content(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['100%', '100%']
            });

//            layer.full(index);
        }

        function customer_add(title, url) {
            var index = layer.open({
                type: 2,
                title: title,
                content: url,
                area: ['100%', '100%']
            });
        }

        function id_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "customer_list?col=id&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "customer_list?col=id&sort=desc";
            }
        }


        function time_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "customer_list?col=created_time&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "customer_list?col=created_time&sort=desc";
            }
        }

        function priority_sort() {
            var sort_mark = document.getElementById("sort_mark").innerHTML;
            if (sort_mark == "desc") {
                location.href = "customer_list?col=priority&sort=asc";
            } else if (sort_mark == "asc" || sort_mark == "") {
                location.href = "customer_list?col=priority&sort=desc";
            }
        }

        $(document).ready(function() {
            $("body").keydown(function() {
             if (event.keyCode == "13") {//keyCode=13是回车键
                     $('#start_query').trigger('click');
                 }
             });
            $('#reset_query').click(function() {
                window.location.href = 'customer_list?reset=1' ;
            })

        })


    </script>
@endsection
