@extends("master")

@section("styles")

{!! Html::style("css/mainLayout.css") !!}
{!! Html::style("css/bottomSector.css") !!}

{!! Html::style("css/contrast.css") !!}

@include("templates.templates_styles")

@endsection

@section("content")

@inject("SectorHydratorService", "App\Services\SectorHydratorService")

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


						<div class="info panel">
							<div class="header fifth-color">
								dummy
							</div>
							<div class="content">

								dummy
							</div>
						</div>

						<div class="info panel">

							<div class="header fifth-color">Poczta dla nauczycieli</div><div class="content"><a href="https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000006-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid+profile&state=OpenIdConnect.AuthenticationProperties%3dEZdPaSYlmnvfVeRXQbeslVs9i-mtuVTd8cGU7ObLaIjgpfasMMgPF0_Ys13ECmJgsumgInkvuVkE_0cpvWolIsmbmyqrtabB0-tWoY01rsEFI6sAb7AiD27iGYVhRIl6g8W6Bip4D0yRPibORWTIKIQmdXGtVYkK6XHEc0ad0t40i-7kO8na8w-zd596N0Ct&nonce=636409908781488413.MmE1MGI5NzMtOGI5Ny00Nzk1LWI1YzAtZDM3YmVlMDJhZDJkYTczYWMzYzItZGZkNy00YjlmLWE2ZTAtMDEwYjNiOTY3MDk0&redirect_uri=https%3a%2f%2fportal.office.com%2flanding&ui_locales=pl-PL&mkt=pl-PL&client-request-id=9b3310a9-fe8e-4901-b184-598f20a7e5e9&msafed=0"><img src="http://sp9.legnica.pl/images_old/poczta.png"></a></div>
						</div>
						<div class="info panel">

							<div class="header fifth-color">Projekt unijny</div><div class="content"><a href="http://sp9.legnica.pl/images_old/articles/2017_18/Projekt_unijny.pdf"><img src="http://sp9.legnica.pl/images_old/articles/2017_18/PR.png"></a></div>
						</div>

						<div class="info panel">
							
							<div class="header fifth-color">Oddziały gimnazjalne</div><div class="content"><a href="http://www.gim5leg.pl/"><img src="http://sp9.legnica.pl/images_old/Oddzialy_gim1.png"></a><br><p style="text-align: justify;">Szkoła Podstawowa nr 9<br>Oddziały gimnazjalne<br>ul. Chojnowska 100<br>59-220 Legnica<br>tel.: 76 723 32 93<br></p></div>
						</div>

					</div>

				</div>

				<div id="bottom_sector" class="sixteen wide column sector">
					<div class="ui centered inside grid">
						<div class="row">

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
@endsection

@section("scripts")

{!! HTML::script("js/LayoutBuilder.js") !!}
{!! HTML::script("js/mainLayout.js") !!}

@include("templates.templates_scripts")

@endsection