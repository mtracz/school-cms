

<div class="ui centered aligned grid" style='display: none;'>

	<div class="ui column" id="main_column">

		<div class="ui icon header centered aligned">
			<i class="write icon"></i>		
			{{ $news_header or ""}}
			{{ $page_header or ""}}
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
			<div class="ui centered grid" style="padding: 20px">
				<div class="column">

					<div class="news panel">
						<div class="title fifth-color" id="preview_header">

						</div>

						<div class="content" id="preview_content">

						</div>

						<div class="ui bottom right attached label fifth-color" id="info_preview">

							<i class="user icon"></i>
							{{ Auth::user()->name }}
							<i class="calendar icon"></i><span class="date"></span>

						</div>

					</div>

				</div>
			</div>
		</div>

		<div class="ui form font_manager">
		<div class="inline fields font_manager_section">

			<div class="field font_color " >
				<div class="ui tiny button" id="change_font_color">
				Kolor czcionki:
				</div>
				<select name="colorpicker-picker-longlist-font-color">
					<option value="#000000">#000000</option>
					<option value="#ffffff">#ffffff</option>	
					<option value="#ac725e">#ac725e</option>
					<option value="#d06b64">#d06b64</option>
					<option value="#f83a22">#f83a22</option>
					<option value="#fa573c">#fa573c</option>
					<option value="#ff7537">#ff7537</option>
					<option value="#ffad46">#ffad46</option>
					<option value="#42d692">#42d692</option>
					<option value="#16a765">#16a765</option>
					<option value="#7bd148">#7bd148</option>
					<option value="#b3dc6c">#b3dc6c</option>
					<option value="#fbe983">#fbe983</option>
					<option value="#fad165">#fad165</option>
					<option value="#92e1c0">#92e1c0</option>
					<option value="#9fe1e7">#9fe1e7</option>
					<option value="#9fc6e7">#9fc6e7</option>
					<option value="#4986e7">#4986e7</option>
					<option value="#9a9cff">#9a9cff</option>
					<option value="#b99aff">#b99aff</option>
					<option value="#c2c2c2">#c2c2c2</option>
					<option value="#cabdbf">#cabdbf</option>
					<option value="#cca6ac">#cca6ac</option>
					<option value="#f691b2">#f691b2</option>
					<option value="#cd74e6">#cd74e6</option>
					<option value="#a47ae2">#a47ae2</option>
				</select>
			</div> 

			<div class="field font_background_color " >
				<div class="ui tiny button" id="change_font_background_color">
				Kolor tła:
				</div>
				<select name="colorpicker-picker-longlist-font-background-color">	     
					<option value="#000000">#000000</option>
					<option value="#ffffff">#ffffff</option>	
					<option value="#ac725e">#ac725e</option>
					<option value="#d06b64">#d06b64</option>
					<option value="#f83a22">#f83a22</option>
					<option value="#fa573c">#fa573c</option>
					<option value="#ff7537">#ff7537</option>
					<option value="#ffad46">#ffad46</option>
					<option value="#42d692">#42d692</option>
					<option value="#16a765">#16a765</option>
					<option value="#7bd148">#7bd148</option>
					<option value="#b3dc6c">#b3dc6c</option>
					<option value="#fbe983">#fbe983</option>
					<option value="#fad165">#fad165</option>
					<option value="#92e1c0">#92e1c0</option>
					<option value="#9fe1e7">#9fe1e7</option>
					<option value="#9fc6e7">#9fc6e7</option>
					<option value="#4986e7">#4986e7</option>
					<option value="#9a9cff">#9a9cff</option>
					<option value="#b99aff">#b99aff</option>
					<option value="#c2c2c2">#c2c2c2</option>
					<option value="#cabdbf">#cabdbf</option>
					<option value="#cca6ac">#cca6ac</option>
					<option value="#f691b2">#f691b2</option>
					<option value="#cd74e6">#cd74e6</option>
					<option value="#a47ae2">#a47ae2</option>
				</select>
			</div>

			<div class="field"></div>
				<div class="ui floating search dropdown icon button " id="change_font_size">
					<i class="text height icon"></i>
					<div class="menu">
						<div class="header">Rozmiar czcionki</div>
						<div class="item" data-value="13px">10</div>
						<div class="item" data-value="15px">11</div>
						<div class="item" data-value="16px">12</div>
						<div class="item" data-value="17px">13</div>
						<div class="item" data-value="19px">14</div>
						<div class="item" data-value="21px">15</div>
						<div class="item" data-value="22px">16</div>
						<div class="item" data-value="23px">17</div>
						<div class="item" data-value="24px">18</div>
						<div class="item" data-value="26px">20</div>
						<div class="item" data-value="29px">22</div>
						<div class="item" data-value="32px">24</div>
						<div class="item" data-value="35px">26</div>
						<div class="item" data-value="36px">27</div>
						<div class="item" data-value="37px">28</div>
						<div class="item" data-value="38px">29</div>
						<div class="item" data-value="40px">30</div>
						<div class="item" data-value="42px">32</div>
						<div class="item" data-value="45px">34</div>
						<div class="item" data-value="48px">36</div>
					</div>
				</div>
		</div>
		</div>

		<form class="ui form" action="{{$news_route or ""}}{{$page_route or ""}}" method="post" id="add_news_article_form">
			{{ csrf_field() }}
			<h3>Tytuł</h3>
			<div class="field">
				<input name="title" placeholder="Tu wpisz tytuł" value="{{$editing_news->title or ""}}{{$editing_page->title or ""}}">
				<div class="ui pointing red basic label hidden" id="title_warning">
					To pole musi być wypełnione
				</div>
			</div>

			<h3>Treść</h3>
			<div class="ui segment content " data-editable data-name="content" @if(isset($editing_news) || isset($editing_page)) data-editing_mode='true'@endif>
				{!!$editing_news->content or ""!!}
				{!!$editing_page->content or ""!!}
				{{-- <p class="title-only">title</p>
				<p class="image-only">image</p>
				<p class="links-only">links</p>
				<p> all</p> --}}
			</div>

			<div class="ui pointing red basic label hidden" id="content_warning">
				To pole musi być wypełnione		
			</div>
			<br>
			<div class="field">
				<div class="ui checkbox">
					@if(isset($editing_news) && $editing_news->is_public == false || isset($editing_page) && $editing_page->is_public == false)
					<input type="checkbox" name="is_public">
					@else
					<input type="checkbox" name="is_public" checked>
					@endif
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

<script type="text/javascript">
	
	$("#preview_news .column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );

</script>
