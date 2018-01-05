

<div class="ui centered aligned grid" style='display: none;'>

	<div class="ui column " id="main_column">

		<div class="ui icon header centered aligned">
			<i class="user circle icon"></i>
			{{ $admin_header or ""}}
		</div>
				
		<form class="ui form" action="{{$admin_route or ""}}" method="post" id="admin_form">
			{{ csrf_field() }}
			<div class="ui four column grid container">
				
				<div class="column centered aligned row">		
					<div class="column">
						<br>
						<div class="field name">
							<h3>Nazwa</h3>
							<input name="name" placeholder="Tu wpisz nazwe" value="{{$editing_admin->name or ""}}">
						</div>
					</div>
				</div>

				<div class="column centered aligned row">
					<div class="column">
						<br>
						<div class="field login">
							<h3>Login</h3>
							<input name="login" placeholder="Tu wpisz login" value="{{$editing_admin->login or ""}}">
						</div>	
					</div>
				</div>

				<div class="column centered aligned row">		
					<div class="column">
						<br>
						<div class="field password">
							<h3>Hasło</h3>
							<input name="password" type="password" placeholder="Tu wpisz hasło" @if(isset($editing_admin)) disabled @endif>
						</div>
						@if(isset($editing_admin))
						<div class="ui tiny button" id="reset_password_button">		
							<i class="refresh icon"></i>
							Resetuj hasło
						</div>
						@endif
					</div>
					
				</div>
				<br>
				<div class="column centered aligned row">		
					<div class="column">
						<br>
							<div class="ui checkbox">
								@if(isset($editing_admin) && $editing_admin->is_active == false)
								<input type="checkbox" name="is_active">
								@else
								<input type="checkbox" name="is_active" checked>
								@endif
								<label>Aktywny</label>
							</div>
							<i class="add user icon"></i>							
					</div>
				</div>

				<div class="column centered aligned row">		
					<div class="column">
						<br>
							{{-- BUTTONS --}}
							<div class="ui red left floated circular button" id="cancel_button" 
							data-route="{{route('admin.manage.get')}}">
							<i class="cancel icon"></i>
							Anuluj
						</div>

						<div class="ui green right floated circular button" id="save_button">
							<i class="check chevron icon"></i>
							@if(isset($editing_admin)) 
								Zapisz
							@else 
								Dodaj				
							@endif
						</div>	
				
					</div>
				</div>			

			</div>
		</form>
		<br>
		<div id="errors_list" class="ui error message hidden">	

		</div>
	</div>

</div>

