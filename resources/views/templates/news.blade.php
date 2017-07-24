<div class="column">
	<div class="row">
		<div class="news panel">

			<div class="editTab">

				@if(Auth::user())

				@include("templates/editTab")

				@endif

			</div>

			<div class="title fifth-color">
				{!! $singleNews->title !!}
			</div>

			<div class="content">
				{!! $singleNews->content !!}
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non pellentesque tortor, vel imperdiet metus. Cras volutpat cursus metus, in consectetur est. Vestibulum ac sapien vitae lectus vestibulum tempor vitae sed quam. Ut finibus lectus dapibus maximus volutpat. Nunc et diam a purus sodales ornare id id urna. Nam at mollis leo. Etiam nec dapibus sem. Phasellus placerat, risus sit amet congue laoreet, ligula justo suscipit purus, at aliquet ligula velit cursus ipsum. In eget lacus lacinia, tincidunt eros vitae, tempor est. Class aptent taciti sociosqu ad litora torquent per 
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

<style type="text/css">

	.news.panel .ui.bottom.right.attached.label i {
		padding-left: 10px !important; 
	}

	.news.panel {

		min-height: 100px;

		position: relative;

		margin-bottom: 10px !important;
	}
	
	.news.panel .title {
		padding: 10px;

		font-size: 20px;
		font-weight: bold;

		-webkit-box-shadow: 0px 2px 10px -2px rgba(0,0,0,0.6);
		-moz-box-shadow: 0px 2px 10px -2px rgba(0,0,0,0.6);
		box-shadow: 2px 2px 20px -2px rgba(0,0,0,0.6);
	}

	.news.panel .content {
		padding: 20px;
		padding-bottom: 40px;

		box-shadow: 0px 2px 10px -2px rgba(0,0,0,0.6);
	}

</style>
