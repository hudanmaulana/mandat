@extends('app')
@section('css')
    <style type="text/css">
        .table a{
            text-decoration:underline;
        }
    </style>
@endsection
@section('stylehead')
    <link rel="stylesheet" href="{{$asset}}/assets/examples/css/uikit/dropdowns.css">
@endsection
@section('body')
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">DataTables</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tables</a></li>
                <li class="breadcrumb-item active">DataTables</li>
            </ol>
            <div class="page-header-actions">
                <a class="btn btn-sm btn-primary btn-round waves-effect waves-classic" href="http://datatables.net" target="_blank">
                    <i class="icon md-link" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Official Website</span>
                </a>
            </div>
        </div>

        <div class="page-content">
            <!-- Panel Table Add Row -->
            <div class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Add Row</h3>
                </header>
                <div class="panel-body">
                    <div id="exampleAddRow_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover table-striped dataTable no-footer" cellspacing="0" id="exampleAddRow" role="grid" aria-describedby="exampleAddRow_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="exampleAddRow" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 50px;">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="exampleAddRow" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 299px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="exampleAddRow" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 276px;">Gender</th>
                                        <th class="sorting" tabindex="0" aria-controls="exampleAddRow" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 276px;">Email</th>
                                        <th class="sorting_disabled text-center" rowspan="1" colspan="1" aria-label="Actions" style="width: 50px;"><i class="icon md-menu" aria-hidden="true"></i></th></tr>
                                    </thead>
                                    <tbody>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">1</td>
                                        <td>Firefox 1.0</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false" aria-hidden="true">
                                                    <i class="icon md-settings" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/assign") }}/@{{t.id}}" role="menuitem">
                                                        <i class="icon md-assignment-check" aria-hidden="true"></i> Asigment
                                                    </a>
                                                    <a ng-if="t.name!='admin'" class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/edit") }}/@{{t.id}}" role="menuitem">
                                                        <i class="icon md-edit" aria-hidden="true"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1">2</td>
                                        <td>Firefox 1.0</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td>Win 98+ / OSX.2+</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-icon btn-info dropdown-toggle" data-toggle="dropdown"
                                                        aria-expanded="false" aria-hidden="true">
                                                    <i class="icon md-settings" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/assign") }}/@{{t.id}}" role="menuitem">
                                                        <i class="icon md-assignment-check" aria-hidden="true"></i> Asigment
                                                    </a>
                                                    <a ng-if="t.name!='admin'" class="dropdown-item" style="text-decoration: none !important;" href="{{ base_url("rn/$module/edit") }}/@{{t.id}}" role="menuitem">
                                                        <i class="icon md-edit" aria-hidden="true"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel Table Add Row -->
        </div>
    </div>

    <div class="site-action" data-plugin="actionBtn">
        <button onclick="window.location = '{{$action}}'" type="button" data-action="add" class="site-action-toggle btn-raised btn btn-success btn-floating">
            <i class="front-icon md-plus animation-scale-up" aria-hidden="true"></i>
            <i class="back-icon md-close animation-scale-up" aria-hidden="true"></i>
        </button>
    </div>

@endsection
@section('script')
    {{--JS PAGE--}}

    <script src="{{$asset}}/assets/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>

    {{--END JS PAGE--}}

    <script type="text/javascript">

        $('body').addClass('site-menubar-hide');

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
