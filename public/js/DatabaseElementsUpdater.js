function DatabaseElementsUpdater() {

	this.elementsUpdateURL = window.location.origin + "/element/manage/update";

	this.elementsToUpdate = [];

	this.ajaxData = {
		"data" : [],
	};

	this.sendToUpdate = () => {

		this.ajaxData.data = this.elementsToUpdate;

		this.sendAjax(this.ajaxData);

		this.elementsToUpdate = [];
		this.ajaxData.data = [];
	}

	this.sendAjax = (data) => {

		this.sendElementsUpdatePromise({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			},
			url: this.elementsUpdateURL,
			data: data,
			method: "POST",
		}).then(function(data) {

			toastr.success("<h3>Zapisano zmiany!</h3>");
			console.log("sendElementsUpdatePromise: success");
			// console.log(data);
		}).catch(function(error) {

			toastr.error("<h3>Próba zmiany nie powiodła się!</h3>");
			console.log("sendElementsUpdatePromise: fail", error);		
		});
	}

	this.sendElementsUpdatePromise = (options) => {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	}

	this.addElement = (id, sector_id, order, is_enabled) => {

		var element = new Element(parseInt(id), parseInt(sector_id), parseInt(order), parseInt(is_enabled));

		if (! this.checkIfExists(element)) {

			this.elementsToUpdate.push(element);
		} else {

			this.updateElement(element);
		}

	}

	this.updateElement = (element) => {

		console.log("updateElement");

		let index;

		for (var i = 0; i < this.elementsToUpdate.length; i++) {

			if( this.elementsToUpdate[i].id == element.id ) {
				index =  i;
			}
		}
		
		this.elementsToUpdate[index].sector_id = element.sector_id;
		this.elementsToUpdate[index].order = element.order;
		this.elementsToUpdate[index].is_enabled = element.is_enabled;

		console.log(this.elementsToUpdate[index]);
		
	}

	this.checkIfExists = (element) => {
		
		if(this.elementsToUpdate.length > 0 ) {
			for (var i = 0; i < this.elementsToUpdate.length; i++) {

				if( this.elementsToUpdate[i].id === element.id ) {
					return true;
				}
			}
		}

		return false;
		
	}
}


function Element(id, sector_id, order, is_enabled) {

	this.id = id;	
	this.sector_id = sector_id;	
	this.order = order;	
	this.is_enabled = is_enabled;
}
