// addfile js
// 

var _validFileExtensions = [".pdf", 
							".doc", 
							".docx",
							]; 

var input = document.getElementById('file');
input.addEventListener('change', function() {
	validateFile(this);
});

//load files from server
$(".ui.menuAdmin_add_file").on("click", function() {
	getFilesViaAjax();
});

//choose image
$("#input_button").on("click", function() {
	$("#file").click();
	return false;
});

function validateFile(input) {
	inputAlert("");
	//IS FILE CHOOSED
	if($("#file").val() < 1) {
		$("#file_name").html("");
		disableAddFileButton();
		return false;
	}

	var file = input.files[0];
	var file_name = file.name;
	max_file_size = 20971520; //20 Mb

	//CHECK IS FILE CHOOSED
	if($("#file").val() < 1) {
		$("#file_name").html("");
		enableAddFileButton();//disable
		return false;
	}

	//CHECK FILE SIZE
	if(file.size > max_file_size) {
		var message = "Za duży plik, max 20 Mb.";
		inputAlert(message);
		return false;
	}
	//CHECK EXTENSION
	if (file_name.length > 0) {
		var validExtension = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var currentExtension = _validFileExtensions[j];
			if (file_name.substr(file_name.length - currentExtension.length, currentExtension.length).toLowerCase() === currentExtension.toLowerCase()) {
				validExtension = true;
				break;
			}
		}		
		if (!validExtension) {
			var message = "Zły plik, dozwolone: " + _validFileExtensions.join(", ");
			inputAlert(message);
			return false;
		}
		if(file_name.length > 40) {
			file_name = file_name.substring(0,39) + "...";
		}
		$("#file_name").html(file_name);
		enableAddFileButton();
	}
}

function enableAddFileButton() {
	if($("#add_file_button").hasClass("disabled")) {
		$("#add_file_button").removeClass("disabled");
	}
}

function disableAddFileButton() {
	if(!$("#add_file_button").hasClass("disabled")) {
		$("#add_file_button").addClass("disabled");
	}
}

function sendEventPromise(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function sendFileViaAjax() {
	sendEventPromise({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: $("#upload_file_form").attr("action"),
		type: "POST",
		data: new FormData($("#upload_file_form")[0]),
		contentType: false,
		processData: false,
	})
	//success
	.then(function (response) {
		if(response.file_status === "success") {			
			document.getElementById("upload_file_form").reset();
			$("#file_name").html("");
			disableAddFileButton();
			toastr.success("Dodano plik");
			getFilesViaAjax();
		} else {
			$data = JSON.parse(response);
			$.each($data, function(key, value) {
				$(".input.alert").append("<p><i class='warning icon'></i>" + value + "</p>");
			})
		}		
	})
	//error
	.catch(function(error) {
		alert("file add ajax error: " + error);
	});
}

$("#add_file_button").on("click", function(event) {
	$(".input.alert").html("");
	event.preventDefault();
    event.stopImmediatePropagation();
	sendFileViaAjax();
	return false;
});

function inputAlert(string) {
	$(".alert")[0].removeAttribute("hidden");
	$(".input.alert").html(string);
}


function getFiles(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

function getFilesViaAjax() {
	getFiles({
		url: $("#files_dropdown").data("file_route"),
		type: "get",
	})
	//success
	.then(function (response) {
			$data = JSON.parse(response);
			$.each($data, function(key, value) {
				if(!checkIsValueInDropdown(key)) {					
			 		$("#files_dropdown").append("<option value="+ key +">"+ value +"</option>");
			 	}
			})				
	})
	//error
	.catch(function(error) {
		alert("file add ajax error: " + error);
	});
}

$("#copy_to_clipboard").on("click", function() {
	var path_to_file = $('#files_dropdown').find(":selected").val();

	// Check if copytoclipboard is supported
	// console.log(document.queryCommandSupported('copy'));
	// 
	if(path_to_file) {
		copyToClipboard(path_to_file);
	}	
});

function checkIsValueInDropdown(value) {
	var dropdown = document.getElementById("files_dropdown");
    var is_in_dropdown = false;
    var i;
    for (i = 0; i < dropdown.length; i++) {
        if(dropdown.options[i].value === value) {
        	is_in_dropdown = true;
        }
    }
    return is_in_dropdown
}
