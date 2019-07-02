@extends('app')
@section('stylehead')
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/dropify/dropify.css">

@endsection
@section('body')
	<div class="page"  id="page_content" ng-controller="addController">
		<div class="page-header">
			<h1 class="page-title">Form Add {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn/{{$module}}">{{$subject}}</a></li>
				<li class="breadcrumb-item active">{{$module}}</li>
			</ol>
		</div>
		<div class="page-content">
			<div class="row">

				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body container-fluid">
							<div class="row row-lg">
								<div class="col-md-8">
									<div class="example-wrap">
										<h4 class="example-title">Add User</h4>
										<div class="example">
											<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
												<div class="form-group form-material">
													<input type="file" class="dropify-event" id="input-file-max-fs" data-plugin="dropify" data-max-file-size="2M" data-column="avatar" file-model="avatar" ng-model="avatar" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="avatar" />
													<input id="field_avatar" class="hidden-upload-input" type="hidden" name="avatar" value="">
												</div>

												<div class="row">
													<div class="form-group form-material col-md-6">
														<label class="form-control-label" for="">Username</label>
														<input type="text" class="form-control"  name="username" placeholder="username"  maxlength="100" autocomplete="off" required />
													</div>
													<div class="form-group form-material col-md-6">
														<label class="form-control-label" for="">Email</label>
														<input type="email" class="form-control"  name="email" placeholder="email"  maxlength="100" autocomplete="off" required />
													</div>
												</div>
												<div class="row">
													<div class="form-group form-material col-md-6">
														<label class="form-control-label" for="">Full Name</label>
														<input type="text" class="form-control"  name="display_name" placeholder="display name"  maxlength="150" autocomplete="off" required />
													</div>
													<div class="form-group form-material col-md-6">
														<label class="form-control-label" for="">Mobile Phone</label>
														<input type="text" class="form-control"  name="mobile" placeholder="mobile phone"  maxlength="14" autocomplete="off" required />
													</div>
												</div>

												<div class="row">
													<div class="form-group form-material  col-md-6">
														<label class="form-control-label">Active</label>
														<div>
															<div class="radio-custom radio-default radio-inline">
																<input type="radio"  name="active" value="1" />
																<label for="">Yes</label>
															</div>
															<div class="radio-custom radio-default radio-inline">
																<input type="radio"  name="active" value="0" checked />
																<label for="">No</label>
															</div>
														</div>
													</div>
													<div class="form-group form-material  col-md-6">
														<label class="form-control-label">Gender</label>
														<div>
															<div class="radio-custom radio-default radio-inline">
																<input type="radio" value="male"  name="gender" />
																<label for="">Male</label>
															</div>
															<div class="radio-custom radio-default radio-inline">
																<input type="radio"  value="female" name="gender" checked />
																<label for="">Female</label>
															</div>
														</div>
													</div>

												</div>

												<div class="row">
													<div class="form-group form-material col-md-6 ">
														<label class="form-control-label" for="">Location</label>
														<input type="text" class="form-control"  name="current_location" placeholder="location"  maxlength="100" autocomplete="off" required />
													</div>
													<div class="form-group form-material col-md-6">
														<label class="form-control-label" for="">Password</label>
														<input type="password" class="form-control"  name="password" placeholder=""  maxlength="250" autocomplete="off" required />
													</div>
												</div>

												<div class="form-group form-material">
													<label class="form-control-label">Groups</label>
													<div>
														<select class="form-control" multiple data-plugin="select2" id="field-groups">
															@foreach( $groups as $v )
																<option value="{{$v['id']}}" @if( in_array($v['id'], $selected_groups) ) selected @endif>{{$v['name']}}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="form-group form-material">
													<button type="button" class="btn btn-primary" ng-click="mySave()">Save</button>
													<a href="{{base_url()}}rn/{{$module}}" class="btn btn-danger">Cancel</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
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
	<script type="text/javascript">


		$('.dropify-event').dropify({
			tpl: {
				clearButton:     '<button type="button" data-column="avatar" id="delete_avatar" data-filename="" ng-click="deleteFileClick($event)"  class="dropify-clear">remove</button>',
			},
			messages: {
				'default': 'Drag and drop a image here or click',
			}
		});
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('addController',function($scope, $http)
		{
			$scope.data = [];
			$scope.columns = [];
			$scope.module = '{{$module}}';
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
						if( result.status ){
							$("#delete_"+field).attr('data-filename', result.message.file_name);
							$("#field_"+field).val(result.message.file_name);
							alertify.success('sukses upload gambar');
						}else{
							alertify.error(result.message);
						}
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
						if( result.status ){
							alertify.success('sukses hapus gambar');
						}else{
							alertify.error(result.message);
						}
					}, function errorCallback(response) {
						console.log(response);
					});
			};
			$scope.mySave = function (redirect=true) {
				var formDataArray = $('#form').serializeArray();
				var formData = {};
				formDataArray.forEach(function(entry) {
					formData[entry.name]=entry.value;
				});
				formData['groups']=$("#field-groups").val();
				$http({
					url: rn_url+"/add",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {

					var result = response.data;
					if( result.status ){
						alertify.success(result.message);
						document.getElementById("form").reset();
						if( redirect ) window.location = rn_url;
					}else{
						alertify.error(result.message);
					}
				}, function errorCallback(response) {
					console.log(response);
					alertify.alert('Oops error, please refresh this page');
				});
			};

		});
	</script>
@endsection
