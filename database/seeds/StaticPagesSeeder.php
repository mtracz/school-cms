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
				'<table class="ui collapsing table kontakt" style="border: none;">
				<tbody >		
				<tr>
				<td>
				<b>Adres</b>
				
				<br>
				Szkoła Podstawowa nr 9<br>
				ul. Marynarska 31<br>
				59-220 Legnica<br><br>				

				<br><b>Sekretariat</b> <br>
				tel. 76 72 33 130 <br>
				fax: 76 75 40 104 <br>
				e-mail: <a href="mailto:sekretariat@sp9.legnica.eu">sekretariat@sp9.legnica.eu</a> <br><br>

				<br><b>Kontakt z administratorem strony:</b> <br>
				<a href="mailto:info@sp9.legnica.pl">info@sp9.legnica.pl</a>
				</td>

				<td class="text-left" style="width: 100px;">
				</td>

				<td valign="top" style="min-width: 285px;">				
				<b>Dyrektor szkoły</b> - mgr Katarzyna Hornicka
				<br><br>				
				</td>
				</tr>
				</tbody>
				</table>

				<img class="align-left" src="http://sp9.legnica.pl/images_old/szkola.jpg" title="Szkoła Podstawowa nr 9 w Legnicy" 
				style="width: 200px">

				<iframe class="align-left" width="200" height="130" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.pl/maps?hl=pl&amp;lr=&amp;ie=UTF8&amp;q=sp+9+legnica&amp;fb=1&amp;split=1&amp;gl=pl&amp;cid=0,0,7333007650869757657&amp;ei=r_9NSuz9CpLm-Qbl6NCEBA&amp;source=embed&amp;ll=51.203562,16.14134&amp;spn=0.006295,0.006295&amp;output=embed">
				
				</iframe>', 
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
