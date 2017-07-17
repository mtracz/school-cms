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
	{!! Html::style("css/master.css") !!}

	@yield("styles")

</head>
<body>

	<div class="ui middle aligned center aligned grid">
		<div class="column" style="max-width: 400px;">
			<h2 class="ui teal image header">
				<img src="assets/images/logo.png" class="image">
				<div class="content">
					Logowanie do systemu
				</div>
			</h2>

			<form class="ui large form" action="{{route("login.post")}}" id="login_form" type="post">
				{{ csrf_field() }}
				<div class="ui stacked segment" >
					<div class="field error" id="login_field">
						<div class="ui left icon input">
							<i class="user icon"></i>
							<input type="text" name="login" placeholder="Login" id="login_input">
						</div>
					</div>
					<div class="field error" id="password_field">
						<div class="ui left icon input" >
							<i class="lock icon"></i>
							<input type="password" name="password" placeholder="Hasło" id="password_input">
						</div>
					</div>
					<div class="ui fluid large teal submit button" id="login_button">Zaloguj</div>
				</div>

				<div class="errors" id="errors_list">
				</div>

			</form>
		</div>
	</div>

	{{-- Scripts --}}
	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/jquery.min.js") !!}
	{!! Html::script("js/master.js") !!}

	<script type="text/javascript">

		function render() {
			var main_element = ".ui.grid > .column";

			var column_height = $(main_element).height();
			var space_top = $(window).height() / 2 - column_height / 2;

			$(main_element).css("margin-top", space_top);
		};

		render();

		$(window).resize(function() {
			render();
		});

	</script>

	@yield("scripts")

</body>
</html>
