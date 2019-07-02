@extends('app')
@section('stylehead')
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/pages/profile.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/dropify/dropify.css">
@endsection
@section('body')
	<div class="page" ng-controller="editController">
		<div class="page-content container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<!-- Page Widget -->
					<div class="card card-shadow text-center">
						<div class="card-block">
							<a class="avatar avatar-lg">
								<img src="{{@$avatar ?: $avatar_default}}" alt="...">
							</a>
							<h4 class="profile-user">{{$display_name}}</h4>
							<p class="profile-job">{{$username}}</p>
							<p>{{$bio}}</p>
							<div class="profile-social">
								<a class="icon bd-twitter" href="{{$facebook}}" target="_blank"></a>
								<a class="icon bd-facebook" href="{{$twitter}}" target="_blank"></a>
							</div>
							<a href="{{$url}}" class="btn btn-primary waves-effect waves-classic">Back</a>
						</div>
						<div class="card-footer">
							<div class="row no-space">
								<div class="col-4">
									<strong class="profile-stat-count">{{$completed}}</strong>
									<small class="badge badge-success">Complete</small>
								</div>
								<div class="col-4">
									<strong class="profile-stat-count">{{$waiting}}</strong>
									<small class="badge badge-warning">Reply Waiting</small>
								</div>
								<div class="col-4">
									<strong class="profile-stat-count">{{$uncompleted}}</strong>
									<small class="badge badge-danger">Uncompleted</small>
								</div>
							</div>
						</div>
					</div>
					<!-- End Page Widget -->
				</div>

				<div class="col-lg-9">
					<!-- Panel -->
					<div class="panel">
						<div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
							<ul class="nav nav-tabs nav-tabs-line" role="tablist">
								<li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#personal_info" aria-controls="activities" role="tab" aria-selected="true">Personal Info</a></li>
								<li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#change_avatar" aria-controls="profile" role="tab" aria-selected="false">Change Avatar</a></li>
								<li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#change_password" aria-controls="messages" role="tab" aria-selected="false">Change Password</a></li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane animation-slide-left active" id="personal_info" role="tabpanel">
									{{-- PERSONAL INFO --}}
									<div class="row row-lg">
										<div class="col-md-12">
											<div class="example">
												<form id="form_pi" autocomplete="off">
													<input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
													<div class="form-group form-material">
														<label class="form-control-label" for="display_name">Display Name</label>
														<input type="text" class="form-control" id="display_name" name="display_name" value="{{$display_name}}" placeholder="Display Name" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="email">Email Address</label>
														<input type="email" class="form-control" id="email" name="email" value="{{$email}}" placeholder="Email Address" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="facebook">Facebook</label>
														<input type="email" class="form-control" id="facebook" name="facebook" value="{{$facebook}}" placeholder="Facebook" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="twitter">Twitter</label>
														<input type="email" class="form-control" id="twitter" name="twitter" value="{{$twitter}}" placeholder="Twitter" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="bio">Bio</label>
														<textarea class="form-control" id="bio" name="bio" rows="3">{{$bio}}</textarea>
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="current_location">Address</label>
														<textarea class="form-control" id="current_location" name="current_location" rows="3">{{$current_location}}</textarea>
													</div>

													<div class="form-group form-material">
														<button type="button" class="btn btn-primary waves-effect waves-classic" ng-click="save_pi()">Save</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane animation-slide-left" id="change_avatar" role="tabpanel">
									{{-- CREATE FORM HERE --}}
									<div class="row row-lg">
										<div class="col-md-12">
											<div class="example">
												<form autocomplete="off">
													<div class="form-group form-material">
														<input type="file" class="dropify-event" id="input-file-max-fs" {{@$avatar ? 'data-default-file='.$avatar.'' : '' }} data-plugin="dropify" data-max-file-size="2M" data-column="avatar" file-model="avatar" ng-model="avatar" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="avatar" />
														<input id="field_avatar" class="hidden-upload-input" type="hidden" name="avatar" value="">
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane animation-slide-left" id="change_password" role="tabpanel">
									{{-- CREATE FORM HERE --}}
									<div class="row row-lg">
										<div class="col-md-12">
											<div class="example">
												<form id="form_password" autocomplete="off">
													<input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
													<div class="form-group form-material">
														<label class="form-control-label" for="new_password">New Password</label>
														<input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="new_password_2">Re-type New Password</label>
														<input type="password" class="form-control" id="new_password_2" name="new_password_2" placeholder="Re-type New Password" autocomplete="off">
													</div>

													<div class="form-group form-material">
														<button type="button" class="btn btn-primary waves-effect waves-classic" ng-click="save_password()">Save</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Panel -->
				</div>
			</div>
		</div>
	</div>

@endsection
@section('script')
	{{--JS PAGE--}}
	<script src="{{$asset}}/assets/vendor/jquery-ui/jquery-ui.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-tmpl/tmpl.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-canvas-to-blob/canvas-to-blob.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-load-image/load-image.all.min.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
	<script src="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
	<script src="{{$asset}}/assets/vendor/dropify/dropify.min.js"></script>
	<script src="{{$asset}}/assets/js/Plugin/dropify.js"></script>

	{{--END JS PAGE--}}

	<script type="text/javascript">
		$('body').addClass('page-profile');

		$("#field_avatar").val('{{ $avatar_pic }}');

		$('.dropify-event').dropify({
			tpl: {
				clearButton:'<button type="button" data-column="avatar" id="delete_avatar" data-filename="{{ $avatar_pic }}" ng-click="deleteFileClick($event)"  class="dropify-clear">remove</button>',
			},
			messages: {
				'default': 'Drag and drop a image here or click',
			}
		});

		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('editController',function($scope, $http)
		{
			$scope.save_pi = function (redirect=true) {
				var formDataArray = $('#form_pi').serializeArray();
				var formData = {};
				formDataArray.forEach(function(entry) {
					formData[entry.name]=entry.value;
				});
				formData['roles']=$("#field-roles").val();
				formData['parent']=$("#field-parent").val();
				$http({
					url: rn_url+"/edit_personal_info_save",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;

					show_notif(result.status, result.message, result.callback_url);

				}, function errorCallback(response) {
					console.log(response);
					toastr.alert('Oops error, please refresh this page');
				});
			};

			$scope.save_password = function (redirect=true) {
				var formDataArray = $('#form_password').serializeArray();
				var formData = {};
				formDataArray.forEach(function(entry) {
					formData[entry.name]=entry.value;
				});
				formData['roles']=$("#field-roles").val();
				formData['parent']=$("#field-parent").val();
				$http({
					url: rn_url+"/edit_change_password_save",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;

					show_notif(result.status, result.message, result.callback_url);

				}, function errorCallback(response) {
					console.log(response);
					toastr.alert('Oops error, please refresh this page');
				});
			};

			$scope.uploadImage = function (files,item) {
				$scope.spinner = false;
				var field = item.attributes['data-column'].value;
				if( files.length ){
					var fd = new FormData();
					fd.append("file", files[0]);
					var uploadUrl = rn_url+"/upload";

					$http.post(uploadUrl, fd, {
						withCredentials: true,
						headers: {'Content-Type': undefined },
						transformRequest: angular.identity
					}).then(function successCallback(response) {
						$scope.spinner = true;
						var result = response.data;

						$("#delete_"+field).attr('data-filename', result.file_name);
						$("#field_"+field).val(result.file_name);

						show_notif(result.status, result.message, result.callback_url);

					}, function errorCallback(response) {
						console.log(response);
					});
				}
			};

			$scope.deleteFileClick = function (event) {
				var item = event.target;
				var file_name = item.attributes['data-filename'].value;
				$http({
					method: 'GET',
					url: rn_url+"/upload/"+file_name
				}).then(function successCallback(response) {
					var result = response.data;

					show_notif(result.status, result.message, result.callback_url);

					}, function errorCallback(response) {
					console.log(response);
				});
			};
		});
	</script>
@endsection
