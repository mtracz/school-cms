// center login form

function render() {
	var main_element = ".ui.grid > .column";

	var column_height = $(main_element).height();
	var space_top = $(window).height() / 2 - column_height / 2;

	$(main_element).css("margin-top", space_top);
};

render();

$(window).resize(function() {
	render();
});

// enter

$(document).keypress(function(e) {
	if(e.which == 13) {
		$("#login_button").trigger("click");
	}
});

// admin login blade

var input_login;
var input_password;

// LOGIN INPUT VALIDATE
$("#login_field").on("change keyup paste click", function(){
	$input_login = $("#login_input").val();
	$field = $("#login_field");
	validateInput($field, $input_login);
});

// PASSWORD INPUT VALIDATE
$("#password_field").on("change keyup paste click", function(){
	$input_password = $("#password_input").val();
	$field = $("#password_field");
	validateInput($field, $input_password);
});

function validateInput(field, input) {
	var input_length = input.length;
	if(input_length < 1) {
		$(field).addClass("error");		
	} else {
		$(field).removeClass("error");

	}
}

// login button
$("#login_button").on("click", function(event) {
	event.preventDefault();
	
	$("#errors_list").html("");
	if($("#login_field").hasClass("error")
		|| $("#password_field").hasClass("error")) {
		var error = "Wyszstkie pola są wymagane";
	$("#errors_list").css("display", '');
	
	$("#errors_list").append("<p><i class='warning icon'></i>" + error + "</p>");
	return false;
}
sendFormData();
});

function sendFormData() {
	var form = $("#login_form");

	$.ajax({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		type: "post",
		url: form.attr("action"),
		data: form.serialize(),
		success: function(data) {
			if(data.login_status == "success") {				
				window.location.href = data.login_route;
			} else {
				$data = JSON.parse(data);
				$.each($data, function(key, value) {
					$("#errors_list").append("<p><i class='warning icon'></i>" + value + "</p>");
					
					if(/dane/.test(value)) {
						$("#login_field").addClass("error");
						$("#password_field").addClass("error");
					}
				});
				return false;
			}
			
		},
		error: function() {
			toastr.error("Do logowania wymagana jest obsługa plików cookies.");
			alert('login admin ajax error');
		}
	})
	
}