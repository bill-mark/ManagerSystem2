@extends('admin.master')

@section('content')
    <header style="position: relative" class="Hui-header cl"><a class="Hui-logo l" title="Fenzotech后台"
                                                                href="/admin/index">后台</a><span
                class="Hui-subtitle l"></span>
        <ul class="Hui-userbar">
            {{--<li>{{$Manager->username}}</li>--}}
            <li><a href="/admin/exit">退出</a></li>

        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>
    {{--<div class="menu_dropdown bk_2">--}}
    {{--<dl id="menu-product">--}}
    {{--<li><a href="/Manager/booking" href="javascript:void(0)">预约信息</a></li>--}}
    {{--</dl>--}}
    {{--</div>--}}

    {{----}}

    {{--<div class="menu_dropdown bk_2">--}}
    {{--<dl id="menu-product">--}}
    {{--<li><a href="/Manager/feedback" data-title="网站信息管理" href="javascript:void(0)">用户反馈</a></li>--}}
    {{--</dl>--}}
    {{--</div>--}}

    <div style="width: 300px;height: 80px; border-radius: 2px;background-color: black;color:white;margin: 50px auto 0 auto;">
        <a href="/admin/booking" href="javascript:void(0)" style="color:white;line-height: 80px;width: 100px;margin-left: 115px;font-size: 20px">预约信息</a>
    </div>
    <div style="width: 300px;height: 80px; border-radius: 2px;background-color: black;color:white;margin: 30px auto 0 auto;">
        <a href="/admin/feedback" href="javascript:void(0)" style="color:white;line-height: 80px;width: 100px;margin-left: 115px;font-size: 20px">用户反馈</a>
    </div>

@endsection
