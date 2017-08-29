// menuAddEdit js
// 

$(".column").removeClass().addClass(window.localStorage.getItem("newsWidth") + " wide column" );



initTab();
// $(".dropdown_name").hide();


var active_tab = $(".item.active").data("tab");

var all_tabs = 1;
// var all_elements_in_tab = 1;

// alert(active_tab);

$("#add_tab").on("click", function() {
	all_tabs += 1;
	var element_id = all_tabs;
	$(".add_tab_div").before('<a class="item " data-tab='+element_id+'>'+element_id+'</a>');

	$(".tabs_content").append(prepareTabContent(element_id));
	
	initTab();
});



// dyanmic dropdown not work on other tabs
// $('#is_dropdown_tab_'+ tab).change( function() {
// 	alert("active tab: " + tab);
// 	return false;
// 	if($(this).is(":checked")) {
// 		$(".add_new_element_tab_"+ tab).show();
// 		$(".dropdown_name_tab_"+ tab).show();
// 	} else {
// 		$(".add_new_element_tab_"+ tab).hide();
// 		$(".dropdown_name_tab_"+ tab).hide();
// 	}
// });
// 
var tab = 1;

$(".ui.toggle.checkbox").on("click", "", function() {
		alert("chuj");
	});

// track active tab
$(".tabular.menu").on("click", function() {
	active_tab = $(".tabular.menu").find(".item.active").data("tab");
	alert(active_tab);
	// dropdownListener(active_tab);
});

function dropdownListener(tab) {

}

function initTab() {
	$('.menu .item').tab();
}

function prepareTabContent(tab_id) {
	var tab_draft = '<div class="ui bottom attached tab segment" data-tab='+tab_id+'>'+					
					'<div class="fields">'+
						'<div class="inline fields">'+
							'<div class="ui toggle checkbox">'+
								'<input type="checkbox" tabindex="0" class="hidden" name="is_dropdown_tab_'+tab_id+'" id="is_dropdown_tab_'+tab_id+'">'+
								'<label>Dropdown</label>'+
							'</div>'+
						'</div>'+
						'<div class="inline fields dropdown_name dropdown_name_tab_'+tab_id+'" style="display: none;">'+
							'<label>Nazwa</label >'+
							'<input type="text" placeholder="Nazwa" name="item_name_tab_'+tab_id+'">'+
						'</div>'+
					'</div>'+
					'<div class="fields elements_tab_'+tab_id+'">'+
						'<div class=" field">'+
							'<div class="circular ui icon button order" disabled>'+
							'<span class="element_order_tab_'+tab_id+'_1">1</span>'+
							'</div>'+
						'</div>'+
						'<div class="five wide field">'+
							'<label>Nazwa</label>'+
							'<input type="text" placeholder="Nazwa elementu" name="element_name_tab_'+tab_id+'_1">'+
						'</div>'+
						'<div class="five wide field">'+
							'<label>URL</label>'+
							'<input type="text" placeholder="URL elementu" name="element_url_tab_'+tab_id+'_1">'+
						'</div>'+
						'<div class="field">'+
							'<div class="ui icon buttons actions">'+
								'<div class="ui negative button element_remove_tab_'+tab_id+'_1"><i class="remove icon"></i>'+
								'</div>'+

								'<div class="ui button element_move_up_tab_'+tab_id+'_1"><i class="long arrow up icon"></i>'+
								'</div>'+
								'<div class="ui button element_move_down_tab_'+tab_id+'_1"><i class="long arrow down icon"></i>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="fourteen wide field add_new_element_tab_'+tab_id+'" hidden>'+
						'<div class="fluid ui positive button"><i class="plus icon"></i>'+
						'</div>'+
					'</div>'+
				'</div>';
	return tab_draft;
}
