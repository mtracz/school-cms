{{-- foreach  render elements--}} 

{{-- TAB CONTENT --}}
<div class="tabs_content">		
	@foreach ($menuObject->menu_item as $item)
	<div 
	@if($item->order == 1) 
		class="ui bottom attached tab segment active" 
	@else 
		class="ui bottom attached tab segment" 
	@endif 
	data-tab={{$item->order}} data-tab_content_order={{$item->order}}>

		@if($item->is_dropdown == 1)
			<div class="alert dropdown">	
		@else
			<div class="alert dropdown" hidden>					
		@endif
		<i class="warning circle icon"></i>
			Po odznaczeniu zostanie tylko 1szy element. Reszta zostanie usunięta!
		</div>
		<div class="three fields">
			<div class="inline fields">
				@if($item->is_dropdown == 1)
				<div class="ui toggle checkbox checked" >
					
					<input type="checkbox" class="hidden" name="is_dropdown_tab_{{$item->order}}" id="is_dropdown_tab_{{$item->order}}" checked>
				@else
				<div class="ui toggle checkbox">
					<input type="checkbox" class="hidden" name="is_dropdown_tab_{{$item->order}}" id="is_dropdown_tab_{{$item->order}}">
				@endif
					<label>Dropdown</label>

				</div>

			</div>
			<div class="inline fields">
				<div class="field dropdown_name" 
					@if(!$item->is_dropdown == 1) 
						style='display: none;' 
					@endif
					>
					<label>Nazwa</label>
					@if($item->is_dropdown == 1)
						<input type="text" placeholder="Nazwa" name="item_name_tab_{{$item->order}}" value="{{$item->name}}">
					@else
						<input type="text" placeholder="Nazwa" name="item_name_tab_{{$item->order}}" value="no checked">
					@endif
				</div>
			</div>
			<div class="inline fields delete_item_div">
				<div class="ui negative button">
					Usuń
				</div>
			</div>
		</div>
	

		<div class="elements">
			@foreach($item->link as $single_link)
			<div class="fields" data-order="{{$single_link->order}}">
				<div class=" field">
					<div class="circular ui icon button order" disabled>
						<span class="element_order">{{$single_link->order}}</span>			
					</div>
				</div>
				<div class="five wide field name">
					<label>Nazwa</label>
					<input type="text" placeholder="Nazwa elementu" name="element_name_tab_{{$item->order}}_{{$single_link->order}}" value="{{$single_link->name}}">
				</div>	
				<div class="five wide field url">
					<label>URL</label>
					<input type="text" placeholder="URL elementu" name="element_url_tab_{{$item->order}}_{{$single_link->order}}" value="{{$single_link->url}}">						
				</div>
				<div class="field">
					<div class="ui icon buttons actions" data-element_order="{{$single_link->order}}">
						<div class="ui negative button element_delete"><i class="remove icon"></i>
						</div>

						<div class="ui up button disabled"><i class="long arrow up icon"></i>
						</div>
						<div class="ui down button disabled" ><i class="long arrow down icon"></i>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>	
			<div class="fourteen wide field add_new_element" @if(!$item->is_dropdown == 1) hidden @endif>
			<div class="fluid ui positive button"><i class="plus icon"></i>
			</div>
		</div>

	</div>
	@endforeach
</div>
{{-- END TAB CONTENT --}}