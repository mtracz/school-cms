
@foreach($element_model as $item)

@if($item->is_enabled)

	@if($item->site_sector->orientation->name === "horizontal")
		
		@if($item->panel_id)
			
			{{-- panel template --}}
			@include("templates/panel")
		@else

			{{-- menuHorizontal template --}}
			@include("templates/menuHorizontal")
		@endif

	@endif

	@if($item->site_sector->orientation->name === "vertical")

		<div class="row">

			@if($item->panel_id)

				{{-- panel template --}}
				@include("templates/panel")
			@else

				{{-- menuHorizontal template --}}
				@include("templates/menuVertical")
			@endif

		</div>

	@endif

@endif
@endforeach