@extends("master")

@section("styles")

{!! Html::style("css/mainLayout.css") !!}

@endsection

@section("content")

@inject("SectorHydratorService", "App\Services\SectorHydratorService")

<div class="ui container">

	<div class="ui button attach_fixed attach_left view_marker view_tablet view_mobile">left attach</div>
	<div class="ui button attach_fixed attach_right view_marker view_tablet view_mobile">right attach</div>
	<div style="clear: both;"></div>

	<div class="ui grid">

		<div id="top_1_sector" class="sixteen wide column sector">
			@php
				$element_model = $SectorHydratorService->hydrateTop_1();
			@endphp

			@include("templates/element")

		</div>

		<div id="top_2_sector" class="sixteen wide column sector">
			{{ $SectorHydratorService->hydrateTop_2() }}<br/>
		</div>

		<div id="top_3_sector" class="sixteen wide column sector">
			{{ $SectorHydratorService->hydrateTop_3() }}<br/>
		</div>

		<div class="ui row_container grid" style="width: 100%; padding: 0px; margin: 0px;">

			<div id="left_sector" class="three wide column sector view_marker view_computer">
				{{ $SectorHydratorService->hydrateLeft() }}
			</div>

			<div id="content_sector" class="ten wide column sector" style="background-color: #ccc;">

				@if(isset($news))

					@foreach($news as $singleNews)

						@include("templates/news")

					@endforeach

				@endif
				
				@yield("content")

				content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>content ipsu<br/>


			</div>

			<div id="right_sector" class="three wide column sector view_marker view_computer">
				{{ $SectorHydratorService->hydrateRight() }}
			</div>

		</div>


		<div id="bottom_sector" class="sixteen wide column sector">
			{{ $SectorHydratorService->hydrateBottom() }}
		</div>


	</div>

</div>
@endsection

@section("scripts")

{!! HTML::script("js/LayoutBuilder.js") !!}
{!! HTML::script("js/mainLayout.js") !!}

@endsection