// admin create blade

var input_super_admin_login;
var input_super_admin_password;
var input_super_admin_password_confirmation;
var input_super_admin_email;

// LOGIN INPUT VALIDATE
$("#super_admin_login").on("change keyup paste click", function(){
	$input_super_admin_login = $("#super_admin_login_input").val();
	$field = $("#super_admin_login");
	validateInput($field, $input_super_admin_login);
});

// PASSWORD INPUT VALIDATE
$("#super_admin_password").on("change keyup paste click", function(){
	$input_super_admin_password = $("#super_admin_password_input").val();
	$field = $("#super_admin_password");
	validateInput($field, $input_super_admin_password);
});

// PASSWORD CONFIRMATION INPUT VALIDATE
$("#super_admin_password_confirmation").on("change keyup paste click", function(){
	$input_super_admin_password_confirmation = $("#super_admin_password_confirmation_input").val();
	$field = $("#super_admin_password_confirmation");
	validateInput($field, $input_super_admin_password_confirmation);
});

// EMAIL INPUT VALIDATE
$("#super_admin_email").on("change keyup paste click", function(){
	$input_super_admin_email = $("#super_admin_email_input").val();
	$field = $("#super_admin_email");
	validateInput($field, $input_super_admin_email);
});


function validateInput(field, input) {
	var input_length = input.length;
	if(input_length < 6) {
		$(field).addClass("error");
	} else {
		$(field).removeClass("error");
	}
}

function validateEmail(email) {
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/; 
	return emailPattern.test(email);	//true or false
}

// create/save button
$("#create_super_admin_form").on("submit", function(event) {
	event.preventDefault();
	
	$("#errors_list").html("");
	if($("#super_admin_login").hasClass("error")
		|| $("#super_admin_password").hasClass("error")
		|| $("#super_admin_password_confirmation").hasClass("error")
		|| $("#super_admin_email").hasClass("error")) {
			var error = "Wyszstkie pola są wymagane";
			$("#errors_list").html(error);
			return false;
	}	

	if($input_super_admin_password != $input_super_admin_password_confirmation) {
		var error = "Hasła się nie zgadzają";
		$("#errors_list").html(error);
		$("#super_admin_password").addClass("error");
		$("#super_admin_password_confirmation").addClass("error");
		return false;
	} else {
		$("#super_admin_password").removeClass("error");
		$("#super_admin_password_confirmation").removeClass("error");
	}

	if(! validateEmail($input_super_admin_email)) {
		var error = "Podaj poprawny email";
		$("#errors_list").html(error);
		$("#super_admin_email").addClass("error");
		return false;
	} else {
		$("#super_admin_email").removeClass("error");
	}

	sendFormData();
});

function sendFormData() {
	var form = $("#create_super_admin_form").serialize();

	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		type: "post",
		url: $("#create_super_admin_form").attr("action"),
		data: form,
		success: function(data) {
			if(data.register_status == "success") {
				alert("success");
				location.reload(false);
			} else {
				$data = JSON.parse(data);
				$.each($data, function(key, value) {
					$("#errors_list").append("<p><i class='warning icon'></i>" + value + "</p>");
					
					if(/login/.test(value)) {
						$("#super_admin_login").addClass("error");
					}
					if(/hasł/.test(value)) {
						$("#super_admin_password").addClass("error");
						$("#super_admin_password_confirmation").addClass("error");
					}
					if(/mail/.test(value)) {
						$("#super_admin_email").addClass("error");
					}
				});
				return false;
			}		
		},
		error: function() {
			alert('create super admin ajax error');
		}
	})
	
}