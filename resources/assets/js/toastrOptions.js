toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}

$(document).ready(function() {
  $("#InfromationMessages > span").each(function() {  //master.blade
    if($(this).attr("type") == "info") {
      toastr.info($(this).attr("data-message"));
    }
    if($(this).attr("type") == "warning") {
      toastr.warning($(this).attr("data-message"));
    }
    if($(this).attr("type") == "error") {
      toastr.error($(this).attr("data-message"));
    }
    if($(this).attr("type") == "success") {
      toastr.success($(this).attr("data-message"));
    }
  });
});