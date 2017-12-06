@extends('admin.layout.layout')

@section('page_header')
    <link href="/resources/admin/assets/pages/plugin/editor_md/editormd.css" rel="stylesheet">
    <link href="/resources/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
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
            <a href="{{route('articleList')}}">文章管理</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">@if(!empty($dataInfo->id))编辑@else添加@endif文章</span>
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
                                    <i class="icon-article font-red-sunglo"></i>
                                    <span class="caption-subject font-red-sunglo bold uppercase">文章管理</span>
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
                                    <form action-url="{{route('articleSave')}}" id="article-add"
                                          class="form-horizontal article-add-form" enctype="multipart/form-data">
                                        @if(!empty($dataInfo->id))<input type="hidden" name="id"
                                                                         value="{{$dataInfo->id}}">@endif
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">文章名称 <span
                                                            class="font-red-thunderbird">*</span></label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-smile-o"></i>
                                                        <input type="text" name="title"
                                                               class="form-control input-circle"
                                                               placeholder="请输入文章名称..."
                                                               @if(!empty($dataInfo->title))value="{{$dataInfo->title}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">副标题</label>
                                                <div class="col-md-4">
                                                    <div class="input-icon">
                                                        <i class="fa fa-lock"></i>
                                                        <input type="text" name="subhead"
                                                               class="form-control input-circle"
                                                               placeholder="请输入副标题..."
                                                               @if(!empty($dataInfo->subhead))value="{{$dataInfo->subhead}}"@endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label col-md-3">缩略图</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail"
                                                             data-trigger="fileinput"
                                                             style="width: 200px; height: 150px;">
                                                            @if(!empty($dataInfo->img_url))
                                                                <img src="{{asset(env('RESOURCE_URL_PREFIX').$dataInfo->img_url)}}">
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> 选择 </span>
                                                                <span class="fileinput-exists"> 修改 </span>
                                                                <input type="file" id="uploadFile" name="file"> </span>
                                                            <a href="javascript:;" id="uploadDelete"
                                                               class="btn red fileinput-exists"
                                                               data-dismiss="fileinput"> 删除 </a>
                                                            <a href="javascript:;" id="uploadDo"
                                                               class="btn green fileinput-exists"
                                                               onclick="uploadImage('uploadFile','img_url')">
                                                                上传 </a>
                                                            @if(!empty($dataInfo->img_url))
                                                                <input type="hidden" id="img_url" name="img_url" value="{{$dataInfo->img_url}}">
                                                                @else
                                                                <input type="hidden" id="img_url" name="img_url" value="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">描述</label>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <textarea name="desc" class="form-control input-circle"
                                                                  cols="80"
                                                                  rows="10">@if(!empty($dataInfo->desc)){{$dataInfo->desc}}@endif</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">内容</label>
                                                <div class="col-md-12" id="editormd">
                                                    <textarea style="display: none" name="content">@if(!empty($dataInfo->content)){{$dataInfo->content->content}}@endif</textarea>
                                                    <input type="hidden" name="content_id" value=@if(!empty($dataInfo->content)){{$dataInfo->content->id}}@endif>
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
    <script src="/resources/admin/assets/pages/js/article.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/pages/plugin/editor_md/editormd.min.js" type="text/javascript"></script>
    <script src="/resources/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <script type="text/javascript">
        // markdown 编辑器
        var editor;
        $(function () {
            editor = editormd({
                id: "editormd",
                width: "70%",
                height: 540,
                path: "/resources/admin/assets/pages/plugin/editor_md/lib/",
                imageUpload: true,
                imageFormats: ["jpg", "jpeg", "gif", "png"],
                imageUploadURL: "{{route('upload')}}" + '?type=editor',
            });
        });
    </script>
@endsection