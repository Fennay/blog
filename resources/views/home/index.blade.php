@extends('home.layout.layout')

@section('seo')
<title>笠缪 - Every Thing Will Be Fine</title>
<meta name="keywords" content="">
<meta name="description" content="">
@endsection

@section('page_css')
<link rel="stylesheet" href="/resources/home/css/index.css">
@endsection

@section('main')
    <div class="col-sm-9">
        @if(!empty($articleList))
            @foreach($articleList as $k=> $vo)
                <div class="article">
                    <h3><a href="{{route('articleDetail',['url'=>$vo->url])}}">{{$vo->title}}</a></h3>
                    <ul>
                        <li>标签： @foreach($vo->tags as $item)<a
                                    href="{{route('tag',['tags' => $item->name])}}">{{$item->name}}</a> &nbsp;@endforeach
                        </li>
                        <li>发布时间： {{$vo->created_at}}</li>
                        <li>点击数: {{$vo->clicks}}</li>
                    </ul>
                    <div class="clearfix"></div>
                    <div>
                        {{$vo->desc}}
                    </div>
                    <span class="detail"><a href="{{route('articleDetail',['url'=>$vo->url])}}">详情</a></span>
                </div>
            @endforeach
        @endif
    </div>
@endsection
