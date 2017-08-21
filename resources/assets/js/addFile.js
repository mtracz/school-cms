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

//choose image
$("#input_button").on("click", function() {
	$("#file").click();
	return false;
});

$("#add_file_button").on("click", function() {
	saveFile();
});

function validateFile(input) {

	var file = input.files[0];
	var file_name = file.name;
	max_file_size = 20971520; //20 Mb
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

function saveFile() {

	var form_data = new FormData($("#upload_file_form")[0]);
	// form_data.append("img_src", img_src);

	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: $("#upload_file_form").attr("action"),
		type: "POST",
		data: form_data,
		contentType: false,
		processData: false,
		success: function(data) {
			if(data.file_status === "success") {
				inputAlert(data.message);
			} else {
				inputAlert("NIE DODANO");
				return false;
			}
			//redirect after avatar saved
			// window.location.replace(data);
			// alert("success");
		},
		error: function(){
			alert("Chwilowe problemy w działaniu serwisu. Please stand by..");
		}
	})
}

function inputAlert(string) {
	$(".alert")[0].removeAttribute("hidden");
	$(".input.alert").html(string);
}