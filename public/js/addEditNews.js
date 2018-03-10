function addZero(e){return e<10&&(e="0"+e),e}function clearPublishDate(){$("#publish_at_date").calendar("clear"),$("#publish_at_time").calendar("clear"),clearPublishCalendarDates()}function clearExpireDate(){$("#expire_at_date").calendar("clear"),$("#expire_at_time").calendar("clear")}function clearPublishCalendarDates(){form_expire_date_object.start_date=!1}function checkDateFields(){var e=document.getElementById("add_news_article_form"),t=!0;return $("#publish_at_now").is(":checked")||(e.publish_at_date.value?$("#publish_date_warning").addClass("hidden"):($("#publish_date_warning").removeClass("hidden"),t=!1),e.publish_at_time.value?$("#publish_time_warning").addClass("hidden"):($("#publish_time_warning").removeClass("hidden"),t=!1)),$("#expire_at_never").is(":checked")||(e.expire_at_date.value?$("#expire_date_warning").addClass("hidden"):($("#expire_date_warning").removeClass("hidden"),t=!1),e.expire_at_time.value?$("#expire_time_warning").addClass("hidden"):($("#expire_time_warning").removeClass("hidden"),t=!1)),t}function getCurrentDate(){var e=new Date,t=addZero(e.getDate()),a=addZero(e.getMonth()+1);return e.getFullYear()+"-"+a+"-"+t}function sendNewsData(){var e=new FormData,t=document.getElementById("add_news_article_form");e.append("content",form_content),e.append("title",t.title.value),e.append("is_public",t.is_public.checked),e.append("is_pinned",t.is_pinned.checked),e.append("publish_at_date",form_publish_date_object.parsed_date),e.append("publish_at_time",form_publish_date_object.time),e.append("expire_at_date",form_expire_date_object.parsed_date),e.append("expire_at_time",form_expire_date_object.time),e.append("publish_at_now",t.publish_at_now.checked),e.append("expire_at_never",t.expire_at_never.checked),e.append("json_images_src",json_images_src),sendAjaxFormData(e)}function getDateOnLoadForm(){var e=$("#original_publish_date").data("original_date"),t=$("#original_expire_date").data("original_date");e?(form_publish_date_object.parsed_date=e,form_publish_date_object.time=$("#publish_at_time").find("input").attr("value")):form_publish_date_object.parsed_date="",t?(form_expire_date_object.parsed_date=t,form_expire_date_object.time=$("#expire_at_time").find("input").attr("value")):form_expire_date_object.parsed_date=""}function setDateInPreviewContent(){var e,t;document.getElementById("add_news_article_form");form_publish_date_object.parsed_date?(t=form_publish_date_object.time,e=form_publish_date_object.parsed_date+" "+t):(t=(new Date).toLocaleTimeString("pl-PL",{hour12:!1,hour:"numeric",minute:"numeric",second:"numeric"}),e=getCurrentDate()+" "+t),$(".date").html(e)}var form_publish_date_object={parsed_date:"",time:""},form_expire_date_object={parsed_date:"",start_date:!1,time:""};$(document).ready(function(){getDateOnLoadForm()}),$("#publish_at_date").calendar({type:"date",firstDayOfWeek:1,text:{days:["Nie","Pon","Wt","Śr","Czw","Pt","Sob"],months:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],monthsShort:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"]},onShow:function(e){var t=getCurrentDate();$("#publish_at_date").calendar("set startDate",t)},onChange:function(e){if(e){var t=e.getFullYear(),a=addZero(e.getMonth()+1),i=addZero(e.getDate());form_expire_date_object.start_date=e,$("#expire_at_date").calendar("set endDate",e),form_publish_date_object.parsed_date=t+"-"+a+"-"+i}else form_publish_date_object.parsed_date=""}}),$("#publish_at_time").calendar({ampm:!1,type:"time",onChange:function(e){e&&(time=e.toLocaleTimeString("pl-PL",{hour12:!1,hour:"numeric",minute:"numeric",second:"numeric"}),form_publish_date_object.time=time)}}),$("#expire_at_date").calendar({type:"date",firstDayOfWeek:1,text:{days:["Nie","Pon","Wt","Śr","Czw","Pt","Sob"],months:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],monthsShort:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"]},onShow:function(e){if(!form_expire_date_object.start_date){var t=getCurrentDate();$("#expire_at_date").calendar("set startDate",t)}},onChange:function(e){if(e){var t=e.getFullYear(),a=addZero(e.getMonth()+1),i=addZero(e.getDate());form_expire_date_object.parsed_date=t+"-"+a+"-"+i}else form_expire_date_object.parsed_date=""}}),$("#expire_at_time").calendar({ampm:!1,type:"time",onChange:function(e){e&&(time=e.toLocaleTimeString("pl-PL",{hour12:!1,hour:"numeric",minute:"numeric",second:"numeric"}),form_expire_date_object.time=time)}}),$("#publish_at_now").change(function(){$(this).is(":checked")?($("#publish_at_fields").addClass("disabled"),clearPublishDate(),$("#publish_date_warning").addClass("hidden"),$("#publish_time_warning").addClass("hidden")):$("#publish_at_fields").removeClass("disabled")}),$("#expire_at_never").change(function(){$(this).is(":checked")?($("#expire_at_fields").addClass("disabled"),clearExpireDate(),$("#expire_date_warning").addClass("hidden"),$("#expire_time_warning").addClass("hidden")):$("#expire_at_fields").removeClass("disabled")}),$("#clear_publish").on("click",function(){clearPublishDate()}),$("#clear_expire").on("click",function(){clearExpireDate()}),$("#preview_button").on("click",function(){return!(!validateTitle()||!validateContent())&&(!!checkDateFields()&&(setDateInPreviewContent(),setContent(),toogleFontManagerSection(),void $("#errors_list").addClass("hidden")))}),$("#public_button").on("click",function(){sendNewsData()});