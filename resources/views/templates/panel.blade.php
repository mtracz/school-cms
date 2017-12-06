
@if($item->panel->panel_type->name === "banner")

	@include("templates/banner")

@endif

@if($item->panel->panel_type->name === "info")
	<div class="four wide column">

		@include("templates/info")
	</div>
@endif

@if($item->panel->panel_type->name === "list")

	<div class="four wide column">

		@include("templates/list")
	</div>

@endif

@if($item->panel->panel_type->name === "accessibilites")

	<div class="four wide column">

		@include("templates/accessibility")
	</div>

@endif

@if($item->panel->panel_type->name === "custom")

	<div class="four wide column">

		@include("templates/custom")
	</div>

@endif