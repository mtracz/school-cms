<div class="column">
	<div class="row">
		<div class="news panel">

			<div class="editTab">

				@if(Auth::user())

				@include("templates/editTab")

				@endif

			</div>

			<div class="title coral-color">
				<i class="pin icon"></i>
				{!! $news_pinned->news->title !!}
			</div>

			<div class="content">
				{!! $news_pinned->news->content !!}				
			</div>

			<div class="ui bottom right attached label coral-color">

				<i class="user icon"></i>
				{!! $news_pinned->news->admin->name !!}
				&nbsp; &nbsp; &nbsp; &nbsp;
				<i class="calendar icon"></i>
				{!! $news_pinned->news->published_at !!}

			</div>
			
		</div>
	</div>
</div>
