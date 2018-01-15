<?php

use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{

    public function run() {

    	$elements = [
            //TOP 2
            // zdjęcie szkoły
            ["id" => "1", "site_sector_id" => 2, "order" => 1, "panel_id" => 1, "menu_id" => null, "is_enabled" => 1],
            //TOP 3
            // menu gorne
            ["id" => "2", "site_sector_id" => 3, "order" => 1, "panel_id" => null, "menu_id" => 1, "is_enabled" => 1],
            //LEFT
            // menu szkola
            ["id" => "3", "site_sector_id" => 4, "order" => 1, "panel_id" => null, "menu_id" => 2, "is_enabled" => 1],
            //menu biblioteka
            ["id" => "4", "site_sector_id" => 4, "order" => 2, "panel_id" => null, "menu_id" => 3, "is_enabled" => 1],
            // menu swietlica
            ["id" => "5", "site_sector_id" => 4, "order" => 3, "panel_id" => null, "menu_id" => 4, "is_enabled" => 1],
            // menu uczniowie
            ["id" => "6", "site_sector_id" => 4, "order" => 4, "panel_id" => null, "menu_id" => 5, "is_enabled" => 1],
            // menu rodzice
            ["id" => "7", "site_sector_id" => 4, "order" => 5, "panel_id" => null, "menu_id" => 6, "is_enabled" => 1],
            // menu projekty i certyfikaty
            ["id" => "8", "site_sector_id" => 4, "order" => 6, "panel_id" => null, "menu_id" => 7, "is_enabled" => 1],
            // mapa strony
            ["id" => "9", "site_sector_id" => 4, "order" => 7, "panel_id" => null, "menu_id" => 8, "is_enabled" => 1],
            // RIGHT
            // ułatwienia dsotępu
            ["id" => "10", "site_sector_id" => 5, "order" => 1, "panel_id" => 2, "menu_id" => null, "is_enabled" => 1],
            // dane szkoly
            ["id" => "11", "site_sector_id" => 5, "order" => 2, "panel_id" => 3, "menu_id" => null, "is_enabled" => 1],           
            // oddziały gimnazjalne
            ["id" => "12", "site_sector_id" => 5, "order" => 3, "panel_id" => 4, "menu_id" => null, "is_enabled" => 1],
            // projekt unijny
            ["id" => "13", "site_sector_id" => 5, "order" => 4, "panel_id" => 9, "menu_id" => null, "is_enabled" => 1],
            // BIP
            ["id" => "14", "site_sector_id" => 5, "order" => 5, "panel_id" => 5, "menu_id" => null, "is_enabled" => 1],
            // legnica z nia zawsze po drodze
            ["id" => "15", "site_sector_id" => 5, "order" => 6, "panel_id" => 6, "menu_id" => null, "is_enabled" => 1],
            // poczta dla nauczycieli (office 365)
            ["id" => "16", "site_sector_id" => 5, "order" => 7, "panel_id" => 7, "menu_id" => null, "is_enabled" => 1],
            
            // DOWN
            // tu jestesmy (google map)
            ["id" => "17", "site_sector_id" => 6, "order" => 1, "panel_id" => 8, "menu_id" => null, "is_enabled" => 1],

    	];

    	$menu = [
    		["id" => "1", "name" => "menu górne"],

    		["id" => "2", "name" => "Szkoła"],

            ["id" => "3", "name" => "Biblioteka"],

            ["id" => "4", "name" => "Świetlica"],

            ["id" => "5", "name" => "Uczniowie"],

            ["id" => "6", "name" => "Rodzice"],

            ["id" => "7", "name" => "Projekty i certyfikaty"],

            ["id" => "8", "name" => "Mapa strony"],
    	];

    	$menu_items = [
            // menu główne
    		["id" => "1", "name" => "Strona główna", "order" => 1, "menu_id" => 1, "is_dropdown" => 0],
            ["id" => "2", "name" => "Dziennik", "order" => 2, "menu_id" => 1, "is_dropdown" => 0],
            ["id" => "3", "name" => "Plan lekcji", "order" => 3, "menu_id" => 1, "is_dropdown" => 0],
    		["id" => "4", "name" => "Kontakt", "order" => 4, "menu_id" => 1, "is_dropdown" => 0],
            // --
            // menu Szkoła
            ["id" => "5", "name" => "Szkoła", "order" => 1, "menu_id" => 2, "is_dropdown" => 1],
            // --
            // menu Biblioteka
    		["id" => "6", "name" => "Biblioteka", "order" => 1, "menu_id" => 3, "is_dropdown" => 0],
            // --
            // menu Świetlica
            ["id" => "7", "name" => "Świetlica", "order" => 1, "menu_id" => 4, "is_dropdown" => 0],
            // --
            // menu Uczniowie
    		["id" => "8", "name" => "Uczniowie", "order" => 1, "menu_id" => 5, "is_dropdown" => 1],
            // --
            // menu Rodzice
            ["id" => "9", "name" => "Rodzice", "order" => 1, "menu_id" => 6, "is_dropdown" => 1],
            // --
            // menu Projekty i certyfikaty
            ["id" => "10", "name" => "Projekty i certyfikaty", "order" => 1, "menu_id" => 7, "is_dropdown" => 1],
            // --
            // menu Mapa strony
            ["id" => "11", "name" => "Mapa strony", "order" => 1, "menu_id" => 8, "is_dropdown" => 0],
            // --
    	];

    	$links = [
            // menu główne
    		["id" => "1", "name" => "Strona główna", "url" => "/", "order" => 1, "menu_item_id" => 1],
    		["id" => "2", "name" => "Dziennik", "url" => "https://uonetplus.vulcan.net.pl/Legnica", "order" => 1, "menu_item_id" => 2],
    		["id" => "3", "name" => "Plan lekcji", "url" => "/plan/index.html", "order" => 1, "menu_item_id" => 3],
    		["id" => "4", "name" => "Kontakt", "url" => "/pages/kontakt", "order" => 1, "menu_item_id" => 4],
            // --
            // menu Szkoła
    		["id" => "5", "name" => "Archiwum", "url" => "/archive", "order" => 1, "menu_item_id" => 5],
            ["id" => "6", "name" => "Historia Szkoły", "url" => "/readarticle.php?article_id=1", "order" => 2, "menu_item_id" => 5],
            ["id" => "7", "name" => "Dokumenty", "url" => "/readarticle.php?article_id=7", "order" => 3, "menu_item_id" => 5],
            ["id" => "8", "name" => "Nauczyciele", "url" => "/readarticle.php?article_id=4", "order" => 4, "menu_item_id" => 5],
            ["id" => "9", "name" => "Raport z ewaluacji", "url" => "/readarticle.php?article_id=166", "order" => 5, "menu_item_id" => 5],
            ["id" => "10", "name" => "Kontakt", "url" => "/pages/kontakt", "order" => 6, "menu_item_id" => 5],
    		["id" => "11", "name" => "Monitoring", "url" => "/readarticle.php?article_id=184", "order" => 7, "menu_item_id" => 5],
            // --
            // Biblioteka
            ["id" => "12", "name" => "Biblioteka", "url" => "/readarticle.php?article_id=50", "order" => 1, "menu_item_id" => 6],
            // --
            // Świetlica
    		["id" => "13", "name" => "Świetlica", "url" => "/readarticle.php?article_id=154", "order" => 1, "menu_item_id" => 7],
            // --
            // menu Uczniowie
            ["id" => "14", "name" => "Absolwenci", "url" => "/readarticle.php?article_id=41", "order" => 1, "menu_item_id" => 8],
            ["id" => "15", "name" => "Asy 9", "url" => "/readarticle.php?article_id=11", "order" => 2, "menu_item_id" => 8],
            ["id" => "16", "name" => "Animator sportowy", "url" => "/readarticle.php?article_id=176", "order" => 3, "menu_item_id" => 8],
            ["id" => "17", "name" => "Koła zainteresowań", "url" => "/readarticle.php?article_id=199", "order" => 5, "menu_item_id" => 8],
            ["id" => "18", "name" => "Strój ucznia (mundurki)", "url" => "/readarticle.php?article_id=103", "order" => 6, "menu_item_id" => 8],
            ["id" => "19", "name" => "Najzdolniejsi", "url" => "/readarticle.php?article_id=84", "order" => 7, "menu_item_id" => 8],
            ["id" => "20", "name" => "Samorząd uczniowski", "url" => "/readarticle.php?article_id=27", "order" => 8, "menu_item_id" => 8],
            ["id" => "21", "name" => "W-f dla kl. I-VI", "url" => "/readarticle.php?article_id=79", "order" => 9, "menu_item_id" => 8],
            ["id" => "22", "name" => "Podręczniki", "url" => "/Podreczniki_2017_2018.pdf", "order" => 10, "menu_item_id" => 8],
            ["id" => "23", "name" => "Gazetka szkolna", "url" => "http://www.juniormedia.pl/redakcje/panel/strzal-w-9", "order" => 11, "menu_item_id" => 8],
            // --
            // menu Rodzice
            ["id" => "24", "name" => "Elementarz", "url" => "/readarticle.php?article_id=165", "order" => 1, "menu_item_id" => 9],
            ["id" => "25", "name" => "Kalendarium", "url" => "/readarticle.php?article_id=82", "order" => 2, "menu_item_id" => 9],
            ["id" => "26", "name" => "Obiady", "url" => "/readarticle.php?article_id=164", "order" => 3, "menu_item_id" => 9],
            ["id" => "27", "name" => "Procedury odbierania uczniów", "url" => "/Procedura.pdf", "order" => 4, "menu_item_id" => 9],
            ["id" => "28", "name" => "Rada Rodziców", "url" => "/readarticle.php?article_id=156", "order" => 5, "menu_item_id" => 9],
            ["id" => "29", "name" => "Rekrutacja", "url" => "/readarticle.php?article_id=175", "order" => 6, "menu_item_id" => 9],
            ["id" => "30", "name" => "Wyposażenie pierwszoklasisty", "url" => "/readarticle.php?article_id=178", "order" => 7, "menu_item_id" => 9],
            ["id" => "31", "name" => "Pedagog i psycholog", "url" => "/readarticle.php?article_id=163", "order" => 8, "menu_item_id" => 9],
            // --
            // menu Projekty i certyfikaty
            ["id" => "32", "name" => "Junior Media", "url" => "/readarticle.php?article_id=180", "order" => 1, "menu_item_id" => 10],
            ["id" => "33", "name" => "Szkoła Bez Przemocy", "url" => "/readarticle.php?article_id=105", "order" => 2, "menu_item_id" => 10],
            ["id" => "34", "name" => "Szkoła w pilotarzu Progr4mowanie", "url" => "http://programowanie.men.gov.pl/", "order" => 3, "menu_item_id" => 10],
            ["id" => "35", "name" => "Akademia Przyjaciół Pszczół", "url" => "/readarticle.php?article_id=151", "order" => 4, "menu_item_id" => 10],
            ["id" => "36", "name" => "Dobry start w szkole", "url" => "/readarticle.php?article_id=129", "order" => 6, "menu_item_id" => 10],
            ["id" => "37", "name" => "Elementarz Korczaka", "url" => "/readarticle.php?article_id=136", "order" => 7, "menu_item_id" => 10],
            ["id" => "38", "name" => "Mały Mistrz", "url" => "/images_old/articles/2016_17/Maly_Mistrz.pdf", "order" => 8, "menu_item_id" => 10],
            ["id" => "39", "name" => "Mistrzowie Kodowania", "url" => "/readarticle.php?article_id=150", "order" => 9, "menu_item_id" => 10],
            ["id" => "40", "name" => "Pracownia Przyrodnicza", "url" => "/readarticle.php?article_id=122", "order" => 9, "menu_item_id" => 10],
            ["id" => "41", "name" => "Bezpiecznie Tu i Tam", "url" => "/readarticle.php?article_id=183", "order" => 9, "menu_item_id" => 10],
            // --
            // Mapa strony
            ["id" => "42", "name" => "Mapa strony", "url" => "/sitemap", "order" => 1, "menu_item_id" => 11],
            // --
    	];

    	$panels = [
    		["id" => "1", "name" => "Zdjęcie szkoły", "header" => null, "content" => "<div id='main_banner'><img src='/images/banner/test_3.jpeg'></div>", "panel_type_id" => 2, "has_header" => 0],

            ["id" => "2", "name" => "Ułatwienia dostępu", "header" => "Ułatwienia dostepu", "content" => '<div class="row">Zmiana kontrastu<i id="change_contrast" class="big icons" data-action="change_contrast"><i class="adjust icon"></i></i></div><div class="ui divider"></div><div class="row">Zmiana czcionki <i class="big icons" data-action="change_font_size" data-font_size="big"><i class="font icon"></i><i class="corner add icon"></i><i class="top right corner add icon"></i></i><i class="large icons" data-action="change_font_size" data-font_size="bigger"><i class="font icon"></i><i class="corner add icon"></i></i><i class="icons" data-action="change_font_size" data-font_size="default"><i class="font icon"></i> </i><div style="clear:both;"></div></div>', "panel_type_id" => 3, "has_header" => 1],

            ["id" => "3", "name" => "Dane szkoły", "header" => "Dane szkoły", "content" => ' 
                <img src="images_old/szkola.jpg" title="Szkoła Podstawowa nr 9 w Legnicy">
                <br>Szkoła Podstawowa nr 9<br>
                ul. Marynarska 31<br>
                59-220 Legnica<br>
                tel.: 76 72 33 130<br>
                fax: 76 75 40 104<br>
                e-mail: <a href="mailto:sekretariat@sp9.legnica.eu">sekretariat@sp9.legnica.eu</a><br><br>
                kontakt<br>
                z administratorem strony:<br>
                <a href="mailto:info@sp9.legnica.pl">info@sp9.legnica.pl</a><br>', "panel_type_id" => 4, "has_header" => 1],            

            ["id" => "4", "name" => "Oddziały gimnazjalne", "header" => "Oddziały gimnazjalne", "content" => '<a href="http://www.gim5leg.pl/"><img src="images_old/Oddzialy_gim1.png"></a><br><p style="text-align: justify;">Szkoła Podstawowa nr 9<br>Oddziały gimnazjalne<br>ul. Chojnowska 100<br>59-220 Legnica<br>tel.: 76 723 32 93<br></p>', "panel_type_id" => 4, "has_header" => 1],

            ["id" => "5", "name" => "BIP", "header" => "BIP", "content" => '<a href="http://www.sp9.bip.legnica.eu"><img src="images_old/bip.png"></a>', "panel_type_id" => 4, "has_header" => 1],

            ["id" => "6", "name" => "Legnica z nią zawsze po drodze", "header" => "Legnica z nią zawsze po drodze", "content" => '<a href="http://www.portal.legnica.eu/"><img src="images_old/legnica2.png"></a>', "panel_type_id" => 4, "has_header" => 1],

            ["id" => "7", "name" => "Office 365", "header" => "Poczta dla nauczycieli", "content" => '<a href="https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000006-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid+profile&state=OpenIdConnect.AuthenticationProperties%3dEZdPaSYlmnvfVeRXQbeslVs9i-mtuVTd8cGU7ObLaIjgpfasMMgPF0_Ys13ECmJgsumgInkvuVkE_0cpvWolIsmbmyqrtabB0-tWoY01rsEFI6sAb7AiD27iGYVhRIl6g8W6Bip4D0yRPibORWTIKIQmdXGtVYkK6XHEc0ad0t40i-7kO8na8w-zd596N0Ct&nonce=636409908781488413.MmE1MGI5NzMtOGI5Ny00Nzk1LWI1YzAtZDM3YmVlMDJhZDJkYTczYWMzYzItZGZkNy00YjlmLWE2ZTAtMDEwYjNiOTY3MDk0&redirect_uri=https%3a%2f%2fportal.office.com%2flanding&ui_locales=pl-PL&mkt=pl-PL&client-request-id=9b3310a9-fe8e-4901-b184-598f20a7e5e9&msafed=0"><img src="images_old/poczta.png"></a>', "panel_type_id" => 4, "has_header" => 1],

            ["id" => "8", "name" => "google_map", "header" => "Tu jesteśmy", "content" => '<iframe width="300" height="130" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.pl/maps?hl=pl&amp;lr=&amp;ie=UTF8&amp;q=sp+9+legnica&amp;fb=1&amp;split=1&amp;gl=pl&amp;cid=0,0,7333007650869757657&amp;ei=r_9NSuz9CpLm-Qbl6NCEBA&amp;source=embed&amp;ll=51.203562,16.14134&amp;spn=0.006295,0.006295&amp;output=embed"></iframe>', "panel_type_id" => 1, "has_header" => 1],

            ["id" => "9", "name" => "Projekt unijny", "header" => "Projekt unijny", "content" => '<a href="images_old/articles/2017_18/Projekt_unijny.pdf"><img src="http://sp9.legnica.eu/images_old/articles/2017_18/PR.png"></a>', "panel_type_id" => 4, "has_header" => 1],

    	];

    	Schema::disableForeignKeyConstraints();

		foreach ($panels as $array) {

			if(!DB::table("panels")->find($array["id"])) {
				 DB::table("panels")->insert($array);
			}
		}

		foreach ($links as $array) {

			if(!DB::table("links")->find($array["id"])) {
				 DB::table("links")->insert($array);
			}
		}

		foreach ($menu_items as $array) {

			if(!DB::table("menu_items")->find($array["id"])) {
				 DB::table("menu_items")->insert($array);
			}
		}

		foreach ($menu as $array) {

			if(!DB::table("menu")->find($array["id"])) {
				 DB::table("menu")->insert($array);
			}
		}

		foreach ($elements as $array) {

			if(!DB::table("elements")->find($array["id"])) {
				 DB::table("elements")->insert($array);
			}
		}
    }
}