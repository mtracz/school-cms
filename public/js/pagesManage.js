function ajaxPostDeletePagesPromise(e){return new Promise(function(t,a){$.ajax(e).done(t).fail(a)})}function addFrontZero(e){return e<10&&(e="0"+e),e}function isInputValueSet(e){return""!=$(e).find("input").val()}function fillDatesInputs(e){$("#publish_at_date").calendar("set date",e.publish_at_date,!0,!0),$("input[name='publish_at_date_parsed']").val(e.publish_at_date_parsed),$("#expire_at_date").calendar("set date",e.expire_at_date,!0,!0),$("input[name='expire_at_date_parsed']").val(e.expire_at_date_parsed),$("#created_at_date").calendar("set date",e.created_at_date,!0,!0),$("input[name='created_at_date_parsed']").val(e.created_at_date_parsed),$("#updated_at_date").calendar("set date",e.updated_at_date,!0,!0),$("input[name='updated_at_date_parsed']").val(e.updated_at_date_parsed)}var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};$(".preview_toggle_button").on("click",function(){var e=$(this).attr("data-id"),t=$(".pages_manage").find(".preview_content[data-id='"+e+"']").closest("tr");console.log(t),$(t).toggle("fast",function(){}),$(t).toggleClass("visible"),$(t).hasClass("visible")||$(t).attr("style","display: none !important")}),$(".actions .ui.edit.button, .ui.clear_search.button, .ui.add_page.button, .ui.show.button").on("click",function(){window.location.href=$(this).attr("data-url")}),$(".ui.delete.button").on("click",function(){var e=$(this).attr("data-url"),t=$(this).parent().parent();$(".ui.basic.delete_aggrement.modal").modal({closable:!1,onDeny:function(){},onApprove:function(){ajaxPostDeletePagesPromise({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},method:"post",url:e}).then(function(e){"success"===e?($(t).remove(),console.log("ajaxPostDeletePagesPromise: success"),toastr.success("Usunięto")):toastr.error(e.error)}).catch(function(){console.log("ajaxPostDeletePagesPromise: fail"),toastr.error("Problem z usunięciem")})}}).modal("show")});var form_create_date_object={raw_date:"",parsed_date:"",timestamp:""},form_update_date_object={raw_date:"",parsed_date:"",timestamp:""};$("#created_at_date").calendar({type:"date",text:{days:["Pon","Wt","Śr","Czw","Pt","Sob","Nie"],months:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],monthsShort:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"]},onShow:function(e){},onChange:function(e){if(e){var t=e.getFullYear(),a=addFrontZero(e.getMonth()+1),r=addFrontZero(e.getDate());form_create_date_object.raw_date=e,form_create_date_object.parsed_date=t+"-"+a+"-"+r,alert(form_create_date_object.parsed_date),$("#updated_at_date").calendar("set startDate",form_create_date_object.raw_date),isInputValueSet("#updated_at_date")&&form_create_date_object.raw_date>form_update_date_object.raw_date&&$("#updated_at_date").calendar("focus")}else form_create_date_object.parsed_date=""}}),$("#updated_at_date").calendar({type:"date",text:{days:["Pon","Wt","Śr","Czw","Pt","Sob","Nie"],months:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],monthsShort:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"]},onShow:function(e){},onChange:function(e){if(e){var t=e.getFullYear(),a=addFrontZero(e.getMonth()+1),r=addFrontZero(e.getDate());form_update_date_object.raw_date=e,form_update_date_object.parsed_date=t+"-"+a+"-"+r}else form_update_date_object.parsed_date=""}}),$(".ui.search.button").on("click",function(e){$("input[name='created_at_date_parsed']").val(form_create_date_object.parsed_date),$("input[name='updated_at_date_parsed']").val(form_update_date_object.parsed_date)});var params=JSON.parse($("#parameters").text());console.log("params",params),"object"==(void 0===params?"undefined":_typeof(params))&&0!=params.length&&fillDatesInputs(params);