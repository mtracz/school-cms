// formNewsPage js

//global variable for content tools
var form_content;

//global for images src in content preview before publish
var json_images_src;

var fontManager = {
	selection: '',
	font_color: '',
	background_color: '',
	font_size: '13px'
	
};

$(window).ready(function() {

	//KOLOR CZCIONKI
	$('select[name="colorpicker-picker-longlist-font-color"]').simplecolorpicker({
		picker: true
	}).on('change', function() {
		fontManager.font_color = $('select[name="colorpicker-picker-longlist-font-color"]').val();

			var font_tag = document.createElement('font');
		    font_tag.style["color"] = fontManager.font_color;
		    font_tag.textContent = fontManager.selection;    

			if(fontManager.selection.rangeCount) {
				var range = fontManager.selection.getRangeAt(0).cloneRange();
				range.surroundContents(font_tag); //bugs here
				fontManager.selection.removeAllRanges();
				fontManager.selection.addRange(range);
			}
		});

	//KOLOR TŁA
	$('select[name="colorpicker-picker-longlist-font-background-color"]').simplecolorpicker({
		picker: true
	}).on('change', function() {
			fontManager.background_color = $('select[name="colorpicker-picker-longlist-font-background-color"]').val();

			var font_tag = document.createElement('font');
		    font_tag.style["background-color"] = fontManager.background_color;
		    font_tag.textContent = fontManager.selection;    

		    var range = fontManager.selection.getRangeAt(0).cloneRange();
		    range.surroundContents(font_tag);//bugs here
		    fontManager.selection.removeAllRanges();
		    fontManager.selection.addRange(range);
		});

	//disable colorpicker span click
	$(".simplecolorpicker.icon").css("pointer-events", "none");
	
	$(".ui.centered.aligned.grid").removeAttr("style");
});

//FONT SIZE ON CHANGE
$('#change_font_size').on("click", function(event) {

	if(!checkEditorIsInEditState() || !checkIsTextSelectedInFontManager()) {
		event.stopImmediatePropagation();
		return false;
	}
});

$('#change_font_size').dropdown({ 
 onChange: function(val) {
	 	var font_tag = document.createElement('font');
	 	font_tag.style["font-size"] = val;	    
	 	font_tag.textContent = fontManager.selection; 

	 	var range = fontManager.selection.getRangeAt(0).cloneRange();	 
	 	range.surroundContents(font_tag);//bugs here
	 	fontManager.selection.removeAllRanges();
	 	fontManager.selection.addRange(range);
	}
});


////
$("#change_font_color").on("click", function(event) {
	let x =  $(".font_color").find('.simplecolorpicker.icon');	
  	if(!checkEditorIsInEditState() || !checkIsTextSelectedInFontManager()) return false;

	x.click();
});
//////
$("#change_font_background_color").on("click", function(event) {
	let x =  $(".font_background_color").find('.simplecolorpicker.icon');
	if(!checkEditorIsInEditState() || !checkIsTextSelectedInFontManager()) return false;
	
	x.click();
});
/////

function checkIsTextSelectedInFontManager() {
	if(!fontManager.selection != '') {
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

$(document).ready(function() {
	form_content = "";
	hideButtons();
	//paste content to form_content onload edit form
	form_content = $(".ui.segment.content").html();
});

if(!window.Kolich){
	Kolich = {};
}

Kolich.Selector = {};
Kolich.Selector.getSelected = function(){
	var t = '';
	if(window.getSelection){
		t = window.getSelection();
	}else if(document.getSelection){
		t = document.getSelection();
	}else if(document.selection){
		t = document.selection.createRange().text;
	}
	return t;
  // Kolich
}

Kolich.Selector.mouseup = function() {
	var selected_text = Kolich.Selector.getSelected();
  // console.log("selected text before: " + fontManager.selection);
  	if(selected_text != '') {
  	fontManager.selection = selected_text;
  	} else {
  	fontManager.selection = '';
  }
// console.log("selected text after: " + fontManager.selection);
}

$(document).ready(function() {
	$('.ui.segment.content').on("mouseup", Kolich.Selector.mouseup);
});

// /////////////////////

// cancel button
$("#cancel_button").on("click", function() {
	window.location.href = "/";
});

// reedit button
$("#reedit_button").on("click", function() {
	showContentToolsIcon();
	hideButtons();
	$("#add_news_article_form").show();
	$("#preview_news").hide();
	$("#edit_step").addClass("active").removeClass("completed");
	$("#preview_step").addClass("disabled").removeClass("active");
	toogleFontManagerSection();
});

// public button
$("#public_button").on("click", function() {
	getImagesSrc();
	$("#errors_list").html("").addClass("hidden");
});


function hideButtons() {
	$("#reedit_button").hide();
	$("#public_button").hide();
	$("#cancel_button").show();
	$("#preview_button").show();
}

function showButtons() {
	$("#reedit_button").show();
	$("#public_button").show();
	$("#cancel_button").hide();
	$("#preview_button").hide();
}

function isTitle() {
	var title = document.getElementById('add_news_article_form').title.value;
	if(! title) {
		return false;
	} else {
		return true;
	}
}

function isContent() {
	if($(".ui.segment.content").data("editing_mode") === "true") {
		form_content = $(".ui.segment.content").html();
	}
	if(form_content < 1) {
		return false;
	} else {
		return true;
	}
}

function getImagesSrc() {	
	var images_src = [];
	$("#preview_content").children("img").each(function() {		
		images_src.push($(this).attr('src')); 

	});
	json_images_src = JSON.stringify(images_src);
}

function hideContentToolsIcon() {
	$(".ct-widget.ct-ignition").hide();
}

function showContentToolsIcon() {
	$(".ct-widget.ct-ignition").show();
}

function sendAjaxFormData(payload) {
	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		type: "post",
		url: $("#add_news_article_form").attr("action"),
		data: payload,
		processData: false,
		contentType: false,
		success: function(data) {
			if(data.add_status === "success" ||
				data.edit_status === "success") {
				window.location.href = data.route;
		} else {				
			$("#errors_list").removeClass("hidden");
			errors = JSON.parse(data);
			$.each(errors, function(key, value) {
				$("#errors_list").append("<p><i class='warning icon'></i>" + value + "</p>");
			});
		}
	},
	error: function(XMLHttpRequest, textStatus, errorThrown) {
		alert('add news ajax error: ', errorThrown);
	}
});
}

function validateTitle() {
	if(! isTitle()) {
		$("#title_warning").removeClass("hidden");
		return false;
	} else {
		$("#title_warning").addClass("hidden");
		return true;
	}
}

function validateContent() {
	if(! isContent()) {
		$("#content_warning").removeClass("hidden");
		return false;
	} else {
		$("#content_warning").addClass("hidden");
		return true;
	}
}

function setContent() {
	//copy title
	var title = document.getElementById('add_news_article_form').title.value;
	$("#preview_header").html(title);
	//copy content
	$("#preview_content").html(form_content);

	hideContentToolsIcon();
	showButtons();
	$("#add_news_article_form").hide();
	$("#preview_news").show();
	$("#edit_step").addClass("completed").removeClass("active");
	$("#preview_step").addClass("active").removeClass("disabled");
}

function toogleFontManagerSection() {
	$(".font_manager_section").toggle();
}