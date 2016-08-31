<!-- 侧边栏开始 -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- 侧边菜单开始 -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-search-wrapper hidden-xs">
                <!-- 快速搜索开始 -->
                <form class="sidebar-search sidebar-search-bordered sidebar-search-solid" action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- 快速搜索结束 -->
            </li>
            <li class="start {{ active_class(if_route_pattern('admin.dashboard')) }} ">
                <a href="{{ route('admin.dashboard') }}">
                <i class="icon-home"></i>
                <span class="title">首页</span>
                <span class="selected"></span>
                </a>
            </li>
            <li>
                <a href="/admin/service">
                <i class="icon-basket"></i>
                <span class="title">服务管理</span>
                </a>
            </li>
            <li>
                <a href="/admin/certify">
                <i class="icon-user-following"></i>
                <span class="title">认证管理</span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                <i class="icon-people"></i>
                <span class="title">用户管理</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="#">所有用户</a>
                    </li>
                    <li>
                        <a href="#">自由人申请</a>
                    </li>
                    <li>
                        <a href="#">服务申请</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern('admin.access*')) }}">
                <a href="javascript:;">
                <i class="icon-shield"></i>
                <span class="title">管理员管理</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route('admin.access.user.index')) }}">
                        <a href="{{ route('admin.access.user.index') }}">管理员</a>
                    </li>
                    <li class="{{ active_class(if_route('admin.access.role.index')) }}">
                        <a href="{{ route('admin.access.role.index') }}">角色管理</a>
                    </li>
                    <li class="{{ active_class(if_route('admin.access.permission.index')) }}">
                        <a href="{{ route('admin.access.permission.index') }}">权限管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/admin/order">
                <i class="icon-basket"></i>
                <span class="title">订单列表</span>
                </a>
            </li>
            <li>
                <a href="/admin/withdraw">
                <i class="icon-credit-card"></i>
                <span class="title">提现列表</span>
                </a>
            </li>
            <li>
                <a href="/admin/message">
                <i class="icon-envelope-open"></i>
                <span class="title">消息推送</span>
                </a>
            </li>
            <li>
                <a href="/admin/feedback">
                <i class="icon-note"></i>
                <span class="title">意见反馈</span>
                </a>
            </li>
            <li>
                <a href="/admin/report">
                <i class="icon-dislike"></i>
                <span class="title">投诉举报</span>
                </a>
            </li>
            <li class="last">
                <a href="javascript:;">
                <i class="icon-settings"></i>
                <span class="title">系统管理</span>
                <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="/admin/log/all">操作日志</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- 侧边菜单结束 -->
    </div>
</div>
<!-- 侧边栏结束 -->