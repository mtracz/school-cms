

<div class="ui centered aligned grid" style='display: none;'>

	<div class="ui column" id="main_column">

		<div class="ui icon header centered aligned">
			<i class="write icon"></i>		
			{{ $panel_header or ""}}
		</div>
		<h5 class="ui centered header sector_info" data-setctor_id="{{$sector_id or ""}}">
			Sektor: {{$sector_name or ""}}
		</h5>
		
		<div class="ui header right aligned">

			<div class="ui mini steps">
				<div class="active step" id="edit_step">
					<i class="edit icon"></i>
					<div class="content">
						<div class="title">Tworzenie</div>
						<div class="description"></div>
					</div>
				</div>
				<div class="disabled step" id="preview_step">
					<i class="unhide icon"></i>
					<div class="content">
						<div class="title">Podgląd</div>
						<div class="description"></div>
					</div>
				</div>
			</div>

		</div>

		<div class="ui segment preview" hidden data-item_name={{$item_name}} id="preview_news">
			<div class="ui centered grid" style="padding: 20px">
				@if($item_name == "banner")
					<div class="sixteen wide column">
				@else
					<div class="four wide column">
				@endif

				@if($item_name == "banner")
					{{ $banner }}
				@elseif($item_name == "list")
					{{ $list_panel }}
				@elseif($item_name == "info")
					{{ $info_panel }}
				@elseif($item_name == "custom")
					{{ $custom_panel }}
				@endif
				</div>
			</div>
		</div>

		<!-- FONT MANAGER -->
		@if($item_name != "banner")
			@include("templates.fontManager")
		@endif
		<!--  -->

		<form class="ui form" action="{{$panel_route or ""}}" method="post" id="add_news_article_form" @if(!isset($editing_panel)) data-panel_type_id={{$panel_type_id}} @endif data-sector_id={{$sector_id}}>
			{{ csrf_field() }}
				<h3>Nazwa*</h3>
				<div class="field">
					<input name="title" placeholder="Tu wpisz nazwę" value="{{$editing_panel->name or ""}}">
					<div class="ui pointing red basic label hidden" id="title_warning">
						To pole musi być wypełnione
					</div>
				</div>

			@if($item_name != "banner")	
				<h3>Nagłówek</h3>
				<div class="field">
					<input name="header" placeholder="Tu wpisz nagłówek" value="{{$editing_panel->header or ""}}">
				</div>
			@endif

			<h3>Treść*</h3>
			<div class="ui segment content" data-editable data-name="content" @if(isset($editing_panel)) data-editing_mode='true'@endif">

				@if(! isset($editing_panel))
					@if($item_name == "banner") <p class="image-only"></p> @endif

					@if($item_name == "list") <p class="links-only"></p> @endif

					@if($item_name == "info") <p class="info-only"></p> @endif

					@if($item_name == "custom") <textarea value="" name="custom-only" id="custom_textarea"></textarea> @endif
				@endif

				{!!$editing_panel->content or ""!!}

			</div>
			<div class="required fields info">* - pola wymagane</div>
			<div class="ui pointing red basic label hidden" id="content_warning">
				To pole musi być wypełnione		
			</div>
			<br>

			
		</form>
		<div id="errors_list" class="ui error message hidden">			
		</div>
		
		{{-- BUTTONS --}}
		<div class="ui red left floated circular button" id="cancel_button" 
		data-route="{{route('element.manage.get')}}">
			<i class="cancel icon"></i>
			Anuluj
		</div>

		<div class="ui blue left floated circular button" id="reedit_button">
			<i class="left chevron icon"></i>
			Popraw
		</div>

		<div class="ui green right floated circular button" id="public_button">
			<i class="check chevron icon"></i>
			Publikuj				
		</div>

		<div class="ui blue right floated circular button" id="preview_button" >
			Podgląd
			<i class="right chevron icon"></i>
		</div>		

	</div>

</div>
