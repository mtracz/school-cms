// addEditPanel.js
var customPanel = $(".ui.segment.preview").find(".custom.panel");
var custom_content = "";

$(document).ready(function() {	
	$("#preview_header").html("");

	if(customPanel.length > 0) {
		hideContentToolsIcon();	
	}
});

// preview button
$("#preview_button").on("click", function() {
	if($("#preview_news").attr("data-item_name") == "custom") {
		if(!validateTitle())
			return false;
	} else 
		if(!validateTitle() || !validateContent()) 
			return false;		

	if(customPanel.length > 0) {
		custom_content = $(".ui.segment.content textarea#custom_textarea").val();
		if(custom_content.length > 0) {
			$("#preview_content").html(custom_content);
			$("#content_warning").addClass("hidden");
			setContent();
			$("#preview_content").html(custom_content);
		} else {
			$("#content_warning").removeClass("hidden");
			return false;
		}		
	} else 
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

	toogleFontManagerSection();
	$("#errors_list").addClass("hidden");
});

// reedit button
$("#reedit_button").on("click", function() {
	if(customPanel.length > 0)
		hideContentToolsIcon();
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
	if(customPanel.length > 0)
		payload_form.append("content", custom_content);
	else
		payload_form.append("content", form_content);

	//form inputs
	payload_form.append("name", form.title.value);
	payload_form.append("json_images_src", json_images_src);

	payload_form.append("sector_id", $("#add_news_article_form").data("sector_id"));
	payload_form.append("panel_type_id", $("#add_news_article_form").data("panel_type_id"));

	if($(".ui.segment.preview").find(".banner.panel").length > 0)
		payload_form.append("header", "");	
	else
		payload_form.append("header", form.header.value);
	
	sendAjaxFormData(payload_form);
};

// 
