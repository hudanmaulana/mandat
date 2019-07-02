@extends('app')
@section('stylehead')
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/blueimp-file-upload/jquery.fileupload.css">
	<link rel="stylesheet" href="{{$asset}}/assets/vendor/dropify/dropify.css">

@endsection
@section('body')
	<div class="page" id="page_content" ng-controller="editController">
		<div class="page-header">
			<h1 class="page-title">Form {{ $title }} {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn/{{$module}}">{{$subject}}</a></li>
				<li class="breadcrumb-item active">{{$module}}</li>
			</ol>
		</div>
		<div class="page-content">
			<div class="panel">
				<div class="panel-body container-fluid">
					<div class="row row-lg">
						<div class="col-md-12">
							<div class="example-wrap">
								<div class="example">
									<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
{{--										<input type="hidden" name="id" value="{{ $id }}">--}}
										<div class="form-group form-material">
											<label class="form-control-label">No Sertifikat</label>
											<input type="text" class="form-control" value="{{ $no_sertifikat }}"  name="no_sertifikat" placeholder="nomor sertifikat" autocomplete="off" required />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label"> Sertifikat</label>
											<input type="file" class="dropify-event" id="input-file-max-fs" data-plugin="dropify" data-max-file-size="2M" data-column="field_1" file-model="field_1" ng-model="field_1" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="field_1" />
											<input id="field_field_1" class="hidden-upload-input" type="hidden" name="field_1" value="">
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">Bukti bayar</label>
											<input type="file" class="dropify-event2" id="input-file-max-fs" data-plugin="dropify" data-max-file-size="2M" data-column="field_2" file-model="field_2" ng-model="field_2" onchange="angular.element(this).scope().uploadImage2(this.files,this)" name="field_2" />
											<input id="field_field_2" class="hidden-upload-input" type="hidden" name="field_2" value="">
										</div>
										
										<div class="form-group form-material">
											<label class="form-control-label">Bill ID</label>
											<input type="text" class="form-control" value="{{ $billid }}"  name="billid" placeholder="bill id" autocomplete="off" required />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">Jasa</label>
											<input type="text" class="form-control" value="{{ $jasa }}"  name="jasa" placeholder="jasa" autocomplete="off" required />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">PNBP</label>
											<input type="text" class="form-control" value="{{ $pnbp }}"  name="pnbp" placeholder="pnbp" autocomplete="off" required />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">Total Biaya</label>
											<input type="text" class="form-control" value="{{ $tot_biaya }}"  name="tot_biaya" placeholder="total biaya" autocomplete="off" required />
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
@endsection
@section('script')
	<script src="{{$asset}}/assets/vendor/dropify/dropify.min.js"></script>
	<script src="{{$asset}}/assets/js/Plugin/dropify.js"></script>
	<script type="text/javascript">
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('editController',function($scope, $http)
		{
			$scope.data = [];
			$scope.columns = [];
			$scope.module = '{{$module}}';
			$('.dropify-event2').dropify({
				tpl: {
					clearButton:     '<button type="button" data-column="field_2" id="delete_field_2" data-filename="" ng-click="deleteFileClick2($event)"  class="dropify-clear">remove</button>',
				},
				messages: {
					'default': 'Drag and drop a file pdf here or click',
				}
			});
			$('.dropify-event').dropify({
				tpl: {
					clearButton:     '<button type="button" data-column="field_1" id="delete_field_1" data-filename="" ng-click="deleteFileClick($event)"  class="dropify-clear">remove</button>',
				},
				messages: {
					'default': 'Drag and drop a file pdf here or click',
				}
			});

			$scope.uploadImage2 = function (files,item) {
				$scope.spinner = false;
				var field = item.attributes['data-column'].value;
				if( files.length ){
					var fd = new FormData();
					fd.append("file", files[0]);
					var uploadUrl = rn_url+"/upload2";

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
							alertify.success('sukses upload file');
						}else{
							alertify.error(result.message);
						}
					}, function errorCallback(response) {

						console.log(response);
					});
				}
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
						if( result.status ){
							$("#delete_"+field).attr('data-filename', result.message.file_name);
							$("#field_"+field).val(result.message.file_name);
							alertify.success('sukses upload file');
						}else{
							alertify.error(result.message);
						}
					}, function errorCallback(response) {

						console.log(response);
					});
				}
			};

			$scope.deleteFileClick2 = function (event) {
				var item = event.target;
				var file_name = item.attributes['data-filename'].value;
				$http({
					method: 'GET',
					url: rn_url+"/upload/"+file_name
				}).then(function successCallback(response) {
					var result = response.data;
					if( result.status ){
						alertify.success('sukses hapus file');
					}else{
						alertify.error(result.message);
					}
				}, function errorCallback(response) {
					console.log(response);
				});
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
						alertify.success('sukses hapus file');
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
				formData['roles']=$("#field-roles").val();
				formData['groups_parent']=$("#field-parent").val();
				$http({
					url: rn_url+"/{{ $action }}",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;
					if( result.status === 'success'){
						toastr.success(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'error'){
						toastr.error(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'info'){
						toastr.info(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'warning'){
						toastr.warning(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}
					else {
						$.each(result.message,  function(key, val) {
							toastr.error(val);
						});
					}
				}, function errorCallback(response) {
					console.log(response);
					toastr.alert('Oops error, please refresh this page');
				});
			};
		});
	</script>
@endsection
