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

				<div class="col-lg-12">
					<!-- Panel -->
					<div class="panel">
						<div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
							<ul class="nav nav-tabs nav-tabs-line" role="tablist">
								<li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#web_setting" aria-controls="activities" role="tab" aria-selected="true">Web Setting</a></li>
								<li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#change_logo" aria-controls="profile" role="tab" aria-selected="false">Change Logo</a></li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane animation-slide-left active" id="web_setting" role="tabpanel">
									{{-- PERSONAL INFO --}}
									<div class="row row-lg">
										<div class="col-md-12">
											<div class="example">
												<form id="form_ws" autocomplete="off">
													{{--<input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">--}}
													<div class="form-group form-material">
														<label class="form-control-label" for="site_title">Site Title</label>
														<input type="text" class="form-control" id="site_title" name="site_title" value="{{$site_title}}" placeholder="Site Title" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="site_keyword">Site Keyword</label>
														<textarea class="form-control" id="site_keyword" name="site_keyword" rows="3">{{$site_keyword}}</textarea>
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="site_description">Site Description</label>
														<textarea class="form-control" id="site_description" name="site_description" rows="3">{{$site_description}}</textarea>
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="tagline">Tagline</label>
														<textarea class="form-control" id="tagline" name="tagline" rows="3">{{$tagline}}</textarea>
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="company_name">Company Name</label>
														<input type="email" class="form-control" id="company_name" name="company_name" value="{{$company_name}}" placeholder="Company Name" autocomplete="off">
													</div>
													<div class="form-group form-material">
														<label class="form-control-label" for="company_address">Company Address</label>
														<textarea class="form-control" id="company_address" name="company_address" rows="3">{{$company_address}}</textarea>
													</div>

													<div class="form-group form-material">
														<button type="button" class="btn btn-primary waves-effect waves-classic" ng-click="save_ws()">Save</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane animation-slide-left" id="change_logo" role="tabpanel">
									{{-- CREATE FORM HERE --}}
									<div class="row row-lg">
										<div class="col-md-12">
											<div class="example">
												<form autocomplete="off">
													<div class="form-group form-material">
														<input type="file" class="dropify-event" id="input-file-max-fs" {{@$site_logo ? 'data-default-file='.UPLOAD_DIR.'uploads/'.$site_logo.'' : '' }} data-plugin="dropify" data-max-file-size="2M" data-column="avatar" file-model="avatar" ng-model="avatar" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="avatar" />
														<input id="field_avatar" class="hidden-upload-input" type="hidden" name="avatar" value="">
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

		$("#field_avatar").val('{{ $site_logo }}');

		$('.dropify-event').dropify({
			tpl: {
				clearButton:'<button type="button" data-column="avatar" id="delete_avatar" data-filename="{{ $site_logo }}" ng-click="deleteFileClick($event)"  class="dropify-clear">remove</button>',
			},
			messages: {
				'default': 'Drag and drop a image here or click',
			}
		});

		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('editController',function($scope, $http)
		{
			$scope.save_ws = function (redirect=true) {
				var formDataArray = $('#form_ws').serializeArray();
				var formData = {};
				formDataArray.forEach(function(entry) {
					formData[entry.name]=entry.value;
				});
				formData['roles']=$("#field-roles").val();
				formData['parent']=$("#field-parent").val();
				$http({
					url: rn_url+"/edit_ws",
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
