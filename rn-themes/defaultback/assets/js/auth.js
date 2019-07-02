var contentID = 'mainContent';
var toastr_options = {
	"showDuration": "0",
	"hideDuration": "0",
	"timeOut": "1000",
	"extendedTimeOut": "0",
};

$(function() {
	/* ---
        Ajax
        */
	$(document).ajaxStart(function(){
		$("#progress").show();
	});

	$(document).ajaxStop(function(){
		$("#progress").hide();
	});
});

/* ---
    ajax form
    */
function submitForm(reload){
	if(typeof(CKEDITOR) !== "undefined"){
		for ( instance in CKEDITOR.instances )
			CKEDITOR.instances[instance].updateElement();
	}
	var contentData = $('form').serialize();
	var url_address = $('form').attr('action');

	$.ajax({
		type:'POST',
		data: contentData,
		url: url_address,
		success: function(i) {
			var obj = jQuery.parseJSON(i);

			if(obj.status == 'sukses'){
				if(obj.message !== '')
					toastr.info(obj.message, toastr_options);

				getPage(reload, 'mainContent');
				$('#modalfrm').modal('hide');

			}
			if(obj.status == 'login'){
				$(location).attr('href', reload);
				toastr.info(obj.message, toastr_options);
			}
			else{
				$.each(obj.message,  function(i, val) {
					toastr.error(val, toastr_options);
				});
			}
		}
	});
	$(this).submit(function() {
		return false;
	});
}
