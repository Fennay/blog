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
                    <h3>{{substr($vo->created_at,0,10)}} [ &nbsp;@foreach($vo->tags as $item)<a
                    href="{{route('tag',['tags' => $item->name])}}">{{$item->name}}</a> &nbsp;@endforeach] <a href="{{route('articleDetail',['url'=>$vo->url])}}">{{$vo->title}}</a></h3>
                </div>
            @endforeach
        @endif
    </div>
@endsection
