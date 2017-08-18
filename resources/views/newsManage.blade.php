@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/newsManage.css")!!}
{!!Html::style("css/mainLayout.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="news_manage table">

		@component("templates.table")

		@slot("headers")

		@foreach($items[0]->getAttributes() as $key => $value)

		<th>{{ $key }}</th>

		@endforeach

		@endslot

		@slot("rows")

		@foreach($items as $item)

		<tr>
			<td>
				{{ $item->id }}
			</td>
			<td>
				{{ $item->title }}
			</td>
			<td>
				<button class="ui button preview_toggle_button" data-id={{ $item->id }}>Podgląd</button>
			</td>
			<td>
				{{ $item->slug }}
			</td>
			<td>
				{{ $item->admin->name }}
			</td>
			<td>
				{{ $item->published_at }}
			<td>
			</td>
				{{ $item->expire_at }}
			</td>
			<td>
				{{ $item->is_public }}
			</td>
			<td>
				{{ $item->created_at }}
			</td>
			<td>
				{{ $item->updated_at }}
			</td>
		</tr>
		<tr class="preview_content" data-id={{ $item->id }} style="display: none;">
			<td colspan="{{ $columns_count }}">
					@include("templates/news")
			</td>
		</tr>

		@endforeach

		@endslot

		@endcomponent

	</div>
</div>

@endsection

@section("scripts")
@parent
{!!Html::script("js/newsManage.js")!!}
@endsection