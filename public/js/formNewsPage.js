// formNewsPage js

//global variable for content tools
var form_content;

//global for images src in content preview before publish
var json_images_src;

var fontManager = {
	selection: '',
	
};

$(window).ready(function() {

	$(".ui.centered.aligned.grid").removeAttr("style");
});

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
  // alert("select:\n"+selected_text);
  console.log("selected text before: " + fontManager.selection);
  if(selected_text !== '') {
  	// alert("You selected:\n"+selected_text);
  	fontManager.selection = selected_text;
  	$("#change_font_size").removeAttr("disabled");
  	$("#change_font_color").removeAttr("disabled");
  	$("#change_font_background_color").removeAttr("disabled");

 //  	var font_tag = document.createElement('font');

 //    font_tag.style["font_tag-size"] = "30px";
 //    font_tag.style["color"] = "red";
 //    font_tag.style["background-color"] = "yellow";
 //    font_tag.textContent = selected_text;    

	// alert("You selected:\n"+selected_text);

	// var range = selected_text.getRangeAt(0).cloneRange();
 //            range.surroundContents(font_tag);
 //            selected_text.removeAllRanges();
 //            selected_text.addRange(range);

    // var font = document.createElement('font');

    // font.style["font-size"] = "30px";
    // font.style["color"] = "red";
    // font.style["background-color"] = "yellow";
    // font.textContent = st;    
    // // var selection = getSelectedText();
    // var range = st.getRangeAt(0);
    // range.deleteContents();
    // range.insertNode(font);
  } else {
  	fontManager.selection = '';
  }

  console.log("selected text after: " + fontManager.selection);
}

$(document).ready(function(){
  $('.ui.segment.content').bind("mouseup", Kolich.Selector.mouseup);
});

$(document).on("mouseup", function() {
	console.log("Any mouseup: ",fontManager.selection.toString());
});

// /////////////////////
// 
// $("#change_font_size").change(function() {	
// 	//select value
//     console.log($(this).val());
//     let selected_item = $(this).val();
   
//     let selection_string = fontManager.selection.toString();
//     if(selection_string.length > 0) {
//     	// alert("zmien");
//     	var font_tag = document.createElement('font');

// 		font_tag.style["font-size"] = selected_item;
// 		font_tag.textContent = selection_string;

// 		var range = fontManager.selection.getRangeAt(0).cloneRange();
// 		// range.surroundContents(font_tag);

// 		range.deleteContents();
//     	range.insertNode(font_tag);
// 		// fontManager.selection.removeAllRanges();
// 		// fontManager.selection.addRange(range);
// 		fontManager.selection = "";
// 		$(this).val("");
// 		$(this).attr("disabled", "");
// 		$("#change_font_color").attr("disabled", "");
// 		$("#change_font_background_color").attr("disabled", "");

//     }

// });

// $("#change_font_color").on("click", ".item", function() {	
// 	//select value
//     console.log($(this));
//     console.log($(this).attr("data-value"));
//     let selected_item = $(this).attr("data-value");
   
//     let selection_string = fontManager.selection.toString();
//     if(selection_string.length > 0) {
//     	// alert("zmien");
//     	var font_tag = document.createElement('font');

// 		font_tag.style["color"] = selected_item;
// 		font_tag.textContent = selection_string;

// 		var range = fontManager.selection.getRangeAt(0).cloneRange();
// 		// range.surroundContents(font_tag);

// 		range.deleteContents();
//     	range.insertNode(font_tag);
// 		// fontManager.selection.removeAllRanges();
// 		// fontManager.selection.addRange(range);
// 		// fontManager.selection = "";
// 		$(this).closest(".text").text("Kolor czcionki");
// 		$(this).attr("disabled", "");
// 		$("#change_font_size").attr("disabled", "");
// 		$("#change_font_background_color").attr("disabled", "");
//     }
// });

$("#change_font_color").change(function() {	
	//select value
    console.log($(this).val());
    console.log($(this));
    let selected_item = $(this).val();
   
    let selection_string = fontManager.selection.toString();
    if(selection_string.length > 0) {
    	// alert("zmien");
    	var font_tag = document.createElement('font');

		font_tag.style["color"] = selected_item;
		font_tag.textContent = selection_string;

		var range = fontManager.selection.getRangeAt(0).cloneRange();
		// range.surroundContents(font_tag);

		range.deleteContents();
    	range.insertNode(font_tag);
		// fontManager.selection.removeAllRanges();
		// fontManager.selection.addRange(range);
		fontManager.selection = "";
		$(this).val("");
		$(this).attr("disabled", "");
		$("#change_font_size").attr("disabled", "");
		$("#change_font_background_color").attr("disabled", "");
    }

});

$("#change_font_background_color").change(function() {	
	//select value
    console.log($(this).val());
    let selected_item = $(this).val();
   
    let selection_string = fontManager.selection.toString();
    if(selection_string.length > 0) {
    	// alert("zmien");
    	var font_tag = document.createElement('font');

		font_tag.style["background-color"] = selected_item;
		font_tag.textContent = selection_string;

		var range = fontManager.selection.getRangeAt(0).cloneRange();
		// range.surroundContents(font_tag);

		range.deleteContents();
    	range.insertNode(font_tag);
		// fontManager.selection.removeAllRanges();
		// fontManager.selection.addRange(range);
		fontManager.selection = "";
		$(this).val("");
		$(this).attr("disabled", "");
		$("#change_font_size").attr("disabled", "");
		$("#change_font_color").attr("disabled", "");
    }

});




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