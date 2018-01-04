<div class="sixteen wide column banner panel">

	@if($item->panel->has_header)

	<div class="header default-primary-color text-primary-color">
		{{ $item->panel->header }}
	</div>

	@endif

	<div class="editMe">
		<div class="content primary-text-color">
			<!-- <img src="{!! $item->panel->content !!}"> -->
			<!-- {!! $item->panel->content !!} -->
		</div>
	</div>

	@if(Auth::user())

	@include("templates/editTab")

	@endif
</div>
