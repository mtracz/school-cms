

<!-- {!! Html::style("css/addFile.css") !!}  -->

<div class="ui grid">

	<div class="ui segments file_background_segment">
		<div class="ui segment file_background_segment">
			<h3>Zarządzanie linkami</h3>
		</div>		

		<div class="ui segments">

			<div class="ui segment">
				<h5>Utwórz link do </h5>

				<div class="ui form">
					<div class="fields ">
						<div class="field dropdown">
							<div class="ui action input" >
								<select class="ui search dropdown" data-file_route="{{route('file.list.get')}}" id="files_dropdown">
									<option value="">Wybierz plik</option>
								</select>

							</div>
						</div>

						<div class="field">
							<button class="ui teal right labeled icon button" id="copy_to_clipboard">
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

<!-- {!! Html::script("js/addFile.js") !!} --> 
