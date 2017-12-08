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
            <span class="active">标签列表</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <a href="{{route('tagsAdd')}}" class="btn btn-outline btn-circle btn-sm green-haze">
                            <i class="fa fa-tags-plus"></i> 添加标签
                        </a>
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
                                <th class="hidden-xs"><i class="fa fa-smail-o"></i> 标签名</th>
                                <th class="hidden-xs"> URL</th>
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
                                    <td class="hidden-xs"> {{$vo->name}}</td>
                                    <td class="hidden-xs"> {{$vo->url}}</td>
                                    <td> {!! getStatus($vo->status) !!}</td>
                                    <td> {{$vo->created_at}}</td>
                                    <td>
                                        <a href="{{route('tagsEdit',['id' => $vo->id])}}" class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-edit"></i> Edit </a>
                                        {{--<a href="javascript:;" onclick='deleteAlert("{{route('tagsDel',['id' => $vo->id])}}")' class="btn btn-outline btn-circle dark btn-sm black delete">--}}
                                            {{--<i class="fa fa-trash-o"></i> Delete </a>--}}
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