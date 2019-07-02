@extends('app')

@section('stylehead')
	<link rel="stylesheet" href="{{$asset}}/assets/css/user.css">
@endsection
@section('body')

<div class="page page-user">
	<div class="page-header">
		<h1 class="page-title">Data {{$subject}}</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
			<li class="breadcrumb-item active">{{$subject}}</li>
		</ol>
		<div class="page-header-actions">
			<a class="btn btn-info btn-icon waves-effect waves-classic" href="{{ base_url("rn/$module/add") }}">
				<i class="icon md-plus" aria-hidden="true"></i>
				<span class="hidden-sm-down">Add User</span>
			</a>
		</div>
	</div>
	<div class="page-content" id="page_content" ng-controller="listController">
		<!-- Panel -->
		<div class="panel">
			<div class="panel-body">
				<form class="page-search-form" role="search">
					<div class="input-search input-search-dark">
						<i class="input-search-icon md-search" aria-hidden="true"></i>
						<input type="text" class="form-control" ng-model="q"  placeholder="Search Users" ng-keyup="searchClick()">
					</div>
				</form>
				<div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
					{{--<div class="dropdown page-user-sortlist">--}}
						{{--Order By: <a class="dropdown-toggle inline-block" data-toggle="dropdown"--}}
									 {{--href="#" aria-expanded="false">Last Active</a>--}}
						{{--<div class="dropdown-menu animation-scale-up animation-top-right animation-duration-250"--}}
							 {{--role="menu">--}}
							{{--<a class="active dropdown-item" href="javascript:void(0)">Last Active</a>--}}
							{{--<a class="dropdown-item" href="javascript:void(0)">Username</a>--}}
							{{--<a class="dropdown-item" href="javascript:void(0)">Location</a>--}}
							{{--<a class="dropdown-item" href="javascript:void(0)">Register Date</a>--}}
						{{--</div>--}}
					{{--</div>--}}

					<ul class="nav nav-tabs nav-tabs-line" role="tablist">
						<li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#all_contacts"
																	aria-controls="all_contacts" role="tab">All Users</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane animation-fade active" id="all_contacts" role="tabpanel">
							<ul class="list-group" >
								<li ng-repeat="t in data" class="list-group-item">
									<div class="media">
										<div class="pr-0 pr-sm-20 align-self-center">
											<div  class="avatar  @{{(t.is_login==1) ? 'avatar-online' : 'avatar-away'}} ">
												<img onerror="this.src='{{$images}}'" ng-src="{{$imagesfill}}/@{{t.avatar}}" alt="...">
												<i class="avatar avatar-busy"></i>
											</div>
										</div>
										<div class="media-body col-md-9 align-self-center">
											<h5 class="mt-0 mb-5">
												@{{t.display_name}} <small ng-if="t.active==1"><span class="badge badge-success">Active</span></small>

												<small ng-if="t.active!=1"><span class="badge badge-danger">Not Active</span></small>
												<small><span title="@{{t.last_login}}" class="badge badge-primary">Last Login @{{t.last_login}}</span></small>
											</h5>
											<h5>
												<a class="text-action" href="javascript:void(0)">
													<i class="icon icon-color md-email md-" aria-hidden="true"></i>
												</a> @{{t.email}}
											</h5>
											<p>
												<i class="icon icon-color md-pin" aria-hidden="true"></i> @{{t.current_location}}
											</p>
											<div>
												<a class="text-action" href="#"  data-toggle="tooltip"
												   data-original-title="Edit">
													<i class="icon icon-color md-smartphone" aria-hidden="true" ></i>
												</a>
												<a class="text-action" href="javascript:void(0)">
													<i class="icon icon-color bd-twitter" aria-hidden="true"></i>
												</a>
												<a class="text-action" href="javascript:void(0)">
													<i class="icon icon-color bd-facebook" aria-hidden="true"></i>
												</a>
												<a class="text-action" href="javascript:void(0)">
													<i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
												</a>
											</div>
										</div>
										<div class="pl-0 pl-sm-50 mt-15 mt-sm-0 align-self-center">
											<div class="btn-group">
												<button type="button" class="btn btn-icon btn-primary dropdown-toggle" data-toggle="dropdown"
														aria-expanded="false" aria-hidden="true">
													<i class="icon md-settings" aria-hidden="true"></i>
												</button>
												<div class="dropdown-menu" role="menu">
													<a class="dropdown-item" href="{{ base_url("rn/$module/edit") }}/@{{t.id}}" role="menuitem">
														<i class="icon md-edit" aria-hidden="true"></i> Edit
													</a>
													{{--<a class="dropdown-item" href=""  ng-click="deleteClick(t.id)" role="menuitem">--}}
														{{--<i class="icon md-delete" aria-hidden="true"></i> Delete--}}
													{{--</a>--}}
												</div>
											</div>

										</div>
									</div>
								</li>
							</ul>
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
				</div>
			</div>
		</div>
		<!-- End Panel -->
	</div>
</div>
<!-- End Page -->
@endsection
@section('script')
	<script src="{{$asset}}/assets/vendor/aspaginator/jquery-asPaginator.min.js"></script>
	<script src="{{$asset}}/assets/js/Plugin/aspaginator.js"></script>
	<script src="{{$asset}}/assets/js/Plugin/responsive-tabs.js"></script>
	<script src="{{$asset}}/assets/js/Plugin/tabs.js"></script>
	<script type="text/javascript">
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('listController',function($scope, $http)
		{
			$scope.perPage = 10;
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
					console.log(JSON.parse(response));
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
					'name':'10',
					'value': 10
				},
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

