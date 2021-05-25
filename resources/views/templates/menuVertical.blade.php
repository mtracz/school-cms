<div class="ui vertical fifth-color menu">

	{{-- @include("templates/menuItem") --}}
	@foreach($item->menu->menu_item as $singleItem)

	@if($singleItem->is_dropdown)

	<div class="ui accordion">
		<div class="title">
			<i class="dropdown icon"></i>
			{{ $singleItem->name }}
		</div>
		<div class="content">
			<div class="ui list">

				{{-- @include("templates/link") --}}
				@foreach($singleItem->link as $link)

				<a href="{{ $link->url }}" class="item fifth-color" style="padding: 10px;">  {{ $link->name }} </a>

				@endforeach
			</div>
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

@endsection