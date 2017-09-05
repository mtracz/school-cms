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
				<button class="ui negative button main_page deny">Anuluj</button>
			</div>
		</div>

		@foreach($site_sectors as $sector) 

		@component("templates.elements")

		@slot("sector_id")
		{{ $sector->id }}
		@endslot

		@slot("sector_name")
		<div class="sector_data" data-sector_panel_allowed_ids="{{ $sector->panels_types_allowed_ids }}" data-sector_is_menu_allowed="{{ $sector->is_menu_allowed }}" data-sector_id="{{ $sector->id }}" style="width: 100%; padding-bottom: 20px;"> 
			<div class="sector_name" style="float: left; line-height: 25px">
				{{ $sector->name }}
			</div>
			<button class="ui add_element button">
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

		<tr class="order @if($item->is_enabled === 0) disable " data-is_enabled="0" @else" data-is_enabled="1" @endif data-sector_id="{{ $sector->id }}" data-id="{{ $item->id }}" data-order={{ $item->order }} data-panel_type_id="{{ $item->panel->panel_type->id }}">
			<td class="center">
				<div class="ui buttons">
					<div class="ui up button"><i class="long arrow up icon"></i></div>
					<div class="ui down button"><i class="long arrow down icon"></i></div>
				</div>
			</td>
			<td class="center name">
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

		<tr class="order @if($item->is_enabled === 0) disable" data-is_enabled="0" @else" data-is_enabled="1" @endif data-sector_id="{{ $sector->id }}" " data-id="{{ $item->id }}" data-order={{ $item->order }} >
			<td class="center">
				<div class="ui buttons">
					<div class="ui up button"><i class="long arrow up icon"></i></div>
					<div class="ui down button"><i class="long arrow down icon"></i></div>
				</div>
			</td>
			<td class="center name">
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

		<div class="ui horizontal divider">
			<div class="ui buttons">
				<button class="ui positive button save">Zapisz</button>
				<button class="ui negative button main_page deny">Anuluj</button>
			</div>
		</div>

	</div>
</div>

	{{-- Modals --}}
	@component("templates.listSelectModal")

		@slot("modal_id")
			selectSectorModal
		@endslot

		@slot("header")
			Wybierz sector
		@endslot

		@slot("selected_item")
			Zaznaczony element: <span class="selected_item_name"></span>
		@endslot

		@slot("list")
			@foreach($site_sectors as $sector)
				<div class="ui fluid list_selector button" data-sector_panel_allowed_ids="{{ $sector->panels_types_allowed_ids }}" data-sector_is_menu_allowed="{{ $sector->is_menu_allowed }}" data-sector_id="{{ $sector->id }}">{{ $sector->name }}</div>
			@endforeach
		@endslot

		@slot("actions")
			<div class="ui red cancel inverted button">
				<i class="remove icon"></i>
				Anuluj
			</div>
			<div class="ui green ok inverted button">
				<i class="checkmark icon"></i>
				Przenieś
			</div>
		@endslot
		
	@endcomponent

	@component("templates.listSelectModal")

		@slot("modal_id")
			selectElementModal
		@endslot

		@slot("header")
			Wybierz element
		@endslot

		@slot("selected_item")
			Dodajesz element do sektora: <span class="selected_item_name"></span>
		@endslot

		@slot("list")
			<div class="ui fluid list_selector button" data-item_name="menu">menu</div>
			@foreach($panel_types as $type)
			<div data-panel_type_id="{{ $type->id }}" data-item_name="{{ $type->name }}" class="ui fluid list_selector button">{{ $type->name }}</div>
			@endforeach
		@endslot

		@slot("actions")
			<div class="ui red cancel inverted button">
				<i class="remove icon"></i>
				Anuluj
			</div>
			<div class="ui green ok inverted button">
				<i class="checkmark icon"></i>
				Dodaj
			</div>
		@endslot
		
	@endcomponent

@endsection

@section("scripts")
@parent
{!!Html::script("js/DatabaseElementsUpdater.js")!!}
{!!Html::script("js/elementsManage.js")!!}
@endsection