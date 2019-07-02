<div class="page">
	<div class="page-header">
		<h1 class="page-title">Form {subject}</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{}">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
			<li class="breadcrumb-item active">Layouts</li>
		</ol>
		<div class="page-header-actions">
			<button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
					data-original-title="Edit">
				<i class="icon md-edit" aria-hidden="true"></i>
			</button>
			<button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
					data-original-title="Refresh">
				<i class="icon md-refresh-alt" aria-hidden="true"></i>
			</button>
			<button type="button" class="btn btn-sm btn-icon btn-primary btn-round" data-toggle="tooltip"
					data-original-title="Setting">
				<i class="icon md-settings" aria-hidden="true"></i>
			</button>
		</div>
	</div>

	<div class="page-content">
		<div class="panel">
			<div class="panel-body container-fluid">
				<div class="row row-lg">
					<div class="col-md-6">
						<!-- Example Basic Form (Form grid) -->
						<div class="example-wrap">
							<h4 class="example-title">Add Role</h4>
							<div class="example">
								<form autocomplete="off">
									<div class="form-group form-material">
										<label class="form-control-label">Name Modul</label>
										<div>
											<select class="form-control" data-plugin="select2">
												<option value="NV">Nevada</option>
												<option value="OR">Oregon</option>
												<option value="WA">Washington</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WV">West Virginia</option>
											</select>
										</div>
									</div>


									<div class="form-group form-material">
										<label class="form-control-label" for="inputBasicEmail">Alias</label>
										<input type="text" class="form-control"  name="inputalias"
											   placeholder="Alias" autocomplete="off" />
									</div>

									<div class="form-group form-material">
										<label class="form-control-label" for="inputBasicEmail">Modul Costum</label>
										<input type="text" class="form-control"  name="inputalias"
											   placeholder="Alias" autocomplete="off" />
									</div>




									<div class="form-group form-material">
										<label class="form-control-label" for="inputBasicPassword">Role Type</label>

												<ul class="list-unstyled example">
													<li class="mb-15">
														<input type="checkbox" class="icheckbox-primary role" id="selectall" onclick="toggle(this)"
															   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"
														/>
														<label for="selectall">Select All</label>
													</li>

													<li class="mb-15">
														<input type="checkbox" class="icheckbox-primary role" id="menu" name="menu"
															   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"
														/>
														<label for="menu">Menu</label>
													</li>

													<li class="mb-15">
														<input type="checkbox" class="icheckbox-primary role" id="add" name="add"
															   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"
														/>
														<label for="add">Add</label>
													</li>
													<li class="mb-15">
														<input type="checkbox" class="icheckbox-primary role" id="edit" name="edit"
															   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"
														/>
														<label for="edit">Edit</label>
													</li>

													<li class="mb-15">
														<input type="checkbox" class="icheckbox-primary role" id="delete" name="delete"
															   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"
														/>
														<label for="delete">Delete</label>
													</li>

												</ul>
									</div>
									<div class="form-group form-material">
										<button type="button" class="btn btn-primary">Save</button>
									</div>
								</form>
							</div>
						</div>
						<!-- End Example Basic Form -->
					</div>
			</div>
		</div>
	</div>
</div>
<!-- End Page -->
	<script type="text/javascript">
		function toggle(source) {
			checkboxes = document.getElementsByClassName('role');
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	</script>
