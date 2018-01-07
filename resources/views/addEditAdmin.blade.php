@extends("mainLayout")

@section("styles")
	@parent
	{!!Html::style("css/formAdmin.css")!!}
@endsection

@section("content")
	@php
		$is_admin_editing = isset($editing_admin);
	@endphp

	@if($is_admin_editing)	
		@component("templates.formAdmin",["editing_admin" => $editing_admin])
	@else
		@component("templates.formAdmin")
	@endif

	@slot("admin_route")
		@if($is_admin_editing)
			{{ route("admin.edit.post", $editing_admin->id) }}
		@else
			{{ route("admin.add.post") }}
		@endif
	@endslot
	
	@slot("admin_header")	
		@if($is_admin_editing)
			Edytuj administratora
		@else
			Dodaj administratora
		@endif
	@endslot

	@endcomponent
@endsection

@section("scripts")
	@parent
	{!!Html::script("js/formAdmin.js")!!}
@endsection