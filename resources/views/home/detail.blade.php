@extends('home.layout.layout')

@section('seo')
<title>{{$articleInfo->title}} | 笠缪 - Every Thing Will Be Fine</title>
<meta name="keywords" content="{{$articleInfo->title}}">
<meta name="description" content="{{$articleInfo->title}}">
@endsection
@section('page_css')
<!-- markdown样式 -->
<link rel="stylesheet" href="/resources/home/css/markdown.css" type="text/css" />
<link rel="stylesheet" href="/resources/home/css/detail.css">
@endsection
@section('main')
	<div class="col-sm-9 ">
		<h1 class="title">{{$articleInfo->title}}</h1>
		<div class="" id="content">
			{!! $articleInfo->content->content !!}
		</div>
		<div id="disqus_thread" style="margin: 100px 0 0 0"></div>
	</div>
	@if(false == config('app.debug	'))
	<script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
		var disqus_config = function () {
		this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
		};
		*/
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://fennay.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
			Disqus.</a></noscript>
	@endif
@endsection
