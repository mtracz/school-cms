

{!! Html::style("css/addFile.css") !!} 

<div class="ui grid">

	<div class="ui segments file_background_segment">
		<div class="ui segment file_background_segment">
			<h3>Zarządzanie plikami</h3>
		</div>		

		<div class="ui segments">

			<div class="two fields">
				<div class="field">

					<div class="ui segment">
						<h5>Dodaj plik</h5>
						<div class="ui form">
							<form action="{{route('file.add.post')}}" method="post" enctype="multipart/form-data" id="upload_file_form">
								{{csrf_field()}}

								<div class="fields">
									<div class="field choose_file">
										<button class="ui grey button select image" id="input_button">Wybierz plik</button>
										<input type="file" accept=".pdf,.doc,.docx" name="file" id="file" hidden>
									</div>
									<div class=" field file_name">
										<span id="file_name"></span>
									</div>					
								</div>
								<div class=" field">
									<button class="ui positive button disabled" id="add_file_button">Dodaj</button>								
								</div>
								<!-- ALERTS -->
								<div class="field">							
									<div class="input alert" hidden></div>	
								</div>
								<!--  -->									
							</form>

						</div>

					</div>

				</div>
				<div class="field">

					<div class="ui segment">
						<h5>Utwórz link do pliku </h5>

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

</div>

{!! Html::script("js/addFile.js") !!}
