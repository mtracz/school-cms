@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/addNews.css")!!}

@endsection


@section("content_layout")

	@component("templates.form")

		@slot("news_header")
			Dodaj newsa
		@endslot

		@slot("news_settings")
			DUPA SETINGS NEWSA
		@endslot

	@endcomponent

@endsection

@section("scripts")
	@parent


@endsection