@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/formNewsPage.css")!!}
	{!!Html::style("css/jquery.simplecolorpicker.css")!!}
@endsection

@section("content")
	@php
		$is_panel_editing = isset($panelObject);
	@endphp

	@if($is_panel_editing)	
		@component("templates.panelForm", ["editing_panel" => $panelObject, 
										  "sector_name" => $sector_name,
										  "item_name" => $panelObject->panel_type->name,
										  "sector_id" => $sector_id])
	@else
		@component("templates.panelForm", ["sector_name" => $sector_name,
											"item_name" => $item_name,
											"sector_id" => $sector_id,
											"panel_type_id" => $panel_type_id])
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

	@slot("info_panel")
	<div class="info panel">
		<div class="header fifth-color" id="preview_header">
		</div>
		<div class="content" id="preview_content">
		</div>
	</div>
	@endslot

	@slot("list_panel")
	<div class="list panel">
		<div class="header fifth-color" id="preview_header">
		</div>
		<div class="wrapper">
			<div class="content" id="preview_content">
			</div>
		</div>
	</div>
	@endslot

	@slot("banner")
	<div class="banner panel">
		<div class="header default-primary-color text-primary-color" id="preview_header">
		</div>
		<div class="editMe">
			<div class="content primary-text-color" id="preview_content">
			</div>
		</div>
	</div>
	@endslot

	@endcomponent
@endsection

@section("scripts")
	@parent
	@stack("fontManager")	
	{!!Html::script("js/formNewsPage.js")!!}
	{!!Html::script("js/addEditPanel.js")!!}
	{!!Html::script("js/jquery.simplecolorpicker.js")!!}
@endsection