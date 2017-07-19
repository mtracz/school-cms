@extends("master")


@section("content")
<div class="ui container">

	<div class="ui grid">
		<div class="row">

			<div class="sixteen wide column">
				1
			</div>
			<div class="sixteen wide column">
				2
			</div>
			<div class="sixteen wide column">
				3
			</div>

			<div class="ui inside grid">
				<div class="row">
					<div class="three wide column">

						<div class="row">
							<div class="panel" style="height: 200px;">
								panel content
							</div>
						</div>
						<div class="row">
							<div class="panel" style="height: 100px;">
								panel content
							</div>
						</div>
						<div class="row">
							<div class="panel" style="height: 300px;">
								panel content
							</div>
						</div>
					</div>

					<div class="ten wide column">

						content

					</div>
					<div class="three wide column">

						<div class="row">
							<div class="panel" style="height: 100px;">
								panel content
							</div>
						</div>
						<div class="row">
							<div class="panel" style="height: 300px;">
								panel content
							</div>
						</div>

					</div>
				</div>

			</div>
			<div id="bottom_sector" class="sixteen wide column">
				<div class="ui inside grid">
					<div class="row">
						<div class="four wide column">
							<div class="panel">
								panel content
							</div>
						</div>
						<div class="four wide column">
							<div class="panel">
								panel content
							</div>
						</div>
						<div class="four wide column">
							<div class="panel">
								panel content
							</div>
						</div>
						<div class="four wide column">
							<div class="panel">
								panel content
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection

<style type="text/css">

	.ui.container {
		height: 100%;
		width: 80vw !important;

		padding-top: 20px;
	}

	.ui.inside.grid {
		width: 100%;
		margin: 0px !important;
	}

	.row {
		border: 1px solid red;

		padding: 0px !important;
	}

	.column {
		border: 1px solid white;

		padding: 0px !important;
	}

	.panel {
		background-color: #222;
		color: white;

		border: 1px dashed white;
	}

	#bottom_sector .panel{
		height: 200px;
	}

	#bottom_sector *{

		max-height: 200px !important;
	}


</style>