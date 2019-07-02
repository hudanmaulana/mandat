@extends('app')
@section('stylehead')
	<style>
		.splashcatopen {
			width: 2px;
			margin-left: 10px;
			border-left: #3f51b5 solid 1px;
		}
		.splashcat {
			width: 15px;
			padding-right: 20px;
			margin-left: -4px;
			border-bottom: #3f51b5 solid 1px;
		}
		.splashmargin {
			width: 15px;
			margin-left: 10px;
			padding-right: 10px;
		}
		a {
			text-decoration: none !important;
		}
	</style>
@endsection
@section('body')
	<div class="page" id="page_content" ng-controller="listController">
		<div class="page-header">
			<h1 class="page-title">Data {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item active">{{$subject}}</li>
			</ol>
			<div class="page-header-actions">
				<a class="btn btn-info btn-icon waves-effect waves-classic" href="{{ base_url("rn/$module/add") }}">
					<i class="icon md-plus" aria-hidden="true"></i>
					<span class="hidden-sm-down">Add data </span>
				</a>
			</div>
		</div>
		<div class="page-content">
			<!-- Panel Basic -->
			<div class="panel">
				<div class="panel-body bootstrap-table">
					<div class="fixed-table-toolbar">
						<form autocomplete="off" accept-charset="utf-8">
						<div class="pull-right search">
							<input class="form-control input-icon" ng-model="q" type="text" placeholder="Search" ng-keyup="searchClick()">
						</div>
						</form>
					</div>
					<table class="table table-hover dataTable table-striped w-full" >
						<thead>
						<tr>
							<th>No. Kontrak</th>
							<th>Status</th>
							<th>Nama</th>
							<th>Cabang</th>
							<th>Nilai Penjamin</th>
							<th>Nilai Benda Fidusia</th>
							<th>Merk Kendaraan</th>
							<th>Tipe Kendaraan</th>
							<th>No Rangka</th>
							<th>No Mesin</th>
							<th width="20%">Action</th>
						</tr>
						</thead>
						<tbody>
						<tr ng-repeat="t in data">

							<td><b><span ng-bind-html="t.splashcat">&nbsp;</span><a  href='{{ base_url("rn/$module/edit") }}/@{{t.no_kontrak}} '> @{{t.no_kontrak}} </b></a>	 </td>
							<td><small ng-if="t.status=='reject'"><span class="badge badge-danger"> @{{t.status}}</span></small>
							<small ng-if="t.status=='terupload'"><span class="badge badge-info"> @{{t.status}}</span></small>
							<small ng-if="t.status=='terkirim'"><span class="badge badge-info"> @{{t.status}}</span></small>
							<small ng-if="t.status=='diterima'"><span class="badge badge-info"> @{{t.status}}</span></small>
							<small ng-if="t.status=='proses_fidusia'"><span class="badge badge-info"> @{{t.status}}</span></small>
							<small ng-if="t.status=='terdaftar'"><span class="badge badge-info"> @{{t.status}}</span></small>

							</td>
							<td>@{{t.nama_pemberi}}</td>
							<td>@{{t.kab_pemberi}}</td>
							<td>@{{t.nilai_penjamin}}</td>
							<td>@{{t.nilai_objek}}</td>
							<td>@{{t.merk_objek}}</td>
							<td>@{{t.tipe_objek}}</td>
							<td>@{{t.no_rangka}}</td>
							<td>@{{t.no_mesin}}</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn btn-icon btn-primary dropdown-toggle" data-toggle="dropdown"
											aria-expanded="false" aria-hidden="true">
										<i class="icon md-settings" aria-hidden="true"></i>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/edit") }}/@{{t.no_kontrak}}" role="menuitem">
											<i class="icon md-edit" aria-hidden="true"></i> Edit
										</a>
										<a class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/priview") }}/@{{t.no_kontrak}}" role="menuitem">
											<i class="icon md-search" aria-hidden="true"></i> Priview
										</a>
										<a class="dropdown-item" style="text-decoration: none !important;" href="" role="menuitem" ng-click="hapus(t.no_kontrak)">
											<i class="icon md-delete" aria-hidden="true"></i> Delete
										</a>
									</div>
								</div>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- End Panel Basic -->
		</div>
	</div>
	<!-- End Page -->
@endsection
@section('script')
	<script type="text/javascript">
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('listController',function($scope, $http)
		{
			$scope.data = [];
			$scope.columns = [];
			$scope.is_search = false;
			$scope.selected = [];
			$scope.readData = function() {
				var query = '';
				if($scope.is_search){
					query += '&q='+$scope.q;
				}
				$http({
					method: 'GET',
					url: rn_url+"/get?"+query
				}).then(function successCallback(response) {
					$scope.data = response.data.message;
					$scope.updateRowData();
				}, function errorCallback(response) {
					console(JSON.parse(response));
					Alertify.alert('Oops error, please refresh this page');
				});
			};
			$scope.searchClick = function () {
				$scope.is_search = true;
				$scope.readData();
			};

			$scope.updateRowData = function() {
				// var query = '';
				// if($scope.is_search){
				// 	query += '&q='+$scope.q;
				// }
				// $http({
				// 	method: 'GET',
				// 	url: rn_url+"/rows?"+query
				// }).then(function successCallback(response) {
				// 	$scope.totalRows = response.data.message;
				// 	$scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
				// }, function errorCallback(response) {
				// 	Alertify.alert('error '+JSON.parse(response));
				// });
			};
			$scope.hapus = function(id_to_delete) {
				alertify.confirm('Apakah Anda ingin menghapus data?', function(){
					$http({
						method: 'GET',
						url: rn_url+"/delete/"+id_to_delete
					}).then(function successCallback(response) {
						var result = response.data;
						if( result.status ){
							toastr.success(result.message);
							$scope.readData();
						}else{
							toastr.error(result.message);
						}
					}, function errorCallback(response) {
						console.log(JSON.parse(response));
						toastr.alert('Oops error, please refresh this page');
					});
				});
			};
			$scope.readData();
		});
	</script>
@endsection
