<div class="ui inverted menu" style="background-color: #999; ">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $item)

		@if($item->is_dropdown === 1)

			<div class="ui dropdown item">
				<div class="default text">{{ $item->name}}</div>
				<div class="menu">

					{{-- @include("templates/link") --}}
					@foreach($item->link as $link)
						<div class="item"> {{$link->name}}</div>

					@endforeach
				</div>
			</div>


		@else
			@foreach($item->link as $link)
			<div class="item">
				{{-- @include("templates/link") --}}

				<a class="link"> {{$link->name}}</a>
			</div>
			@endforeach
		@endif

	@endforeach
</div>