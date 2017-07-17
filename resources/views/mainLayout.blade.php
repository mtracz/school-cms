@extends("master")

@section("styles")

{!! Html::style("css/mainLayout.css") !!}

@endsection

@section("content")

<div class="ui container">

	<div class="ui button attach_fixed attach_left view_marker view_tablet view_mobile">left attach</div>
	<div class="ui button attach_fixed attach_right view_marker view_tablet view_mobile">right attach</div>
	<div style="clear: both;"></div>

	<div class="ui grid">

		<div id="top_1_sector" class="sixteen wide column sector">
			{{-- @foreach --}}
			{{-- @include(elementelementelement) --}}
		</div>

		<div id="top_2_sector" class="sixteen wide column sector">
			{{-- @foreach --}}
		</div>

		<div id="top_3_sector" class="sixteen wide column sector">
			{{-- @foreach --}}
		</div>

		<div class="ui row_container grid" style="width: 100%; padding: 0px; margin: 0px;">

			<div id="left_sector" class="three wide column sector view_marker view_computer">
				{{-- @foreach --}}
			</div>

			<div id="content_sector" class="ten wide column sector">

				@include("templates/element")

				@yield("content_layout")

				 mainLayout CONTENT


			</div>

			<div id="right_sector" class="three wide column sector view_marker view_computer">
				{{-- @foreach --}}
			</div>

		</div>


		<div id="bottom_sector" class="sixteen wide column sector">
			{{-- @foreach --}}
		</div>


	</div>

</div>
@endsection

@section("scripts")

{!! HTML::script("js/LayoutBuilder.js") !!}
{!! HTML::script("js/mainLayout.js") !!}

@endsection