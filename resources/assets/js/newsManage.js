
$(".preview_toggle_button").on("click", function() {

	var obj = $(".news_manage").find(".preview_content [data-id='"+ $(this).attr("data-id") +"']").closest("tr");

	$(obj).toggle( "fast", function() {} );
});