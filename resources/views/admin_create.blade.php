<!DOCTYPE html>
<html>
<head>
	{{-- styles --}}
	{!! Html::style("css/semantic.min.css") !!}
</head>
<body>
	
	<!-- Sign up modal -->
<div class="ui basic  sign-up-modal">
	<div class="ui icon header">
		<i class="user icon"></i>
		Sign up
	</div>
	<div class="ui divider"></div>
	<div class="content">
		<form action=" " method="post" id="sign-up-form" class="ui inverted form">
			{{ csrf_field() }}
			<div class="two fields">
				<div class="field required">
					<label> Login </label>
					<input placeholder="Login" name="login" id="login" type="text" value=" {{ old("login") }}" tabindex="1">
				</div>
				<div class="field required">
					<label> Password </label>
					<input type="password" placeholder="Password" name="password" id="password" type="text" tabindex="2">
				</div>
			</div>
			<div class="two fields">
				<div class="field required">
					<label> Email </label>
					<input placeholder="Email" name="email" id="email" type="text" value="{{ old('email') }}" tabindex="4">
				</div>
				<div class="field required">
					<label> Confirm password </label>
					<input type="password" placeholder="Confirm password" name="password_confirmation" id="password_confirmation" tabindex="3">
				</div>
			</div>

			{{-- Front end errors --}}
			<div class="ui inverted error message">
			</div>

			{{-- Back end errors --}}
			<div class="ui bottom inverted message error_messages">
				<div class="ui bulleted list error_list">
					
				</div>
			</div>
		</form>

	</div>
	<div class="ui divider"></div>
	
	<div class="actions">
		<button class="cancel_button ui red basic cancel deny inverted button" tabindex="6" data-content="cokolwiek">
			<i class="remove icon"></i>
			"Cancel"
		</button>
		<button class="submit_button ui green ok inverted button" form="sign-up-form" type="submit" tabindex="5">
			<i class="arrow circle outline up icon" ></i>
			"Sign up"
		</button>
		<button class="ok_button ui green inverted button">
			<i class="checkmark icon" ></i>
				Ok
		</button>
	</div>
</div>

</body>
</html>

{{-- scripts --}}
{!! Html::script("js/semantic.min.js") !!}
{!! Html::script("js/jquery.min.js") !!}