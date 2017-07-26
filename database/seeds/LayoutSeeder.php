<?php

use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{

    public function run() {

    	$elements = [
    		["id" => "1", "site_sector_id" => 1, "order" => 1, "panel_id" => 1, "menu_id" => null, "is_enabled" => 0],
    		["id" => "2", "site_sector_id" => 3, "order" => 1, "panel_id" => 2, "menu_id" => null, "is_enabled" => 0],
    		["id" => "3", "site_sector_id" => 2, "order" => 1, "panel_id" => null, "menu_id" => 1, "is_enabled" => 1],
    		["id" => "4", "site_sector_id" => 4, "order" => 1, "panel_id" => null, "menu_id" => 2, "is_enabled" => 1],
    		["id" => "5", "site_sector_id" => 5, "order" => 1, "panel_id" => null, "menu_id" => 3, "is_enabled" => 1],
    		["id" => "6", "site_sector_id" => 3, "order" => 2, "panel_id" => 3, "menu_id" => null, "is_enabled" => 1],
    		["id" => "7", "site_sector_id" => 4, "order" => 2, "panel_id" => 4, "menu_id" => null, "is_enabled" => 1],
    		["id" => "8", "site_sector_id" => 5, "order" => 2, "panel_id" => 5, "menu_id" => null, "is_enabled" => 1],
    		["id" => "9", "site_sector_id" => 6, "order" => 1, "panel_id" => 6, "menu_id" => null, "is_enabled" => 1],
    		["id" => "10", "site_sector_id" => 6, "order" => 2, "panel_id" => 7, "menu_id" => null, "is_enabled" => 1],
    		["id" => "11", "site_sector_id" => 4, "order" => 3, "panel_id" => 8, "menu_id" => null, "is_enabled" => 1],
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
    		["id" => "1", "name" => "banner_1", "header" => null, "content" => "images/banner/test_1.jpeg", "panel_type_id" => 3, "has_header" => 0],
    		["id" => "2", "name" => "banner_2", "header" => null, "content" => "images/banner/test_2.jpeg", "panel_type_id" => 3, "has_header" => 0],
    		["id" => "3", "name" => "banner_3", "header" => null, "content" => "images/banner/test_3.jpeg", "panel_type_id" => 3, "has_header" => 0],

    		["id" => "4", "name" => "info_1", "header" => "info_1", "content" => "<img src='/images/banner/test_1.jpeg'> <p> sample text </p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "5", "name" => "info_2", "header" => "<strong>Operating Hours:</strong>", "content" => "<p><strong>Monday-Saturday:</strong><br/>8:00am–12:00am (EDT)<br/><strong>Sunday:</strong> <br/>9:00am–12:00am (EDT)<br/></p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "6", "name" => "info_3", "header" => "info_3_header", "content" => "<h3> kek </h3><br/><p> asdasdadasd </p>", "panel_type_id" => 5, "has_header" => 1],
    		["id" => "7", "name" => "info_4", "header" => "info_4", "content" => "<p> asdasdasdadasdasdvSWZS45</p>", "panel_type_id" => 5, "has_header" => 1],

    		["id" => "8", "name" => "list_1", "header" => null, "content" => "<a> link </a></br><a> link </a></br><a> link </a></br><a> link </a></br>", "panel_type_id" => 7, "has_header" => 0],
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