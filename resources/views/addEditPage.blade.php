@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/formNewsPage.css")!!}
	{!!Html::style("css/addEditPage.css")!!}
	{!!Html::style("css/jquery.simplecolorpicker.css")!!}
@endsection

@section("content")
	@php
		$is_page_editing = isset($editing_page);
	@endphp

	@if($is_page_editing)	
		@component("templates.form",["editing_page" => $editing_page])
	@else
		@component("templates.form")
	@endif

	@slot("page_route")
		@if($is_page_editing)
			{{ route("page.edit.post", $editing_page->id) }}
		@else
			{{ route("page.add.post") }}
		@endif
	@endslot
	
	@slot("page_header")	
		@if($is_page_editing)
			Edytuj stronę
		@else
			Dodaj stronę
		@endif
	@endslot

	@endcomponent
@endsection

@section("scripts")
	@parent
	{!!Html::script("js/formNewsPage.js")!!}
	{!!Html::script("js/addEditPage.js")!!}
	{!!Html::script("js/jquery.simplecolorpicker.js")!!}
@endsection