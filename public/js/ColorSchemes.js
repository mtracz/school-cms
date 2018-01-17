var _contrast;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var colorSchemes = {
	standard: {
		".background-color": {
			"backgroundColor": "#fff",
			"color": "white"
		},
		".first-color": {
			"backgroundColor": "#BAC9D8",
			"color": "white"
		},
		".second-color": {
			"backgroundColor": "#EDAB61",
			"color": "white"
		},
		".third-color": {
			"backgroundColor": "#FFEEDB",
			"color": "white"
		},
		".fourth-color": {
			"backgroundColor": "#346C9E",
			"color": "white"
		},
		".fifth-color": {
			"backgroundColor": "#406DE4",
			"color": "white"
		},
		".coral-color": {
			"backgroundColor": "#e14658",
			"color": "white"
		},
		".title, .header": {
			"border": "none"
		},
		".panel .content": {
			"backgroundColor": "#fff",
			"color": "black",
			"border": "1px solid black"
		},
		".news.panel .content": {
			"backgroundColor": "#fff",
			"color": "black",
			"border": "none"
		},
		".ui.pagination.menu .item": {
			"backgroundColor": "#406DE4",
			"color": "white"
		},
		".ui.pagination.menu .active.item": {
			"backgroundColor": "#e14658",
			"color": "white"
		},
		".panel .ui.segment, .ui.main.segment, #content_sector .ui.segment": {
			"backgroundColor": "white"
		},
		".panel": {
			"backgroundColor": "white"
		},
		".list.panel .content, .list.panel .wrapper": {
			"borderColor": "rgb(64, 109, 228)"
		},
		".list.panel .content": {
			"borderLeft": "10px solid #406DE4"
		},
		".ui.menu": {
			"border": "none"
		},
		".ui.menu .item": {
			"border": "none",
			"color": "white"
		},
		".ui.accordion .content": {
			"background": "none",
			"border": "none"
		},
		".ui.accordion .title, .ui.accordion .content a": {
			"color": "white"
		},
		".panel a": {
			"color": "#e14658"
		}
	},
	contrast: (_contrast = {
		".background-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".first-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".second-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".third-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".fourth-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".fifth-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".coral-color": {
			"backgroundColor": "black",
			"color": "yellow"
		},
		".title, .header": {
			"border": "1px solid white"
		},
		".content": {
			"backgroundColor": "black",
			"color": "yellow",
			"border": "1px solid white"
		},
		".ui.pagination.menu .item": {
			"backgroundColor": "black"
		}
	}, _defineProperty(_contrast, ".ui.pagination.menu .item", {
		"backgroundColor": "black"
	}), _defineProperty(_contrast, ".ui.pagination.menu .active.item", {
		"backgroundColor": "grey",
		"color": "red"
	}), _defineProperty(_contrast, ".pagination_container .ui.pagination.menu .item.disabled", {
		"backgroundColor": "black"
	}), _defineProperty(_contrast, ".ui.segment", {
		"backgroundColor": "black"
	}), _defineProperty(_contrast, ".panel", {
		"backgroundColor": "black"
	}), _defineProperty(_contrast, ".list.panel .content, .list.panel .wrapper", {
		"borderColor": "white"
	}), _defineProperty(_contrast, ".list.panel .content", {
		"borderLeft": "10px solid white"
	}), _defineProperty(_contrast, ".ui.menu", {
		"border": "1px solid white"
	}), _defineProperty(_contrast, ".ui.menu .item", {
		"border": "1px dashed white",
		"color": "yellow"
	}), _defineProperty(_contrast, ".ui.accordion .title, .ui.accordion .content a", {
		"color": "yellow"
	}), _defineProperty(_contrast, ".ui.accordion .content .item", {
		"border": "none"
	}), _defineProperty(_contrast, ".menuAdmin .ui.inverted.menu .item", {
		"color": "white",
		"border": "none"
	}), _defineProperty(_contrast, ".panel a", {
		"color": "orange"
	}), _contrast)
};

var contrastElements = [".background-color", ".first-color", ".second-color", ".third-color", ".fourth-color", ".fifth-color", ".coral-color", ".title, .header", ".panel .content", ".news.panel .content", ".ui.pagination.menu .item", ".ui.pagination.menu .active.item", ".panel .ui.segment, .ui.main.segment, #content_sector .ui.segment", ".panel", ".list.panel .content, .list.panel .wrapper", ".list.panel .content", ".ui.menu", ".ui.menu .item", ".ui.accordion .content", ".ui.accordion .title, .ui.accordion .content a", ".panel a"];