

function enableFontManager(target) {
	$(target).on("mouseup", CurrentSelection.Selector.mouseup);
}


$(window).ready(function() {

	//KOLOR CZCIONKI
	$('select[name="colorpicker-picker-longlist-font-color"]').simplecolorpicker({
		picker: true
	}).on('change', function() {
		var color = $('select[name="colorpicker-picker-longlist-font-color"]').val();

			var font_tag = document.createElement('font');
		    font_tag.style["color"] = color;
		    font_tag.textContent = CurrentSelection.selection;    

			// if(fontManager.selection.rangeCount) {
				var range = CurrentSelection.selection.getRangeAt(0).cloneRange();
				range.surroundContents(font_tag); //bugs here
				CurrentSelection.selection.removeAllRanges();
				CurrentSelection.selection.addRange(range);
			// }
		});

	//KOLOR TŁA
	$('select[name="colorpicker-picker-longlist-font-background-color"]').simplecolorpicker({
		picker: true
	}).on('change', function() {
			var background_color = $('select[name="colorpicker-picker-longlist-font-background-color"]').val();

			
			var font_tag = document.createElement('font');
		    font_tag.style["background-color"] = background_color;
		    font_tag.textContent = CurrentSelection.selection;    

		    var range = CurrentSelection.selection.getRangeAt(0).cloneRange();
		    range.surroundContents(font_tag);//bugs here
		    CurrentSelection.selection.removeAllRanges();
		    CurrentSelection.selection.addRange(range);
		});

	//disable colorpicker span click
	$(".simplecolorpicker.icon").css("pointer-events", "none");
	
	
});

//FONT SIZE ON CHANGE
$('#change_font_size').on("click", function(event) {

	if(!checkEditorIsInEditState() || !checkIsTextSelectedInCurrentSelection()) {
		event.stopImmediatePropagation();
		return false;
	}
});

$('#change_font_size').dropdown({ 
 onChange: function(val) {

	 	var font_tag = document.createElement('font');
	 	font_tag.style["font-size"] = val;	    
	 	font_tag.textContent = CurrentSelection.selection; 

	 	var range = CurrentSelection.selection.getRangeAt(0).cloneRange();	 
	 	range.surroundContents(font_tag);//bugs here
	 	CurrentSelection.selection.removeAllRanges();
	 	CurrentSelection.selection.addRange(range);
	}
});


////
$("#change_font_color").on("click", function(event) {
	let x =  $(".font_color").find('.simplecolorpicker.icon');	
  	if(!checkEditorIsInEditState() || !checkIsTextSelectedInCurrentSelection()) return false;

	x.click();
});
//////
$("#change_font_background_color").on("click", function(event) {
	let x =  $(".font_background_color").find('.simplecolorpicker.icon');
	if(!checkEditorIsInEditState() || !checkIsTextSelectedInCurrentSelection()) return false;
	
	x.click();
});
/////

function checkIsTextSelectedInCurrentSelection() {
	if(CurrentSelection.selection == "") {
		toastr.warning("Zaznacz tekst w polu 'Treść'.");
		return false;
	}
	return true;
}

function checkEditorIsInEditState() {
	if(! $(".ct-widget.ct-ignition.ct-widget--active").hasClass("ct-ignition--editing")) {
  		toastr.warning("Włącz tryb edycji aby edytowakć czcionkę.");
		return false;
	}
	return true;
}

if(!window.CurrentSelection){
	CurrentSelection = {
		selection: '',
	};
}

CurrentSelection.Selector = {};
CurrentSelection.Selector.getSelected = function() {
	var text = '';
	if(window.getSelection){
		text = window.getSelection();
	}else if(document.getSelection){
		text = document.getSelection();
	}else if(document.selection){
		text = document.selection.createRange().text;
	}
	return text;
}

CurrentSelection.Selector.mouseup = function() {

	var selected_text = CurrentSelection.Selector.getSelected();
  	if(selected_text != '') {
  		CurrentSelection.selection = selected_text;
  	} else {
  		CurrentSelection.selection = '';
  	}
}
