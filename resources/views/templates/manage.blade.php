
<div class="options_container">
	<div class="ui segment">
		<i class="filter icon"></i>Filters
		<div class="ui options segment">
			<form action="" method="get">
				<div class="ui grid">
					<div class="row">
						<div class="eight wide column">
							1
						</div>
						<div class="eight wide column">
							2
						</div>
					</div>
					<div class="bottom row">
						<div class="eight wide column">
							<div class="ui right action left icon search input center aligned">
								<i class="search icon"></i>
								<input type="text">
								<button class="ui search button">Szukaj</button>
							</div>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
{{ $pagination }}
<table class="ui fixed collapsing table">
	<thead>
		<tr>
			{{ $headers }}
		</tr>
	</thead>
	<tbody>
		{{ $rows }}
	</tbody>

</table>
{{ $pagination }}