function LayoutBuilder() {

	this.build = () => {

		this.toggleElementsBasedOnViewportGroup();

		this.toggleSectors();
	};

	this.toggleSectors = () => {

		$(".sector").each(){
			console.log($(this.html()));
			if($(this).html().length == 0){
				$(this).addClass("disabled");
			} else {
				$(this).removeClass("disabled");
			}
		};
	};

	this.updateContentWidth = () => {

		var count = $(".line_container").find(":not(.disabled)").length;

		console.log("Count : " + count);

		switch(count){
			case 1:
			$("#content").removeClass("ten");
			$("#content").removeClass("thriteen");
			$("#content").addClass("sixteen");
			break;

			case 2:
			$("#content").removeClass("ten");
			$("#content").removeClass("sixteen");
			$("#content").addClass("ten");
			break;

			case 3:
			$("#content").removeClass("sixteen");
			$("#content").removeClass("thriteen");
			$("#content").addClass("ten");
			break;

		}
	};

	this.toggleElementsBasedOnViewportGroup = () => {

		var viewportGroupName = this.specifyCurrentViewportGroupName();
		console.log("ViewportGroupName : " + viewportGroupName);

		var view_mark = marker;
		console.log(view_mark);

		$("." + view_mark).each(function (index) {

			console.log("view_mark element: " + $(this));

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
