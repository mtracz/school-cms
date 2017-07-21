<div class="news panel">	
	
	<div class="title">
		{!! $singleNews->title !!}
	</div>

	<div class="content">
		{!! $singleNews->content !!}
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif
	
</div>

<style type="text/css">

	.news {
		background-color: #22313F;
	}
	
	.news .title {


	}

	.news .content {


	}

</style>
