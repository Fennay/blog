@extends('home.layout.layout')

@section('seo')
    <title>{{$articleInfo->title}} | 笠缪 - Every Thing Will Be Fine</title>
    <meta name="keywords" content="{{$articleInfo->title}}">
    <meta name="description" content="{{$articleInfo->title}}">
    <script type="text/javascript" src="/resources/home/js/showdown.js"></script>
@endsection

@section('main')

    <div class="col-sm-9 ">
        <h1>{{$articleInfo->title}}</h1>
        <div class="" id="content">
            {!! $articleInfo->content->content !!}
        </div>
    </div>
@endsection
