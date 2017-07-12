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

	<!-- Fonts -->
	{!! Html::style("css/semantic.min.css") !!}
	{!! Html::style("css/master.css") !!}

</head>
<body>

	@yield("maintenance")

	@yield("content")

	<!-- Scripts  -->
	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/jquery.min.js") !!}
	{!! Html::script("js/master.js") !!}

	@yield("scripts")

</body>
</html>
