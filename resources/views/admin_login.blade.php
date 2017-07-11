<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	{{-- styles --}}
	{!! Html::style("css/semantic.min.css") !!}

</head>
<body>

	<div class="ui middle aligned center aligned grid">
	  <div class="column">
	    <h2 class="ui teal image header">
	      <img src="assets/images/logo.png" class="image">
	      <div class="content">
	        Log-in to your account
	      </div>
	    </h2>
	    <form class="ui large form">
	      <div class="ui stacked segment">
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="user icon"></i>
	            <input type="text" name="email" placeholder="E-mail address">
	          </div>
	        </div>
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="lock icon"></i>
	            <input type="password" name="password" placeholder="Password">
	          </div>
	        </div>
	        <div class="ui fluid large teal submit button">Login</div>
	      </div>

	      <div class="ui error message"></div>

	    </form>

	    <div class="ui message">
	      New to us? <a href="#">Sign Up</a>
	    </div>
	  </div>
	</div>

</body>
</html>

	{{-- scripts --}}

	{!! Html::script("js/semantic.min.js") !!}
	{!! Html::script("js/jquery.min.js") !!}