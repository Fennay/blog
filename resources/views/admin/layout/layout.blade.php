<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8"/>
	<title>Blog 后台管理系统 | Every Thing Will Be Ok ! | 麦奇网络</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #4 for statistics, charts, recent events and reports"
		  name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
		  type="text/css"/>
	<link href="/resources/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
		  type="text/css"/>
	<link href="/resources/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
		  type="text/css"/>
	<link href="/resources/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
		  type="text/css"/>
	<link href="/resources/admin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
		  type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="/resources/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet"
		  type="text/css"/>
@yield('page_header')
<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="/resources/admin/assets/global/css/components.min.css" rel="stylesheet" id="style_components"
		  type="text/css"/>
	<link href="/resources/admin/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->
	<link href="/resources/admin/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css"/>
	<link href="/resources/admin/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css"
		  id="style_color"/>
	<link href="/resources/admin/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner ">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="/">
				<img src="/resources/admin/assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
		   data-target=".navbar-collapse"> </a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN HEADER SEARCH BOX -->
			<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
			<form class="search-form" action="page_general_search_2.html" method="GET">
				<div class="input-group">
					<input type="text" class="form-control input-sm" placeholder="Search..." name="query">
					<span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
				</div>
			</form>
			<!-- END HEADER SEARCH BOX -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide"></li>
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
					<!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
					<li class="dropdown dropdown-extended dropdown-notification dropdown-dark"
						id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
						   data-close-others="true">
							<i class="icon-user"></i>
							<span class="badge badge-success"> {{session('username')}} </span>
						</a>
					</li>
					<li class="separator hide"></li>
					<li class="dropdown">
						<a href="{{route('logout')}}" style="display: block;width: 44px;height: 74px;" class="dropdown-toggle">
							<i class="icon-logout"></i>
						</a>
					</li>
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
@include('admin.layout.sidebar')
<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<!-- BEGIN CONTENT BODY -->
		<div class="page-content">

			{{--内容--}}
			@yield('content')
		</div>
		<!-- END CONTENT BODY -->
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner"> 2016 &copy; Metronic Theme By
		<a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
		<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
		   title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase
			Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN QUICK NAV -->
<!-- 提示弹框 -->
<div class="modal fade bs-modal-sm info" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">提示语</h4>
			</div>
			<div class="modal-body"><i class="glyphicon glyphicon-ok"></i>这里是提示信息</div>
			<div class="modal-footer">
				<button type="button" class="btn dark btn-outline" data-dismiss="modal">关闭</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- 确认弹框 -->
<div class="modal fade bs-modal-sm confirm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">你确定吗？</h4>
			</div>
			<div class="modal-body"><i class="glyphicon glyphicon-exclamation-sign"></i> 确认吗？</div>
			<div class="modal-footer">
				<button type="button" class="btn dark btn-outline" data-dismiss="modal">关闭</button>
				<button type="button" class="btn dark btn-outline confirm-sure" data-dismiss="modal">确定</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="/resources/admin/assets/global/plugins/respond.min.js"></script>
<script src="/resources/admin/assets/global/plugins/excanvas.min.js"></script>
<script src="/resources/admin/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/resources/admin/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
		type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
		type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/resources/admin/assets/global/plugins/jquery-validation/js/jquery.validate.js"
		type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/jquery-validation/js/localization/messages_zh.js"
		type="text/javascript"></script>
<script src="/resources/admin/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"
		type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/resources/admin/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('page_footer')
<script src="/resources/admin/assets/pages/js/common.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/resources/admin/assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/resources/admin/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>