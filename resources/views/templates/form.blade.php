


<div class="ui centered aligned grid">
 
 
	<div class="ui ten wide column" id="add_news_column">

			<div class="ui icon header centered aligned">
					<i class="write icon"></i>		
						{{ $news_header or ""}}
						{{ $article_header or ""}}
			</div>
		
				<div class="ui header right aligned">
					
					<div class="ui mini steps">
						<div class="active step">
						<i class="edit icon"></i>
							<div class="content">
								<div class="title">Tworzenie</div>
								<div class="description"></div>
							</div>
						</div>
						<div class="step">
							<i class="unhide icon"></i>
							<div class="content">
								<div class="title">Podgląd</div>
								<div class="description"></div>
							</div>
						</div>
					</div>

				</div>							

			<div class="ui form" id="add_news_form">

				<div class="field">
					<label>Tytuł</label>
					<textarea rows="1" name="title"></textarea>
					<div class="ui pointing red basic label ">
						Wypełnij to pole
					</div>
				</div>

				<div class="field">
					<label>Treść</label>					
					<textarea name="content"></textarea>
					<div class="ui pointing red basic label ">
						Wypełnij to pole
					</div>
				</div>

				<div class="field">
					<div class="ui checkbox">
						<input type="checkbox" name="is_public" checked>
						<label>Publiczny</label>
					</div>
				</div>

				<div class="field">
					extra options news
					@if(isset($news_settings))
					<br>
						{{$news_settings}}

					@endif
				</div>

				{{-- BUTTONS --}}
				<div class="ui left floated negative button">
					<i class="cancel icon"></i>
					Anuluj
				</div>


				<div class="ui right floated primary button">
					Podgląd
					<i class="right chevron icon"></i>
				</div>

			</div>
		
	</div>

</div>