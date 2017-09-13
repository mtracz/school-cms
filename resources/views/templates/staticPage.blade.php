@extends("mainLayout")

@section("styles")
	@parent

@endsection

@section("content_layout")

	<div class="column">
		<div class="row">
			<div class="page panel" style="max-width: 100%;">

				<div class="title first-color">
					{!! $page->title !!}
				</div>

				<div class="content editMe">
					{!! $page->content !!}	
				</div>
				
			</div>
		</div>
	</div>

@endsection

@section("scripts")
	@parent

@endsection