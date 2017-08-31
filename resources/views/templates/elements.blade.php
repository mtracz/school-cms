
<div class="ui top attached segment">
	<div class="sector_name">
		
		<div class="actions">
			{{ $sector_name }}
			{{-- <div class="ui toggle right button"><i class="hide icon"></i></div> --}}
		</div>
	</div>

	<div class="ui attached content segment">
		{{-- {{ $pagination }} --}}
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
		{{-- {{ $pagination }} --}}
	</div>
</div>