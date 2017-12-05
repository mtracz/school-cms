@extends("mainLayout")

@section("styles")
@parent
{!! Html::style("css/menuAddEdit.css") !!}
@endsection


@section("content")
	@php
		$is_editing = isset($editing_mode);		
	@endphp
<br><br><br>
<div class="ui centered aligned grid">
	
	<div class="column">
			<div class="ui centered header">
			@if($is_editing) 
				Edytuj menu
			@else
				Dodaj menu
			@endif
			</div>
			<h5 class="ui centered header sector_info" data-setctor_id="{{$sector_id or ""}}">
				Sektor: {{$sector_name or ""}}
			</h5>
			<form class="ui form" 
			@if($is_editing) 
					action="{{route("menu.edit.post", $menuObject->id)}}"
			@else
					action="{{route("menu.add.post")}}"
			@endif  
			method="post" id="menu_form">
			{{ csrf_field() }}

			<div class="six wide field focus">
				<label>Nazwa</label>
				@if($is_editing)
					<input type="text" placeholder="Nazwa menu" name="menu_name" autofocus onfocus="this.value = '{{$menuObject->name}}'">
				@else
					<input type="text" placeholder="Nazwa menu" autofocus name="menu_name">
				@endif
			</div>

			<h5>Dodaj element</h5>
			<div class="field tab arrows">
				<div>Kolejność</div>
				<div class="ui icon buttons">
					<div class="ui left button "><i class="long left arrow icon"></i></div>
					<div class="ui right button "><i class="long right arrow icon"></i></div>
				</div>
			</div>

			
			{{-- TABS START --}}
			<div class="ui top attached tabular menu">
				@if($is_editing)
					@foreach ($menuObject->menu_item as $item)
						<a 
						@if($item->order == 1) 
						class="item active"
						@else class="item" 
						@endif data-tab={{$item->order}} data-order={{$item->order}}> {{$item->order}} </a>
					@endforeach
				@else
					<a class="item active" data-tab="1" data-order="1">1</a>
				@endif

				<div class="ui icon buttons add_tab_div">
					<div class="compact ui positive button" id="add_tab"><i class="add circle large icon"></i>
					</div>
				</div>
			</div>
			{{-- END TABS --}}
		
			@if($is_editing)
				@include("elements.editMenu")
			@else
			{{-- TAB CONTENT --}}
			<div class="tabs_content">		

				<div class="ui bottom attached tab segment active" data-tab="1" data-tab_content_order="1">
					<div class="alert dropdown" hidden>
						<i class="warning circle icon"></i>
						Po odznaczeniu zostanie tylko 1szy element. Reszta zostanie usunięta!
					</div>
					<div class="three fields">
						<div class="inline fields">
							<div class="ui toggle checkbox">

								<input type="checkbox" class="hidden" name="is_dropdown_tab_1" id="is_dropdown_tab_1">
								<label>Dropdown</label>
								
							</div>

						</div>
						<div class="inline fields">
							<div class="field dropdown_name" style='display: none;'>
								<label>Nazwa</label>
								<input type="text" placeholder="Nazwa" name="item_name_tab_1" value="no checked">
							</div>
						</div>
						<div class="inline fields delete_item_div">
							<div class="ui negative button">
								Usuń
							</div>
						</div>
					</div>

					<div class="elements">

						<div class="fields" data-order="1">
							<div class=" field">
								<div class="circular ui icon button order" disabled>
								<span class="element_order">1</span>			
								</div>
							</div>
							<div class="five wide field name">
								<label>Nazwa</label>
								<input type="text" placeholder="Nazwa elementu" name="element_name_tab_1_1">
							</div>	
							<div class="five wide field url">
								<label>URL</label>
								<input type="text" placeholder="URL elementu" name="element_url_tab_1_1">						
							</div>
							<div class="field">
								<div class="ui icon buttons actions" data-element_order="1">
									<div class="ui negative button element_delete"><i class="remove icon"></i>
									</div>

									<div class="ui up button disabled"><i class="long arrow up icon"></i>
									</div>
									<div class="ui down button disabled" ><i class="long arrow down icon"></i>
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="fourteen wide field add_new_element" hidden>
						<div class="fluid ui positive button"><i class="plus icon"></i>
						</div>
					</div>

				</div>
			</div>
			{{-- END TAB CONTENT --}}
			@endif

			<br>
			{{-- buttons --}}
			<div class="route_to_elements_manage" hidden data-route_to_elements_manage="{{route("element.manage.get")}}"></div>
			<div class="ui red left floated circular button cancel">
				<i class="cancel icon"></i>
				Anuluj
			</div>
			<div class="ui blue right floated circular button save_menu" >
				<i class="save icon"></i>
				Zapisz
			</div>

		</form>

	</div>

</div>


<div class="ui basic mini confirm delete modal">
	
	<div class="ui icon centered header">
		<i class="trash outline icon"></i>
		Czy na pewno usunąć?
	</div>
	<div class="actions">		
		<div class="ui deny inverted red left floated button" data-value="deny">Nie</div>
		<div class="ui approve inverted green right floated button" data-value="approve">Tak</div>
	</div>
	
</div>
@endsection

@section("scripts")
@parent
{!! Html::script("js/menuAddEdit.js") !!}
@endsection
