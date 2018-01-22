function LayoutBuilder() {

	this.build = () => {

		this.toggleElementsBasedOnViewportGroup();

		this.sizeContentSector();
	};

	this.sizeContentSector = () => {

		this.toggleSectors();

		var enabledSectors = $(".row_container > :not(.hideElement)").length;

		console.log("Enabled sectors: " + enabledSectors);

		switch(enabledSectors) {
			case 1:
				$("#content_sector").removeClass().addClass("sixteen wide column sector");
				try {
					window.localStorage.setItem("newsWidth","sixteen");
				} catch(error) {
					// toastr.error("Brak obsługi cookies. Nie można zapisać szerokości (16) newsów");
				}
			break;

			case 2:
				$("#content_sector").removeClass().addClass("thirteen wide column sector");
				try {
					window.localStorage.setItem("newsWidth","thirteen");
				} catch(error) {
					// toastr.error("Brak obsługi cookies. Nie można zapisać szerokości (13) newsów");
				}
			break;

			case 3:
				$("#content_sector").removeClass().addClass("ten wide column sector");
				try {
					window.localStorage.setItem("newsWidth","ten");
				} catch(error) {
					// toastr.error("Brak obsługi cookies. Nie można zapisać szerokości (10) newsów");
				}
			break;
		}
	};

	this.toggleSectors = () => {

		$(".sector").each(function() {
			if($(this).attr("id") == "bottom_sector") {

				if( $(this).find(".ui.grid").children().length == 0 ) {
					$(this).addClass("hideElement");
				} else {
					$(this).removeClass("hideElement");
				}

			} else {
				if($(this).children().length == 0) {
					$(this).addClass("hideElement");
				} else {
					$(this).removeClass("hideElement");
				}
			}
		});

	};

	this.toggleElementsBasedOnViewportGroup = () => {

		var viewportGroupName = this.specifyCurrentViewportGroupName();

		this.saveToLocalStorage(viewportGroupName);

		console.log("ViewportGroupName : " + viewportGroupName);

		$(".view_marker").each(function (index) {

			console.log("view_marker element:", $(this));

			if( $(this).hasClass(viewportGroupName)) {

				if( !$(this).hasClass("sector") ) {
					$(this).addClass("sector");
				}

				$(this).removeClass("hideElement");
			} else {

				if( $(this).hasClass("sector") ) {
					$(this).removeClass("sector");
				}

				$(this).addClass("hideElement");
			}
			
		});
	};

	this.specifyCurrentViewportGroupName = () => {

		var width = this.getViewportWidth();

		var name;

		viewportGroups.forEach(function(element, index){

			if(width >= element.min && width <= element.max){

				name = element.name;
			}
		});

		return name;
	};

	
	this.saveToLocalStorage = (viewportGroupName) => {
		try {
			window.localStorage.setItem("viewportGroupName", viewportGroupName);
		} catch(error) {
			// toastr.error("Brak obsługi cookies");
		}
	};
		

	this.getViewportWidth = () => {

		return $(window).width();
	};

	this.message = () => {

		console.log(viewportGroups);
	};
};
