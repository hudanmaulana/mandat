@extends('app')
@section('body')
<!-- Page -->
<div class="page">
	<div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">

          <div class="col-md-3">
                <div class="card p-30 flex-row justify-content-between">
                    <div class="white">
                        <a href="{url}rn/dataFidusia" class="btn-raised btn btn-info btn-floating waves-effect waves-classic waves-effect waves-light">
                            <i class="icon md-assignment-check" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="counter counter-md counter text-right">
                        <div class="counter-number-group">
                            <span class="counter-number-related text-capitalize">Entri Data</span>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-3">
				<div class="card p-30 flex-row justify-content-between">
					<div class="white">
						<a href="{url}rn/dataacc" class="btn-raised btn btn-info btn-floating waves-effect waves-classic waves-effect waves-light">
							<i class="icon md-book" aria-hidden="true"></i>
						</a>
					</div>
					<div class="counter counter-md counter text-right">
						<div class="counter-number-group">
							<span class="counter-number-related text-capitalize">Data</span>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-3">
                <div class="card p-30 flex-row justify-content-between">
                    <div class="white">
                        <a href="{url}rn/sertifikat" class="btn-raised btn btn-danger btn-floating waves-effect waves-classic waves-effect waves-light">
                            <i class="icon md-star-outline" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="counter counter-md counter text-right">
                        <div class="counter-number-group">
                            <span class="counter-number-related text-capitalize">Sertifikat</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $group = array('admin');
            if ($this->ion_auth->in_group($group)) : ?>
            <div class="col-md-3">
                <div class="card p-30 flex-row justify-content-between">
                    <div class="white">
                        <a href="{url}rn/users" class="btn-raised btn btn-info btn-floating waves-effect waves-classic waves-effect waves-light">
                            <i class="icon md-accounts-list" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="counter counter-md counter text-right">
                        <div class="counter-number-group">
                            <span class="counter-number-related text-capitalize">User</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="card p-30 flex-row justify-content-between">
                    <div class="white">
                        <a href="{url}rn/groups" class="btn-raised btn btn-success btn-floating waves-effect waves-classic waves-effect waves-light">
                            <i class="icon md-accounts" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="counter counter-md counter text-right">
                        <div class="counter-number-group">
                            <span class="counter-number-related text-capitalize">Group</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                    <div class="card p-30 flex-row justify-content-between">
                    <div class="white">
                        <a href="{url}rn/dashboard_setting" class="btn-raised btn btn-danger btn-floating waves-effect waves-classic waves-effect waves-light">
                            <i class="icon md-settings" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="counter counter-md counter text-right">
                        <div class="counter-number-group">
                            <span class="counter-number-related text-capitalize">Settings</span>
                        </div>
                    </div>
                </div>
            </div>
				<div class="col-md-3">
					<div class="card p-30 flex-row justify-content-between">
						<div class="white">
							<a href="{url}rn/role" class="btn-raised btn btn-default btn-floating waves-effect waves-classic waves-effect waves-light">
								<i class="icon md-key" aria-hidden="true"></i>
							</a>
						</div>
						<div class="counter counter-md counter text-right">
							<div class="counter-number-group">
								<span class="counter-number-related text-capitalize">Role</span>
							</div>
						</div>
					</div>
				</div>
            <?php endif; ?>
        </div>
	</div>
</div>
<div class="loader-overlay" style="display: none !important;"></div>
<!-- End Page -->
