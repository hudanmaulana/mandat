
@extends('app')

@section('body')
    <div id="page_content" ng-controller="addController">
		<div class="page-header">
			<h1 class="page-title">Data {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item active">{{$subject}}</li>
			</ol>

		</div>

		<div class="page-content">

			<div class="row">
				<div class="col-md-8">
					<!-- Panel form detail -->
					<div class="panel panel-bordered">
						<div class="panel-heading">
							<h3 class="panel-title">Description</h3>
						</div>
						<div class="panel-body">
							<div class="row row-lg">
								<div class="col-md-12">
									<div class="example-wrap">
										<div class="example">

												<div class="form-group form-material">
													<input  class="form-control" placeholder="Subject" id="field-subject" ng-model="form.subject" type="text" autocomplete="off">
												</div>
												<div class="form-group form-material">
													<input  class="form-control" placeholder="Module Name" id="field-module" ng-model="form.module" type="text" autocomplete="off">
												</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Panel form detail -->
					<!-- Panel form tabel -->
					<div class="panel">
						<div class="panel-body bootstrap-table">
							<table class="table table-hover dataTable table-striped w-full">
								<caption>@{{ table_name }}</caption>
								<thead>
								<tr>
									<th width="20" style="min-width: 30%">option</th>
									<th width="20">alias</th>
									<th width="10">name</th>
									<th width="10">type</th>
									<th width="10">max_length</th>
									<th width="10">default</th>
									<th width="10">primary_key</th>
								</tr>
								</thead>
								<tbody>
								<tr ng-repeat="v in tables">
									<td>
										<select ng-model="form.options[$index]" class="md-input">
											<option value="0">none</option>
											<option value="upload">upload</option>
											<option value="int">number (int)</option>
											<option value="varchar">varchar</option>
											<option value="text">text</option>
											<option value="date">date</option>
											<option value="datetime">datetime</option>
										</select>
									</td>
									<td>
										<input class="md-input" type="text" ng-init="form.alias[$index] = v.alias" ng-model="form.alias[$index]">
									</td>
									<td>@{{v.name}}</td>
									<td>@{{v.type}}</td>
									<td>@{{v.max_length}}</td>
									<td>@{{v.default}}</td>
									<td>@{{v.primary_key}}</td>
								</tr>
								</tbody>
								<tfoot>
								<tr>
									<th>option</th>
									<th>alias</th>
									<th>name</th>
									<th>type</th>
									<th>max_length</th>
									<th>default</th>
									<th>primary_key</th>
								</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<!-- end panel form tabel -->
				</div>
				<div class="col-md-4">
					<!-- Panel form tabel select -->
					<div class="panel panel-bordered">
						<div class="panel-heading">
							<h3 class="panel-title">Table Select</h3>
						</div>
						<div class="panel-body">
							<div class="row row-lg">
								<div class="col-md-12">
									<div class="example-wrap">
										<div class="example">

												<div class="form-group form-material">
													<select id="input-table" class="form-control" ng-change="changedTable()" data-ng-options="o for o in optionTable" data-ng-model="selectedTable">
													</select>
												</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Panel form tabel select -->

					<!-- Panel form tabel select -->
					<div class="panel panel-bordered">
						<div class="panel-heading">
							<h3 class="panel-title"> Action</h3>
						</div>
						<div class="panel-body">
							<div class="row row-lg">
								<div class="col-md-12">
									<div class="example-wrap">
										<div class="example">

											<div class="form-group form-material">
												<button type="button" class="btn btn-primary" ng-click="mySave()">Save</button>
												<a href="{{base_url()}}rn/{{$module}}" class="btn btn-danger">Cancel</a>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Panel form tabel select -->
				</div>
			</div>

		</div>


        <div id="page_content_inner" style="display: none;">

        </div>
    </div>
@endsection

@section('head')
    <script src="{{ base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('script')
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{$module}}', ['ngSanitize']);
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.table_name = 'Table Name';
            $scope.tables = [];
            $scope.columns = [];
            $scope.options = [];
            $scope.module = '{{$module}}';
            $scope.form = {};

            $scope.optionTable = {!! json_encode($tables) !!};
            $scope.selectedTable = $scope.optionTable[0];

            $scope.changedTable = function() {
                $scope.spinner = false;
                $scope.table_name = $scope.selectedTable;
                $http({
                    url: rn_url+'/show_table/'+$scope.table_name,
                    method: "GET"
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.tables = response.data;
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.mySave = function () {
                $scope.form.table = $scope.selectedTable;
                $scope.spinner = false;
                $http({
                    url: rn_url,
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: $scope.form
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    var result = response.data;
                    if( result.status === 1 ){
                        $scope.form = {};
                        $scope.alertMessage = result.message;
                        $scope.alertClass = 'alert-success';
                        $scope.alertBox = true;
                    }else{
                        $scope.alertMessage = result.message;
                        $scope.alertClass = 'alert-danger';
                        $scope.alertBox = true;
                        console.log(result);
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            showBox();
        });

        app.filter('underscoreless', function () {
            return function (input) {
                return input.replace(/_/g, ' ');
            };
        });

        app.filter("ucwords", function () {
            return function (input){
                if(input) { //when input is defined the apply filter
                    input = input.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                }
                return input;
            }
        })

    </script>
@endsection
