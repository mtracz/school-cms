<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class StaticPagesSeeder extends Seeder
{

	public function run() {

		$pages = [];
		$pagesLastId = DB::table('static_pages')->max('id');
		$i = 1;
		array_push(
			$pages,
			["id" => $pagesLastId + $i, 
			"title" => "Kontakt", 
			"content" => 
				'<div class="ui grid">
				  <div class="eight wide column" style="padding: 30px !important; border-right: 1px solid #eeeeee;">  		 	 
				  <b>Adres:</b><br>
				  <img src="http://sp9.legnica.pl/images/szkola.jpg" title="Szkoła Podstawowa nr 9 w Legnicy">
				  <br>
				  Szkoła Podstawowa nr 9<br>
				  ul. Marynarska 31<br>
				  59-220 Legnica<br>
				  <br>
				  <iframe width="170" height="130" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.pl/maps?hl=pl&amp;lr=&amp;ie=UTF8&amp;q=sp+9+legnica&amp;fb=1&amp;split=1&amp;gl=pl&amp;cid=0,0,7333007650869757657&amp;ei=r_9NSuz9CpLm-Qbl6NCEBA&amp;source=embed&amp;ll=51.203562,16.14134&amp;spn=0.006295,0.006295&amp;output=embed"></iframe>
				  <br>
				  <b>Sekretariat:</b><br>
				  tel.: 76 72 33 130<br>
				  fax: 76 75 40 104<br>
				  <br>
				  <b>E-mail:</b><br>
				  <a href="mailto:info@sp9.legnica.pl">info@sp9.legnica.pl</a>
				  <br><br>
				  </div>
				  <div class="eight wide column" style="padding: 30px !important">
				  <b>Dyrektor szkoły</b> - mgr Katarzyna Hornicka<br> 
				  jest do Państwa dyspozycji:<br><br>
				  - w poniedziałek - od 7.30 - 8.30<br>
				  - w czwartek - od 14.30 - 15.30
				  </div>
				 </div>', 
			"slug" => "kontakt", 
			"created_by" => 1, 
			"is_public" => 1, 
			"created_at" => Carbon::now()]
			);
		$i++;

		Schema::disableForeignKeyConstraints();

		foreach ($pages as $array) {
			if(!DB::table("static_pages")->find($array["id"])) {
				DB::table("static_pages")->insert($array); 
			}
		}
	}

}
