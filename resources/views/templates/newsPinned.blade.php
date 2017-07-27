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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non pellentesque tortor, vel imperdiet metus. Cras volutpat cursus metus, in consectetur est. Vestibulum ac sapien vitae lectus vestibulum tempor vitae sed quam. Ut finibus lectus dapibus maximus volutpat. Nunc et diam a purus sodales ornare id id urna. Nam at mollis leo. Etiam nec dapibus sem. Phasellus placerat, risus sit amet congue laoreet, ligula justo <a>YOLO</a> purus, at aliquet ligula velit cursus ipsum. In eget lacus lacinia, tincidunt eros vitae, tempor est. Class aptent taciti sociosqu ad litora torquent per</p>
			</div>

			<div class="ui bottom right attached label coral-color">

				<i class="user icon"></i>
				{!! $news_pinned->news->admin->name !!}
				<i class="calendar icon"></i>
				{!! $news_pinned->news->published_at !!}

			</div>
			
		</div>
	</div>
</div>
