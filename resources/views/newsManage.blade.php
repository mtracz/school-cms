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

		@slot("options")

		<div class="ui segment">
			<h2><i class="search icon"></i>Opcje zarządzania</h2>

			<div class="ui divider"></div>

			<div class="ui options segment">
				<form class="ui form" action="" method="get">
					<div class="three fields">
						<div class="field">
							<label>Tytuł</label>
							<input type="text" name="title" placeholder="Tytuł">
						</div>
						<div class="field">
							<label>Autor</label>
							<input type="text" name="author" placeholder="Autor">
						</div>
						<div class="field">
							<label>Status</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								<div class="default text">Status</div>
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
									<input type="text" placeholder="Data" name="publish_at_date" >
								</div>						
							</div>				
						</div>
						<div class="field">
							<label>Data wygaśnięcia</label>
							<div class="ui calendar" id="expire_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="expire_at_date" >
								</div>						
							</div>
						</div>
						<div class="field">
							<label>Data utworzenia</label>
							<div class="ui calendar" id="created_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="created_at_date" >
								</div>						
							</div>	
						</div>
						<div class="field">
							<label>Data ostatniej edycji</label>
							<div class="ui calendar" id="updated_at_date">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" placeholder="Data" name="updated_at_date" >
								</div>						
							</div>	
						</div>
					</div>

					<button class="ui submit left floated button"><i class="search icon"></i>Szukaj</button>
				</form>
				<button class="ui add_news button" data-url="{{ route('news.add.get') }}">
					<i class="newspaper icon"></i>Dodaj nowego newsa
				</button>
			</div>
		</div>

		@endslot

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
				@else
				<i class="ban icon"></i>
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


{{-- <div class="ui grid">
						<div class="row">
							<div class="four wide column">
								<div class="ui right icon input">
									<input type="text">
									<i class="circular search link icon"></i>
								</div>
							</div>
							<div class="four wide column">
								
							</div>
							<div class="four wide column">
								
							</div>
							<div class="four wide column">
								
							</div>
						</div>
						<div class="bottom row">
							<div class="eight wide column">
								<div class="ui right action left icon search input center aligned">
									<i class="search icon"></i>
									<input type="text">
									<button class="ui search button">Szukaj</button>
								</div>
							</div>
							<div class="eight wide column">
								<button class="ui add_news button" data-url="{{ route('news.add.get') }}">
									<i class="newspaper icon"></i>Dodaj newsa
								</button>
							</div>
						</div>
					</div> --}}