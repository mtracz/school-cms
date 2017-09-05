
<div class="ui top attached segment" data-div_sector_id='{{ $sector_id }}'>
	<div class="sector_header">
		
		<div class="actions">
			{{ $sector_name }}
		</div>
	</div>

	<div class="ui attached content segment">
		<table id="sector_table" class="ui fixed table">

			<thead>
				<tr>
					{{ $headers }}
				</tr>
			</thead>
			<tbody>
				{{ $rows }}	
			</tbody>

		</table>
	</div>
</div>