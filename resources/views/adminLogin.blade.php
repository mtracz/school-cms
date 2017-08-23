@extends("master")
	
@section("styles")

	{!! Html::style("css/adminLogin.css") !!}

@endsection

@section("content")

	<div class="ui middle aligned center aligned grid">
	  <div class="main column">
	    <h2 class="ui teal image header">
	      <i class="key icon"></i>
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
	            <input type="text" name="login" placeholder="Login" id="login_input" tabindex="0" autofocus>
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

@endsection


@section("scripts")

	{!! Html::script("js/adminLogin.js") !!}

@endsection

