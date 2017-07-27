

<div class="ui menu fifth-color">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $singleItem)

		@if($singleItem->is_dropdown === 1)

		<div class="ui simple dropdown item">
			{{ $singleItem->name }} <i class="dropdown icon"></i>
			<div class="menu fifth-color">

				{{-- @include("templates/link") --}}
				@foreach($singleItem->link as $link)

				<a href="{{ $link->url }}" class="item fifth-color">  {{ $link->name }} </a>

				@endforeach
			</div>
		</div>

		@else
			@foreach($singleItem->link as $link)

			<a href="{{ $link->url }}" class="item fifth-color">
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
