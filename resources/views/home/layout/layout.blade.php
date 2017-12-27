<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    @yield('seo')

            <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="/resources/home/css/index.css">
    <!-- markdown样式 -->
    <link rel="stylesheet" href="/resources/home/css/github-markdown.css" type="text/css" />

    <!-- 代码高亮插件 -->
    <script type="text/javascript" src="/resources/plugins/syntaxHighlighter/scripts/shCore.js"></script>
    <script type="text/javascript" src="/resources/plugins/syntaxHighlighter/scripts/shBrushBash.js"></script>
    <script type="text/javascript" src="/resources/plugins/syntaxHighlighter/scripts/shBrushPhp.js"></script>
    <link type="text/css" rel="stylesheet" href="/resources/plugins/syntaxHighlighter/styles/shCoreDefault.css"/>

    {{--语法高亮插件--}}
    <script type="text/javascript">
        SyntaxHighlighter.all();
    </script>

    {{--顶部进度条插件--}}
    <link href='/resources/plugins/nprogress/css/nprogress.css' rel='stylesheet'/>

    {{--日历插件--}}
    <link href='/resources/plugins/calendar/css/calendar.css' rel='stylesheet'/>

    <link rel="shortcut icon" href="/ico.png"/>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="nav border">
            <ul>
                <li><a href="/">首页</a></li>
                {{--<li><a href="">人生</a></li>--}}
                {{--<li><a href="">百味</a></li>--}}
                {{--<li><a href="/about">关于</a></li>--}}
            </ul>
        </div>
    </div>
    <div class="row">
        @include('home.layout.sidebar')

        @yield('main')
    </div>

    <diw class="row">
        <div class="copy-right text-center">
            Design By Feng © 2016
        </div>
    </diw>
</div>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

{{--日历插件--}}
<script src='/resources/plugins/calendar/js/calendar.js'></script>
<script>

    $('#ca').calendar({
        width: 240,
        height: 240,
        data:{!! $calendarData !!}
    });
</script>

<script src='/resources/plugins/nprogress/js/nprogress.js'></script>
<script>
    NProgress.start();
    setTimeout(function () {
        NProgress.done();
        $('.fade').removeClass('out');
    }, 1000);
</script>

<script type="text/javascript" src="/resources/home/js/tag_cloud.js"></script>

@yield('page_js')
<script>
    var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?9b44ce4223cb9bdb81f8ba648f11db4e";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
<script type="text/javascript" color="128,128,128" opacity='0.7' zIndex="-1" count="150"
        src="//cdn.bootcss.com/canvas-nest.js/1.0.0/canvas-nest.min.js"></script>
</body>
</html>