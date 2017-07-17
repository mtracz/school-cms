
@foreach($element_model as $item)

	@if($item->panel_id)

		{{-- panel template --}}
		@include("templates/panel")
	@else

		{{-- menu template --}}
		@include("templates/menu")
	@endif
	<br>
@endforeach