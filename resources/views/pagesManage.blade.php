@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/mainLayout.css")!!}
{!!Html::style("css/pagesManage.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="pages_manage">

		@component("templates.manage")

		@slot("options")

		<div class="ui segment">
			<h2><i class="search icon"></i>Filtry</h2>

			<div class="ui divider"></div>

			<div class="ui options segment">
				<form class="ui filters form" action="{{ route("pages.manage.get") }}" method="get">

					<div class="three fields">
						<div class="field">
							<label>Tytuł</label>
							<input type="text" name="title" placeholder="Tytuł" @if(isset($params["title"])) value="{{ $params['title'] }}" @endif>
						</div>
						<div class="field">
							<label>Autor</label>
							<input type="text" name="author" placeholder="Autor" @if(isset($params["title"])) value="{{ $params['author'] }}" @endif>
						</div>
						<div class="field">
							<label>Status</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								@if(isset($params["status"]) && $params["status"] == "private")
								<div class="text"> Prywatny </div>
								@elseif(isset($params["status"]) && $params["status"] == "public")
								<div class="text"> Publiczny </div>
								@else
								<div class="default text"> Status </div>
								@endif
								<div class="menu">
									<div class="item" data-value="public">Publiczny</div>
									<div class="item" data-value="private">Prywatny</div>
								</div>
							</div>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Data utworzenia</label>
							<div class="ui calendar" id="created_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="created_at_date" @if(isset($params["created_at_date"])) value="{{ $params['created_at_date'] }}" @endif>
									<input type="text" name="created_at_date_parsed"  hidden>
								</div>						
							</div>
						</div>
						<div class="field">
							<label>Data ostatniej edycji</label>
							<div class="ui calendar" id="updated_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="updated_at_date" @if(isset($params["updated_at_date"])) value="{{ $params['updated_at_date'] }}" @endif>
									<input type="text" name="updated_at_date_parsed"  hidden>
								</div>						
							</div>
						</div>
					</div>
					<button class="ui submit search left floated button"><i class="search icon"></i>Szukaj</button>
				</form>
				<button class="ui clear_search button" data-url="{{ route('pages.manage.get') }}">
					<i class="close icon"></i>Wyczyść
				</button>
				<button class="ui add_pages button" data-url="{{ route('page.add.get') }}">
					<i class="file icon"></i>Dodaj nową stronę
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
				<th class="center"> Tytuł </th>
				<th class="center"> Autor </th>
				<th class="center"> Publiczna </th>
				<th class="center"> Data utworzenia </th>
				<th class="center"> Data ostatniej edycji </th>
				<th class="center"> Akcje </th>

				<div class="counter" style="color: black;">
				{{ $items_count }} / {{ $items_count_all }}
				</div>
			@endslot

			@slot("rows")

				@foreach($items as $item)

				<tr>
					<td class="center">
						{{ $item->title }}
					</td>
					<td class="center">
						{{ $item->admin->name }}
					</td>
					<td class="center">
						@if( $item->is_public == 1)
						<i class="checkmark green icon"></i>
						@else
						<i class="remove red icon"></i>
						@endif
					</td>
					<td class="center" data-created_at="{{ strtotime($item->created_at) }}">
						{{ $item->created_at }}
					</td>
					<td class="center" data-updated_at="{{ strtotime($item->updated_at) }}">
						{{ $item->updated_at }}
					</td>
					<td class="actions">

						<div class="ui edit button" data-url="{{ route('page.edit.get', ['id' => $item->id])}} "> <i class="configure icon"></i> </div>

						<div class="ui delete button" data-url="{{ route('page.delete.post', ['id' => $item->id])}}"> <i class="trash icon"></i> </div>

					</td>
				</tr>

				@endforeach

			@endslot

			@slot("pagination")

				<div class="pagination_container">
					@include("templates/pagination")
				</div>

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



@endsection

@section("scripts")
@parent
{!!Html::script("js/pagesManage.js")!!}
@endsection