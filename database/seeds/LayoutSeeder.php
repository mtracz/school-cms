<?php

use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{

    public function run() {

    	$elements = [
    		["id" => "6", "site_sector_id" => 3, "order" => 2, "panel_id" => 3, "menu_id" => null, "is_enabled" => 1],
    		["id" => "7", "site_sector_id" => 4, "order" => 2, "panel_id" => 4, "menu_id" => null, "is_enabled" => 1],
    		["id" => "8", "site_sector_id" => 5, "order" => 1, "panel_id" => 5, "menu_id" => null, "is_enabled" => 1],
    		["id" => "9", "site_sector_id" => 6, "order" => 1, "panel_id" => 6, "menu_id" => null, "is_enabled" => 1],
    		["id" => "10", "site_sector_id" => 6, "order" => 3, "panel_id" => 7, "menu_id" => null, "is_enabled" => 1],
            ["id" => "11", "site_sector_id" => 4, "order" => 3, "panel_id" => 8, "menu_id" => null, "is_enabled" => 1],
            ["id" => "12", "site_sector_id" => 5, "order" => 2, "panel_id" => 10, "menu_id" => null, "is_enabled" => 1],
            ["id" => "13", "site_sector_id" => 6, "order" => 2, "panel_id" => 9, "menu_id" => null, "is_enabled" => 1],
            ["id" => "14", "site_sector_id" => 5, "order" => 3, "panel_id" => 11, "menu_id" => null, "is_enabled" => 1],
            ["id" => "15", "site_sector_id" => 5, "order" => 4, "panel_id" => 12, "menu_id" => null, "is_enabled" => 1],
            ["id" => "16", "site_sector_id" => 5, "order" => 5, "panel_id" => 13, "menu_id" => null, "is_enabled" => 1],
            ["id" => "17", "site_sector_id" => 5, "order" => 6, "panel_id" => 14, "menu_id" => null, "is_enabled" => 1],
    		["id" => "18", "site_sector_id" => 5, "order" => 7, "panel_id" => 15, "menu_id" => null, "is_enabled" => 1],
    	];
        
    	$menu = [
    		["id" => "1", "name" => "menu1"],
    		["id" => "2", "name" => "menu2"],
    		["id" => "3", "name" => "vertical_menu"],
    	];

    	$menu_items = [
    		["id" => "1", "name" => "item11", "order" => 1, "menu_id" => 1, "is_dropdown" => 1],
    		["id" => "2", "name" => "item12", "order" => 2, "menu_id" => 1, "is_dropdown" => 0],
    		["id" => "3", "name" => "item21", "order" => 1, "menu_id" => 2, "is_dropdown" => 0],
    		["id" => "4", "name" => "item22", "order" => 2, "menu_id" => 2, "is_dropdown" => 0],
    		["id" => "5", "name" => "item23", "order" => 3, "menu_id" => 2, "is_dropdown" => 0],
    		["id" => "6", "name" => "item31", "order" => 1, "menu_id" => 3, "is_dropdown" => 1],
    		["id" => "7", "name" => "item32", "order" => 2, "menu_id" => 3, "is_dropdown" => 0],
    	];

    	$links = [
    		["id" => "1", "name" => "link1", "url" => "#", "order" => 1, "menu_item_id" => 1],
    		["id" => "2", "name" => "link2", "url" => "#", "order" => 2, "menu_item_id" => 1],
    		["id" => "3", "name" => "link3", "url" => "#", "order" => 1, "menu_item_id" => 2],
    		["id" => "4", "name" => "link4", "url" => "#", "order" => 1, "menu_item_id" => 3],
    		["id" => "5", "name" => "link5", "url" => "#", "order" => 1, "menu_item_id" => 4],
    		["id" => "6", "name" => "link6", "url" => "#", "order" => 1, "menu_item_id" => 5],
    		["id" => "7", "name" => "link7", "url" => "#", "order" => 1, "menu_item_id" => 6],
    		["id" => "8", "name" => "link8", "url" => "#", "order" => 2, "menu_item_id" => 6],
    		["id" => "9", "name" => "link9", "url" => "#", "order" => 1, "menu_item_id" => 7],
    	];

    	$panels = [
    		["id" => "1", "name" => "banner_1", "header" => null, "content" => "/images/banner/test_1.jpeg", "panel_type_id" => 3, "has_header" => 0],
    		["id" => "2", "name" => "banner_2", "header" => null, "content" => "/images/banner/test_2.jpeg", "panel_type_id" => 3, "has_header" => 0],
    		["id" => "3", "name" => "banner_3", "header" => null, "content" => "/images/banner/test_3.jpeg", "panel_type_id" => 3, "has_header" => 0],

    		["id" => "4", "name" => "info_1", "header" => "info_1", "content" => "<img src='/images/banner/test_1.jpeg'> <p> sample text </p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "5", "name" => "info_2", "header" => "<strong>Operating Hours:</strong>", "content" => "<p><strong>Monday-Saturday:</strong><br/>8:00am–12:00am (EDT)<br/><strong>Sunday:</strong> <br/>9:00am–12:00am (EDT)<br/></p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "6", "name" => "info_3", "header" => "info_3_header", "content" => "<h3> kek </h3><br/><p> asdasdadasd </p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "7", "name" => "info_4", "header" => "info_4", "content" => "<p> asdasdasdadasdasdvSWZS45</p>", "panel_type_id" => 5, "has_header" => 1],

    		["id" => "8", "name" => "list_1", "header" => null, "content" => "<a> link </a></br><a> link </a></br><a> link </a></br><a> link </a></br>", "panel_type_id" => 7, "has_header" => 0],
            ["id" => "9", "name" => "google_map", "header" => null, "content" => '<iframe width="170" height="130" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.pl/maps?hl=pl&amp;lr=&amp;ie=UTF8&amp;q=sp+9+legnica&amp;fb=1&amp;split=1&amp;gl=pl&amp;cid=0,0,7333007650869757657&amp;ei=r_9NSuz9CpLm-Qbl6NCEBA&amp;source=embed&amp;ll=51.203562,16.14134&amp;spn=0.006295,0.006295&amp;output=embed"></iframe>', "panel_type_id" => 6, "has_header" => 0],
            ["id" => "10", "name" => "ułatwienia_dostępu", "header" => "Ułatwienia dostepu", "content" => '<div class="row">Zmiana kontrastu<i id="change_contrast" class="big icons" data-action="change_contrast"><i class="adjust icon"></i></i></div><div class="ui divider"></div><div class="row">Zmiana czcionki <i class="big icons" data-action="change_font_size" data-font_size="big"><i class="font icon"></i><i class="corner add icon"></i><i class="top right corner add icon"></i></i><i class="large icons" data-action="change_font_size" data-font_size="bigger"><i class="font icon"></i><i class="corner add icon"></i></i><i class="icons" data-action="change_font_size" data-font_size="default"><i class="font icon"></i> </i><div style="clear:both;"></div></div>', "panel_type_id" => 4, "has_header" => 1],
            ["id" => "11", "name" => "Poczta dla nauczycieli", "header" => "Poczta dla nauczycieli", "content" => '<a href="https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000006-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid+profile&state=OpenIdConnect.AuthenticationProperties%3dEZdPaSYlmnvfVeRXQbeslVs9i-mtuVTd8cGU7ObLaIjgpfasMMgPF0_Ys13ECmJgsumgInkvuVkE_0cpvWolIsmbmyqrtabB0-tWoY01rsEFI6sAb7AiD27iGYVhRIl6g8W6Bip4D0yRPibORWTIKIQmdXGtVYkK6XHEc0ad0t40i-7kO8na8w-zd596N0Ct&nonce=636409908781488413.MmE1MGI5NzMtOGI5Ny00Nzk1LWI1YzAtZDM3YmVlMDJhZDJkYTczYWMzYzItZGZkNy00YjlmLWE2ZTAtMDEwYjNiOTY3MDk0&redirect_uri=https%3a%2f%2fportal.office.com%2flanding&ui_locales=pl-PL&mkt=pl-PL&client-request-id=9b3310a9-fe8e-4901-b184-598f20a7e5e9&msafed=0"><img src="http://sp9.legnica.pl/images/poczta.png"></a>', "panel_type_id" => 5, "has_header" => 1],
            ["id" => "12", "name" => "Projekt unijny", "header" => "Projekt unijny", "content" => '<a href="http://sp9.legnica.pl/images_old/articles/2017_18/Projekt_unijny.pdf"><img src="http://sp9.legnica.eu/images_old/articles/2017_18/PR.png"></a>', "panel_type_id" => 5, "has_header" => 1],
            ["id" => "13", "name" => "Oddziały gimnazjalne", "header" => "Oddziały gimnazjalne", "content" => '<a href="http://www.gim5leg.pl/"><img src="http://sp9.legnica.pl/images_old/Oddzialy_gim1.png"></a><br><p style="text-align: justify;">Szkoła Podstawowa nr 9<br>Oddziały gimnazjalne<br>ul. Chojnowska 100<br>59-220 Legnica<br>tel.: 76 723 32 93<br></p>', "panel_type_id" => 5, "has_header" => 1],
            ["id" => "14", "name" => "BIP", "header" => "BIP", "content" => '<a href="http://www.sp9.bip.legnica.eu"><img src="http://sp9.legnica.pl/images_old/bip.png"></a>', "panel_type_id" => 5, "has_header" => 1],
            ["id" => "15", "name" => "Legnica", "header" => "Legnica", "content" => '<a href="http://www.portal.legnica.eu/"><img src="http://sp9.legnica.pl/images/legnica2.png"></a>', "panel_type_id" => 5, "has_header" => 1],

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