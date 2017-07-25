<div class="list panel">

	@if($item->panel->has_header)

	<div class="header fifth-color">
		{!! $item->panel->header !!}
	</div>

	@endif
	<div class="wrapper">
		<div class="content ">

			{!! $item->panel->content !!}

		</div>
	</div>
	@if(Auth::user())

	@include("templates/editTab")

	@endif
</div>

<style type="text/css">

	.list.panel {
		margin: 0px 0px 1px 0px !important;
	}

	.list.panel .wrapper {
		border: 1px solid #406DE4;
	}

	.list.panel .header {

		padding: 10px;

		border-bottom: 1px solid #fff;
	}

	.list.panel .content {

		padding: 20px;

		border-left: 10px solid #406DE4;
	}

	.list.panel a {
		cursor: pointer;

		color: #406DE4;
	}

</style>
