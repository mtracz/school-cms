@extends("master")

@section("styles")

{!! Html::style("css/mainLayout.css") !!}

@endsection

@section("content")

@inject("SectorHydratorService", "App\Services\SectorHydratorService")

<div class="ui container">
	<div class="ui active page dimmer">
		<div class="ui active text massive loader">
			Ładowanie strony...
		</div>
	</div>

	<div class="ui main segment" style="display: none;">

		<div class="ui grid">
			<div class="row">

				<div id="top_1_sector" class="sixteen wide column sector">

					@php
					$element_model = $SectorHydratorService->hydrateTop_1();
					@endphp

					@include("templates/element")

				</div>

				<div id="top_2_sector" class="sixteen wide column sector">

					@php
					$element_model = $SectorHydratorService->hydrateTop_2();
					@endphp

					@include("templates/element")

				</div>

				<div id="top_3_sector" class="sixteen wide column sector">

					@php
					$element_model = $SectorHydratorService->hydrateTop_3();
					@endphp

					@include("templates/element")

				</div>

				<div class="ui inside grid row_container">


					<div id="left_sector" class="three wide column sector view_marker view_computer">

						@php
						$element_model = $SectorHydratorService->hydrateLeft();
						@endphp

						@include("templates/element")

					</div>

					<div id="content_sector" class="ten wide column sector">

						@if(isset($news))

							@if(isset($news_pinned))

								@include("templates/newsPinned")

							@endif

							@foreach($news as $singleNews)

								@if($singleNews->id != $news_pinned->news_id)

								@include("templates/news")

								@endif

							@endforeach

						@endif

						@yield("content_layout")

					</div>

					<div id="right_sector" class="three wide column sector view_marker view_computer">

						@php
						$element_model = $SectorHydratorService->hydrateRight();
						@endphp

						@include("templates/element")

					</div>


				</div>

				<div id="bottom_sector" class="sixteen wide column sector">
					<div class="ui centered inside grid">

						@php
						$element_model = $SectorHydratorService->hydrateBottom();
						@endphp

						@include("templates/element")
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection

@section("scripts")

{!! HTML::script("js/LayoutBuilder.js") !!}
{!! HTML::script("js/mainLayout.js") !!}

@endsection