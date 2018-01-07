// formAdmin js

$(document).ready(function() {
	$(".ui.centered.aligned.grid").removeAttr("style");
});

// cancel button
$("#cancel_button").on("click", function(el) {
	window.location.href = $(this).data("route");
});

// save button
$("#save_button").on("click", function() {
	$("#errors_list").html("").addClass("hidden");
	if(validateForm())
		if(validateInputLength()) 
			sendAdminData();		
		else
			$("#errors_list").removeClass("hidden").html("Nazwa, login i hasło min. 6 znaków.");	
	else
		$("#errors_list").removeClass("hidden").html("Wszystkie pola są wymagane.");
});

// reset password button
$("#reset_password_button").on("click", function() {
	var form = document.getElementById('admin_form');
	form.password.type = "text";
	form.password.value = getTimeStamp();
});

function getTimeStamp() {
       var now = new Date();
       return (
       	// (now.getMonth() + 1) 
       	// + '/' + (now.getDate()) 
       	// + '/' + now.getFullYear() 
       	now.getHours() 
       	+''+ ((now.getMinutes() < 10) ? ("0" + now.getMinutes()) : (now.getMinutes())) 
       	+''+ ((now.getSeconds() < 10) ? ("0" + now.getSeconds()) : (now.getSeconds()))
       	);
}


function isName() {
	var name = document.getElementById('admin_form').name.value;
	if(! name)
		return false;
	else
		return true;
}

function isLogin() {
	var login = document.getElementById('admin_form').login.value;
	if(! login)
		return false;
	else 
		return true;
}

function isPassword() {
	var password = document.getElementById('admin_form').password.value;
	if(! password)
		return false;
	else
		return true;
}

function validateForm() {
	var edit_mode = $(".field.password input").attr("disabled");
	if(edit_mode && edit_mode != false) {
		if(! isName() || ! isLogin())
			return false;
	} else {
		if(! isName() || ! isLogin() || ! isPassword())
			return false;
	}

	return true;
}

function validateInputLength() {
	var form = document.getElementById('admin_form');
	var edit_mode = $(".field.password input").attr("disabled");
	if(edit_mode && edit_mode != false) {
		if(form.name.value.length < 6 || form.login.value.length < 6)
			return false;
	} else {
		if(form.name.value.length < 6 || form.login.value.length < 6 || form.password.value.length < 6)
			return false;
	}

	return true;
}

function sendAdminData() {

	var payload_form = new FormData();
	var form = document.getElementById('admin_form');
	
	//ADD TO FORM
	//form inputs, checkboxes
	payload_form.append("name", form.name.value);
	payload_form.append("login", form.login.value);
	payload_form.append("password", form.password.value);
	payload_form.append("is_active", form.is_active.checked);
	
	sendAjaxFormData(payload_form);
};

function sendAjaxFormData(payload) {
	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		type: "post",
		url: $("#admin_form").attr("action"),
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