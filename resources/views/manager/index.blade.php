@extends('manager.master')

@section('content')
    <header class="Hui-header cl"><a class="Hui-logo l" title="in 工装" href="">您好!</a><span
                class="Hui-subtitle l">管理员</span>
        <ul class="Hui-userbar">
            <li></li>
            <li><a href="/exit" style="color:white;">退出</a></li>
        </ul>
        <a href="javascript:;" class="Hui-nav-toggle Hui-iconfont" aria-hidden="false">&#xe667;</a>
    </header>
    <aside class="Hui-aside">
        <input runat="server" id="divScrollValue" type="hidden" value=""/>
        <div class="menu_dropdown bk_2">
            <dl id="menu-product">
                <dt><i class="Hui-iconfont">&#xe637;</i> CRM<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="customer_list?reset=1" data-title="客户" href="javascript:void(0)">客户列表页</a></li>
                        <li><a _href="statistics_crm" data-title="统计信息" href="javascript:void(0)">统计信息</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-order">
                <dt><i class="Hui-iconfont">&#xe687;</i> Project<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="project_list" data-title="项目列表" href="javascript:void(0)">项目列表页</a></li>
                        <li><a _href="statistics_project" data-title="统计信息" href="javascript:void(0)">统计信息</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-order">
                <dt><i class="Hui-iconfont">&#xe687;</i> 帐号管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li><a _href="account_manage" data-title="帐号管理" href="javascript:void(0)">管理员工帐号</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
    <section class="Hui-article-box">
        <div id="Hui-tabNav" class="Hui-tabNav">
            <div class="Hui-tabNav-wp">
                <ul id="min_title_list" class="acrossTab cl">
                    <li class="active"><span title="我的桌面" data-href="/">我的桌面</span><em></em></li>
                </ul>
            </div>
            <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S"
                                                      href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a
                        id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i
                            class="Hui-iconfont">&#xe6d7;</i></a></div>
        </div>
        <div id="iframe_box" class="Hui-article">
            <div class="show_iframe">
                <div style="display:none" class="loading"></div>
                <iframe scrolling="yes" frameborder="0" src="/manager/welcome"></iframe>
            </div>
        </div>
    </section>
@endsection
@section('my-js')
    <script type="text/javascript">
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s)})();
        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
    </script>
@endsection
