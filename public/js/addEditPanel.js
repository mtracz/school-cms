// addEditPanel.js

$(document).ready(function() {
	$("#preview_header").html("");
});

// preview button
$("#preview_button").on("click", function() {
	if($("#preview_news").attr("data-item_name") == "banner") {		
		if(!validateContent())
			return false;
	} else {
		if(!validateTitle() || !validateContent()) {
			return false;
		}
	}
	
	setContent();
	//override setContent();
	var form = document.getElementById('add_news_article_form');
	let header = form.header.value;
	if(header.length > 0) {
		$("#preview_header").html(header);
		$("#preview_header").show();
	}
	else 
		$("#preview_header").hide();
	
	//--
	toogleFontManagerSection();
	$("#errors_list").addClass("hidden");

	//render content to html if custom panel chose
	let customPanel = $(".ui.segment.preview").find(".custom.panel")
	if(customPanel) {
		var content = $("textarea#custom_textarea").val();		
		console.log("content", content);
		alert(content);
		$("#preview_content").html(content);
	}	
});

// public button
$("#public_button").on("click", function() {
	sendPageData();
});

function sendPageData() {

	var payload_form = new FormData();
	var form = document.getElementById('add_news_article_form');
	
	//ADD TO FORM
	//global content variable
	payload_form.append("content", form_content);
	//form inputs
	payload_form.append("name", form.title.value);
	payload_form.append("json_images_src", json_images_src);

	payload_form.append("sector_id", $("#add_news_article_form").data("sector_id"));
	payload_form.append("panel_type_id", $("#add_news_article_form").data("panel_type_id"));

	payload_form.append("header", form.header.value);
	
	sendAjaxFormData(payload_form);
};

// 
