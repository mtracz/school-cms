<div id="{{ $modal_id }}" class="ui longer modal">
	<i class="close icon"></i>
	<div class="header">
		{{ $header }}
		<div class="ui divider"></div>
		{{ $selected_item }}
	</div>
	<div class="scrolling content">
		{{ $list }}
	</div>
	<div class="actions">
		{{ $actions }}
	</div>
</div>