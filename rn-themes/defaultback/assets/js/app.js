
$(function() {
    autoStart();
    //getMenu(url);
    dataTable();

    /* ---
        link
        */
    $('body').on('click', '.ajax', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var msg = $(this).attr('data-msg');

        if(msg){
            var check = confirm(msg);
            if(check == true) {
                getPage(url);
            }
        }
        else{
            getPage(url);
        }
    });

    /* ---
        pagination
        */
    $('body').on('click', 'ul#pagination>li>a', function(e){
        e.preventDefault();
        var Pagination_url = $(this).attr('href');
        var url = Pagination_url.replace(site, '');
        $.ajax({
            url     : Pagination_url,
            type    : 'POST',
            success:function(data){
                var $page_data = $(data);
                $('#mainContent').html($page_data);
                $('table').addClass('table');

                if(window.location != site + url)
                    window.history.pushState({path: "+window.location+"}, "", site + url);
            }
        });
    });
});

$(document).ajaxStart(function(){
    $("#progress").show();
});

$(document).ajaxStop(function(){
    $("#progress").hide();
    autoStart();
    dataTable();
});

var elem = document.body;
function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.mozRequestFullScreen) { /* Firefox */
        elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE/Edge */
        elem.msRequestFullscreen();
    }
}

function autoStart(){
    /* ---
        Fullsc
        */
    // $('#fullsc').click(function () {
    //     screenfull.toggle(document.body);
    // });
/*



    /!* ---
        tanggal
        *!/
    $('.tanggal').datepicker({
        format: 'yyyy-mm-dd',
        startView: 0,
        maxViewMode: 2,
    });

    $('.bulan').datepicker({
        format: "mm",
        startView: 1,
        minViewMode: 1,
        maxViewMode: 1
    });

    $('.tahun').datepicker({
        format: "yyyy",
        startView: 2,
        minViewMode: 2,
        maxViewMode: 2
    });

    $('.bulan_tahun').datepicker({
        format: 'yyyy-mm',
        startView: 1,
        minViewMode: 1,
        maxViewMode: 2,
    });
    /!* ---
        select2
        *!/
    $('.select2').select2();

    /!* ---
        price
        *!/
    $('.price').priceFormat({         
        prefix      : '',
        centsLimit  : 0
    });
*/

    /* ---
        checkall
        */
    $('#checkall').click(function () {    
        $('.checkall').prop('checked', this.checked);    
    });
}

/* ---
    general function
    */
function getMenu(url){
    $.ajax({
        type:'POST', data:'name='+ url, url:site + 'api/menu_get', success:function(i) {
            $('#menu').html(i);
        }
    });
}

function getPage(url){
    var url = url.replace(site, '');
    //var title = url.split("/");

    $.ajax({
        type:'POST', url:site + url, success:function(i) {
            $('#mainContent').html(i);
            //$('.page-title').html(title[0]);
            //getMenu(url);
      
            if(window.location != site + url)
                window.history.pushState({path: "+window.location+"}, "", site + url);
        }
    });
}

function filter(url){
    var contentData = $('#formfilter').serialize();
    var url = url.replace(site, '');

    $.ajax({
        type:'POST', url:site + url + '?' + contentData, success:function(i) {
            $("#mainContent").html(i);
      
            if(window.location != site + url + '?' + contentData)
                window.history.pushState({path: "+window.location+"}, "", site + url + '?' + contentData);
        }
    });

    $(this).submit(function() {
        return false;
    });
}

/* ---
    ajax form
    */
function submitForm(reload){
    if(typeof(CKEDITOR) !== "undefined"){
        for ( instance in CKEDITOR.instances )
           CKEDITOR.instances[instance].updateElement();    
    }
    var contentData = $('#formsubmit').serialize();
    var url_address = $('#formsubmit').attr('action');
    
    $.ajax({
        type:'POST', 
        data: contentData, 
        url: url_address,
        success: function(i) {
            var obj = jQuery.parseJSON(i);

            if(obj.status == 'sukses'){
                alertify.info(obj.message, toastr_options);
                
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                getPage(reload);
            }
            else if(obj.status == 'login'){
                $(location).attr('href', reload);
                alertify.info(obj.message, toastr_options);
            }
            else{
                $.each(obj.message,  function(key, val) {
                    alertify.error(val, toastr_options);
                });
            }
        }
    });
    $(this).submit(function() {
        return false;
    });
}

function submitFormFile(reload){
    if(typeof(CKEDITOR) !== "undefined"){
        for ( instance in CKEDITOR.instances )
           CKEDITOR.instances[instance].updateElement();    
    }
    var contentData = $('#formsubmit').serialize();
    var url_address = $('#formsubmit').attr('action');

    $('#formsubmit').ajaxForm({
        type:'POST',
        data: contentData,
        url: url_address,
        success: function(i) {
            var obj = jQuery.parseJSON(i);

            if(obj.status == 'sukses'){
                alertify.info(obj.message, toastr_options);
                
                $('.modal').modal('hide');
                $('.modal-backdrop').remove();
                getPage(reload);
            }
            else if(obj.status == 'login'){
                $(location).attr('href', reload);
                alertify.info(obj.message, toastr_options);
            }
            else{
                $.each(obj.message,  function(i, val) {
                    alertify.error(val, toastr_options);
                });
            }
        }
    }).submit();
    $(this).submit(function() {
        return false;
    });
}

function submitMenu()
{
    var menuData = $('ol.sortable').nestedSortable('serialize');
    var contentData = $('form').serialize();
    var url_address = $('#form_input').attr('action');

    $.ajax({
        type: "POST",
        data: menuData + '&' + contentData,
        url: url_address,
        success: function(i){
            var obj = jQuery.parseJSON(i);
            
            if(obj.status == 'sukses'){
                alertify.info(obj.message, toastr_options);
            }
        }
    });
    $(this).submit(function () {
        return false;
    });
}

/* ---
    data tables
    */
function dataTable(){
    var ele = 'datatable';
    var link = $('#datatable').attr('url');
    var display = $(this).data('limit');

    $('#'+ ele).DataTable({
        retrieve: true,
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[50, 100, 200, 400], [50, 100, 200, 400]],
        "iDisplayLength": display,
        "order": [],
        "ajax":{
            url : link,
            type: "POST",
            error: function(){
                $('.'+ ele +'-error').html('');
                $('#'+ ele).append('<tbody class="'+ ele +'-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                $('#'+ ele +'_processing').css('display','none');
                
            },
            "columnDefs": [
                { 
                    "targets": [0], 
                    "searchable": false, 
                    "orderable": false
                },
            ]
        }
    });
}
