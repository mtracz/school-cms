<!DOCTYPE html>
<html>
<head>
	{{-- styles --}}
	{!! Html::style("css/semantic.min.css") !!}
	{!! Html::style("css/admin_create.css") !!}
</head>
<body>
	
<div class="content">
		<div class="ui icon centered aligned header">
			<i class="add to calendar icon"></i>
			naglowek
		</div>
		<div class="ui divider"></div><br>
		<form action="" method="post" id="profile_edit_form" class="ui form">
			{{ csrf_field() }}
			<div class="ui three column grid">				

				<div class="column centered aligned row">
					<div class="column">
						<div class="field required" id="profile_username">
							<label>label</label>
							<input value="" name="username" id="profile_username_input">
						</div>	
					</div>					
				</div>

				<div class="column centered aligned row">
					<div class="column">
						<div class="field required" id="profile_email">
							<label>label</label>
							<input type="text" value="" name="email" id="profile_email_input">
						</div>
					</div>				
				</div>

				<div class="column centered aligned row">
					<div class="column">
						<div class="field">					

						</div>
					</div>				
				</div>
			</div>
		</form>
	</div>

</body>
</html>

{{-- scripts --}}
{!! Html::script("js/semantic.min.js") !!}
{!! Html::script("js/jquery.min.js") !!}
{!! Html::script("js/admin_create.js") !!}