@extends('admin.layout.layout')

@section('page_header')
    <link href="/resources/admin/assets/pages/plugin/editor_md/editormd.css" rel="stylesheet">
    <link href="/resources/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <link href="/resources/admin/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="/resources/admin/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
@endsection

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
            <a href="{{route('tagsList')}}">标签管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">@if(!empty($dataInfo->id))编辑@else添加@endif标签</span>
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
                                    <i class="icon-tags font-red-sunglo"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">标签管理</span>
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
                                    <form action-url="{{route('tagsSave')}}" id="tags-add"
                                          class="form-horizontal form" enctype="multipart/form-data">
                                        @if(!empty($dataInfo->id))<input type="hidden" name="id"
                                                                         value="{{$dataInfo->id}}">@endif
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">标签名称 <span
                                                            class="font-red-thunderbird">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-smile-o"></i>
                                                        <input type="text" name="name"
                                                               class="form-control input-circle"
                                                               placeholder="请输入标签名称..."
                                                               @if(!empty($dataInfo->name))value="{{$dataInfo->name}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">标签地址 <span
                                                            class="font-red-thunderbird">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-smile-o"></i>
                                                        <input type="text" name="url"
                                                               class="form-control input-circle"
                                                               placeholder="标签访问地址..."
                                                               @if(!empty($dataInfo->url))value="{{$dataInfo->url}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">状态</label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" name="status" class="make-switch"
                                                           @if(empty($dataInfo->status) || 1 == $dataInfo->status) checked
                                                           @endif
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
    <script src="/resources/admin/assets/pages/js/tags.js" type="text/javascript"></script>
    <script type="text/javascript">
        // 请求中文转换英文接口
        $('input[name=name]').blur(function () {
            var title = $(this).val();
            if ('' !== title) {
                $.ajax({
                    type: "post",
                    url: "{{route('url2English')}}",
                    data: {'title': title},
                    dataType: "json",
                    success: function (j) {
                        if ('success' === j.status) {
                            $('input[name=url]').val(j.data.englishUrl);
                        }
                    }
                });
            }
        });
    </script>
@endsection