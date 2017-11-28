

<!-- {!! Html::style("css/addFile.css") !!}  -->

<div class="ui grid">

	<div class="ui segments file_background_segment">
		<div class="ui segment file_background_segment">
			<h3>Zarządzanie linkami</h3>
		</div>		

		<div class="ui segments">

			<div class="ui segment">
				<h5 class="links header">Utwórz link do </h5>

				<div class="ui form">
					<div class="fields">
						<div class="field dropdown" >
							<div class="ui action input" >
								<select class="ui search dropdown"
								data-news_link_route="{{route('news_links.list.get')}}" 
								data-page_link_route="{{route('pages_links.list.get')}}" 
								id="links_dropdown">
									<option value="">Wybierz element</option>
								</select>

							</div>
						</div>

						<div class="field">
							<button class="ui teal right labeled icon button" id="copy_to_clipboard_links">
								<i class="copy icon"></i>
								Kopiuj do schowka
							</button>
						</div>

					</div>
				</div>
			</div>

		</div>

	</div>
</div>

{!! Html::script("js/createLink.js") !!} 