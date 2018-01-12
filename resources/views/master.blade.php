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
	{!! Html::style("css/toastr.min.css") !!}
	{!! Html::style("css/magnific-popup.css") !!}

	@yield("styles")

</head>
<body class="background-color body">

	<div class="ui active page dimmer">
		<div class="ui active text massive loader">
			Ładowanie strony...
		</div>
	</div>

	{!! Html::script("js/jquery.min.js") !!}

	{{-- Menu for Admin when Logged In --}}
	@if(Auth::user())
		@include("templates/menuAdmin")
		<div class="air_bag"></div>
	@endif
	{{-- //////////////// --}}

	<div class="cookie_info" style="display: none;">
		<p class="text">
			{{ $cookie_text }} 
		</p>
		<button class="ui button accept_coockies">
			Rozumiem
		</button>
	</div>

	{{-- TOASTR MESSAGES --}}
	<div id="InfromationMessages" style="display: none;">
		@if(Session::get("messages"))
		@foreach(Session::get("messages") as $message => $type)
		<span type="{{$type}}" data-message="{{$message}}"></span>
		@endforeach
		@endif
	</div>

	@yield("content")

	{{-- Scripts --}}

	{!! Html::script("js/jquery.min.js") !!}
	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/calendar.min.js") !!}
	{!! Html::script("js/master.js") !!}
	{!! Html::script("js/content-tools.min.js") !!}
	{!! Html::script("js/contentToolsSetToolbox.js") !!}
	{!! Html::script("js/contentToolsSetLanguage.js") !!}
	{!! Html::script("js/contentToolsInit.js") !!}
	{!! Html::script("js/toastr.min.js") !!}
	{!! Html::script("js/toastrOptions.js") !!}	
	{!! Html::script("js/jquery.magnific-popup.min.js") !!}	
	
	@yield("scripts")

</body>
</html>
