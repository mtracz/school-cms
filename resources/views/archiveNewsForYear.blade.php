@extends("mainLayout")

@section("styles")
		@parent
		{!! Html::style("css/archiveNewsForYear.css") !!} 
@endsection

@section("content_layout")

@php
$is_news_show = isset($show_news);
@endphp

<div class="column">
	<div class="row">
		<div class="page panel">

			<div class="title first-color">
				Archiwum newsów {{$year or ""}}
			</div>
			

			<div class="content editMe">

				<div class="ui middle aligned selection list">
					@foreach ($news_for_year as $key => $value)
					<div class="item" data-url="{{ route('news.show.get', $value['slug']) }}">
						<i class="ui newspaper right icon"></i>
						<div class="content archive_news_for_year_item_content">
							{{ $value["title"] }}
						</div>
					</div>	
					@endforeach	
				</div>

				<div class="pagination_container">
						@include("templates/pagination")
				</div>
				
			</div>	

		</div>
	</div>
</div>

@endsection

@section("scripts")
		@parent
		{!! Html::script("js/archiveNewsForYear.js") !!} 
@endsection