
@foreach($element_model as $item)

	@if($item->panel_id)

		{{-- panel template --}}
		testing panel output: 
		{{ $item->panel }}
	@else

		{{-- menu template --}}
		testing menu output: 
		{{ $item->menu }}

		@include("templates/menu")
	@endif
	<br>
@endforeach