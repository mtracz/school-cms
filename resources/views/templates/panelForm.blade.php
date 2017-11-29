

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

		<div class="ui segment preview" hidden id="preview_news">
			<!-- <div class="ui centered grid" style="padding: 20px"> -->
				<div class="four wide column">
					<div class="header fifth-color" id="preview_header">

					</div>
					<!-- if(panel == list) -->
					<!-- <div class="wrapper"> -->
					<!-- endif -->
						<div class="content" id="preview_content">
					
						</div>
					<!-- if(panel == list) -->
					<!-- </div> -->
					<!-- endif -->
				</div>
			<!-- </div> -->
		</div>

		@include("templates.fontManager")

		<form class="ui form" action="{{$panel_route or ""}} method="post" id="add_news_article_form">
			{{ csrf_field() }}
			<h3>Tytuł</h3>
			<div class="field">
				<input name="title" placeholder="Tu wpisz tytuł" value="{{$editing_panel->title or ""}}">
				<div class="ui pointing red basic label hidden" id="title_warning">
					To pole musi być wypełnione
				</div>
			</div>

			<h3>Treść</h3>
			<div class="ui segment content " data-editable data-name="content" @if(isset($editing_panel)) data-editing_mode='true'@endif>

				{!!$editing_panel->content or ""!!}
				
				{{-- <p class="title-only">title</p>
				<p class="image-only">image</p>
				<p class="links-only">links</p>
				<p> all</p> --}}
			</div>

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

<script type="text/javascript">
	
	$("#preview_news .column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );

</script>
