$(".preview_toggle_button").on("click", function() {

	var id = $(this).attr("data-id");

	var obj = $(".news_manage").find(".preview_content[data-id='"+ id +"']").closest("tr");

	console.log(obj);
	$(obj).toggle( "fast", function() {} );
});


$(".actions .ui.button").on("click", function() {

	window.location.href = $(this).attr("data-url");
});
