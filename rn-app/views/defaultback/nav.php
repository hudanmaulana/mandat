<?php
    $user = get_instance()->ion_auth->user()->row();
    $is_login = ($user->is_login == 1) ? 'avatar-online' : '';
?>

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
     role="navigation">
    <div class="navbar-header" style="margin-right: 20px">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
<!--        		<button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"-->
<!--        				data-toggle="collapse">-->
<!--        			<i class="icon md-more" aria-hidden="true"></i>-->
<!--        		</button>-->
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <a href="{url}">
                <img class="navbar-brand-logo" src="{upload_dir}uploads/<?= $setting['site_logo']?>">
                <span class="navbar-brand-text hidden-xs-down  logo-custom"> <?= $setting['site_title']?></span>
            </a>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <!--			<span class="sr-only">Toggle Search</span>-->
            <!--			<i class="icon md-search" aria-hidden="true"></i>-->
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
				<li class="nav-item dropdown dropdown-fw dropdown-mega">
					<a class="nav-link waves-effect waves-light waves-round" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade" role="button">Menu <i class="icon md-chevron-down" aria-hidden="true"></i></a>
					<div class="dropdown-menu" role="menu">
						<div class="mega-content">
							<div class="row">
								<div class="col-md-4">
									<h5>Data</h5>
									<ul class="blocks-2">
										<li class="mega-menu m-0">
											<ul class="list-icons">
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/dataFidusia" class=" waves-effect waves-light waves-round">Entri Data</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/dataacc" class=" waves-effect waves-light waves-round">Data</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/accindata" class=" waves-effect waves-light waves-round">Status Data</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/sertifikat" class=" waves-effect waves-light waves-round">Sertifikat</a>
												</li>

											</ul>
										</li>

									</ul>
								</div>
								<div class="col-md-4">
									<h5>Setting</h5>
									<ul class="blocks-2">
										<li class="mega-menu m-0">
											<ul class="list-icons">
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/users" class=" waves-effect waves-light waves-round">Users</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/groups" class=" waves-effect waves-light waves-round">Groups</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/dashboard_setting" class=" waves-effect waves-light waves-round">Setting</a>
												</li>
												<li><i class="md-chevron-right" aria-hidden="true"></i>
													<a href="<?php echo base_url()?>/rn/role" class=" waves-effect waves-light waves-round">role</a>
												</li>
											</ul>
										</li>

									</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
            </ul>



            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">

                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
                <span class="avatar <?= $is_login ?>">
                  <img src="<?= UPLOAD_DIR ?>uploads/avatars/{avatar}" alt="...">
                  <i></i>
                </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{url}rn/users" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                        <a class="dropdown-item" href="{url}rn/dashboard_setting" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{url}logout" role="menuitem"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
    </div>
</nav>

<div class="site-menubar">
    <div class="site-menubar-body">
        <ul class="site-menu" data-plugin="menu">
            <li class="site-menu-item has-sub">
                <a href="javascript:void(0)" dropdown-badge="false">
                    <i class="site-menu-icon md-notifications" aria-hidden="true"></i>
                    <span class="site-menu-title">Notifications</span>
                    <span class="site-menu-arrow"></span>
                </a>
                <ul class="site-menu-sub">
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/grids.html">
                            <span class="site-menu-title">Grid Scaffolding</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/layout-grid.html">
                            <span class="site-menu-title">Layout Grid</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/headers.html">
                            <span class="site-menu-title">Different Headers</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/panel-transition.html">
                            <span class="site-menu-title">Panel Transition</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/boxed.html">
                            <span class="site-menu-title">Boxed Layout</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/two-columns.html">
                            <span class="site-menu-title">Two Columns</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="../layouts/bordered-header.html">
                            <span class="site-menu-title">Bordered Header</span>
                        </a>
                    </li>
                    <li class="site-menu-item">
                        <a class="animsition-link" href="javascript:void(0)">
                            <span class="site-menu-title">All Notifications</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="site-menu-item has-sub">
                <a href="{url}rn/user" class="animsition-link">
                    <i class="site-menu-icon md-account" aria-hidden="true"></i>
                    <span class="site-menu-title">Profile</span>
                </a>
            </li>
            <li class="site-menu-item has-sub">
                <a href="{url}rn/dashboard_setting" class="animsition-link">
                    <i class="site-menu-icon md-settings" aria-hidden="true"></i>
                    <span class="site-menu-title">Settings</span>
                </a>
            </li>
            <div class="dropdown-divider"></div>
            <li class="site-menu-item has-sub">
                <a href="{url}logout" class="animsition-link">
                    <i class="site-menu-icon md-power" aria-hidden="true"></i>
                    <span class="site-menu-title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
