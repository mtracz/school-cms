<div class="sixteen wide column menuAdmin ">
	<div class="ui inverted menu sticky_menu">
		<div class="left menu">
			<a class="ui item home" href="/"><i class="home icon"></i>Strona główna</a>
		</div>

		<div class="ui simple dropdown item news">
			<i class="newspaper icon"></i>
			News
			<div class="ui menu">
				<a class="ui item" href="{{ route("news.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<a class="ui item" href="{{ route("news.add.get") }}" ><i class="plus icon"></i>Dodaj</a>
			</div>
		</div>

		<div class="ui simple dropdown item static_pages">
			<i class="sticky note icon"></i>
			Strony
			<div class="ui menu">
				<div class="ui item"><i class="list layout icon"></i>Zarządzaj</div>
				<div class="ui item"><i class="plus icon"></i>Dodaj</div>
			</div>
		</div>

		<a class="ui item site_sectors"><i class="group object icon"></i>Rozmieszczenie elementów</a>
		<a class="ui item settings"><i class="signal icon"></i>Statystyki</a>
		<a class="ui item settings" href="{{ route("settings.get") }}" ><i class="options icon"></i>Ustawienia</a>
		<div class="right menu">
			<a class="ui item sign_out" data-route={{route("logout.post")}}><i class="sign out icon"></i>Wyloguj</a>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(".sign_out").on('click',function() {
		var route = $(this).data("route");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			},
			url: route,
			type: "POST",

			success: function(response) {
				$(".ui.container").dimmer("show");
				window.location.href = response.route;
			}			
		});
	});

</script>

<style type="text/css">
	
 .menuAdmin a {
 	color: white !important;
 }

</style>
