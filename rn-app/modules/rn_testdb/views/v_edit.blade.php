@extends('app')
@section('body')
    <div id="page_content" ng-controller="editController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Edit <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
                <input type="hidden" name="notification_id" value="{{ $row[$pk] }}">
                <div class="uk-grid uk-grid-medium ">
                    <div class="uk-width-xLarge-8-10 uk-width-large-7-10" >
                        <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                            <div ng-bind-html="alertMessage"></div>
                        </div>

                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content large-padding">
                                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                    <div class="uk-width-large-1">
                                                                                                                                                                                                                                                            
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-notification_type">Notification Type</label>
                                            <input class="md-input" id="field-notification_type" name="notification_type" type="text" value="{{$row["notification_type"]}}" maxlength="50" >
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-notification_user">Notification User</label>
                                            <input class="md-input" id="field-notification_user" name="notification_user" type="number" value="{{$row["notification_user"]}}" maxlength="20" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-notification_desc">Notification Desc</label>
                                            <input class="md-input" id="field-notification_desc" name="notification_desc" type="text" value="{{$row["notification_desc"]}}" maxlength="" >
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                                                <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                <div id="notification_parent_field_box">
                                    <div id="notification_parent_display_as_box"> Notification Parent : </div>
                                    <div id="notification_parent_input_box">
                                                        <span class="uk-form-file md-btn md-btn-primary">
                                                            <span>Upload a file</span>
                                                            <input type="file" data-column="notification_parent" class="gc-file-upload" ng-model="notification_parent" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="notification_parent">
                                                            <input id="field_notification_parent" class="hidden-upload-input" type="hidden" name="notification_parent" value="{{$row["notification_parent"]}}">
                                                        </span>
                                        <div id="success_notification_parent" class="upload-success-url" style="display: @if($row["notification_parent"]) block @else none @endif ;padding-top:7px;">
                                            <a href="{{base_url('assets/uploads/')}}/{{$row["notification_parent"]}}" id="file_notification_parent" class="open-file" target="_blank">{{$row["notification_parent"]}}</a>
                                            <br>
                                            <a href="javascript:void(0)" data-column="notification_parent" id="delete_notification_parent" data-filename="{{$row["notification_parent"]}}" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                <div id="notification_status_field_box">
                                    <div id="notification_status_display_as_box"> Notification Status : </div>
                                    <div id="notification_status_input_box">
                                                        <span class="uk-form-file md-btn md-btn-primary">
                                                            <span>Upload a file</span>
                                                            <input type="file" data-column="notification_status" class="gc-file-upload" ng-model="notification_status" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="notification_status">
                                                            <input id="field_notification_status" class="hidden-upload-input" type="hidden" name="notification_status" value="{{$row["notification_status"]}}">
                                                        </span>
                                        <div id="success_notification_status" class="upload-success-url" style="display: @if($row["notification_status"]) block @else none @endif ;padding-top:7px;">
                                            <a href="{{base_url('assets/uploads/')}}/{{$row["notification_status"]}}" id="file_notification_status" class="open-file" target="_blank">{{$row["notification_status"]}}</a>
                                            <br>
                                            <a href="javascript:void(0)" data-column="notification_status" id="delete_notification_status" data-filename="{{$row["notification_status"]}}" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                                                                                                                                                                                                                                                                                        
                                <div id="notification_icon_field_box">
                                    <div id="notification_icon_display_as_box"> Notification Icon : </div>
                                    <div id="notification_icon_input_box">
                                                        <span class="uk-form-file md-btn md-btn-primary">
                                                            <span>Upload a file</span>
                                                            <input type="file" data-column="notification_icon" class="gc-file-upload" ng-model="notification_icon" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="notification_icon">
                                                            <input id="field_notification_icon" class="hidden-upload-input" type="hidden" name="notification_icon" value="{{$row["notification_icon"]}}">
                                                        </span>
                                        <div id="success_notification_icon" class="upload-success-url" style="display: @if($row["notification_icon"]) block @else none @endif ;padding-top:7px;">
                                            <a href="{{base_url('assets/uploads/')}}/{{$row["notification_icon"]}}" id="file_notification_icon" class="open-file" target="_blank">{{$row["notification_icon"]}}</a>
                                            <br>
                                            <a href="javascript:void(0)" data-column="notification_icon" id="delete_notification_icon" data-filename="{{$row["notification_icon"]}}" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                                                                                                                                                                                                                        
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-notification_date">Notification Date</label>
                                    <input class="timepic" id="field-notification_date" name="notification_date" type="text" value="{{$row["notification_date"]}}" >
                                </div><br>
                                                                                                                                                                
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                                                <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div id="options-content" class="uk-width-medium-1">
                                        <button type="submit" class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySave()">Save</button>
                                        <button type="submit" class="md-btn mdn-btn-small md-btn-success save-and-go-back-button" ng-click="mySave(true)">Save & Back</button>
                                        <a href="cms/{{ $module }}" class="md-btn mdn-btn-small return-to-list">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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
        app.controller('editController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "{{$module}}";

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            
            $scope.deleteFileClick = function (event) {
                var item = event.target;
                var file_name = item.attributes['data-filename'].value;
                var field = item.attributes['data-column'].value;
                UIkit.modal.confirm('Apakah anda yakin ingin menghapus file ini?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/upload/"+file_name
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        $("#success_"+field).hide();
                        $("#field_"+field).val(response.data.file_name);
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.uploadImage = function (files,item) {
                var field = item.attributes['data-column'].value;
                if( files.length ){
                    var fd = new FormData();
                    fd.append("file", files[0]);
                    var uploadUrl = cms_url+"/upload";
                    $scope.spinner = false;
                    $http.post(uploadUrl, fd, {
                        withCredentials: true,
                        headers: {'Content-Type': undefined },
                        transformRequest: angular.identity
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        if( response.status === 200 ){
                            $("#success_"+field).show();
                            $("#file_"+field).html( response.data.file_name ).attr('href', base_url+'assets/uploads/'+response.data.file_name);
                            $("#delete_"+field).attr('data-filename', response.data.file_name);
                            $("#field_"+field).val(response.data.file_name);
                        }else{
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                }
            };

            
            $scope.mySave = function (redirect) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url+"/edit",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'alert-success';
                        $scope.alertBox = true;
                        if(redirect) window.location = cms_url;
                    }else{
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'alert-danger';
                        $scope.alertBox = true;
                    }
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            showBox();
        });

    </script>
@endsection
