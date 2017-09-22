// addEditPage.js

$(document).ready(function() {
	$("#info_preview").hide();
});

// preview button
$("#preview_button").on("click", function() {
	if(!validateTitle() || !validateContent()) {
		return false;
	}
	setContent();
	toogleFontManagerSection();
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
	//form inputs, checkboxes
	payload_form.append("title", form.title.value);
	payload_form.append("is_public", form.is_public.checked);
	payload_form.append("json_images_src", json_images_src);
	
	sendAjaxFormData(payload_form);	
};
