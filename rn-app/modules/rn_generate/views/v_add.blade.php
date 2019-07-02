<?php echo "@extends('app')".PHP_EOL ?>
<?php echo "@section('body')".PHP_EOL ?>

<div class="page" id="page_content" ng-controller="editController">
	<div class="page-header">
		<h1 class="page-title">Form {{ $title }} {{$subject}}</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo '{{ base_url() }}'?>rn/<?php echo '{{$module}}'?>">{{$subject}}</a></li>
			<li class="breadcrumb-item active">{{$module}}</li>
		</ol>
	</div>
</div>

    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/<?php echo '{{ $module }}'?>" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
            </h1> <span class="uk-text-muted uk-text-upper uk-text-small" id="product_edit_sn">You can add new data in this form</span>
        </div>
        <div id="page_content_inner" style="display: none;">
            <form id="form" action="" method="post" class="form-div uk-form-stacked" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
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
                                        @foreach ($fields as $field)
                                        @if($field->primary_key!=1)
                                        @if($field->type=='varchar' || $field->type=='char')
                                        <?php echo PHP_EOL;?>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label>
                                            <input class="md-input" id="field-{{ $field->name }}" name="{{ $field->name }}" type="text" value="" maxlength="{{ $field->max_length }}" />
                                        </div>
                                        @endif
                                        @if($field->type=='int' || $field->type=='bigint')
                                        <?php echo PHP_EOL;?>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label>
                                            <input class="md-input" id="field-{{ $field->name }}" name="{{ $field->name }}" type="number" value="" maxlength="{{ $field->max_length }}" />
                                        </div>
                                        @endif
                                        @if($field->type=='text')
                                        <?php echo PHP_EOL;?>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="{{ $field->name }}">{{ $field->alias }}</label>
                                            <textarea id="{{ $field->name }}" name="{{ $field->name }}" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['{{ $field->name }}'])delete CKEDITOR.instances['{{ $field->name }}'];
                                                CKEDITOR.replace( '{{ $field->name }}' ,{filebrowserBrowseUrl : '<?php echo "{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}"?>',filebrowserUploadUrl : '<?php echo "{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}"?>',filebrowserImageBrowseUrl : '<?php echo "{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}"?>'});
                                            </script>
                                        </div>

                                        @endif
                                        @if($field->type=='tinyint')
                                        <?php echo PHP_EOL;?>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label >
                                            <p id="field-{{ $field->name }}">
                                                <input type="radio" name="{{ $field->name }}" value="1" id="field-{{ $field->name }}-1" data-md-icheck />
                                                <label for="field-{{ $field->name }}-1" class="inline-label">Yes</label>
                                                <input type="radio" name="{{ $field->name }}" value="0" id="field-{{ $field->name }}-2" data-md-icheck />
                                                <label for="field-{{ $field->name }}-2" class="inline-label">No</label>
                                            </p>
                                        </div>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                    </div>
                    @php
                    $form_extra = false;
                    @endphp
                    @foreach ($fields as $field)
                        @if( $field->type=='date' || $field->type=='datetime' || $field->type=='enum' || $field->type=='special' || $field->type=='upload' )
                            @php
                            $form_extra = true;
                            @endphp
                        @endif
                    @endforeach


                    <div class="uk-width-xLarge-2-10 uk-width-large-3-10 uk-sortable sortable-handler" data-uk-grid-margin data-uk-sortable>
                        @if( $form_extra )
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Form Detail </h3>
                            </div>
                            <div class="md-card-content">
                                @foreach ($fields as $field)
                                @if($field->primary_key!=1)
                                @if($field->type=='date')
                                <?php echo PHP_EOL;?>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label>
                                    <input class="datepic" id="field-{{ $field->name }}" name="{{ $field->name }}" type="text" value="" maxlength="{{ $field->max_length }}" />
                                </div>
                                @endif
                                @if($field->type=='datetime')
                                <?php echo PHP_EOL;?>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label>
                                    <input class="timepic" id="field-{{ $field->name }}" name="{{ $field->name }}" type="text" value="" maxlength="{{ $field->max_length }}" />
                                </div>
                                @endif
                                @if($field->type=='enum')
                                <?php echo PHP_EOL;?>
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-{{ $field->name }}">{{ $field->alias }}</label>
                                    <select id="field-{{ $field->name }}" name="{{ $field->name }}" data-md-selectize>
                                        @foreach ($field->data as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                @endif
                                @if($field->type=='upload')
                                <?php echo PHP_EOL;?>
                                <div id="{{$field->name}}_field_box">
                                    <div id="{{$field->name}}_display_as_box"> {{$field->alias}} : </div>
                                    <div id="{{$field->name}}_input_box">
                                                    <span class="uk-form-file md-btn md-btn-primary">
                                                        <span>Upload a file</span>
                                                        <input type="file" data-column="{{$field->name}}" class="gc-file-upload" file-model="{{$field->name}}" ng-model="{{$field->name}}" onchange="angular.element(this).scope().uploadImage(this.files,this)" name="{{$field->name}}">
                                                        <input id="field_{{$field->name}}" class="hidden-upload-input" type="hidden" name="{{$field->name}}" value="">
                                                    </span>
                                        <div id="success_{{$field->name}}" class="upload-success-url" style="display:none;padding-top:7px;">
                                            <a href="" id="file_{{$field->name}}" class="open-file" target="_blank"></a>
                                            <br>
                                            <a href="javascript:void(0)" data-column="{{$field->name}}" id="delete_{{$field->name}}" data-filename="" ng-click="deleteFileClick($event)" class="md-btn md-btn-danger">delete</a>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @endif
                                @endif
                                @endforeach

                            </div>
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"><br></h3>
                            </div>
                        </div>
                        @endif
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div id="options-content" class="uk-width-medium-1">
                                        <button type="submit" class="md-btn md-btn-primary mdn-btn-small submit-form" ng-click="mySave()">Save</button>
                                        <button type="submit" class="md-btn mdn-btn-small md-btn-success save-and-go-back-button" ng-click="mySave(true)">Save & Back</button>
                                        <a href="cms/<?php echo '{{ $module }}'?>" class="md-btn mdn-btn-small return-to-list">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php echo '@endsection'.PHP_EOL ?>
<?php echo "@section('head')".PHP_EOL ?>
    <script src="<?php echo "{{ base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js') }}"?>"></script>
<?php echo "@endsection".PHP_EOL ?>
<?php echo "@section('script')".PHP_EOL?>
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '<?php echo '{{$module}}'?>', ['ngSanitize']);
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "<?php echo '{{$module}}'?>";

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            @if($upload_exist)

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

            @endif

            $scope.mySave = function (redirect) {
                var formDataArray = $('#form').serializeArray();
                var formData = {};
                formDataArray.forEach(function(entry) {
                    formData[entry.name]=entry.value;
                });
                $scope.spinner = false;
                $http({
                    url: cms_url+"/add",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: formData
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    if( response.status === 200 ){
                        $scope.alertMessage = response.data;
                        $scope.alertClass = 'alert-success';
                        $scope.alertBox = true;
                        document.getElementById("form").reset();
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
<?php echo '@endsection'.PHP_EOL?>
