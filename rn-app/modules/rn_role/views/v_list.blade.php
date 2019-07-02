@extends('app')
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
					<span class="hidden-sm-down">Add Role</span>
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
					<table class="table table-hover dataTable table-striped w-full">
						<thead>
						<tr>
							<th>Module</th>
							<th>Menu</th>
							<th>Add</th>
							<th>Edit</th>
							<th>Delete</th>
							<th width="20%">Action</th>
						</tr>
						</thead>
						<tbody>
						<tr ng-repeat="t in data">
							<td>@{{t.alias}}</td>
							<td ng-if="t.menu==true"><button type="button" class="btn btn-sm btn-icon btn-success btn-round waves-effect waves-classic">
									<i class="icon md-check" aria-hidden="true"></i>
								</button></td>
							<td ng-if="t.menu==false"><button type="button" class="btn btn-sm btn-icon btn-danger btn-round waves-effect waves-classic">
									<i class="icon md-close" aria-hidden="true"></i>
								</button></td>
							<td ng-if="t.add==true"><button type="button" class="btn btn-sm btn-icon btn-success btn-round waves-effect waves-classic">
									<i class="icon md-check" aria-hidden="true"></td>
							<td ng-if="t.add==false"><button type="button" class="btn btn-sm btn-icon btn-danger btn-round waves-effect waves-classic">
									<i class="icon md-close" aria-hidden="true"></i>
								</button></td>
							<td ng-if="t.edit==true"><button type="button" class="btn btn-sm btn-icon btn-success btn-round waves-effect waves-classic">
									<i class="icon md-check" aria-hidden="true"></td>
							<td ng-if="t.edit==false"><button type="button" class="btn btn-sm btn-icon btn-danger btn-round waves-effect waves-classic">
									<i class="icon md-close" aria-hidden="true"></i>
								</button></td>
							<td ng-if="t.delete==true"><button type="button" class="btn btn-sm btn-icon btn-success btn-round waves-effect waves-classic">
									<i class="icon md-check" aria-hidden="true"></td>
							<td ng-if="t.delete==false"><button type="button" class="btn btn-sm btn-icon btn-danger btn-round waves-effect waves-classic">
									<i class="icon md-close" aria-hidden="true"></i>
								</button></td>
							<td><button ng-click="deleteClick(t.value)" type="button" class="btn btn-danger"><i class="icon md-delete" aria-hidden="true"></i></button></td>
						</tr>
						</tbody>
					</table>
					<div class="fixed-table-pagination" style="">
						<div class="pull-left pagination-detail">
							<span class="pagination-info">Showing @{{pageStart}} to @{{maxPage}} of  @{{ totalRows | number }} rows</span>
							<span class="page-list"><span class="btn-group dropup">
									<select class="form-control" ng-change="changedPerPage()" data-ng-options="o.name for o in optionPerPage" data-ng-model="selectedOptionPerPage"></select>
							</span> rows per page</span>
						</div>
						<div class="pull-right pagination">
							<ul class="pagination">
								<li class="page-number" ng-click="startPageClick()" style="float: left;"><a href="" >« First</a></li>
								<li class="page-pre" ng-click="prevPageClick()"><a href="" >« Prev</a></li>
								<li class="page-next" ng-click="nextPageClick()"><a href="" >Next »</a></li>
								<li class="page-number" ng-click="endPageClick()" style="float: right;"><a href="" >Last »</a></li>
							</ul>
						</div>
					</div>
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
			$scope.perPage = 20;
			$scope.totalRows = 0;
			$scope.pageStart = 1;
			$scope.pageEnd = 0;
			$scope.data = [];
			$scope.columns = [];
			$scope.maxPage = 0;
			$scope.is_search = false;
			$scope.selected = [];
			$scope.readData = function(page) {
				var query = '?limit='+$scope.perPage;
				if(page)query += '&page='+page;
				if($scope.is_search){
					query += '&q='+$scope.q;
				}
				$http({
					method: 'GET',
					url: rn_url+"/get?"+query
				}).then(function successCallback(response) {
					$scope.data = response.data.message;
					$scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
					$scope.updateRowData();

				}, function errorCallback(response) {
					console(JSON.parse(response));
					Alertify.alert('Oops error, please refresh this page');
				});
			};
			$scope.updateRowData = function() {
				var query = '';
				if($scope.is_search){
					query += '&q='+$scope.q;
				}
				$http({
					method: 'GET',
					url: rn_url+"/rows?"+query
				}).then(function successCallback(response) {

					$scope.totalRows = response.data.message;
					$scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
				}, function errorCallback(response) {

					Alertify.alert('error '+JSON.parse(response));
				});
			};
			$scope.optionPerPage = [
				{
					'name':'20',
					'value': 20
				},{
					'name':'25',
					'value': 25
				},{
					'name':'50',
					'value': 50
				},{
					'name':'100',
					'value': 100
				}
			];
			$scope.selectedOptionPerPage = $scope.optionPerPage[0];
			$scope.searchClick = function () {
				$scope.is_search = true;
				$scope.pageStart = 1;
				$scope.readData($scope.pageStart);
			};
			$scope.changedPerPage = function() {
				$scope.perPage = $scope.selectedOptionPerPage.value;
				$scope.readData($scope.pageStart);
			};
			$scope.deleteClick = function(id_to_delete) {
				alertify.confirm('Apakah Anda ingin menghapus data?', function(){

					$http({
						method: 'GET',
						url: rn_url+"/delete/"+id_to_delete
					}).then(function successCallback(response) {

						var result = response.data;
						if( result.status ){
							alertify.success(result.message);
							$scope.readData();
						}else{
							alertify.error(result.message);
						}
					}, function errorCallback(response) {
						console.log(JSON.parse(response));
						Alertify.alert('Oops error, please refresh this page');
					});
				});
			};
			$scope.nextPageClick = function () {
				var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
				if($scope.pageStart < maxPage){
					$scope.pageStart +=1;
					$scope.readData($scope.pageStart);
				}
			};
			$scope.prevPageClick = function () {
				if( $scope.pageStart > 1 ){
					$scope.pageStart -=1;
					$scope.readData($scope.pageStart);
				}
			};
			$scope.startPageClick = function () {
				$scope.pageStart = 1;
				$scope.readData($scope.pageStart);
			};
			$scope.endPageClick = function () {
				$scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
				$scope.readData($scope.pageStart);
			};
			$scope.readData();
		});
	</script>
@endsection
