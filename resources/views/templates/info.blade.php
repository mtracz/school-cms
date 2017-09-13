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

<style type="text/css">

	.info.panel {
		position: relative;

		margin: 0px 0px 2px 0px !important;
	}

	.info.panel .header {

		padding: 10px;

	}

	.info.panel .content {

		padding: 10px;

		text-align: justify;

		border: 1px solid #102242;

		max-width: 100%;

		word-wrap: break-word;
	}

	.info.panel .content img{
		max-width: 100%; 
		border: 1px solid #BAC9D8;
	}

</style>

<script type="text/javascript">
	


</script>
