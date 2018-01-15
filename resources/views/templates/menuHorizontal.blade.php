

<div class="ui menu fifth-color view_marker view_computer">

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

<!-- MOBILE MENU -->

<div class="ui menu view_marker view_tablet view_mobile mobile top_menu">
	<div class="ui floating dropdown item" style="width: 100%">
		<i class="align justify icon"></i>
		<span>Menu</span>
		<div class="menu fifth-color">

			@foreach($item->menu->menu_item as $singleItem)

			@if($singleItem->is_dropdown === 1)

			<div class="item">
				{{ $singleItem->name }} <i class="dropdown icon"></i>
				<div class="right menu fifth-color">

					{{-- @include("templates/link") --}}
					@foreach($singleItem->link as $link)
					<div class="item">
						<a href="{{ $link->url }}" class="fifth-color">  {{ $link->name }} </a>
					</div>
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
	</div>
</div>

@section("scripts")
@parent

@endsection
