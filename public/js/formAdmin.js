function getTimeStamp(){var e=new Date;return e.getHours()+""+(e.getMinutes()<10?"0"+e.getMinutes():e.getMinutes())+(e.getSeconds()<10?"0"+e.getSeconds():e.getSeconds())}function isName(){return!!document.getElementById("admin_form").name.value}function isLogin(){return!!document.getElementById("admin_form").login.value}function isPassword(){return!!document.getElementById("admin_form").password.value}function validateForm(){var e=$(".field.password input").attr("disabled");if(e&&0!=e){if(!isName()||!isLogin())return!1}else if(!isName()||!isLogin()||!isPassword())return!1;return!0}function validateInputLength(){var e=document.getElementById("admin_form"),n=$(".field.password input").attr("disabled");if(n&&0!=n){if(e.name.value.length<6||e.login.value.length<6)return!1}else if(e.name.value.length<6||e.login.value.length<6||e.password.value.length<6)return!1;return!0}function sendAdminData(){var e=new FormData,n=document.getElementById("admin_form");e.append("name",n.name.value),e.append("login",n.login.value),e.append("password",n.password.value),e.append("is_active",n.is_active.checked),sendAjaxFormData(e)}function sendAjaxFormData(e){$.ajax({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},type:"post",url:$("#admin_form").attr("action"),data:e,processData:!1,contentType:!1,success:function(e){"success"===e.add_status||"success"===e.edit_status?window.location.href=e.route:($("#errors_list").removeClass("hidden"),errors=JSON.parse(e),$.each(errors,function(e,n){$("#errors_list").append("<p><i class='warning icon'></i>"+n+"</p>")}))},error:function(e,n,t){alert("add news ajax error: ",t)}})}$(document).ready(function(){$(".ui.centered.aligned.grid").removeAttr("style")}),$("#cancel_button").on("click",function(e){window.location.href=$(this).data("route")}),$("#save_button").on("click",function(){$("#errors_list").html("").addClass("hidden"),validateForm()?validateInputLength()?sendAdminData():$("#errors_list").removeClass("hidden").html("Nazwa, login i hasło min. 6 znaków."):$("#errors_list").removeClass("hidden").html("Wszystkie pola są wymagane.")}),$("#reset_password_button").on("click",function(){var e=document.getElementById("admin_form");e.password.type="text",e.password.value=getTimeStamp()});