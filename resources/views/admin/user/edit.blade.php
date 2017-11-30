@extends('admin.layout.layout')

@section('content')
    <div class="page-head">
        <div class="page-title">
            <h1>Blog后台管理系统
                <small>Every Thing Will Be Ok!</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{route('userList')}}">用户管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">编辑用户</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-line boxless tabbable-reversed">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-user font-red-sunglo"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">用户管理</span>
                                    {{--<span class="caption-helper">编辑用户 ...</span>--}}
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
                                <div class="portlet-body form">
                                    <form action-url="{{route('userSave')}}" id="user-add"
                                          class="form-horizontal user-add-form">
                                        @if(!empty($dataInfo->id))<input type="hidden" name="id"
                                                                     value="{{$dataInfo->id}}">@endif
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">用户名 <span
                                                            class="font-red-thunderbird">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-user"></i>
                                                        <input type="text" name="username"
                                                               class="form-control input-circle"
                                                               placeholder="请输入用户名..." @if(!empty($dataInfo->username))value="{{$dataInfo->username}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">密码 <span
                                                            class="font-red-thunderbird">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-lock"></i>
                                                        <input type="password" name="password"
                                                               class="form-control input-circle"
                                                               placeholder="请输入密码..."></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">邮箱</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-envelope"></i>
                                                        <input type="email" name="email"
                                                               class="form-control input-circle"
                                                               placeholder="请输入邮箱..." @if(!empty($dataInfo->email))value="{{$dataInfo->email}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">手机号</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-phone"></i>
                                                        <input type="text" name="telephone"
                                                               class="form-control input-circle"
                                                               placeholder="请输入手机号..." @if(!empty($dataInfo->telephone))value="{{$dataInfo->telephone}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">性别</label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="sex" class="make-switch"
                                                           @if(empty($dataInfo->sex) || 0 == $dataInfo->sex) checked @endif
                                                           data-on-text="<i class='fa fa-male'></i>"
                                                           data-off-text="<i class='fa fa-female'></i>" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">状态</label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="status" class="make-switch"
                                                           @if(empty($dataInfo->status) || 0 == $dataInfo->status) checked @endif
                                                           data-on-text="启用" data-off-text="关闭" value="1">
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