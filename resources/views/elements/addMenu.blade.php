@extends("mainLayout")

@section("styles")
@parent
{!! Html::style("css/menuAddEdit.css") !!}
@endsection


@section("content")
<br><br><br>
<div class="ui centered aligned grid">

	<div class="column">

		<form class="ui form" action="" method="post" id="menu_form">
			{{ csrf_field() }}

			<div class="six wide field focus">
				<label>Nazwa</label>
				<input type="text" placeholder="Nazwa menu" autofocus name="menu_name">
			</div>		

			<h5>Dodaj element</h5>
			<div class="field">
				<div>Kolejność</div>
				<div class="ui icon buttons">
					<div class="ui button"><i class="long left arrow icon"></i></div>
					<div class="ui button"><i class="long right arrow icon"></i></div>
				</div>
			</div>

			{{-- TABS START --}}
			<div class="ui top attached tabular menu">

				<a class="item active" data-tab="1">1</a>

				<div class="ui icon buttons add_tab_div">
					<div class="compact ui positive button" id="add_tab"><i class="add circle large icon"></i>
					</div>
				</div>
			</div>
			{{-- END TABS --}}

			{{-- TAB CONTENT --}}
			<div class="tabs_content">		

				<div class="ui bottom attached tab segment active" data-tab="1">
					
					<div class="fields">
						<div class="inline fields">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden" name="is_dropdown_tab_1" id="is_dropdown_tab_1">
								<label>Dropdown</label>
							</div>
						</div>
						<div class="inline fields dropdown_name dropdown_name_tab_1" style='display: none;'>
							<label>Nazwa</label >
							<input type="text" placeholder="Nazwa" name="item_name_tab_1">
						</div>
					</div>
					<div class="fields elements_tab_1">
						<div class=" field">
							<div class="circular ui icon button order" disabled>
							<span class="element_order_tab_1_1">1</span>			
							</div>
						</div>
						<div class="five wide field">
							<label>Nazwa</label>
							<input type="text" placeholder="Nazwa elementu" name="element_name_tab_1_1">
						</div>	
						<div class="five wide field">
							<label>URL</label>
							<input type="text" placeholder="URL elementu" name="element_url_tab_1_1">						
						</div>
						<div class="field">
							<div class="ui icon buttons actions">
								<div class="ui negative button element_remove_tab_1_1"><i class="remove icon"></i>
								</div>

								<div class="ui button element_move_up_tab_1_1"><i class="long arrow up icon"></i>
								</div>
								<div class="ui button element_move_down_tab_1_1"><i class="long arrow down icon"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="fourteen wide field add_new_element_tab_1" hidden>
						<div class="fluid ui positive button"><i class="plus icon"></i>
						</div>
					</div>

				</div>
			</div>
			{{-- END TAB CONTENT --}}
		
			<br>
			{{-- buttons --}}
			<div class="ui red left floated circular button">
				<i class="cancel icon"></i>
				Anuluj
			</div>
			<div class="ui blue right floated circular button" >
				<i class="save icon"></i>
				Zapisz
			</div>

		</form>

	</div>

</div>

@endsection

@section("scripts")
@parent
{!! Html::script("js/menuAddEdit.js") !!}
@endsection
