

<div class="ui centered aligned grid" style='display: none;'>
<div class="center aligned column row">
	<div class="ui column " id="main_column">

		<div class="ui icon header centered aligned">
			<i class="user circle icon"></i>
			{{ $admin_header or ""}}
		</div>
				
		<form class="ui form" action="{{$admin_route or ""}}" method="post" id="admin_form">
			{{ csrf_field() }}
			<h3>Nazwa</h3>
			<div class="field four wide">
				<input name="name" placeholder="Tu wpisz nazwe" value="{{$editing_admin->name or ""}}">
				<div class="ui pointing red basic label hidden" id="name_warning">
					To pole musi być wypełnione
				</div>
			</div>

			<h3>Login</h3>
			<div class="field four wide">
				<input name="title" placeholder="Tu wpisz login" value="{{$editing_admin->login or ""}}">
				<div class="ui pointing red basic label hidden" id="login_warning">
					To pole musi być wypełnione
				</div>
			</div>

			<h3>Hasło</h3>
			<div class="field four wide">
				<input name="title" placeholder="Tu wpisz hasło" value="{{$editing_admin->password or ""}}">
				<div class="ui pointing red basic label hidden" id="password_warning">
					To pole musi być wypełnione
				</div>
			</div>

			<br>
			<div class="field">
				<div class="ui checkbox">
					@if(isset($editing_admin) && $editing_admin->is_active == false)
					<input type="checkbox" name="is_active">
					@else
					<input type="checkbox" name="is_active" checked>
					@endif
					<label>Aktywny</label>
				</div>
				<i class="world icon"></i>
			</div>	
		</form>

		<div id="errors_list" class="ui error message hidden">			
		</div>
		<br>
		{{-- BUTTONS --}}
		<div class="ui red centered floated circular button" id="cancel_button" 
		data-route="{{route('admin.manage.get')}}">
			<i class="cancel icon"></i>
			Anuluj
		</div>

		<div class="ui green centered floated circular button" id="public_button">
			<i class="check chevron icon"></i>
			Dodaj				
		</div>	

	</div>
</div>
</div>

<script type="text/javascript">
	
	$("#preview_news .column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );

</script>
