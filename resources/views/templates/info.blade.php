@if($item->site_sector->orientation->name === "horizontal")

<div class="info panel">

	@if($item->panel->has_header)

	<div class="header fourth-color">
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

<style type="text/css">

	.info.panel {
		position: relative;

		padding: 0px 2px 0px 2px;
	}

	.info .header {

		padding: 10px;

	}

	.info .content {

		padding: 10px;

		text-align: justify;

		border-left: 2px solid #346C9E;
		border-right: 2px solid #346C9E;
		border-bottom: 2px solid #346C9E;
	}

</style>

<script type="text/javascript">
	


</script>
