@extends('admin.layout.layout')

@section('content')
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Admin Dashboard 2
                <small>statistics, charts, recent events and reports</small>
            </h1>
        </div>
        <!-- END PAGE TITLE -->
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span class="active">用户列表</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <a href="{{route('userAdd')}}" class="btn btn-outline btn-circle btn-sm green-haze">
                            <i class="fa fa-user-plus"></i> 添加用户 </a>
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
                                <th>
                                    <i class="fa fa-briefcase"></i> 编号
                                </th>
                                <th class="hidden-xs">
                                    <i class="fa fa-user"></i> 用户名
                                </th>
                                <th>
                                    <i class="fa fa-envelope"></i> 邮箱
                                </th>
                                <th>
                                    <i class="fa fa-shopping-cart"></i> 状态
                                </th>
                                <th>
                                    <i class="fa fa-shopping-calendar"></i> 创建时间
                                </th>
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
                                    <td class="hidden-xs"> {{$vo->username}}</td>
                                    <td> @if(empty($vo->email))-@else{{$vo->email}}@endif</td>
                                    <td> {!! getStatus($vo->status) !!}</td>
                                    <td> {{$vo->created_at}}</td>
                                    <td>
                                        <a href="{{route('userEdit',['id' => $vo->id])}}" class="btn btn-outline btn-circle btn-sm purple">
                                            <i class="fa fa-edit"></i> Edit </a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black">
                                            <i class="fa fa-trash-o"></i> Delete </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END SAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection