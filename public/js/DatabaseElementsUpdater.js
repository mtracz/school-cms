function DatabaseElementsUpdater() {
	var _this = this;

	this.elementsUpdateURL = window.location.origin + "/element/manage/update";

	this.elementsToUpdate = [];

	this.ajaxData = {
		"data": []
	};

	this.sendToUpdate = function () {

		_this.ajaxData.data = _this.elementsToUpdate;

		_this.sendAjax(_this.ajaxData);

		_this.elementsToUpdate = [];
		_this.ajaxData.data = [];
	};

	this.sendAjax = function (data) {

		_this.sendElementsUpdatePromise({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			},
			url: _this.elementsUpdateURL,
			data: data,
			method: "POST"
		}).then(function (data) {

			toastr.success("<h3>Zapisano zmiany!</h3>");
			console.log("sendElementsUpdatePromise: success");
			// console.log(data);
		}).catch(function (error) {

			toastr.error("<h3>Próba zmiany nie powiodła się!</h3>");
			console.log("sendElementsUpdatePromise: fail", error);
		});
	};

	this.sendElementsUpdatePromise = function (options) {
		return new Promise(function (resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	this.addElement = function (id, sector_id, order, is_enabled) {

		var element = new Element(parseInt(id), parseInt(sector_id), parseInt(order), parseInt(is_enabled));

		if (!_this.checkIfExists(element)) {

			_this.elementsToUpdate.push(element);
		} else {

			_this.updateElement(element);
		}
	};

	this.updateElement = function (element) {

		console.log("updateElement");

		var index = void 0;

		for (var i = 0; i < _this.elementsToUpdate.length; i++) {

			if (_this.elementsToUpdate[i].id == element.id) {
				index = i;
			}
		}

		_this.elementsToUpdate[index].sector_id = element.sector_id;
		_this.elementsToUpdate[index].order = element.order;
		_this.elementsToUpdate[index].is_enabled = element.is_enabled;

		console.log(_this.elementsToUpdate[index]);
	};

	this.checkIfExists = function (element) {

		if (_this.elementsToUpdate.length > 0) {
			for (var i = 0; i < _this.elementsToUpdate.length; i++) {

				if (_this.elementsToUpdate[i].id === element.id) {
					return true;
				}
			}
		}

		return false;
	};
}

function Element(id, sector_id, order, is_enabled) {

	this.id = id;
	this.sector_id = sector_id;
	this.order = order;
	this.is_enabled = is_enabled;
}