<div class="sixteen wide column banner panel">

	@if($item->panel->has_header)

	<div class="header default-primary-color text-primary-color">
		{{ $item->panel->header }}
	</div>

	@endif
	<div class="content primary-text-color" style="background-image: url({!! $item->panel->content !!});">

	</div>

	@if(Auth::user())

		@include("templates/editTab")

	@endif
</div>

<style type="text/css">

	.banner .header {

		font-size: 16px;

		padding: 10px;

		border-bottom: 3px solid #303F9F;
	}

	.banner .content {

		padding: 0px !important;
		
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		background-color: pink;
		background-blend-mode: hard-light;

		height: 600px;

		/*border-left: 10px solid #3F51B5;*/
		/*border-right: 10px solid #3F51B5;*/

		border: 20px solid #3F51B5;
	}

</style>