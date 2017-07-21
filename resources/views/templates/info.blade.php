<div class="info panel">

	@if($item->panel->has_header)

	<div class="header default-primary-color text-primary-color">
		{!! $item->panel->header !!}
	</div>

	@endif
	<div class="content light-primary-color primary-text-color">
		
		{!! $item->panel->content !!}
		
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif

</div>


<style type="text/css">

	.info .header {

		padding: 10px;

		border-bottom: 3px solid #303F9F;
	}

	.info .content {

		padding: 20px;

		
	}

</style>

<script type="text/javascript">
	


</script>
