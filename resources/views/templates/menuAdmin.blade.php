
{!! Html::style("css/menuAdmin.css") !!}

<div class="sixteen wide column menuAdmin view_marker view_computer">
	<div class="ui inverted menu sticky_menu view_marker view_computer">
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
				<a class="ui item" href="{{ route("page.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<a class="ui item" href="{{ route("page.add.get") }}"><i class="plus icon"></i>Dodaj</a>
			</div>
		</div>

		<div class="ui simple dropdown item files">
			<i class="file text icon"></i>
			Pliki
			<div class="ui menu">
				<a class="ui item" href="{{ route("file.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<div class="ui item menuAdmin_add_file"><i class="plus icon"></i>Dodaj</div>
			</div>
		</div>

		<div class="ui simple dropdown item links">
			<i class="linkify text icon"></i>
			Linki
			<div class="ui menu">
				<div class="ui item menuAdmin_news_links"><i class="newspaper icon"></i>Newsy</div>
				<div class="ui item menuAdmin_pages_links"><i class="sticky note icon"></i>Strony</div>
			</div>
		</div>

		<a class="ui item site_sectors" href="{{ route("element.manage.get") }}"><i class="group object icon"></i>Zarządzanie elementami</a>
		<a class="ui item settings" href="{{ route("settings.get") }}" ><i class="options icon"></i>Ustawienia</a>
		@if(Auth::user()->is_super_admin)
		<a class="ui item settings" href="{{ route("admin.manage.get") }}" ><i class="users icon"></i>
		Administratorzy</a>
		@endif
		<div class="right menu">
			<a class="ui item sign_out" data-route="{{ route("logout.post") }}"><i class="sign out icon"></i>Wyloguj</a>
		</div>
	</div>
</div>

<!-- MOBILE / TABLET MENU ADMIN -->
<div class="ui inverted menu menuAdmin view_marker view_tablet view_mobile sticky_menu">
	<div class="ui dropdown item" style="width: 100%">
		<i class="align justify icon"></i>
		<span>Panel administratora</span>

		<div class="menu mobile" id="mobile_menu">

			<div class="ui list">
				<a class="ui home" href="/">
					<div class="item">
						<i class="home icon"></i>
						Strona główna
					</div>
				</a>
				<div class="item">
					<div>
						<i class="newspaper icon"></i>
						News
					</div>
					<div class="list">
						<a class=" item" href="{{ route("news.manage.get") }}">
							<!-- <div class="item"> -->
							<i class="list layout icon"> Zarządzaj </i>
							<!-- </div> -->
						</a>
						<a class=" item" href="{{ route("news.add.get") }}" >
							<!-- <div class="item"> -->
							<i class="plus icon"> Dodaj </i>
							<!-- </div> -->
						</a>
					</div>
				</div>

				<div class="item">
				<a class="ui site_sectors" href="{{ route("element.manage.get") }}">
					<i class="group object icon"></i>
					Zarządzanie elementami
				</a>
				</div>

				<div class="item">
				<a class="ui settings" href="{{ route("settings.get") }}" >
					<i class="options icon"></i>
					Ustawienia
				</a>
				</div>

				@if(Auth::user()->is_super_admin)
				<div class="item">
				<a class="ui settings" href="{{ route("admin.manage.get") }}" >
					<i class="users icon"></i>
					Administratorzy
				</a>
				</div>
				@endif
				
				<div class="item">
				<a class="ui sign_out" data-route="{{ route("logout.post") }}">
					<i class="sign out icon"></i>
					Wyloguj
				</a>
				</div>
			</div>

			<!-- <a class="ui item home" href="/"><i class="home icon"></i>Strona główna</a>
			
			<div class="ui list">
				<div class="item">
					<a class="home" href="/"><i class="home icon"></i>Strona główna</a>

				</div>
				<div>News</div>
				<div class="list">
					
					
				</div>
			</div>
			<div class="item">Warranty</div> -->
		</div>

		<!-- 	<div class="ui simple dropdown item news">
			<i class="newspaper icon"></i>
			News
			<div class="right menu">
				<a class="ui item" href="{{ route("news.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<a class="ui item" href="{{ route("news.add.get") }}" ><i class="plus icon"></i>Dodaj</a>
			</div>
		</div> -->

	<!-- 	<div class="ui simple dropdown item static_pages">
			<i class="sticky note icon"></i>
			Strony
			<div class=" menu">
				<a class="ui item" href="{{ route("page.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<a class="ui item" href="{{ route("page.add.get") }}"><i class="plus icon"></i>Dodaj</a>
			</div>
		</div>

		<div class="ui dropdown item files">
			<i class="file text icon"></i>
			Pliki
			<div class="right menu">
				<a class="ui item" href="{{ route("file.manage.get") }}"><i class="list layout icon"></i>Zarządzaj</a>
				<div class="ui item menuAdmin_add_file"><i class="plus icon"></i>Dodaj</div>
			</div>
		</div>

		<div class="ui dropdown item links">
			<i class="linkify text icon"></i>
			Linki
			<div class="right menu">
				<div class="ui item menuAdmin_news_links"><i class="newspaper icon"></i>Newsy</div>
				<div class="ui item menuAdmin_pages_links"><i class="sticky note icon"></i>Strony</div>
			</div>
		</div>

		<a class="ui item site_sectors" href="{{ route("element.manage.get") }}"><i class="group object icon"></i>Zarządzanie elementami</a>

		<a class="ui item settings" href="{{ route("settings.get") }}" ><i class="options icon"></i>Ustawienia</a>
		
		@if(Auth::user()->is_super_admin)
		<a class="ui item settings" href="{{ route("admin.manage.get") }}" ><i class="users icon"></i>
		Administratorzy</a>
		@endif

		<a class="ui item sign_out" data-route="{{ route("logout.post") }}"><i class="sign out icon"></i>Wyloguj</a>
	
 -->
		<!-- </div> -->
	</div>
</div>


	{{-- MODAL ADD_FILE --}}
	@include("addFileModal")

	{{-- MODAL LINKS --}}
	@include("linksModal")


{!! Html::script("js/menuAdmin.js") !!}	

