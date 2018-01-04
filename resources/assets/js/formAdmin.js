// formAdmin js

$(document).ready(function() {
	$(".ui.centered.aligned.grid").removeAttr("style");
});

// cancel button
$("#cancel_button").on("click", function(el) {
	window.location.href = $(this).data("route");
});

// public button
$("#public_button").on("click", function() {
	$("#errors_list").html("").addClass("hidden");
	validateForm();
	sendPageData();
});

function isName() {
	var name = document.getElementById('admin_form').name.value;
	if(! name) {
		$("#name_warning").addClass("hidden");
		return false;
	} else {
		$("#name_warning").removeClass("hidden");		
		return true;
	}
}

function isLogin() {
	var login = document.getElementById('admin_form').login.value;
	if(! login) {
		$("#login_warning").addClass("hidden");
		return false;
	} else {
		$("#login_warning").removeClass("hidden");
		return true;
	}
}

function isPassword() {
	var password = document.getElementById('admin_form').password.value;
	if(! password) {
		$("#password_warning").addClass("hidden");
		return false;
	} else {
		$("#password_warning").removeClass("hidden");
		return true;
	}
}


function validateForm() {
	if(! isName() || ! isLogin() || ! isPassword())
		return false;

	return true;
}


function sendPageData() {

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