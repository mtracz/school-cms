<div class="sixteen wide column banner panel">

	@if($item->panel->has_header)

	<div class="header default-primary-color text-primary-color">
		{{ $item->panel->header }}
	</div>

	@endif

	<div class="editMe">
		<div class="content primary-text-color">
			<img src="{!! $item->panel->content !!}">
		</div>
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif
</div>

<style type="text/css">

	.banner.panel {
		margin: 1px 0px 3px 0px !important;
	}

	.banner .header {

		font-size: 16px;

		padding: 10px;

		border-bottom: 3px solid #303F9F;
	}

	.banner .content {

		width: 80vw;
		height: 400px;
		overflow: hidden;

		position: relative;
	}

	.banner .content img {
		position: absolute;
		margin: auto; 
		min-height: 100%;
		min-width: 100%;

    	/* For the following settings we set 100%, but it can be higher if needed*/
    	left: -100%;
    	right: -100%;
    	top: -100%;
    	bottom: -100%;
    }

</style>