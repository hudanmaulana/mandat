@extends('app')
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
			<div class="panel">
				<div class="panel-body container-fluid">
					<div class="row row-lg">
						<div class="col-md-6">
							<div class="example-wrap">
								<h4 class="example-title">Add Role</h4>
								<div class="example">
									<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
										<div class="form-group form-material">
											<label class="form-control-label">Name Modul</label>
											<div>
												<select class="form-control" name="module" data-plugin="select2">
													@foreach ($modules as $value):?>
													<option value="{{$value}}">{{format_title($value)}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="form-group form-material">
											<label class="form-control-label" for="inputBasicEmail">Alias</label>
											<input type="text" class="form-control"  name="alias" placeholder="Alias" autocomplete="off" />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label" for="inputBasicEmail">Modul Costum</label>
											<input type="text" class="form-control"  name="custom" placeholder="costum" autocomplete="off" />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label" for="inputBasicPassword">Role Type</label>
											<ul class="list-unstyled example">
												<li class="mb-15">
													<input type="checkbox" class="icheckbox-primary role" id="selectall" onclick="toggle(this)"
														   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"/>
													<label for="selectall">Select All</label>
												</li>
												<li class="mb-15">
													<input type="checkbox" class="icheckbox-primary role" id="menu" name="menu"
														   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"/>
													<label for="menu">Menu</label>
												</li>
												<li class="mb-15">
													<input type="checkbox" class="icheckbox-primary role" id="add" name="add"
														   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"/>
													<label for="add">Add</label>
												</li>
												<li class="mb-15">
													<input type="checkbox" class="icheckbox-primary role" id="edit" name="edit"
														   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"/>
													<label for="edit">Edit</label>
												</li>
												<li class="mb-15">
													<input type="checkbox" class="icheckbox-primary role" id="delete" name="delete"
														   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue"/>
													<label for="delete">Delete</label>
												</li>
											</ul>
										</div>
										<div class="form-group form-material">
											<button type="button" class="btn btn-primary" ng-click="mySaveBack()">Save</button>
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
			<script type="text/javascript">
				function toggle(source) {
					checkboxes = document.getElementsByClassName('role');
					for(var i=0, n=checkboxes.length;i<n;i++) {
						checkboxes[i].checked = source.checked;
					}
				}
				var app = angular.module( '{{$module}}', ['ngSanitize']);
				app.controller('addController',function($scope, $http)
				{
					$scope.data = [];
					$scope.columns = [];
					$scope.module = '{{$module}}';
					$scope.mySave = function () {
						var formDataArray = $('#form').serializeArray();
						var formData = {};
						formDataArray.forEach(function(entry) {
							formData[entry.name]=entry.value;
						});
						$http({
							url: rn_url+"/add",
							method: "POST",
							headers: {'Content-Type': 'application/x-www-form-urlencoded'},
							data: formData
						}).then(function successCallback(response) {
							var result = response.data;
							if( result.status ){
								alertify.success(result.message);
								$(".upload-success-url").hide();
								document.getElementById("form").reset();
							}else{
								alertify.error(result.message);
							}
						}, function errorCallback(response) {
							console.log('error : '+ JSON.stringify(response));
							alertify.alert('Oops error, please refresh this page');
						});
					};
					$scope.mySaveBack = function () {
						var formDataArray = $('#form').serializeArray();
						var formData = {};
						formDataArray.forEach(function(entry) {
							formData[entry.name]=entry.value;
						});

						$http({
							url: rn_url+"/add",
							method: "POST",
							headers: {'Content-Type': 'application/x-www-form-urlencoded'},
							data: formData
						}).then(function successCallback(response) {

							var result = response.data;
							if( result.status ){
								window.location = rn_url;
							}else{
								alertify.error(result.message);
							}
						}, function errorCallback(response) {
							$scope.spinner = true;
							console.log('error : '+ JSON.stringify(response));
							UIkit.modal.alert('Oops error, please refresh this page');
						});
					};

				});
			</script>
@endsection
