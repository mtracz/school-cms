// formNewsPage js

//global variable for content tools
var form_content;

//global for images src in content preview before publish
var json_images_src;



$(window).ready(function() {
	$(".ui.centered.aligned.grid").removeAttr("style");
});

$(document).ready(function() {
	form_content = "";
	hideButtons();
	//paste content to form_content onload edit form
	form_content = $(".ui.segment.content").html();


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
		error: function(error) {
			alert('add news ajax error: ' + error);
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