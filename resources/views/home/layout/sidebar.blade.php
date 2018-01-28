
<div class="col-sm-3">
	<div class="human-time">
		<object width="210" height="90" align="middle">
			<param name="allowScriptAccess" value="always"/>
			<param name="movie" value="/resources/home/flash/honehone_clock_wh.swf"/>
			<param name="quality" value="high"/>
			<param name="bgcolor" value="#ffffff"/>
			<param name="wmode" value="transparent"/>
			<embed wmode="transparent" src="/resources/home/flash/honehone_clock_wh.swf" quality="high"
				   allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
		</object>
	</div>

	<fieldset class="info border">
		<legend>关于我</legend>
		<p>邮箱：feng@fennay.com</p>
		<p>微博：<a href="http://weibo.com/524565488/" target="_blank">山脚下的乌龟</a></p>
	</fieldset>

	<fieldset class="tagCloud border" id="tagCloud">
		<legend>标签云</legend>
		@if(!empty($tagsList))
			@foreach($tagsList as $K => $tag)
				<a href="{{route('tag',['tag'=>$tag->name])}}" style="color:{{randColor()}}">{{$tag->name}}</a>
			@endforeach
		@endif
	</fieldset>

	<fieldset class="border" id="calender">
		<legend>日历</legend>
		<div id="ca"></div>

	</fieldset>

</div>