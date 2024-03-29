<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap material admin template">
	<meta name="author" content="">

	<title>{title}</title>

	<link rel="apple-touch-icon" href="{asset}/assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="{asset}/assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{asset}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/bootstrap-extend.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/site.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/custom.css">

	<!-- Plugins -->
	<link rel="stylesheet" href="{asset}/assets/vendor/animsition/animsition.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/switchery/switchery.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/intro-js/introjs.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/flag-icon-css/flag-icon.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/waves/waves.css">

<!--	<link rel="stylesheet" href="{asset}/assets/vendor/chartist/chartist.css">-->
<!--	<link rel="stylesheet" href="{asset}/assets/vendor/jvectormap/jquery-jvectormap.css">-->
<!--	<link rel="stylesheet" href="{asset}/assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">-->
	<link rel="stylesheet" href="{asset}/assets/examples/css/dashboard/v1.css">

	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
	<link rel="stylesheet" href="{asset}/assets/examples/css/tables/datatable.css">



	<link rel="stylesheet" href="{asset}/assets/vendor/select2/select2.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-tokenfield/bootstrap-tokenfield.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-select/bootstrap-select.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/icheck/icheck.css">

	<link rel="stylesheet" href="{asset}/assets/vendor/asrange/asRange.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/ionrangeslider/ionrangeslider.min.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/asspinner/asSpinner.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/clockpicker/clockpicker.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/ascolorpicker/asColorPicker.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/jquery-labelauty/jquery-labelauty.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/timepicker/jquery-timepicker.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/jquery-strength/jquery-strength.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/multi-select/multi-select.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/typeahead-js/typeahead.css">
	<link rel="stylesheet" href="{asset}/assets/examples/css/forms/advanced.css">
    <link rel="stylesheet" href="{asset}/assets/vendor/alertify/alertify.css">
    <link rel="stylesheet" href="{asset}/assets/examples/css/advanced/alertify.css">

    <!-- Fonts -->
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-select/bootstrap-select.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/jquery-selective/jquery-selective.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/bootstrap-markdown/bootstrap-markdown.css">
	<link rel="stylesheet" href="{asset}/assets/examples/css/apps/taskboard.min.css">
	<!-- Fonts -->
	<link rel="stylesheet" href="{asset}/assets/fonts/font-awesome/font-awesome.css">
	<link rel="stylesheet" href="{asset}/assets/fonts/material-design/material-design.min.css">
	<link rel="stylesheet" href="{asset}/assets/fonts/brand-icons/brand-icons.min.css">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

	<!--[if lt IE 9]>
	<script src="{asset}/assets/vendor/html5shiv/html5shiv.min.js"></script>
	<![endif]-->

	<!--[if lt IE 10]>
	<script src="{asset}/assets/vendor/media-match/media.match.min.js"></script>
	<script src="{asset}/assets/vendor/respond/respond.min.js"></script>
	<![endif]-->

	<!-- Scripts -->
	<script src="{asset}/assets/vendor/breakpoints/breakpoints.js"></script>
	<script>
		Breakpoints();
	</script>

	<script type="text/javascript">var site = '<?=BASE_URL?>';</script>
	<script type="text/javascript">var url = '<?=uri_string()?>';</script>
	<script type="text/javascript">var urltask = '<?=BASE_URL?><?=uri_string()?>';</script>
	<!-- Core  -->
	<script src="{asset}/assets/vendor/babel-external-helpers/babel-external-helpers.js"></script>
	<script src="{asset}/assets/vendor/jquery/jquery.js"></script>
	<script src="{asset}/assets/vendor/popper-js/umd/popper.min.js"></script>
	<script src="{asset}/assets/vendor/bootstrap/bootstrap.js"></script>
	<script src="{asset}/assets/vendor/animsition/animsition.js"></script>
	<script src="{asset}/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
	<script src="{asset}/assets/vendor/asscrollbar/jquery-asScrollbar.js"></script>
	<script src="{asset}/assets/vendor/asscrollable/jquery-asScrollable.js"></script>
	<script src="{asset}/assets/vendor/waves/waves.js"></script>
</head>
<body class="animsition site-navbar-small dashboard">
<!--[if lt IE 8]>
<![endif]-->
