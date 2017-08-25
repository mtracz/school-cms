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
				<form class="ui filters form" action="{{ route("page.manage.get") }}" method="get">

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
					<div class="two fields">
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
				<button class="ui add_pages button" data-url="{{ route('page.add.get') }}">
					<i class="file icon"></i>Dodaj nową stronę
				</button>
			</div>
		</div>

		@endslot

		@slot("pagination")

		{{-- <div class="pagination_container">
			@include("templates/pagination")
		</div>
		--}}

		<div class="air_bag"></div>
		@endslot


		@slot("headers")
		<th> 1 </th>
		@endslot

		@slot("rows")
		<tr>
			<td> temp </td>
		</tr>

		@endslot


		@slot("pagination")

		{{-- <div class="pagination_container">
			@include("templates/pagination")
		</div> --}}

		@endslot

		@endcomponent
	</div>
</div>

@endsection

@section("scripts")
@parent
{!!Html::script("js/pagesManage.js")!!}
@endsection