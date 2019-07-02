@extends('app')
@section('stylehead')
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/pages/profile.css">
	<link rel="stylesheet" href="{{$asset}}/assets/examples/css/apps/message.css">
	<style>
		.datepicker table tr td.active:active,
		.datepicker table tr td.active.highlighted:active,
		.datepicker table tr td.active.active,
		.datepicker table tr td.active.highlighted.active {
			background-color: #3f51b5 !important;
			border-color: #3f51b5 !important;;
			box-shadow: none  !important;
			border-radius: 0 !important;
			color: #fff !important;
		}
		.color-whites{
			color: #757575!important;
		}

		.project-team-items {
			/* padding: 0; */
			/* margin-bottom: 0; */
			list-style: none;
		}

		.project-team-items .team-item {
			float: left;
		}

		.project-team-items .item-divider {
			width: 30px;
			line-height: 42px;
			text-align: center;
		}

		.badge-urgent {
			color: #fff;
			background-color: #e53935;
		}
		.badge-high {
			color: #fff;
			background-color: #fb8c00;
		}
		.badge-normal {
			color: #fff;
			background-color: #dcdfe3;
		}
	</style>
@endsection
@section('body')
	<div class="page" id="page_content" ng-controller="listController" >
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
							<a href="{{$url}}/edit" class="btn btn-primary waves-effect waves-classic">Edit</a>
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
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Task List</h3>
						</div>
						<div class="panel-body bootstrap-table">
							<div class="fixed-table-toolbar mb-20">
								<div class="row mb-10">
									<div class="col-md-6 border-btm">
										<div class="pull-left">
											<div class="keep-open btn-group mt-10">
												<button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapsefilter" aria-expanded="false" aria-controls="collapsefilter">
													Filter
												</button>
											</div>
										</div>

									</div>
									<div class="col-md-6 border-btm">
										<div class="pull-right search">
											<input class="form-control input-icon" ng-model="q" type="text" placeholder="Search" ng-keyup="searchClick()">
										</div>
									</div>

								</div>

								<div class="collapse" id="collapsefilter">
									<div class="row mb-10">
										<div class="col-md-3">
											<div class="form-group">
												<label for="filter-status">Status</label>
												<select id="filter-status" class="form-control">
													<option disabled="" selected="" value="">Status</option>
													<option value="completed">Completed</option>
													<option value="uncompleted">Uncompleted</option>
													<option value="waiting">Waiting</option>
												</select>

											</div>

											</div>
										<div class="col-md-3"><div class="form-group">
												<label for="filter-priority">Priority</label>
												<select id="filter-priority" class="form-control">
													<option disabled="" selected="" value="">Priority</option>
													<option value="normal">Normal</option>
													<option value="high">High</option>
													<option value="urgent">Urgent</option>
												</select>

											</div></div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="filter-user">Filter User</label>
												<select id="filter-user" class="form-control">
													<option disabled="" selected="" value="">Filter User</option>
													@foreach( $user_filter as $item )
														<option value="{{$item['id']}}">{{$item['display_name']}}</option>
													@endforeach
												</select>
											</div>

										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="filter-user">Filter Date</label>
												<input type="text" class="form-control date" id="filter-date" placeholder="multiple dates">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<button ng-click="readData()" type="button" class="btn btn-sm btn-primary">Apply</button>
												<a href="{{ base_url("rn/$module") }}" class="color-whites btn btn-sm btn-default">Reset</a>

											</div>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-hover dataTable table-striped w-full" >
								<thead>
								<tr>
									<td></td>
									<td >Task From</td>
									<td>Date</td>
									<td>Title</td>
									<td width="20%">Status</td>
									<td width="10%">Action</td>
								</tr>
								</thead>
								<tbody>

								<tr ng-repeat="d in data">
									<td>
										<span ng-if="d.status=='completed'" class="badge badge-pill badge-success"><i class="fas fa-check"></i></span>
										<span ng-if="d.status=='uncompleted'" class="badge badge-pill badge-danger"><i class="fa fa-2x fa-close"></i></span>
										<span ng-if="d.status=='waiting'" class="badge badge-pill badge-warning"><i class="fa fa-clock"></i></i></span>


									 </td>
									<td>@{{ d.display_name }}</td>
									<td>@{{ d.duedate }}</td>
									<td>@{{ d.title }}</td>
									<td>
										<span ng-if="d.priority=='urgent'" class="badge badge-urgent">Urgent</span>
										<span ng-if="d.priority=='normal'" class="badge badge-normal">Normal</span>
										<span ng-if="d.priority=='high'" class="badge badge-high">High</span>
									</td>
									<td>
										<button ng-click="readDetails(d.id)" type="button" class="btn btn-icon btn-primary" data-target="#exampleModalSuccess" data-toggle="modal">
											<i class="icon md-comment" aria-hidden="true"></i>
										</button>
									</td>
								</tr>
								</tbody>
							</table>
							<div class="fixed-table-pagination" style="">
								<div class="pull-left pagination-detail">
									<span class="pagination-info">Showing @{{pageStart}} to @{{maxPage}} of  @{{ totalRows | number }} rows</span>
									<span class="page-list"><span class="btn-group dropup">
									<select class="form-control" ng-change="changedPerPage()" data-ng-options="o.name for o in optionPerPage" data-ng-model="selectedOptionPerPage"></select></span> rows per page</span>
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
			<div class="modal fade modal-success" id="exampleModalSuccess" aria-hidden="true"
				 aria-labelledby="exampleModalSuccess" role="dialog" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 style="order:0!important;" class="modal-title">Work Report</h4>
							<br/>
							<ul class="project-team-items clearfix">

								<li class="team-item" ng-repeat="x in details.users">
									<a href="#" class="avatar avatar-sm my-5">
										<img onerror="this.src='{{$images}}'" class="avatar" ng-src="{{$imagesfill}}/@{{ x.img }}" >
									</a>
								</li>


							</ul>
						</div>
						<div class="modal-body app-message">


							<div style="height: 500px!important;" class="app-message-chats">
								<button type="button" id="historyBtn" class="btn btn-round btn-default btn-flat primary-500">History Messages</button>
								<div class="chats">
									<div class="chat" ng-repeat="xd in details.chat">
										<div ng-class="xd.id_user==14 ? 'chat-left' : ''">
										<div class="chat-avatar">
											<a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="">
												<img onerror="this.src='{{$images}}'" class="avatar" ng-src="{{$imagesfill}}/@{{ xd.img }}" >
											</a>
										</div>
										<div class="chat-body">
											<div class="chat-content">
												<p>
													@{{ xd.message }}
												</p>
											</div>
										</div>
										</div>
									</div>




									<p class="time">27 April 2019</p>
									<div class="chat chat-left">
										<div class="chat-avatar">
											<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="">
												<img src="{{$asset}}/assets/portraits/5.jpg" alt="Edward Fletcher">
											</a>
										</div>
										<div class="chat-body">
											<div class="chat-content">
												<p>You wait for notice.</p>
											</div>
											<div>
												<div class="chat-content">
													<p>Consectetuorem ipsum dolor sit<smal style="font-size:11px;margin-left:10px;font-style: italic"><span>8.15</span></smal></p>

												</div>

											</div>

											<div class="chat-content">
												<p>OK?</p>

											</div>
										</div>
									</div>

								</div>

							</div>
							<form class="app-message-input">
								<div class="input-group form-material">

									<input class="form-control" type="text" placeholder="Type message here ...">
									<span class="input-group-btn">
              <button type="button" class="btn btn-pure btn-default icon md-mail-send"></button>
            </span>
								</div>
							</form>
							{{--<div class="panel">--}}
								{{--<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">--}}
									{{--<div  class="form-group form-material" data-plugin="formMaterial">--}}
										{{--<input type="hidden" id="idmem" name="id" value="@{{ details.id }}">--}}
										{{--<label class="form-control-label" for="textarea"></label>--}}
										{{--<textarea ng-if="details.description==''" class="form-control" id="description" name="description" rows="3" placeholder="write comment at here"></textarea>--}}
										{{--<textarea ng-if="details.description!=''" class="form-control" id="description" name="description" rows="3" placeholder="write comment at here">@{{ details.description }}</textarea>--}}
									{{--</div>--}}
								{{--</form>--}}
							{{--</div>--}}
						</div>
						<div class="modal-footer">
							{{--<button ng-if="details.description==''" type="button" ng-click="mySave()" class="btn btn-primary">Submit</button>--}}
							{{--<button ng-if="details.description!=''" type="button" ng-click="mySave()" class="btn btn-primary">Update</button>--}}
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

@endsection
@section('script')
	{{--JS PAGE--}}

	{{--END JS PAGE--}}
	<script src="{{$asset}}/assets/vendor/autosize/autosize.js"></script>
	<script type="text/javascript">
		$('.date').datepicker({
			multidate: true,
			format: 'yyyy-mm-dd',
			orientation: "bottom",
		});

		$('body').addClass('page-profile');
		$(".app-message-chats").animate({ scrollTop: $(document).height() }, "fast");

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
			$scope.filter = {};
			$scope.readData = function() {
				$scope.filter.priority 				= $("#filter-priority").val();
				$scope.filter.user                  = $("#filter-user").val();
				$scope.filter.status                = $("#filter-status").val();
				$scope.filter.date                  = $("#filter-date").val();
				$scope.filter.limit                 = $scope.perPage;
				$scope.filter.page                  = $scope.pageStart;
				var params = $.param( $scope.filter );
				if($scope.is_search){
					params += '&q='+$scope.q;
				}
				$http({
					method: 'GET',
					url: rn_url+"/get?"+params
				}).then(function successCallback(response) {
					$scope.data = response.data.message;

					$scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
					$scope.updateRowData();
				}, function errorCallback(response) {
					Alertify.modal.alert('error '+JSON.parse(response));
				});
			};
			$scope.updateRowData = function() {
				$scope.filter.priority 				= $("#filter-priority").val();
				$scope.filter.user                  = $("#filter-user").val();
				$scope.filter.status                = $("#filter-status").val();
				$scope.filter.date                  = $("#filter-date").val();
				var params = $.param( $scope.filter );
				if($scope.is_search){
					params += '&q='+$scope.q;
				}
				$http({
					method: 'GET',
					url: rn_url+"/rows?"+params
				}).then(function successCallback(response) {
					$scope.totalRows = response.data.message;
					$scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
				}, function errorCallback(response) {
					Alertify.modal.alert('error '+JSON.parse(response));
				});
			};
			$scope.details = [];
			$scope.readDetails = function (id) {
				$http({
					method: 'GET',
					url: rn_url+"/getdetails?id="+id
				}).then(function successCallback(response) {
					$scope.details = response.data;
					console.log($scope.details);
				}, function errorCallback(response) {
					Alertify.modal.alert('error '+JSON.parse(response));
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
				},
				{
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
				$scope.readData();
			};
			$scope.changedPerPage = function() {
				$scope.perPage = $scope.selectedOptionPerPage.value;
				$scope.readData();
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
			$scope.mySave = function (redirect=false) {

				var formDataArray = $('#form').serializeArray();
				var formData = {};
				formDataArray.forEach(function(entry) {
					formData[entry.name]=entry.value;
				});
				$http({
					url: rn_url+"/updatereport",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;
					if( result.status ){
						$scope.readData();
						alertify.success(result.message);
						if(redirect) window.location = rn_url;
					}else{
						alertify.error(result.message);
					}
				}, function errorCallback(response) {
					console.log('error : '+ JSON.stringify(response));
					alertify.alert('Oops error, please refresh this page');
				});
			};

			$scope.nextPageClick = function () {
				var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
				if($scope.pageStart < maxPage){
					$scope.pageStart +=1;
					$scope.readData();
				}
			};
			$scope.prevPageClick = function () {
				if( $scope.pageStart > 1 ){
					$scope.pageStart -=1;
					$scope.readData();
				}
			};
			$scope.startPageClick = function () {
				$scope.pageStart = 1;
				$scope.readData();
			};
			$scope.endPageClick = function () {
				$scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
				$scope.readData();
			};
			$scope.readData();
		});
	</script>
@endsection
