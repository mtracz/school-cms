@extends("master")

@section("content")

<div class="ui container" style="background-color: #ddd; margin-top: 50px; width: 80vw; padding: 10px;">

	<div class="ui horizontal divider">
		<i class="options icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i>
	</div>

	<div class="wrapper" style=" padding: 30px;">

		{{-- sdasdasdssssssssssssssssssssssssssssssss --}}

		<form class="ui form">

			<div class="ui horizontal divider" style="color: #406DE4;">
				<i class="user circle icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Admin
			</div>

			<div class="six wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Email głównego admina </div>
					<input name="admin_email" type="email" placeholder="Adres email" value="{{ $settings['admin_email'] }}">
				</div>
			</div>

			<div class="ui horizontal divider" style="color: #406DE4;">
				<i class="window restore icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Strona
			</div>

			<div class="four wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Tytuł serwisu </div>
					<input name="title" type="text" placeholder="Tytuł serwisu" maxLength="30" value="{{ $settings['title'] }}">
				</div>
			</div>
			<div class="ten wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Opis serwisu </div>
					<input name="description" type="text" placeholder="Opis serwisu" maxLength="160" value="{{ $settings['description'] }}">
				</div>
			</div>
			<div class="ten wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Słowa kluczowe </div>
					<input pattern="((?:[a-z][a-z]+))" name="keywords" placeholder="Słowa kluczowe" value="{{ $settings['keywords'] }}">
				</div>
			</div>
			<div class="four wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Maksymalna liczba newsów na stronę </div>
					<input name="news_per_page" type="number" min="1" placeholder="Maksymalna liczba newsów na stronę" value="{{ $settings['news_per_page'] }}">
				</div>
			</div>
			<div class="ten wide field">
				<div class="ui labeled input">
					<div class="ui label" style="background-color: #406DE4; color: white;"> Motyw </div>
					<select>
						@foreach($themes as $theme)

						<option value="{{ $theme->id }}"> {{ $theme->name }} </option></div>

						@endforeach
					</select>
				</div>
			</div>

			<div class="field">
				
			</div>
		</form>

		{{-- sdasdasdssssssssssssssssssssssssssssssss --}}

		<div class="ui horizontal divider" style="color: #406DE4;">
			<i class="user circle icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Admin
		</div>

		<p> Admin email :{{ $settings["admin_email"] }} </p>

		<div class="ui horizontal divider" style="color: #406DE4;">
			<i class="window restore icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Strona
		</div>

		<p> Title :	{{ $settings["title"] }} </p>
		<p> Description :	{{ $settings["description"] }} </p>
		<p> Keywords :	{{ $settings["keywords"] }} </p>

		<p> News per page :	{{ $settings["news_per_page"] }} </p>

		<p> Theme dropdown:	{{ $settings["theme"] }} </p>

		<div class="ui horizontal divider" style="color: #406DE4;">
			<i class="configure icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Tryb serwisowy
		</div>

		<p> Maintenance mode check:	{{ $settings["is_maintenance_mode"] }} </p>
		<p> Maintenance mode text:	{{ $settings["maintenance_mode_text"] }} </p>
		<p> Cookie text :	{{ $settings["cookie_text"] }} </p>

		<div class="ui horizontal divider" style="color: #406DE4;">
			<i class="handicap icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i> Ułatwienia dostępu
		</div>

		<p> Font default :	{{ $settings["font_size_default"] }} </p>
		<p> Font big:	{{ $settings["font_size_big"] }} </p>
		<p> Font biggest:	{{ $settings["font_size_biggest"] }} </p>

	</div>

	<div class="ui horizontal divider">
		<i class="options icon" style="font-size: 40px; margin: 0px 10px 0px 10px;"></i>
	</div>

	@endsection