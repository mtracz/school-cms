@extends("mainLayout")

@section("content")	
<br><br><br><br><br><br><br>
	<div class="column upload form">                    

		<form action="{{route('file.add.post')}}" method="post" enctype="multipart/form-data" id="upload_file_form">
			{{csrf_field()}}
			<div class="inline fields">
				<div class="ui buttons">
					<button class="ui grey button select image" id="input_button">Wybierz plik</button>
					<div class="or" data-text=":"></div>
					<button class="ui basic button" id="file_name" disabled></button>
					<input type="file" accept=".pdf,.doc,.docx" name="file" id="file" hidden>
					<button class="ui positive button disabled" id="add_file_button">Dodaj</button>
				</div>  		
			</div>			
		</form>
	</div>
	<!-- ALERTS -->
	<span class="input alert" hidden></span>
	<!--  -->
@endsection

@section("scripts")
	@parent
	{!! Html::script("js/addFile.js") !!}
@endsection


