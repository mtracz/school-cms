function DateAnalyzer() {

	
	//Stores dates from left to right, from oldest to newest respectively

	this.comparingArray = [

	"create","publish","update","expire"

	];

	this.compareTimestamps = (first, sign, second) => {

		if( first + " " + sign + " " + second ) {
			return true;
		} else {
			return false;
		}
	}
}

// !! JUST A REFERENCE !!
	// 
	// this.serverURL = window.location.href + "/event";

	// this.sendEvent = (eventData) => {

	// 	console.log("EventSubscriber -> sendEvent");

	// 	sendEventPromise({
	// 		headers: {
	// 			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
	// 		},
	// 		url: this.serverURL,
	// 		method: "POST",
	// 		data: eventData,
	// 	})
	// 	.then(function (){
	// 		console.log("EventSubscriber -> sendEvent: success");
	// 	})
	// 	.catch(function(error) {
	// 		console.log("EventSubscriber -> sendEvent: error" + error);
	// 	});
	// };