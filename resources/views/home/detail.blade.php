@extends('home.layout.layout')

@section('seo')
    <title>{{$articleInfo->title}} | 笠缪 - Every Thing Will Be Fine</title>
    <meta name="keywords" content="{{$articleInfo->seo_keywords}}">
    <meta name="description" content="{{$articleInfo->seo_desc}}">
@endsection

@section('main')

    <div class="col-sm-9">
        <h1>{{$articleInfo->title}}</h1>
        <div class="article" id="content">
            {!! $articleInfo->content !!}
        </div>
    </div>
@endsection