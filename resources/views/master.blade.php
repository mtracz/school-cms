<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="description" content="...">
	<meta name="keywords" content="none">

	<title></title>

	{{-- Styles --}}
	{!! Html::style("css/semantic.min.css") !!}
	{!! Html::style("css/calendar.min.css") !!}
	{!! Html::style("css/master.css") !!}
	{!! Html::style("css/content-tools.min.css") !!}

	@yield("styles")

</head>
<body class="background-color">

	{!! Html::script("js/jquery.min.js") !!}

	{{-- Menu for Admin when Logged In --}}
	@if(Auth::user())

	@include("templates/menuAdmin")

	@endif
	{{-- //////////////// --}}

	<div class="cookie_info">
		<p class="text">
		{{ $cookie_text }} 
		</p>
		<button class="ui button accept_coockies">
			Rozumiem
		</button>
	</div>

	@yield("content")

	{{-- Scripts --}}
	
	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/calendar.min.js") !!}
	{!! Html::script("js/master.js") !!}
	{!! Html::script("js/content-tools.min.js") !!}
	{!! Html::script("js/contentToolsInit.js") !!}

	@yield("scripts")

</body>
</html>
