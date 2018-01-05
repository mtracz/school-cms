@extends("master")

@section("content")

<div class="ui centered aligned grid container" style='background-color: ; padding-top: 30px'>
	<div class="ui column">

		<div class="ui icon header centered aligned">
			<i class="warning icon"></i>
			<h1>
				Nie znaleziono takiej strony.
			</h1>

			<h3>
				Możesz wrócić do strony głównej lub skontaktować się z administratorem serwisu.
			</h3>
			<br><br>
			<button class="massive ui blue circular button" 
				onClick="window.location.replace(' {{ $main_route }} ');">
				Wróć do strony głownej
			</button>

		</div>
	</div>
</div>

<script type="text/javascript">
	
</script>

@endsection
