@extends("mainLayout")

@section("styles")
	@parent

@endsection

@section("content_layout")

	@php
		$is_news_show = isset($show_news);
	@endphp

	<div class="column">
		<div class="row">
			<div class="page panel">

				<div class="title first-color">
					Archiwum newsów
				</div>

				<div class="content editMe">
					<table class="ui striped table">
						<thead >
							<tr>
								<th>Rok</th>
								<th class="center aligned">Liczba newsów</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
					@foreach ($news_years_count as $key => $value)
					
							<tr>
								<td class="left aligned">
									{{ $value["year"] }}
								</td>
								<td class="center aligned">
									{{ $value["count"] }}
								</td>
								<td class="center aligned">
									<button class="ui grey circular button show" data-url="{{ route("archiveYear.show.get", [ $value['year'] ]) }}">
										<i class="ui browser icon "></i>
										Pokaż wszystkie
									</button>
								</td>
							</tr>								
						
					@endforeach
					</tbody>
					</table>
				</div>	
				
			</div>
		</div>
	</div>

@endsection

@section("scripts")
	@parent
	{!! Html::script("js/archiveNews.js") !!} 
@endsection