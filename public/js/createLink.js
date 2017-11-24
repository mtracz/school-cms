

//load news from server
$(".ui.item.menuAdmin_news_links").on("click", function() {
	getFilesViaAjax();
});

//load pages from server
$(".ui.item.menuAdmin_pages_links").on("click", function() {
	getFilesViaAjax();
});

function getFiles(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function getFilesViaAjax() {
	getFiles({
		url: $("#links_dropdown").data("link_route"),
		type: "get",
	})
	//success
	.then(function (response) {
			$data = JSON.parse(response);
			$.each($data, function(key, value) {
				if(!checkIsValueInDropdown(key)) {
			 		$("#links_dropdown").append("<option value="+ key +">"+ value +"</option>");
			 	}
			})				
	})
	//error
	.catch(function(error) {
		alert("links ajax error: " + error);
	});
}

$("#copy_to_clipboard_links").on("click", function() {
	var path_to_file = $('#links_dropdown').find(":selected").val();

	// Check if copytoclipboard is supported
	// console.log(document.queryCommandSupported('copy'));
	// 
	if(path_to_file) {
		copyToClipboard(path_to_file);
	}	
});

