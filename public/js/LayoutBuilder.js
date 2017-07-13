function LayoutBuilder() {

	this.build = () => {

		
		this.toggleElementsBasedOnViewportGroup();

		this.fitContentSector();
	};

	this.fitContentSector = () => {

		this.toggleSectors();

		var enabledSectors = $(".row_container > :not(.disabled)").length;

		console.log("Enabled sectors: " + enabledSectors);

		switch(enabledSectors){
			case 1:
			$("#content_sector").removeClass().addClass("sixteen wide column sector");
			break;

			case 2:
			$("#content_sector").removeClass().addClass("thirteen wide column sector");
			break;

			case 3:
			$("#content_sector").removeClass().addClass("ten wide column sector");
			break;
		}
	};

	this.toggleSectors = () => {

		$(".sector").each(function(){
			if($(this).children().length == 0){
				$(this).addClass("disabled");
			} else {
				$(this).removeClass("disabled");
			}
		});
	};

	this.toggleElementsBasedOnViewportGroup = () => {

		var viewportGroupName = this.specifyCurrentViewportGroupName();
		console.log("ViewportGroupName : " + viewportGroupName);

		$(".view_marker").each(function (index) {

			console.log("view_marker element: " + $(this));

			if( $(this).hasClass(viewportGroupName)) {

				$(this).removeClass("disabled");
			} else {

				$(this).addClass("disabled");
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

	this.getViewportWidth = () => {

		return $(window).width();
	};

	this.message = () => {

		console.log(viewportGroups);
	};
};
