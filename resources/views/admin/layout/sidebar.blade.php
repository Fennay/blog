<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start active open">
                <a href="javascript:;" target="_blank" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start">
                        <a href="{{config('pro.web_home_url')}}" target="_blank" class="nav-link ">
                            <i class="icon-direction"></i>
                            <span class="title">查看站点</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Articles</h3>
            </li>
            <li class="nav-item">
                <a href="{{route('articleList')}}" class="nav-link nav-toggle">
                    <i class="icon-list"></i>
                    <span class="title">文章列表</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('tagsList')}}" class="nav-link nav-toggle">
                    <i class="icon-tag"></i>
                    <span class="title">标签列表</span>
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">User</h3>
            </li>
            <li class="nav-item">
                <a href="{{route('userList')}}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">用户列表</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('logout')}}" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">退出登录</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>