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

        <!-- 多说评论框 start -->
        <div class="ds-thread" data-category="{{$articleInfo->tag_name}}" data-thread-key="{{$articleInfo->id}}"
             data-title="{{$articleInfo->title}}" data-author-key="{{$articleInfo->author}}"></div>
        <!-- 多说评论框 end -->
        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
            var duoshuoQuery = {short_name: "blog7856"};
            (function () {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';
                ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
        <!-- 多说公共JS代码 end -->
    </div>



@endsection