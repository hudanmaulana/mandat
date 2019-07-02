<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="theme-color" content="#1976d2">
	    <title><?=$this->config->item('site_title').' &bull; '.$this->config->item('company')?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?=ASSETS?>assets/favicon.ico">
		<link rel="manifest" href="<?=ASSETS?>assets/manifest.json">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<link rel="stylesheet" href="<?=ASSETS?>plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=ASSETS?>plugins/datatables/datatables.min.css">
		<link rel="stylesheet" href="<?=ASSETS?>plugins/datepicker/datepicker.min.css">
		<link rel="stylesheet" href="<?=ASSETS?>plugins/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>plugins/select2/select2.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>plugins/easyautocomplete/easy-autocomplete.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>css/_all-skins.min.css">
        <link rel="stylesheet" href="<?=ASSETS?>css/animate.css">
		<link rel="stylesheet" href="<?=ASSETS?>css/style.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue-light fixed sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><i class="fa fa-chevron-left"></i></a>
                    <div class="top-logo">
                        <img src="<?=ASSETS?>assets/rencanaku.png" class="img-responsive" alt="<?=$this->config->item('site_title')?>">
                    </div>
					<div class="navbar-custom-menu">
						<?php
						$user = $this->ion_auth->user()->row();
						$avatar = (@$user->photo) ? UPLOAD_DIR.'avatar/'.$user->photo : UPLOAD_DIR.'avatar/avatar.png';
						?>
	        			<ul class="nav navbar-nav">
							<li>
				            	<a href="#" id="fullsc"><i class="fa fa-arrows-alt"></i></a>
				        	</li>
	        				<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?=$avatar?>" class="user-image" alt="<?=$user->display_name?>" title="<?=$user->display_name?>">
									<span class="hidden-xs">&nbsp;</span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<img src="<?=$avatar?>" alt="<?=$user->display_name?>" title="<?=$user->display_name?>" class="img-circle" />

										<p>
										<?=$user->display_name?>
										<small>Member since <?=date('d F Y', $user->created_on)?></small>
										</p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<?=anchor('auth/edit_user/'.$user->id, 'Profile', 'class="ajax btn btn-default btn-flat"')?>
										</div>
										<div class="pull-right">
											<?=anchor('auth/logout/'.$user->id, '<i class="fa fa-sign-out"></i> Sign out', 'class="btn btn-default btn-flat"')?>
										</div>
									</li>
								</ul>
							</li>
	        			</ul>
	        		</div>
	        	</nav>
			</header>

			<aside class="main-sidebar">
				<section class="sidebar">
					<div class="user-panel">
						<img src="<?=ASSETS?>assets/logo.png" class="img-responsive" alt="<?=$this->config->item('site_title')?>">
					</div>
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header"><?=$this->config->item('site_title')?></li>
						<li><?=anchor('cms', '<i class="fa fa-cubes"></i> <span>Dasboard</span>', 'class="ajax"')?></li>
                        <?php if($this->ion_auth->is_admin()):?>
    						<li class="treeview">
    							<a href="#">
    								<i class="fa fa-sitemap"></i> <span>Visi Misi</span>
    								<span class="pull-right-container">
    									<i class="fa fa-angle-left pull-right"></i>
    								</span>
    							</a>
    							<ul class="treeview-menu">
    								<li><?=anchor('cms/visimisi', '<i class="fa fa-chevron-right"></i> Visi Misi', 'class="ajax"')?></li>
    								<li><?=anchor('cms/tujuan', '<i class="fa fa-chevron-right"></i> Tujuan', 'class="ajax"')?></li>
    								<li><?=anchor('cms/indikator_tujuan', '<i class="fa fa-chevron-right"></i> Indikator Tujuan', 'class="ajax"')?></li>
    								<li><?=anchor('cms/sasaran', '<i class="fa fa-chevron-right"></i> Sasaran', 'class="ajax"')?></li>
    								<li><?=anchor('cms/indikator_sasaran', '<i class="fa fa-chevron-right"></i> Indikator Sasaran', 'class="ajax"')?></li>
    							</ul>
    						</li>
    						<li class="treeview">
    							<a href="#">
    								<i class="fa fa-bookmark"></i> <span>Prioritas</span>
    								<span class="pull-right-container">
    									<i class="fa fa-angle-left pull-right"></i>
    								</span>
    							</a>
    							<ul class="treeview-menu">
    								<li><?=anchor('cms/prioritas?q=4', '<i class="fa fa-chevron-right"></i> Prioritas Nasional', 'class="ajax"')?></li>
    								<li><?=anchor('cms/prioritas?q=5', '<i class="fa fa-chevron-right"></i> Prioritas DIY', 'class="ajax"')?></li>
    								<li><?=anchor('cms/prioritas?q=6', '<i class="fa fa-chevron-right"></i> Prioritas Kabupaten', 'class="ajax"')?></li>
    							</ul>
    						</li>
    						<li class="treeview">
    							<a href="#">
    								<i class="fa fa-book"></i> <span>Program/Kegiatan</span>
    								<span class="pull-right-container">
    									<i class="fa fa-angle-left pull-right"></i>
    								</span>
    							</a>
    							<ul class="treeview-menu">
    								<li><?=anchor('cms/urusan', '<i class="fa fa-chevron-right"></i> Urusan', 'class="ajax"')?></li>
    								<li><?=anchor('cms/program', '<i class="fa fa-chevron-right"></i> Program', 'class="ajax"')?></li>
    								<li><?=anchor('cms/kegiatan', '<i class="fa fa-chevron-right"></i> Kegiatan', 'class="ajax"')?></li>
    							</ul>
    						</li>
    						<li class="treeview">
    							<a href="#">
    								<i class="fa fa-database"></i> <span>Data Master</span>
    								<span class="pull-right-container">
    									<i class="fa fa-angle-left pull-right"></i>
    								</span>
    							</a>
    							<ul class="treeview-menu">
    								<li><?=anchor('cms/kecamatan', '<i class="fa fa-chevron-right"></i> Kecamatan', 'class="ajax"')?></li>
    								<li><?=anchor('cms/desa', '<i class="fa fa-chevron-right"></i> Desa', 'class="ajax"')?></li>
                                    <li><?=anchor('cms/rekening', '<i class="fa fa-chevron-right"></i> Rekening', 'class="ajax"')?></li>
    								<li><?=anchor('cms/shbj', '<i class="fa fa-chevron-right"></i> SHBJ', 'class="ajax"')?></li>
    								<li><?=anchor('cms/sk_jalan', '<i class="fa fa-chevron-right"></i> SK Jalan', 'class="ajax"')?></li>
    								<li><?=anchor('cms/pd', '<i class="fa fa-chevron-right"></i> PD', 'class="ajax"')?></li>
    								<li><?=anchor('cms/tahun', '<i class="fa fa-chevron-right"></i> Tahun', 'class="ajax"')?></li>
    							</ul>
    						</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-users"></i> <span>Users</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><?=anchor('auth/edit_user/'.$user->id, '<i class="fa fa-chevron-right"></i> Your Profile', 'class="ajax"')?></li>
                                    <?php if($this->ion_auth->is_admin()):?>
                                    <li><?=anchor('auth/list_user', '<i class="fa fa-chevron-right"></i> All Users', 'class="ajax"')?></li>
                                    <li><?=anchor('auth/create_user', '<i class="fa fa-chevron-right"></i> Add User', 'class="ajax"')?></li>
                                    <li><?=anchor('auth/groups', '<i class="fa fa-chevron-right"></i> User Groups', 'class="ajax"')?></li>
                                    <?php endif?>
                                </ul>
                            </li>
                        <?php endif?>
                        <?php if($this->ion_auth->is_admin()):?>
    						<li class="treeview">
    							<a href="#">
    								<i class="fa fa-gear"></i> <span>Setting</span>
    								<span class="pull-right-container">
    									<i class="fa fa-angle-left pull-right"></i>
    								</span>
    							</a>
    							<ul class="treeview-menu">
                                    <li><?=anchor('cms/general', '<i class="fa fa-chevron-right"></i> <span>Setting</span>', 'class="ajax"')?></li>
                                    <li><?=anchor('cms/menus', '<i class="fa fa-chevron-right"></i> Menus', 'class="ajax"')?></li>
                                </ul>
                            </li>
                        <?php endif?>
					</ul>
				</section>
			</aside>

			<div class="content-wrapper" id="mainContent">
				<div class="container">
					<?php
					echo @($message) ? '<div class="alert alert-info">'.$message.'</div>': '';
					$flashmessage = $this->session->flashdata('message');
					echo @($flashmessage) ? '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$flashmessage.'</div>' : '';
					//$this->output->enable_profiler(TRUE);
					?>
				</div>

				<?=@$content?>
			</div>

			<div id="progress" class="loading text-secondary" style="display: none">
				<i class="fa fa-gear fa-4x fa-spin fa-fw"></i>
			</div>
		</div>
		<script type="text/javascript">var site = '<?=BASE_URL?>';</script>
		<script type="text/javascript">var url = '<?=uri_string()?>';</script>
		<script src="<?=ASSETS?>js/jquery.min.js"></script>
		<script src="<?=ASSETS?>js/jquery.form.js"></script>
        <script src="<?=ASSETS?>js/jquery.slimscroll.min.js"></script>
        <script src="<?=ASSETS?>js/screenfull.js"></script>
		<script src="<?=ASSETS?>plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=ASSETS?>plugins/easyautocomplete/jquery.easy-autocomplete.min.js"></script>
        <script src="<?=ASSETS?>plugins/datatables/datatables.min.js"></script>
        <script src="<?=ASSETS?>plugins/datepicker/datepicker.min.js"></script>
        <script src="<?=ASSETS?>plugins/price/jquery.price_format.min.js"></script>
        <script src="<?=ASSETS?>plugins/select2/select2.min.js"></script>
        <script src="<?=ASSETS?>plugins/sortable/jquery-ui.js"></script>
        <script src="<?=ASSETS?>plugins/sortable/jquery.mjs.nestedSortable.js"></script>
        <script type="text/javascript">
            /* ---
                menus
                */
            $(function() {
                $('.sortable').nestedSortable({
                    handle: 'div',
                    items: 'li',
                    toleranceElement: '> div',
                    maxLevels: 2
                });
            });
        </script>
        <script src="<?=ASSETS?>plugins/toastr/toastr.min.js"></script>
		<script src="<?=ASSETS?>js/adminlte.min.js"></script>
		<script src="<?=ASSETS?>js/app.js"></script>
	</body>
</html>
