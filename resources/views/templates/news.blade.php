<div class="column">
	<div class="row">
		<div class="news panel">

			<div class="editTab">

				@if(Auth::user())

				@include("templates/editTab")

				@endif

			</div>

			<div class="title fifth-color" data-id={{ $singleNews->id }}>
				{!! $singleNews->title !!}
			</div>

			<div class="content editMe" data-id={{ $singleNews->id }}>
				{!! $singleNews->content !!}	
			</div>

			<div class="ui bottom right attached label fifth-color">

				<i class="user icon"></i>
				{!! $singleNews->admin->name !!}
				<i class="calendar icon"></i>
				{!! $singleNews->published_at !!}

			</div>
			
		</div>
	</div>
</div>
