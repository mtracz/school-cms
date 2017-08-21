@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/mainLayout.css")!!}
{!!Html::style("css/newsManage.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="news_manage">

		@component("templates.manage")

		@slot("pagination")

		<div class="pagination_container">
			@include("templates/pagination")
		</div>

		@endslot

		@slot("headers")

		<th> ID </th>
		<th> Tytuł </th>
		<th> Zawartość </th>
		<th> Slug </th>
		<th> Autor </th>
		<th> Data publikacji </th>
		<th> Data wygaśnięcia </th>
		<th> Publiczny </th>
		<th> Data utworzenia </th>
		<th> Data ostatniej edycji </th>
		<th> Akcje </th>

		@endslot

		@slot("rows")

		@foreach($items as $item)

		<tr @if($item->id == $news_pinned->news_id) class="pinned" @endif >
			<td>
				{{ $item->id }}
			</td>
			<td>
			@if($item->id == $news_pinned->news_id)
				<i class="pin icon"></i>
			@endif
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
			<td data-publish_at="{{ strtotime($item->published_at) }}">
				{{ $item->published_at }}
			</td>
			<td data-expire_at="{{ strtotime($item->expire_at) }}">
				@if($item->expire_at)
					{{ $item->expire_at }}
				@endif
			</td>
			<td class="ui center aligned">
				@if( $item->is_public == 1)
				<i class="checkmark green icon"></i>
				@else
				<i class="remove red icon"></i>
				@endif
			</td>
			<td data-created_at="{{ strtotime($item->created_at) }}">
				{{ $item->created_at }}
			</td>
			<td data-updated_at="{{ strtotime($item->updated_at) }}">
				{{ $item->updated_at }}
			</td>
			<td class="actions">

				<div class="ui edit button" data-url="{{ route('news.edit.get', ['id' => $item->id])}} "> <i class="configure icon"></i> </div>
				<div class="ui delete button" data-url="{{ route('news.delete.get', ['id' => $item->id])}}"> <i class="trash icon"></i> </div>

			</td>
		</tr>
		<tr class="preview_content" data-id="{{ $item->id }}" style="display: none;">
			<td colspan="{{ $columns_count }}">

				@if($item->id == $news_pinned->news_id)
				@include("templates/newsPinned")
				@else
				@include("templates/news")
				@endif
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