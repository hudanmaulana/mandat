@extends('app')
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
										<input type="hidden" name="id" value="{{ $id }}">
										<div class="form-group form-material">
											<label class="form-control-label">Name</label>
											<input type="text" class="form-control" value="{{ $name }}"  name="name" placeholder="name" autocomplete="off" required />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">Parent</label>
											<div>

												{!!html_entity_decode($groupsx)!!}
											</div>
										</div>
										<div class="form-group form-material">
											<label class="form-control-label" for="inputBasicEmail">Decription</label>
											<input type="text" class="form-control" value="{{ $description }}" name="description" placeholder="description" autocomplete="off" />
										</div>
										<div class="form-group form-material">
											<label class="form-control-label">Role</label>
											<div>
												<select class="form-control" multiple data-plugin="select2" id="field-roles">
													@foreach( $roles as $v )
														<option value="{{$v['setting_id']}}" @if(in_array($v['setting_id'], $selected_roles)) selected @endif>{{$v['setting_name']}}</option>
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
@endsection
@section('script')
	<script type="text/javascript">
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('editController',function($scope, $http)
		{
			$scope.data = [];
			$scope.columns = [];
			$scope.module = '{{$module}}';
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
