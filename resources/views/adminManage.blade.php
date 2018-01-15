@extends("mainLayout")

@section("styles")
@parent
{!!Html::style("css/mainLayout.css")!!}
{!!Html::style("css/pagesManage.css")!!}
@endsection

@section("content")

<div class="ui container">

	<div class="air_bag"></div>
	<div class="admins_manage">

		@component("templates.manage")

		@slot("header")
			<i class="users icon"></i>
			Administratorzy
		@endslot

		@slot("options")
		 <div class="ui options segment">
			<button class="ui add_admin button" data-url="{{ route('admin.add.get') }}">
				<i class="file icon"></i>Dodaj administratora
			</button>
		</div>
		<!-- <div class="ui segment">
			<h2><i class="search icon"></i>Filtry</h2>

			<div class="ui divider"></div>

			<div class="ui options segment">
				<form class="ui filters form" action="{{ route("admin.manage.get") }}" method="get">

					<div class="three fields">
						<div class="field">
							<label>Nazwa</label>
							<input type="text" name="title" placeholder="Nazwa" @if(isset($params["title"])) value="{{ $params['title'] }}" @endif>
						</div>						
						<div class="field">
							<label>Super administrator</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								@if(isset($params["status"]) && $params["status"] == "private")
								<div class="text"> Tak </div>
								@elseif(isset($params["status"]) && $params["status"] == "public")
								<div class="text"> Nie </div>
								@else
								<div class="default text"> Tak / Nie </div>
								@endif
								<div class="menu">
									<div class="item" data-value="public">Tak</div>
									<div class="item" data-value="private">Nie</div>
								</div>
							</div>
						</div>
						<div class="field">
							<label>Aktywny</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								@if(isset($params["status"]) && $params["status"] == "private")
								<div class="text"> Aktywny </div>
								@elseif(isset($params["status"]) && $params["status"] == "public")
								<div class="text"> Nieaktywny </div>
								@else
								<div class="default text"> Aktywny / Nieaktywny </div>
								@endif
								<div class="menu">
									<div class="item" data-value="public">Aktywny</div>
									<div class="item" data-value="private">Nieaktywny</div>
								</div>
							</div>
						</div>
					</div>					
					<button class="ui submit search left floated button"><i class="search icon"></i>Szukaj</button>
				</form>
				<button class="ui clear_search button" data-url="{{ route('admin.manage.get') }}">
					<i class="close icon"></i>Wyczyść
				</button>
				<button class="ui add_admin button" data-url="{{ route('admin.add.get') }}">
					<i class="file icon"></i>Dodaj administratora
				</button>
			</div>
		</div> -->

		@endslot

		@if($admins && count($admins) > 0)

			@slot("pagination")

			<!-- <div class="pagination_container">
				include("templates/pagination")
			</div> -->
			
			@endslot


			@slot("headers")
				<th class="center"> Nazwa </th>
				<th class="center"> Login </th>
				<th class="center"> Super administrator </th>
				<th class="center"> Aktywny </th>
				<th class="center"> Data utworzenia </th>
				<th class="center"> Akcje </th>

				<div class="counter" style="color: black;">
				{{-- {{ $items_count }} / {{ $items_count_all }} --}}
				</div>
			@endslot

			@slot("rows")

				@foreach($admins as $admin)

				<tr>
					<td class="center">
						{{ $admin->name }}
					</td>
					<td class="center">
						{{ $admin->login }}
					</td>
					<td class="center">
						@if( $admin->is_super_admin == 1)
						<i class="checkmark green icon"></i>
						@else
						<i class="remove red icon"></i>
						@endif
					</td>
					<td class="center">
						@if( $admin->is_active == 1)
						<i class="checkmark green icon"></i>
						@else
						<i class="remove red icon"></i>
						@endif
					</td>
					<td class="center" data-created_at="{{ strtotime($admin->created_at) }}">
						{{ $admin->created_at }}
					</td>

					<td class="actions">

						<div class="ui edit button" data-url="{{ route('admin.edit.get', ['id' => $admin->id])}} " data-inverted="" data-tooltip="Edytuj" data-position="bottom center"> <i class="configure icon"></i> </div>

						@if(!$admin->is_super_admin == 1)
							<div class="ui delete button" data-url="{{ route('admin.delete.post', ['id' => $admin->id])}}" data-inverted="" data-tooltip="Usuń" data-position="bottom center"> <i class="trash icon"></i> </div>
						@endif					

					</td>
				</tr>

				@endforeach

			@endslot

			@slot("pagination")

				<!-- <div class="pagination_container">
					include("templates/pagination")
				</div> -->

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
			<p>Czy na pewno chcesz usunąć wybranego administratora?</p>
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
{!!Html::script("js/adminsManage.js")!!}
@endsection