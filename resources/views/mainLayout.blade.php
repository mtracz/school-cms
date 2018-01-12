@extends("master")

@section("styles")

{!! Html::style("css/mainLayout.css") !!}
{!! Html::style("css/bottomSector.css") !!}

{!! Html::style("css/contrast.css") !!}

@include("templates.templates_styles")

@endsection

@section("content")

@inject("SectorHydratorService", "App\Services\SectorHydratorService")

<div class="ui left sidebar">
	@php
	$element_model = $SectorHydratorService->hydrateLeft();
	@endphp

	@include("templates/element")
</div>
<div class="ui right sidebar">
	@php
	$element_model = $SectorHydratorService->hydrateRight();
	@endphp

	@include("templates/element")
</div>
<div class="pusher">
	<div class="ui container">

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

							@foreach($news as $item)

							@include("templates/news")

							@endforeach

							<div class="ui segment">
								<div class="ui center grid">
									<div class="pagination_container">

										@include("templates/pagination")

									</div>
								</div>
							</div>

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
							<div class="doubling two column row">

								@php
								$element_model = $SectorHydratorService->hydrateBottom();
								@endphp

								@include("templates/element")
							</div>

							@include("footerStaticData")
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

</div>

<!-- SCROLL TOP -->
<button class="ui tiny button attach_fixed_bottom attach_right" id="go_top" style="display: none;">
	<i class="chevron circle up icon"></i> Do góry
</button>
<!--  -->

<!-- SIDEBAR LEFT -->
<button class="ui tiny button attach_fixed attach_left view_marker view_mobile view_tablet ">
	<i class="arrow right icon"></i>
</button>
<!--  -->

<!-- SIDEBAR RIGHT -->
<button class="ui tiny button attach_fixed attach_right view_marker view_mobile view_tablet ">
	<i class="arrow left icon"></i>
</button>
<!--  -->

@endsection

@section("scripts")

{!! HTML::script("js/LayoutBuilder.js") !!}
{!! HTML::script("js/mainLayout.js") !!}

@include("templates.templates_scripts")

@endsection