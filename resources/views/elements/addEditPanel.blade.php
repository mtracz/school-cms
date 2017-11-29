@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/formNewsPage.css")!!}
	{!!Html::style("css/addEditPage.css")!!}
	{!!Html::style("css/jquery.simplecolorpicker.css")!!}
@endsection

@section("content")
	@php
		$is_panel_editing = isset($panelObject);
	@endphp

	@if($is_panel_editing)	
		@component("templates.panelForm", ["editing_panel" => $panelObject, 
										  "sector_name" => $sector_name])
	@else
		@component("templates.panelForm", ["sector_name" => $sector_name])
	@endif

	@slot("panel_route")
		@if($is_panel_editing)
			{{ route("panel.edit.post", $panelObject->id) }}
		@else
			{{ route("panel.add.post") }}
		@endif
	@endslot
	
	@slot("panel_header")
		@if($is_panel_editing)
			Edytuj panel:   {{ $panelObject->name }}
		@else
			Dodaj panel: {{ $item_name }} 
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