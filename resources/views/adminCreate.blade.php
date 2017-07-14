@extends("master")

@section("styles")

	{!! Html::style("css/adminCreate.css") !!}

@endsection


@section("content")

	<div class="ui container">
		<div class="ui icon centered aligned header">
			<i class="user icon"></i>
			Logowanie do systemu CMS
		</div>
		<div class="ui divider"></div><br>
		<div class="information">
			<i class="info icon"></i>
			<br>
			<span>
				Nie znaleziono konta super administratora.<br> Prawdopodobnie logujesz się po raz pierwszy. 
				<br><br>
				Stwórz konto, którego bedziesz używał/ła do logowania w systemie.
			</span>
		</div>
		</div><br>
		<div class="ui divider">
		<br><br>

		<form action="{{route("register.post")}}" method="post" id="create_super_admin_form" class="ui form">
			{{ csrf_field() }}

			<div class="ui six column grid container">

				{{-- <div class="column centered aligned row"> --}}
					<div class="ui segment">
					<div class="column centered aligned row">		<div class="column">
								<div class="error field required" id="super_admin_login">
									<label>Login</label>
									<input placeholder="wpisz login" name="login" id="super_admin_login_input">
								</div>	
							</div>
					</div>
					</div>					
				{{-- </div> --}}

				<div class="column centered aligned row">
					<div class="column">
						<div class="error field required" id="super_admin_password">
							<label>Hasło</label>
							<input type="password" placeholder="wpisz hasło" name="password" id="super_admin_password_input">
						</div>
					</div>				
				</div>

				<div class="column centered aligned row">
					<div class="column">
						<div class="error field required" id="super_admin_password_confirmation">
							<label>Powtórz hasło</label>
							<input type="password" placeholder="powtórz hasło" name="password_confirmation" id="super_admin_password_confirmation_input">
						</div>
					</div>				
				</div>

				<div class="column centered aligned row">
					<div class="column">
						<div class="error field required" id="super_admin_email">
							<label>Email</label>
							<input type="text" placeholder="wpisz email" name="email" id="super_admin_email_input">
						</div>
						<p class="email info">
							<i class="email info circle icon"></i>
							Na ten email będą przychodziły wiadomości ze strony.
						</p>	
						<p class="required info">
							* pola wymgane, min. 6 znaków
						</p>			
					</div>
				</div>	

				<div class="column centered aligned row">
					<div class="column centered aligned">
						<button class="ui inverted button" id="create_super_admin">Stwórz</button>
					</div> 
					<div class="ui divider">				
 				</div>

				<div class="errors column centered aligned row">
					<div class="column" id="errors_list">				
					</div>						
				</div>	

			</div>		
 		</form>	
	</div>

@endsection


@section("scripts")

	{!! Html::script("js/adminCreate.js") !!}

@endsection
