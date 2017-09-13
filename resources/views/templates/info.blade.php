@if($item->site_sector->orientation->name === "horizontal")

<div class="info panel">

	@if($item->panel->has_header)

	<div class="header fifth-color">
		{!! $item->panel->header !!}
	</div>

	@endif
	<div class="content">
		
		{!! $item->panel->content !!}
		
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif

</div>

@else

<div class="info panel">

	@if($item->panel->has_header)

	<div class="header fifth-color">
		{!! $item->panel->header !!}
	</div>

	@endif
	<div class="content">
		
		{!! $item->panel->content !!}
		
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif

</div>

@endif
