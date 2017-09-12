<div class="accessibilities panel">

	<div class="header coral-color">
		<i class="large handicap icon"></i>{!! $item->panel->header !!}
	</div>

	<div class="content">
		
		{{-- {!! $item->panel->content !!} --}}


		<div class="row">
			Zmiana kontrastu
			<i id="change_contrast" class="big icons" data-action="change_contrast">
				<i class="adjust icon"></i>
			</i>
		</div>
		<div class="ui divider"></div>
		<div class="row">
			Zmiana czcionki 
			<i class="big icons change_font" data-action="change_font_size" data-font_size="biggest" data-font_value="{{ $font_values["biggest"] }}" >
				<i class="font icon"></i>
				<i class="corner add icon"></i>
				<i class="top right corner add icon"></i>
			</i>
			<i class="large icons change_font" data-action="change_font_size" data-font_size="big" data-font_value="{{ $font_values["big"] }}" >
				<i class="font icon"></i><i class="corner add icon"></i>
			</i>
			<i class="icons change_font" data-action="change_font_size" data-font_size="standard" data-font_value="{{ $font_values["standard"] }}" >
				<i class="font icon"></i> 
			</i>
			<div style="clear:both;"></div>
		</div>

	</div>

</div>
