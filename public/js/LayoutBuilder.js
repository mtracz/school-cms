function LayoutBuilder() {
	var _this = this;

	this.build = function () {

		_this.toggleElementsBasedOnViewportGroup();

		_this.sizeContentSector();
	};

	this.sizeContentSector = function () {

		_this.toggleSectors();

		var enabledSectors = $(".row_container > :not(.hideElement)").length;

		console.log("Enabled sectors: " + enabledSectors);

		switch (enabledSectors) {
			case 1:
				$("#content_sector").removeClass().addClass("sixteen wide column sector");
				window.localStorage.setItem("newsWidth", "sixteen");
				break;

			case 2:
				$("#content_sector").removeClass().addClass("thirteen wide column sector");
				window.localStorage.setItem("newsWidth", "thirteen");
				break;

			case 3:
				$("#content_sector").removeClass().addClass("ten wide column sector");
				window.localStorage.setItem("newsWidth", "ten");
				break;
		}
	};

	this.toggleSectors = function () {

		$(".sector").each(function () {
			if ($(this).attr("id") == "bottom_sector") {

				if ($(this).find(".ui.grid").children().length == 0) {
					$(this).addClass("hideElement");
				} else {
					$(this).removeClass("hideElement");
				}
			} else {
				if ($(this).children().length == 0) {
					$(this).addClass("hideElement");
				} else {
					$(this).removeClass("hideElement");
				}
			}
		});
	};

	this.toggleElementsBasedOnViewportGroup = function () {

		var viewportGroupName = _this.specifyCurrentViewportGroupName();

		_this.saveToLocalStorage(viewportGroupName);

		console.log("ViewportGroupName : " + viewportGroupName);

		$(".view_marker").each(function (index) {

			console.log("view_marker element:", $(this));

			if ($(this).hasClass(viewportGroupName)) {

				if (!$(this).hasClass("sector")) {
					$(this).addClass("sector");
				}

				$(this).removeClass("hideElement");
			} else {

				if ($(this).hasClass("sector")) {
					$(this).removeClass("sector");
				}

				$(this).addClass("hideElement");
			}
		});
	};

	this.specifyCurrentViewportGroupName = function () {

		var width = _this.getViewportWidth();

		var name;

		viewportGroups.forEach(function (element, index) {

			if (width >= element.min && width <= element.max) {

				name = element.name;
			}
		});

		return name;
	};

	this.saveToLocalStorage = function (viewportGroupName) {

		window.localStorage.setItem("viewportGroupName", viewportGroupName);
	};

	this.getViewportWidth = function () {

		return $(window).width();
	};

	this.message = function () {

		console.log(viewportGroups);
	};
};