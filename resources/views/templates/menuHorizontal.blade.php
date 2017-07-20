@if($item->site_sector->orientation->name == "horizontal")

<div class="ui inverted menu">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $singleItem)

		@if($singleItem->is_dropdown === 1)

		<div class="ui simple dropdown item">
			<div class="default text">{{ $singleItem->name }} <i class="angle down icon"></i></div>
			<div class="menu">

				{{-- @include("templates/link") --}}
				@foreach($singleItem->link as $link)

				<a href="{{ $link->url }}" class="item">  {{ $link->name }} </a>

				@endforeach
			</div>
		</div>

		@else
			@foreach($singleItem->link as $link)

			<a href="{{ $link->url }}" class="item">
				{{-- @include("templates/link") --}}
				{{ $link->name }}
			</a>

			@endforeach
		@endif

	@endforeach
</div>

@endif

@if($item->site_sector->orientation->name == "vertical")

<div class="ui inverted vertical menu">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $singleItem)

		@if($singleItem->is_dropdown === 1)

		<div class="ui simple dropdown item">
			<div class="default text">{{ $singleItem->name }} <i class="angle right icon"></i></div>
			<div class="menu">

				{{-- @include("templates/link") --}}
				@foreach($singleItem->link as $link)

				<a href="{{ $link->url }}" class="item">  {{ $link->name }} </a>

				@endforeach
			</div>
		</div>

		@else
			@foreach($singleItem->link as $link)

			<a href="{{ $link->url }}" class="item">
				{{-- @include("templates/link") --}}
				{{ $link->name }}
			</a>

			@endforeach
		@endif

	@endforeach
</div>

@endif

@section("scripts")

@parent

<script type="text/javascript">
	
	$('.ui.dropdown').dropdown();

</script>

@endsection
