@extends("master")

@section("content")

<div class="ui settings container">

	<div class="ui horizontal divider">
		<div class="ui buttons">
			<button class="ui positive button submit">Zapisz</button>
			<button class="ui negative button">Anuluj</button>
		</div>
	</div>

	<div class="wrapper">
		<form class="ui form">

			<div class="ui horizontal divider">
				<i class="user circle icon"></i> Admin
			</div>

			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Email głównego administratora </div>
					<input name="admin_email" type="email" placeholder="Adres email" value="{{ $settings['admin_email'] }}">
				</div>
			</div>

			<div class="ui horizontal divider">
				<i class="window restore icon"></i> Strona
			</div>

			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Tytuł serwisu </div>
					<input name="title" type="text" placeholder="Tytuł serwisu" maxLength="30" value="{{ $settings['title'] }}">
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Opis serwisu </div>
					<textarea name="description" rows="2" placeholder="Opis serwisu">{{ $settings['description'] }}</textarea>
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Słowa kluczowe </div>
					<input pattern="((?:[A-Z]|[a-z]+))" name="keywords" placeholder="Słowa kluczowe" value="{{ $settings['keywords'] }}">
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Maksymalna liczba newsów na stronę </div>
					<input name="news_per_page" type="number" min="1" placeholder="Maksymalna liczba newsów na stronę" value="{{ $settings['news_per_page'] }}">
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Motyw </div>
					<select name="theme_name">
						<option value=""> {{ $settings["theme"] }} </option>

						@foreach($themes as $theme)

						@if($theme->name != $settings["theme"])

						<option value="{{ $theme->id }}"> {{ $theme->name }} </option>

						@endif

						@endforeach
					</select>
				</div>
			</div>

			<div class="ui horizontal divider">
				<i class="configure icon"></i> Tryb serwisowy
			</div>

			<div class="field">
				@if($settings["is_maintenance_mode"] === 1)

				<div class="inline field">
					<div class="ui toggle checkbox">
						<input type="checkbox" name="is_maintenance_mode" checked>
						<label>Włącz tryb serwisowy</label>
					</div>
				</div>

				@else

				<div class="inline field">
					<div class="ui toggle checkbox">
						<input type="checkbox" name="is_maintenance_mode">
						<label>Włącz tryb serwisowy</label>
					</div>
				</div>

				@endif
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Tekst trybu serwisowego </div>
					<input name="maintenance_mode_text" type="text" placeholder="Tytuł serwisu" value="{{ $settings['maintenance_mode_text'] }}">
				</div>
			</div>

			<div class="ui horizontal divider">
				<i class="handicap icon"></i> Ułatwienia dostępu
			</div>

			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Czcionka podstawowa </div>
					<input name="font_size_default" type="number" min="1" placeholder="px" value="{{ $settings['font_size_default'] }}">
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Czcionka większa </div>
					<input name="font_size_big" type="number" min="1" placeholder="px" value="{{ $settings['font_size_big'] }}">
				</div>
			</div>
			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Czcionka największa </div>
					<input name="font_size_biggest" type="number" min="1" placeholder="px" value="{{ $settings['font_size_biggest'] }}">
				</div>
			</div>

			<div class="ui horizontal divider">
				<i class="comment icon"></i> Ciasteczka
			</div>

			<div class="field">
				<div class="ui labeled input">
					<div class="ui label"> Informacja o ciasteczkach </div>
					<textarea name="cookie_text" rows="2">{{ $settings['cookie_text'] }}</textarea>
				</div>
			</div>

		</form>
	</div>

	<div class="ui horizontal divider">
		<div class="ui buttons">
			<button class="ui positive button submit">Zapisz</button>
			<button class="ui negative button">Anuluj</button>
		</div>
	</div>
</div>

@endsection

@section("scripts")

@parent
{!!Html::script("js/settings.js")!!}

@endsection