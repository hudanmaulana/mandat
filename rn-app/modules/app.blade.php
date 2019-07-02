<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap material admin template">
	<meta name="author" content="">

	<title>{{ @$subject ? $subject : 'Reponesia' }}</title>

	<link rel="apple-touch-icon" href="{{$asset}}/assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="{{$asset}}/assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{$asset}}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{$asset}}/assets/css/bootstrap-extend.min.css">
	<link rel="stylesheet" href="{{$asset}}/assets/css/site.min.css">
	<link rel="stylesheet" href="{{$asset}}/assets/css/custom.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/animsition/animsition.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/switchery/switchery.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/intro-js/introjs.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/flag-icon-css/flag-icon.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/waves/waves.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/toastr/toastr.css">
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/advanced/toastr.css">
	@yield('stylehead')

	<!--	<link rel="stylesheet" href="{{$asset}}/assets/vendor/chartist/chartist.css">-->
	<!--	<link rel="stylesheet" href="{{$asset}}/assets/vendor/jvectormap/jquery-jvectormap.css">-->
	<!--	<link rel="stylesheet" href="{{$asset}}/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">-->
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/dashboard/v1.css">

	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/tables/datatable.css">



	<link rel="stylesheet" href="{{$asset}}/assets/vendor/select2/select2.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-select/bootstrap-select.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/icheck/icheck.css">

	<link rel="stylesheet" href="{{$asset}}/assets/vendor/asrange/asRange.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/ionrangeslider/ionrangeslider.min.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/asspinner/asSpinner.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/clockpicker/clockpicker.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/ascolorpicker/asColorPicker.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/jquery-labelauty/jquery-labelauty.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/timepicker/jquery-timepicker.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/jquery-strength/jquery-strength.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/multi-select/multi-select.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/typeahead-js/typeahead.css">
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/forms/advanced.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/alertify/alertify.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/notie/notie.css">
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/advanced/alertify.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/bootstrap-table/bootstrap-table.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/webui-popover/webui-popover.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/toolbar/toolbar.css">


	<!-- Fonts -->
	<link rel="stylesheet" href="{{$asset}}/assets/fonts/font-awesome/font-awesome.css">
	<link rel="stylesheet" href="{{$asset}}/assets/fonts/material-design/material-design.min.css">
	<link rel="stylesheet" href="{{$asset}}/assets/fonts/brand-icons/brand-icons.min.css">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

	<!--[if lt IE 9]>
	<script src="{{$asset}}/assets/vendor/html5shiv/html5shiv.min.js"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="{{$asset}}/assets/vendor/media-match/media.match.min.js"></script>
	<script src="{{$asset}}/assets/vendor/respond/respond.min.js"></script>
	<![endif]-->

	<!-- Scripts -->
	<script src="{{$asset}}/assets/vendor/breakpoints/breakpoints.js"></script>
	<script>
		Breakpoints();
	</script>
	<style>
		.site-navbar-small .slidePanel.slidePanel-left, .site-navbar-small .slidePanel.slidePanel-right {
			top: 4.286rem !important;
		}
	</style>

</head>
<body class="animsition site-navbar-small"  ng-app="{{ $ismodul ?  $module : ''}}">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
@include('header')



@yield('body')

@include('footer')
<!-- Footer -->
<footer class="site-footer">
	<div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Reponesia</a></div>
	<div class="site-footer-right">
		Crafted with <i class="red-600 icon md-favorite"></i> by <a href="#">Merbabu Dev</a>
	</div>
</footer>

<script type="text/javascript">var site = '<?=BASE_URL?>';</script>
<script type="text/javascript">var url = '<?=uri_string()?>';</script>
<script>
	var base_url = '{{ base_url() }}';
</script>
<script type="text/javascript">
	var rn_module = '{{ $module }}';
	var rn_url = '{{ base_url("rn/$module") }}';
</script>
<script type="text/javascript">
	var jq = jQuery.noConflict(true);
</script>

<!-- Core  -->

<script src="{{$asset}}/assets/vendor/angular/angular.min.js"></script>
<script src="{{$asset}}/assets/vendor/angular-sanitize/angular-sanitize.min.js"></script>
<script src="{{$asset}}/assets/vendor/angular-route/angular-route.min.js"></script>
<script src="{{$asset}}/assets/vendor/angular-storage/ngStorage.min.js"></script>


<script src="{{$asset}}/assets/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="{{$asset}}/assets/vendor/jquery/jquery.js"></script>
<script src="{{$asset}}/assets/vendor/popper-js/umd/popper.min.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap/bootstrap.js"></script>
<script src="{{$asset}}/assets/vendor/animsition/animsition.js"></script>
<script src="{{$asset}}/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="{{$asset}}/assets/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="{{$asset}}/assets/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="{{$asset}}/assets/vendor/waves/waves.js"></script>

<!-- Plugins -->
<script src="{{$asset}}/assets/vendor/switchery/switchery.js"></script>
<script src="{{$asset}}/assets/vendor/intro-js/intro.js"></script>
<script src="{{$asset}}/assets/vendor/screenfull/screenfull.js"></script>
<script src="{{$asset}}/assets/vendor/slidepanel/jquery-slidePanel.js"></script>
<!--<script src="{{$asset}}/assets/vendor/chartist/chartist.min.js"></script>-->
<!--<script src="{{$asset}}/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js"></script>-->
<!--<script src="{{$asset}}/assets/vendor/jvectormap/jquery-jvectormap.min.js"></script>-->
<!--<script src="{{$asset}}/assets/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>-->
<script src="{{$asset}}/assets/vendor/matchheight/jquery.matchHeight-min.js"></script>
<script src="{{$asset}}/assets/vendor/peity/jquery.peity.min.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net/jquery.dataTables.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons/buttons.html5.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons/buttons.flash.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons/buttons.print.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons/buttons.colVis.js"></script>
<script src="{{$asset}}/assets/vendor/select2/select2.min.js"></script>
<script src="{{$asset}}/assets/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>
<script src="{{$asset}}/assets/vendor/asrange/jquery-asRange.min.js"></script>
<script src="{{$asset}}/assets/vendor/bootbox/bootbox.js"></script>
<script src="{{$asset}}/assets/vendor/webui-popover/jquery.webui-popover.min.js"></script>
<script src="{{$asset}}/assets/vendor/toolbar/jquery.toolbar.js"></script>
<script src="{{$asset}}/assets/vendor/toastr/toastr.js"></script>

<script src="{{$asset}}/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap-select/bootstrap-select.js"></script>
<script src="{{$asset}}/assets/vendor/jquery-selective/jquery-selective.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
{{--<script src="{{$asset}}/assets/vendor/bootbox/bootbox.js"></script>--}}


<!-- Scripts -->
<script src="{{$asset}}/assets/js/Component.js"></script>
<script src="{{$asset}}/assets/js/Plugin.js"></script>
<script src="{{$asset}}/assets/js/Base.js"></script>
<script src="{{$asset}}/assets/js/Config.js"></script>

<script src="{{$asset}}/assets/js/Section/Menubar.js"></script>
<script src="{{$asset}}/assets/js/Section/Sidebar.js"></script>
<script src="{{$asset}}/assets/js/Section/PageAside.js"></script>
<script src="{{$asset}}/assets/js/Plugin/menu.js"></script>

<!-- Config -->
<script src="{{$asset}}/assets/js/config/colors.js"></script>
<script src="{{$asset}}/assets/js/config/tour.js"></script>
<script>Config.set('assets', '../assets');</script>

<!-- Page -->
<script src="{{$asset}}/assets/js/Plugin/icheck.js"></script>
<script src="{{$asset}}/assets/js/Site.js"></script>
<script src="{{$asset}}/assets/js/Plugin/asscrollable.js"></script>
<script src="{{$asset}}/assets/js/Plugin/slidepanel.js"></script>
<script src="{{$asset}}/assets/js/Plugin/switchery.js"></script>
<script src="{{$asset}}/assets/js/Plugin/matchheight.js"></script>
<!--<script src="{{$asset}}/assets/js/Plugin/jvectormap.js"></script>-->
<script src="{{$asset}}/assets/js/Plugin/peity.js"></script>
<script src="{{$asset}}/assets/js/Plugin/datatables.js"></script>
<script src="{{$asset}}/assets/js/Plugin/select2.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-tokenfield.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-tagsinput.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-select.js"></script>

<script src="{{$asset}}/assets/js/Plugin/switchery.js"></script>
<script src="{{$asset}}/assets/js/Plugin/asrange.js"></script>
<script src="{{$asset}}/assets/js/Plugin/ionrangeslider.js"></script>
<script src="{{$asset}}/assets/js/Plugin/asspinner.js"></script>
<script src="{{$asset}}/assets/js/Plugin/clockpicker.js"></script>
<script src="{{$asset}}/assets/js/Plugin/ascolorpicker.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-maxlength.js"></script>
<script src="{{$asset}}/assets/js/Plugin/jquery-knob.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-touchspin.js"></script>
<script src="{{$asset}}/assets/js/Plugin/card.js"></script>
<script src="{{$asset}}/assets/js/Plugin/jquery-labelauty.js"></script>
<script src="{{$asset}}/assets/js/Plugin/bootstrap-datepicker.js"></script>
<script src="{{$asset}}/assets/js/Plugin/jt-timepicker.js"></script>
<script src="{{$asset}}/assets/js/Plugin/datepair.js"></script>
<script src="{{$asset}}/assets/js/Plugin/jquery-strength.js"></script>
<script src="{{$asset}}/assets/js/Plugin/multi-select.js"></script>
<script src="{{$asset}}/assets/examples/js/tables/datatable.js"></script>
<script src="{{$asset}}/assets/examples/js/uikit/icon.js"></script>
<script src="{{$asset}}/assets/vendor/alertify/alertify.js"></script>
<script src="{{$asset}}/assets/vendor/notie/notie.js"></script>
<script src="{{$asset}}/assets/js/Plugin/alertify.js"></script>
<script src="{{$asset}}/assets/js/Plugin/notie-js.js"></script>
<script src="{{$asset}}/assets/js/Plugin/toastr.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap-table/bootstrap-table.min.js"></script>
<script src="{{$asset}}/assets/vendor/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js"></script>



<script src="{{$asset}}/assets/js/Plugin/webui-popover.js"></script>
<script src="{{$asset}}/assets/js/Plugin/toolbar.js"></script>

<script src="{{$asset}}/assets/examples/js/uikit/tooltip-popover.js"></script>


<!--<script src="{{$asset}}/assets/examples/js/dashboard/v1.js"></script>-->
<script src="{{$asset}}/assets/js/app.js"></script>
<script src="{{$asset}}/assets/js/ang.js"></script>
<script src="{{$asset}}/assets/js/custom.js"></script>


@yield('script')

</body>
</html>

