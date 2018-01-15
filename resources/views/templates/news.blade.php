<div class="column">
	<div class="row">
		<div class="news panel" style="max-width: 100%;">

			<div class="editTab">

				@if(Auth::user())

				@include("templates/editTab")

				@endif

			</div>

			<div class="news title fifth-color" data-id={{ $item->id }}>
				{!! $item->title !!}
			</div>

			<div class="content editMe" data-id={{ $item->id }}>
				{!! $item->content !!}	
			</div>

			<div class="ui bottom right attached label fifth-color">
				
				<i class="user icon"></i>
				{!! $item->admin->name !!}
				 &nbsp; &nbsp; &nbsp; &nbsp;
				<i class="calendar icon"></i>
				{!! $item->published_at !!}
				
			</div>
			
		</div>
	</div>
</div>
