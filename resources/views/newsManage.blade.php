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
		
		@slot("header")
		<i class="newspaper icon"></i>
		Newsy
		@endslot

		@slot("options")

		<div class="ui segment">
			<h2><i class="search icon"></i>Filtry</h2>

			<div class="ui divider"></div>

			<div id="parameters" hidden>
			@if(isset($params))
				{{ json_encode($params) }}
			@endif
			</div>

			<div class="ui options segment">
				<form class="ui filters form" action="{{ route("news.manage.get") }}" method="get">
					<div class="three fields">
						<div class="field">
							<label>Tytuł</label>
							<input type="text" name="title" placeholder="Tytuł" @if(isset($params["title"])) value="{{$params["title"]}}" @endif>
						</div>
						<div class="field">
							<label>Autor</label>
							<input type="text" name="author" placeholder="Autor" @if(isset($params["author"])) value="{{$params["author"]}}" @endif>
						</div>
						<div class="field">
							<label>Status</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								@if(isset($params["status"]) && $params["status"] == "public") 
								<div class="text"> Publiczny </div>
								@elseif(isset($params["status"]) && $params["status"] == "private")
								<div class="text"> Prywatny </div>
								@else
								<div class="default text">Status</div>
								@endif
								<div class="menu">
									<div class="item" data-value="public">Publiczny</div>
									<div class="item" data-value="private">Prywatny</div>
								</div>
							</div>
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Data publikacji</label>
							<div class="ui calendar" id="publish_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="publish_at_date">
									<input type="text" name="publish_at_date_parsed"  hidden>
								</div>						
							</div>				
						</div>
						<div class="field">
							<label>Data wygaśnięcia</label>
							<div class="ui calendar" id="expire_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="expire_at_date" >
									<input type="text" name="expire_at_date_parsed"  hidden>
								</div>						
							</div>
						</div>
						<div class="field">
							<label>Data utworzenia</label>
							<div class="ui calendar" id="created_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="created_at_date" >
									<input type="text" name="created_at_date_parsed"  hidden>
								</div>						
							</div>	
						</div>
						<div class="field">
							<label>Data ostatniej edycji</label>
							<div class="ui calendar" id="updated_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="updated_at_date" >
									<input type="text" name="updated_at_date_parsed"  hidden>
								</div>						
							</div>	
						</div>
					</div>

					<button class="ui submit search left floated button"><i class="search icon"></i>Szukaj</button>
				</form>
				<button class="ui clear_search button" data-url="{{ route('news.manage.get') }}">
					<i class="close icon"></i>Wyczyść
				</button>
				<button class="ui add_news button" data-url="{{ route('news.add.get') }}">
					<i class="newspaper icon"></i>Dodaj nowego newsa
				</button>
			</div>
		</div>

		@endslot

		@if(count($items) > 0)

		@slot("pagination")

		<div class="pagination_container">
			@include("templates/pagination")
		</div>

		@endslot

		@slot("headers")

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

		<div class="counter" style="color: black;">
			{{ $items_count }} / {{ $items_count_all }}
		</div>
		@endslot

		@slot("rows")

		@foreach($items as $item)

		<tr @if(isset($news_pinned) && $item->id == $news_pinned->news_id) class="pinned" @endif >
			<td>
				@if(isset($news_pinned) && $item->id == $news_pinned->news_id)
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
				@else
				<i class="ban icon"></i>
				@endif
			</td>
			<td>
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

				<div class="ui edit button" data-url="{{ route('news.edit.get', ['id' => $item->id])}} " data-inverted="" data-tooltip="Edytuj" data-position="bottom center"> <i class="configure icon"></i> </div>

				<div class="ui delete button" data-url="{{ route('news.delete.get', ['id' => $item->id])}}" data-inverted="" data-tooltip="Usuń" data-position="bottom center"> <i class="trash icon"></i> </div>

			</td>
		</tr>
		<tr class="preview_content" data-id="{{ $item->id }}" style="display: none !important;">
			<td colspan="{{ $columns_count }}">

				@if(isset($news_pinned) && $item->id == $news_pinned->news_id)
				@include("templates/newsPinned")
				@else
				@include("templates/news")
				@endif
			</td>
		</tr>

		@endforeach

		@endslot

		@else

		@slot("headers")
		@include("templates/noSearchResults")
		@endslot

		@slot("rows") @endslot

		@slot("pagination") @endslot

		@endif

		@endcomponent

	</div>
</div>

@component("templates/deleteAggrementModal")
@slot("header")
<i class="trash outline icon"></i>
Potwierdzenie usunięcia
@endslot

@slot("content")
<p>Czy na pewno chcesz usunąć wybrany element?</p>
@endslot

@slot("actions")
<div class="ui red basic cancel inverted button" >
	<i class="remove icon"></i>
	Anuluj
</div>
<div class="ui green ok inverted button">
	<i class="checkmark icon"></i>
	Usuń
</div>
@endslot
@endcomponent

@endsection

@section("scripts")
@parent
{!!Html::script("js/DateAnalyzer.js")!!}
{!!Html::script("js/newsManage.js")!!}
@endsection
