@extends('admin.layout.layout')

@section('content')
    <div class="page-head">
        <div class="page-title">
            <h1>Blog后台管理系统
                <small> Every Thing Will Be Ok!</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">文章列表</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <a href="{{route('articleAdd')}}" class="btn btn-outline btn-circle btn-sm green-haze">
                            <i class="fa fa-article-plus"></i> 添加文章 </a>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"> </a>
                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-advance table-hover">
                            <thead>
                            <tr>
                                <th><i class="fa fa-briefcase"></i> 编号</th>
                                <th class="hidden-xs"><i class="fa fa-smail-o"></i> 文章名</th>
                                <th>副标题</th>
                                <th width="140">图片地址</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataList as $vo)
                                <tr>
                                    <td class="highlight">
                                        <div class="{{randColor()}}"></div>
                                        <a href="javascript:;"></a>{{$vo->id}}
                                    </td>
                                    <td class="hidden-xs"> {{$vo->title}}</td>
                                    <td>@if(empty($vo->subhead))-@else{{$vo->subhead}}@endif</td>
                                    <td>@if(!empty($vo->img_url))<img src="{{asset(env('RESOURCE_URL_PREFIX').$vo->img_url)}}" width="120" height="80" alt="111111111">@else - @endif</td>
                                    <td> {!! getStatus($vo->status) !!}</td>
                                    <td> {{$vo->created_at}}</td>
                                    <td>
                                        <a href="{{route('articleEdit',['id' => $vo->id])}}" class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-edit"></i> Edit </a>
                                        <a href="javascript:;" onclick='deleteAlert("{{route('articleDel',['id' => $vo->id])}}")' class="btn btn-outline btn-circle dark btn-sm black delete">
                                            <i class="fa fa-trash-o"></i> Delete </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $dataList->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_footer')

@endsection