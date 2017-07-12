<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	{{-- styles --}}
	{!! Html::style("css/semantic.min.css") !!}
	{!! Html::style("css/admin_login.css") !!}

</head>
<body>

	<div class="ui middle aligned center aligned grid">
	  <div class="column">
	    <h2 class="ui teal image header">
	      <img src="assets/images/logo.png" class="image">
	      <div class="content">
	        Logowanie do systemu
	      </div>
	    </h2>

	    <form class="ui large form" action="{{route("login.post")}}" id="login_form" type="post">
	    {{ csrf_field() }}
	      <div class="ui stacked segment">
	        <div class="field error" id="login_field">
	          <div class="ui left icon input">
	            <i class="user icon"></i>
	            <input type="text" name="login" placeholder="Login" id="login_input">
	          </div>
	        </div>
	        <div class="field error" id="password_field">
	          <div class="ui left icon input" >
	            <i class="lock icon"></i>
	            <input type="password" name="password" placeholder="Hasło" id="password_input">
	          </div>
	        </div>
	        <div class="ui fluid large teal submit button" id="login_button">Zaloguj</div>
	      </div>

	      <div class="errors" id="errors_list">	      	
	      </div>

	    </form>

	  </div>
	</div>

</body>
</html>

	{{-- scripts --}}

	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/jquery.min.js") !!}
	{!! Html::script("js/admin_login.js") !!}
