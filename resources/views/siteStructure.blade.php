@extends("master")

@section("styles")

{!! Html::style("css/siteStructure.css") !!}

@endsection

@section("content")

<div class="ui container">

	<div class="ui button attach_fixed attach_left">left attach</div>
	<div class="ui button attach_fixed attach_right">right attach</div>
	<div style="clear: both;"></div>

	<div class="ui grid">

		<div id="top_1" class="sixteen wide column sector">

			<div class="ui segment">top_1 ipsu</div>
			
		</div>

		<div id="top_2" class="sixteen wide column sector">
			
			<div class="ui segment">top_2 ipsu</div>

		</div>

		<div id="top_3" class="sixteen wide column sector">
			
			<div class="ui segment">top_3 ipsu</div>

		</div>


		<div id="left" class="three wide column sector view_computer">

			<div class="ui segment">

				left ipsu<br/>
				left ipsu<br/>
				left ipsu<br/>
				left ipsu<br/>
				left ipsu<br/>
				left ipsu<br/>
				left ipsu<br/>

			</div>

		</div>

		<div id="content" class="ten wide column sector">

			<div class="ui segment">

				content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>
				
			</div>

		</div>

		<div id="right" class="three wide column sector view_computer">

			<div class="ui segment">

				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>
				right ipsu<br/>

			</div>

		</div>


		<div id="bottom" class="sixteen wide column sector">
			
			<div class="ui segment">bottom ipsu</div>

			
			
		</div>


	</div>

</div>
@endsection

@section("scripts")
	
	{!! HTML::script("js/siteStructure.js") !!}

@endsection