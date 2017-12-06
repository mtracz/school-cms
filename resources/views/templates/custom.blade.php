<div class="custom panel">

	@if($item->panel->has_header)

		<div class="header fifth-color">
			{!! $item->panel->header !!}
		</div>

	@endif
	<div class="content">	
		{!! $item->panel->content !!}
	</div>

</div>