

<div class="ui menu fifth-color">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $singleItem)

		@if($singleItem->is_dropdown === 1)

		<div class="ui simple dropdown item">
			<div class="default text">{{ $singleItem->name }} <i class="dropdown icon"></i></div>
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

@section("scripts")

@parent

<script type="text/javascript">
	
	$('.ui.dropdown').dropdown();

</script>

@endsection
