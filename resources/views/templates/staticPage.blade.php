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
			<div class="page panel" style="max-width: 100%;">

				<div class="title first-color">
					{!! $page->title !!}
				</div>

				<div class="content editMe">
					{!! $page->content !!}

					<!-- for news only -->
					@if($is_news_show)
					<div class="ui bottom right attached label fifth-color">
						<i class="user icon"></i>
						{!! $page->admin->name !!}
						&nbsp;&nbsp;&nbsp;&nbsp;
						<i class="calendar icon"></i>
						{!! $page->published_at !!}
					</div>
					@endif
					<!--  -->
				</div>
				
			</div>
		</div>
	</div>

@endsection

@section("scripts")
	@parent

@endsection