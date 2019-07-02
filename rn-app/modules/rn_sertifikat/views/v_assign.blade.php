@extends('app')
@section('body')
	<div class="page"  id="page_content" ng-controller="addController">
		<div class="page-header">
			<h1 class="page-title">Form Assign {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn/{{$module}}">{{$subject}}</a></li>
				<li class="breadcrumb-item active">Assign {{$module}}</li>
			</ol>
		</div>
		<div class="page-content">
			<div class="panel">
				<div class="panel-body container-fluid">
					<div class="row row-lg">
						<div class="col-md-6">
							<div class="example-wrap">
								<h4 class="example-title">Assign User To Group {{$row['name']}}</h4>
								<div class="example">
									<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
										<input type="hidden" name="id" value="{{ $row[$pk] }}">
										<div class="form-group form-material">
											<label class="form-control-label">Name User</label>
											<div>
												<select style="width: 100%" id="field-user" class="form-control" data-md-select2 data-allow-clear="true" data-placeholder="User..."></select>
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
		$('#field-user').select2({
			ajax: {
				url: '{{base_url("rn/$module/users")}}',
				processResults: function (data) {
					return {
						results: data
					};
				}
			}
		});
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('addController',function($scope, $http)
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
				formData['user']=$("#field-user").val();
				$http({
					url: rn_url+"/assign",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;
					if( result.status ){
						alertify.success(result.message);
						document.getElementById("form").reset();
						if(redirect) window.location = rn_url;
					}else{
						alertify.error(result.message);
					}
				}, function errorCallback(response) {
					console.log('error : '+ JSON.stringify(response));
					alertify.alert('Oops error, please refresh this page');
				});
			};
		});
	</script>
@endsection
