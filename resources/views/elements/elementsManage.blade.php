@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/mainLayout.css")!!}
{!!Html::style("css/elementsManage.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="elements_manage">

		@foreach($site_sectors as $sector) 

		@component("templates.sectorList")

		@slot("sector_name")
		{{ $sector->name }}
		@endslot

		@slot("headers")
		<th>Kolejność</th>
		<th>Nazwa</th>
		<th>Typ</th>
		<th>Akcje</th>
		@endslot

		@slot("rows")
			@foreach($elements as $item)

			@if($item->site_sector_id == $sector->id)
				@if(isset($item->panel_id))
				
				<tr data-order={{ $item->order }}>
					<td class="center">
						{{ $item->order }}
					</td>
					<td class="center">
						{{ $item->panel->name }}
						
					</td>
					<td class="center">
						{{ $item->panel->panel_type->name }}
					</td>
					<td class="actions">

							{{-- <div class="ui edit button" data-url="{{ route('element.edit.get', ['id' => $item->id])}} "> <i class="configure icon"></i> </div>
						<div class="ui delete button" data-url="{{ route('element.delete.post', ['id' => $item->id])}}" > <i class="trash icon"></i> </div> --}}
					</td>
				</tr>

				@else

				<tr data-order={{ $item->order }}>
					<td class="center">
						{{ $item->order }}
					</td>
					<td class="center">
						{{ $item->menu->name }}
					</td>
					<td class="center">
						menu
					</td>
					<td class="actions">

							{{-- <div class="ui edit button" data-url="{{ route('element.edit.get', ['id' => $item->id])}} "> <i class="configure icon"></i> </div>
						<div class="ui delete button" data-url="{{ route('element.delete.post', ['id' => $item->id])}}" > <i class="trash icon"></i> </div> --}}
					</td>
				</tr>

				@endif
				
			@endif

			@endforeach
		@endslot

		@endcomponent

		@endforeach

	</div>
</div>

@endsection

@section("scripts")
@parent
{!!Html::script("js/elementsManage.js")!!}
@endsection