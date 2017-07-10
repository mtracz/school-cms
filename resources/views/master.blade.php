<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	{!! Html::style("css/semantic.min.css") !!}

</head>
<body>

	@yield("maintenance")

	@yield("content")

	<!-- Scripts  -->
	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/jquery.min.js") !!}
</body>
</html>
