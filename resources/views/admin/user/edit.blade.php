@extends('admin.layout.layout')

@section('content')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Form Layouts
                <small>form layouts</small>
            </h1>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">Form Stuff</span>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-line boxless tabbable-reversed">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-red-sunglo"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">Form Sample</span>
                                    <span class="caption-helper">form actions on top...</span>
                                </div>
                                <div class="actions">
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-cloud-upload"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                        <i class="icon-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action-url="{{route('userSave')}}" class="form-horizontal login-form">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            <span>请输入帐号名和密码. </span>
                                        </div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">用户名</label>
                                                <div class="col-md-4">
                                                    <input type="text" name="username" class="form-control input-circle"
                                                           placeholder="请输入用户名...">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">密码</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-lock"></i>
                                                        <input type="passpord" name="passpord" class="form-control input-circle"
                                                               placeholder="请输入密码..."></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">邮箱</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-envelope"></i>
                                                        <input type="email" name="email" class="form-control input-circle"
                                                               placeholder="请输入邮箱..."></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">手机号</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-phone"></i>
                                                        <input type="text" name="telephone" class="form-control input-circle"
                                                               placeholder="请输入手机号...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">性别</label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="sex" class="make-switch" checked data-on-text="<i class='fa fa-male'></i>" data-off-text="<i class='fa fa-female'></i>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">状态</label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="status" class="make-switch" checked data-on-text="启用" data-off-text="关闭">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-circle green">提交</button>
                                                    <button type="button" class="btn btn-circle grey-salsa btn-outline">
                                                        取消
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_footer')
<script src="/resources/admin/assets/pages/js/user.js" type="text/javascript"></script>
@endsection