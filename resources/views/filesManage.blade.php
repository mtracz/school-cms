@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/mainLayout.css")!!}
{!!Html::style("css/filesManage.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="files_manage">

		@component("templates.manage")

		@slot("options")

		<div class="ui segment">
			<h2><i class="search icon"></i>Filtry</h2>

			<div class="ui divider"></div>

			<div class="ui options segment">
				<form class="ui filters form" action="{{ route("file.manage.get") }}" method="get">
					<div class="two fields">
						<div class="field">
							<label>Nazwa</label>
							<input type="text" name="name" placeholder="Nazwa" @if(isset($params["name"])) value="{{ $params['name'] }}" @endif>
						</div>
					</div>
					<button class="ui submit search left floated button"><i class="search icon"></i>Szukaj</button>
				</form>
				<button class="ui clear_search button" data-url="{{ route('file.manage.get') }}">
					<i class="close icon"></i>Wyczyść
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
				<th class="center"> Nazwa </th>
				<th class="center"> Akcje </th>

				<div class="counter" style="color: black;">
				{{ $items_count }} / {{ $items_count_all }}
				</div>
			@endslot

			@slot("rows")
				@foreach($items as $item)

				<tr>
					<td class="center">
						{{ $item["name"] }}
					</td>
					<td class="actions">
					{{-- set name for route !! --}}
						<div class="ui delete button" data-url="{{ route('file.delete.post', ["name" => $item['name'] ])}}" > <i class="trash icon"></i> </div>
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
{!!Html::script("js/filesManage.js")!!}
@endsection