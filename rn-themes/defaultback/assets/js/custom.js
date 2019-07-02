toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "slideUp"
};

function show_notif(status, message, callback_url) {
    if( status === 'success'){
        toastr.success(message);
        if (typeof result.callback_url !== "undefined") {
            setTimeout(function () {
                window.location.href = callback_url;
            }, 500);
        }
    }else if( status === 'error'){
        toastr.error(message);
        if (typeof callback_url !== "undefined") {
            setTimeout(function () {
                window.location.href = callback_url;
            }, 500);
        }
    }else if( status === 'info'){
        toastr.info(message);
        if (typeof callback_url !== "undefined") {
            setTimeout(function () {
                window.location.href = callback_url;
            }, 500);
        }
    }else if( status === 'warning'){
        toastr.warning(message);
        if (typeof callback_url !== "undefined") {
            setTimeout(function () {
                window.location.href = callback_url;
            }, 500);
        }
    }
    else {
        $.each(message,  function(key, val) {
            toastr.error(val);
        });
    }
}

$('#fullsc').click(function () {
    screenfull.toggle(document.body);
});

function openFullscreen() {
    screenfull.toggle(document.body);
}

$(document).ready(function(){
	$("a").removeAttr('title');
	$('.select2-selection__choice').hover(function() {$(this).prop('title', '');});
	$('.select2-selection__rendered').hover(function() {$(this).prop('title', '');});
	$('#select2-filter-field_divisi-container').hover(function() {$(this).prop('title', '');});

});

