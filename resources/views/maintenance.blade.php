@extends("master")

@section("styles")

{!! Html::style("css/maintenance.css") !!}

@endsection

@section("content")

<div class="ui container fluid maintenance_content">
	<h3 class="site_title"></h3>
	<div class="ui divider"></div>
	<p class="maintenance_text"></p>
</div>

@endsection
