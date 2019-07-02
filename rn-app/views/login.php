
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="bootstrap material admin template">
	<meta name="author" content="">

	<title>Login | {title}</title>

	<link rel="apple-touch-icon" href="{asset}/assets/images/apple-touch-icon.png">
	<link rel="shortcut icon" href="{asset}/assets/images/favicon.ico">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{asset}/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/bootstrap-extend.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/site.min.css">
	<link rel="stylesheet" href="{asset}/assets/css/custom.css">
	<link rel="stylesheet" href="{asset}/assets/fonts/awesome/css/all.css">
	<!-- Plugins -->
	<link rel="stylesheet" href="{asset}/assets/vendor/animsition/animsition.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/switchery/switchery.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/intro-js/introjs.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/flag-icon-css/flag-icon.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/waves/waves.css">
	<link rel="stylesheet" href="{asset}/assets/vendor/toastr/toastr.min.css">
	<link rel="stylesheet" href="{asset}/assets/examples/css/pages/login-v3.css">


	<!-- Fonts -->
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
</head>
<body class="animsition page-login-v3 layout-full">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
	<div class="page-content vertical-align-middle">
		<div class="panel">
			<div class="panel-body">
				<div class="brand">
<!--					<img class="brand-img logo-max-size" src="{assets}/uploads/{logo}" alt="...">-->
					<span style="font-size: 3em; color: Tomato;">
  <i class="fal fa-book"></i>
</span>
					<h2 class="brand-text font-size-18">{title}</h2>
				</div>
				<?php
				$attributes = array(
					'name'        	=> 'login_form',
					'role'        	=> 'form',
					'onsubmit'		=> 'submitForm(\''.$url.'\')',
					'autocomplete'	=> 'off');

				echo form_open('do_login', $attributes);
				if($this->uri->segment(1) != '')
					echo form_hidden('current_url', current_url());
				?>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="<?=$identity['type']?>" name="<?=$identity['name']?>" id="<?=$identity['id']?>" class="<?=$identity['class']?>"  value="<?=$identity['value']?>">
						<label class="floating-label">Email</label>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="<?=$password['type']?>" name="<?=$password['name']?>" id="<?=$password['id']?>" class="<?=$password['class']?>"  value="<?=$password['value']?>">
						<label class="floating-label">Password</label>
					</div>
					<div class="form-group clearfix">
						<div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
							<input type="checkbox" id="inputCheckbox" name="remember">
							<label for="inputCheckbox">Remember me</label>
						</div>
	<!--						<a class="float-right" href="forgot-password.html">Forgot password?</a>-->
					</div>
					<button type="submit" id="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
<!--				<button type="submit" id="submit" class="btn btn-danger btn-block btn-lg mt-20 waves-effect waves-classic"><i class="fab fa-google-plus-g"></i>-->
<!--					Sign in with Google+</button>-->
					<?php
					echo form_close()
					?>
<!--				<p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p>-->
			</div>
		</div>

		<footer class="page-copyright page-copyright-inverse">
			<p>APPS BY WartegTech</p>
			<p>© 2019. All RIGHT RESERVED.</p>
			<div class="social">
				<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-twitter" aria-hidden="true"></i>
				</a>
				<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-facebook" aria-hidden="true"></i>
				</a>
				<a class="btn btn-icon btn-pure" href="javascript:void(0)">
					<i class="icon bd-google-plus" aria-hidden="true"></i>
				</a>
			</div>
		</footer>
	</div>
</div>
<!-- End Page -->


<!-- Core  -->
<script src="{asset}/assets/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="{asset}/assets/vendor/jquery/jquery.js"></script>
<script src="{asset}/assets/vendor/toastr/toastr.min.js"></script>
<script src="{asset}/assets/vendor/popper-js/umd/popper.min.js"></script>
<script src="{asset}/assets/vendor/bootstrap/bootstrap.js"></script>
<script src="{asset}/assets/vendor/animsition/animsition.js"></script>
<script src="{asset}/assets/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="{asset}/assets/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="{asset}/assets/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="{asset}/assets/vendor/waves/waves.js"></script>

<!-- Plugins -->
<script src="{asset}/assets/vendor/switchery/switchery.js"></script>
<script src="{asset}/assets/vendor/intro-js/intro.js"></script>
<script src="{asset}/assets/vendor/screenfull/screenfull.js"></script>
<script src="{asset}/assets/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="{asset}/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Scripts -->
<script src="{asset}/assets/js/Component.js"></script>
<script src="{asset}/assets/js/Plugin.js"></script>
<script src="{asset}/assets/js/Base.js"></script>
<script src="{asset}/assets/js/Config.js"></script>

<script src="{asset}/assets/js/Section/Menubar.js"></script>
<script src="{asset}/assets/js/Section/Sidebar.js"></script>
<script src="{asset}/assets/js/Section/PageAside.js"></script>
<script src="{asset}/assets/js/Plugin/menu.js"></script>

<!-- Config -->
<script src="{asset}/assets/js/config/colors.js"></script>
<script src="{asset}/assets/js/config/tour.js"></script>
<script>Config.set('assets', '../../assets');</script>

<!-- Page -->
<script src="{asset}/assets/js/Site.js"></script>
<script src="{asset}/assets/js/auth.js"></script>
<script src="{asset}/assets/js/Plugin/asscrollable.js"></script>
<script src="{asset}/assets/js/Plugin/slidepanel.js"></script>
<script src="{asset}/assets/js/Plugin/switchery.js"></script>
<script src="{asset}/assets/js/Plugin/jquery-placeholder.js"></script>
<script src="{asset}/assets/js/Plugin/material.js"></script>

<script>
	(function(document, window, $){
		'use strict';
		var Site = window.Site;
		$(document).ready(function(){
			Site.run();
		});
	})(document, window, jQuery);
</script>
</body>
</html>
