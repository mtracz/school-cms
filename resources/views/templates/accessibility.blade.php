<div class="accessibilities panel">

	<div class="header coral-color">
		<i class="large handicap icon"></i>{!! $item->panel->header !!}
	</div>

	<div class="content">
		
		{{-- {!! $item->panel->content !!} --}}

		<div class="row">
			Zmiana kontrastu
			<i class="big icons" data-action="change_contrast">
				<i class="adjust icon"></i>
			</i>
		</div>
		<div class="ui divider"></div>
		<div class="row">
			Zmiana czcionki 
			<i class="big icons" data-action="change_font_size" data-font_size="big">
				<i class="font icon"></i>
				<i class="corner add icon"></i>
				<i class="top right corner add icon"></i>
			</i>
			<i class="large icons" data-action="change_font_size" data-font_size="bigger">
				<i class="font icon"></i><i class="corner add icon"></i>
			</i>
			<i class="icons" data-action="change_font_size" data-font_size="default">
				<i class="font icon"></i> 
			</i>
			<div style="clear:both;"></div>
		</div>

	</div>

</div>
