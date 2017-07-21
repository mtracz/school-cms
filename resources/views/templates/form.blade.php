

<div class="ui centered aligned grid">
 
 
	<div class="ui column" id="add_news_column">

			<div class="ui icon header centered aligned">
					<i class="write icon"></i>		
						{{ $news_header or ""}}
						{{ $article_header or ""}}
			</div>
		
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
				<h4>
				<div id="preview_header">
					preview header
				</div>
				</h4>
				<div id="preview_content">
					preview content
				</div>
				
			</div>

			<form class="ui form" action="{{$news_route or ""}}{{$article_route or ""}}" method="post" id="add_news_article_form">
			{{ csrf_field() }}
				<h3>Tytuł</h3>
				<div class="field">
					<input name="title" placeholder="Tu wpisz tytuł">
					<div class="ui pointing red basic label hidden" id="title_warning">
						To pole musi być wypełnione
					</div>
				</div>

				<h3>Treść</h3>
				<div class="ui segment content" data-editable data-name="content">
				<p></p>
				</div>
				<div class="ui pointing red basic label hidden" id="content_warning">
						To pole musi być wypełnione		
				</div>
				<br>
				<div class="field">
					<div class="ui checkbox">
						<input type="checkbox" name="is_public" checked>
						<label>Publiczny</label>
					</div>
					<i class="world icon"></i>
				</div>

				<div class="news_settings">		
					@if(isset($news_settings))
						{{$news_settings}}
					@endif
				</div>

			</form>
			<div id="errors_list" class="ui error message hidden">			
			</div>
		
			{{-- BUTTONS --}}
			<div class="ui red left floated circular button" id="cancel_button">
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