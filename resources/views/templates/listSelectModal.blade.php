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

<script type="text/javascript">

	$(".scrolling.content .list_selector").bind("DOMSubtreeModified", function() {
		var selected_items = $(".scrolling.content").find(".ui.list_selector.activated");

		if(selected_items.length > 0)
			$(".ui.green.ok.inverted.button").removeClass("disabled");
		else
			$(".ui.green.ok.inverted.button").addClass("disabled");
	});

</script>