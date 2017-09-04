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

		<div class="ui horizontal divider">
			<div class="ui buttons">
				<button class="ui positive button save">Zapisz</button>
				<button class="ui negative button cancel">Anuluj</button>
			</div>
		</div>

		@foreach($site_sectors as $sector) 

		@component("templates.elements")

		@slot("sector_name")
		<div style="width: 100%"> 
			{{ $sector->name }}
			<button class="ui tr_add_element button right floated">
				<i class="plus icon"></i>
			</button>
		</div>
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

		<tr class="order @if($item->is_enabled === 0) disable " data-is_enabled="0" @else" data-is_enabled="1" @endif data-sector_id="{{ $sector->id }}" data-id="{{ $item->id }}" data-order={{ $item->order }} >
			<td class="center">
				<div class="ui buttons">
					<div class="ui up button"><i class="long arrow up icon"></i></div>
					<div class="ui down button"><i class="long arrow down icon"></i></div>
				</div>
			</td>
			<td class="center ">
				{{ $item->panel->name }}

			</td>
			<td class="center">
				{{ $item->panel->panel_type->name }}
			</td>
			<td class="actions">

				<div class="ui edit button" data-url=""> <i class="configure icon"></i> </div>
				<div class="ui delete button" data-url="" > <i class="trash icon"></i> </div>
				@if($item->is_enabled === 0)
				<div class="ui toggle show button"><i class="unhide icon"></i></div>
				@else
				<div class="ui toggle hide button"><i class="hide icon"></i></div>
				@endif
				<div class="ui move button"><i class="move icon"></i></div>
				
			</td>
		</tr>

		@else

		<tr class="order @if($item->is_enabled === 0) disable" data-is_enabled="0" @else" data-is_enabled="1" @endif data-sector_id="{{ $sector->id }}" " data-id="{{ $item->id }}" data-order={{ $item->order }}>
			<td class="center">
				<div class="ui buttons">
					<div class="ui up button"><i class="long arrow up icon"></i></div>
					<div class="ui down button"><i class="long arrow down icon"></i></div>
				</div>
			</td>
			<td class="center">
				{{ $item->menu->name }}
			</td>
			<td class="center">
				menu
			</td>
			<td class="actions">

				<div class="ui edit button" data-url=""> <i class="configure icon"></i> </div>
				<div class="ui delete button" data-url="" > <i class="trash icon"></i> </div>
				@if($item->is_enabled === 0)
				<div class="ui toggle show button"><i class="unhide icon"></i></div>
				@else
				<div class="ui toggle hide button"><i class="hide icon"></i></div>
				@endif
				<div class="ui move button"><i class="move icon"></i></div>

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
{!!Html::script("js/DatabaseElementsUpdater.js")!!}
{!!Html::script("js/elementsManage.js")!!}
@endsection