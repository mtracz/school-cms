
var settingsUrl = window.location.origin + "/settings/set";

$(".ui.button.settings.submit").on("click", function(event) {
	event.preventDefault();

	var formData = $("#settings_form :not(.change_password_toggle input):not(.field.maintenance input)").serialize();

	if( $(".field.maintenance .ui.toggle.checkbox input").is(":checked") ) {
		formData += "&is_maintenance_mode=" + 1;
	} else {
		formData += "&is_maintenance_mode=" + 0;
	}
	postSettingsData({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: settingsUrl,
		method: "POST",
		data: formData,
		beforeSend: function() {
			$(".ui.dimmer").dimmer("show");
		},
	})
	.then(function (data) {
		$(".ui.dimmer").dimmer("hide");

		toastr.success("<h1> Zapisano zmiany! </h1>");

		console.log("SettingsForm: Submit success");
	})
	.catch(function (error) {

		console.log("SettingsForm: Submit fail. ERROR: " + error);
		alert("SettingsForm: Submit fail. ERROR: " + error);
	});
});

function postSettingsData(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}



$(".show_change_password_toggle").on("click", function () {
	
	$(".change_password_toggle").slideToggle();

	$(".show_change_password_toggle").toggleClass("active");
});



var changePasswordUrl = window.location.origin + "/password/change";

$(".ui.button.password.submit").on("click", function (event) {
	event.preventDefault();

	var changePasswordData = $(".change_password_toggle input").serialize();

	console.log(changePasswordData);

	postChangePassword({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		url: changePasswordUrl,
		method: "POST",
		data: changePasswordData,
		beforeSend: function() {
			$(".ui.dimmer").dimmer("show");
		},
	})
	.then(function (data) {
		$(".ui.dimmer").dimmer("hide");

		console.log("data", data);

		if( data["password_change"] == "success" ) {

			clearChangePasswordInputs();

			console.log("SettingsForm: Submit success");
			toastr.success("<h2> Hasło zostało pomyślnie zmienione! </h2>");
			
		} else {

			clearChangePasswordInputs();

			var error_message = createErrorMessage(data["errors"]);

			toastr.error(error_message, "<h2> Dane zmiany hasła niepoprawne </h2>");
			console.log("SettingsForm: Submit fail. ERROR: Data incorrect", data["errors"][0]);
		}
	})
	.catch(function (error) {

		console.log("SettingsForm: Submit fail. ERROR: " + error);
		alert("SettingsForm: Submit fail. ERROR: " + error);
	});
});

function createErrorMessage(errors_array) {
		
	let error_message = "";

	for( var i = 0; i < errors_array.length; i++ ) {
		error_message = error_message.concat(errors_array[i]) + "<br>";
	}

	return error_message;
}

function clearChangePasswordInputs() {
	$("input[type='password']").val("");
}

function postChangePassword(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}

