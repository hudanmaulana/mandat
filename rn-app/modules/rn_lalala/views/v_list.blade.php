@extends('app')
@section('body')
    <div id="page_content" ng-controller="listController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_content_inner" style="display: none;">
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-medium-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text"> Actions </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-6">
                                    <div class="uk-button-dropdown pull-right" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                        <button class="md-btn ">Bulk Action <i class="material-icons">expand_more</i></button>
                                        <div class="uk-dropdown uk-dropdown-small">
                                            <ul class="uk-nav uk-nav-dropdown">
                                                <li class="uk-nav-header">Bulk Action</li>
                                                <li><a id="deleteall" href="javascript:void(0)" ng-click="deleteClickBulkAction()">Delete Permanently</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="options-content" class="uk-width-medium-1-2">
                                    <a href="{{ base_url("cms/$module/add") }}" title="Add Post" class="md-btn md-btn-success"><i class="material-icons">add</i>Add </a>
                                    <button class="md-btn" data-uk-modal="{target:'#filtering-form-search'}"><i class="material-icons">search</i> Search</button>
                                    <button ng-click="readData()" class="md-btn md-btn-primary"><i class="material-icons">loop</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal" id="filtering-form-search" aria-hidden="true">
                <div class="uk-modal-dialog" style="top: -15.5px;">
                    <div class="uk-modal-header">
                        <div class="uk-clearfix">
                            <div class="uk-float-left">
                                <h3 class="uk-modal-title">Search {{ $subject }}</h3>
                            </div>
                            <div class="uk-float-right">
                                <a class="md-btn md-btn-flat md-btn-wave waves-effect waves-button uk-modal-close" href="javascript:void(0)"><i class="material-icons">close</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1">
                        <form autocomplete="off" accept-charset="utf-8">
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <label for="search_text">Search</label>
                                    <input ng-model="q" type="text" class="md-input" size="30" id="search_text">
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="md-input-wrapper">
                                    <select id="search-column" class="md-input">
                                                                                                                                                                 
 <option value="no_kontrak">No Kontrak</option>                                                                                  
 <option value="ketegori_fidusia">Ketegori Fidusia</option>                                                                                  
 <option value="jenis_fidusia">Jenis Fidusia</option>                                                                                  
 <option value="jk_pemberiFidusia">Jk PemberiFidusia</option>                                                                                  
 <option value="jenis_penggunaa">Jenis Penggunaa</option>                                                                                  
 <option value="nama_pemberi">Nama Pemberi</option>                                                                                  
 <option value="nik_pemberi">Nik Pemberi</option>                                                                                  
 <option value="telp_pemberi">Telp Pemberi</option>                                                                                  
 <option value="alamat_pemberi">Alamat Pemberi</option>                                                                                  
 <option value="pos_pemberi">Pos Pemberi</option>                                                                                  
 <option value="prov_pemberi">Prov Pemberi</option>                                                                                  
 <option value="kab_pemberi">Kab Pemberi</option>                                                                                  
 <option value="kec_pemberi">Kec Pemberi</option>                                                                                  
 <option value="kel_pemberi">Kel Pemberi</option>                                                                                  
 <option value="rt_pemberi">Rt Pemberi</option>                                                                                  
 <option value="rw_pemberi">Rw Pemberi</option>                                                                                  
 <option value="nama_debitur">Nama Debitur</option>                                                                                  
 <option value="kategori_penerimaFidusia">Kategori PenerimaFidusia</option>                                                                                  
 <option value="subKategori_penerima">SubKategori Penerima</option>                                                                                  
 <option value="nama_penerima">Nama Penerima</option>                                                                                  
 <option value="npwp_penerima">Npwp Penerima</option>                                                                                  
 <option value="telp_penerima">Telp Penerima</option>                                                                                  
 <option value="alamat_penerima">Alamat Penerima</option>                                                                                  
 <option value="pos_penerima">Pos Penerima</option>                                                                                  
 <option value="prov_penerima">Prov Penerima</option>                                                                                  
 <option value="kab_penerima">Kab Penerima</option>                                                                                  
 <option value="kec_penerima">Kec Penerima</option>                                                                                  
 <option value="kel_penerima">Kel Penerima</option>                                                                                  
 <option value="rt_penerima">Rt Penerima</option>                                                                                  
 <option value="rw_penerima">Rw Penerima</option>                                                                                  
 <option value="nomor_akta">Nomor Akta</option>                                                                                  
 <option value="tgl_akta">Tgl Akta</option>                                                                                  
 <option value="nama_notaris">Nama Notaris</option>                                                                                  
 <option value="kedudukan_notaris">Kedudukan Notaris</option>                                                                                  
 <option value="isi_perjanjian">Isi Perjanjian</option>                                                                                  
 <option value="nilai_penjaminFidusia">Nilai PenjaminFidusia</option>                                                                                  
 <option value="berdasarkan">Berdasarkan</option>                                                                                  
 <option value="waktu_perjanjianAwal">Waktu PerjanjianAwal</option>                                                                                  
 <option value="waktu_perjanjianAhir">Waktu PerjanjianAhir</option>                                                                                  
 <option value="kategori_objek">Kategori Objek</option>                                                                                  
 <option value="jumlah_roda">Jumlah Roda</option>                                                                                  
 <option value="merk_objek">Merk Objek</option>                                                                                  
 <option value="tipe_objek">Tipe Objek</option>                                                                                  
 <option value="no_rangka">No Rangka</option>                                                                                  
 <option value="no_mesin">No Mesin</option>                                                                                  
 <option value="bukti_objek">Bukti Objek</option>                                                                                  
 <option value="nilai_objek">Nilai Objek</option>                                                                                  
 <option value="nilai_penjamin">Nilai Penjamin</option>                                                                             </select>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1">
                                        <input class="md-btn md-btn-primary uk-modal-close" type="button" value="Search" ng-click="searchClick()">
                                        <input class="md-btn md-btn-success uk-modal-close" type="reset" onclick="document.forms[0].reset();" ng-click="reset()" value="Clear filtering">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br>

            <div ng-click="hideAlert()" ng-class="alertClass" ng-show="alertBox" class="uk-alert" data-uk-alert>
                <div ng-bind-html="alertMessage"></div>
            </div>

            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-toolbar"> <h3 class="md-card-toolbar-heading-text"> List data  {{ $subject }}</h3> </div>
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap table_check" style="margin-bottom: 68px;">
                            <thead>
                            <tr>
                                <th class="small_col"><input class="check_all" type="checkbox" ng-model="checkbox" ng-click="selectAll($event)" title="Select All"></th>
                                                                                                                                                                        
 <th>No Kontrak</th>
                                                                                                                                        
 <th>Ketegori Fidusia</th>
                                                                                                                                        
 <th>Jenis Fidusia</th>
                                                                                                                                        
 <th>Jk PemberiFidusia</th>
                                                                                                                                        
 <th>Jenis Penggunaa</th>
                                                                                                                                        
 <th>Nama Pemberi</th>
                                                                                                                                        
 <th>Nik Pemberi</th>
                                                                                                                                        
 <th>Telp Pemberi</th>
                                                                                                                                        
 <th>Alamat Pemberi</th>
                                                                                                                                        
 <th>Pos Pemberi</th>
                                                                                                                                        
 <th>Prov Pemberi</th>
                                                                                                                                        
 <th>Kab Pemberi</th>
                                                                                                                                        
 <th>Kec Pemberi</th>
                                                                                                                                        
 <th>Kel Pemberi</th>
                                                                                                                                        
 <th>Rt Pemberi</th>
                                                                                                                                        
 <th>Rw Pemberi</th>
                                                                                                                                        
 <th>Nama Debitur</th>
                                                                                                                                        
 <th>Kategori PenerimaFidusia</th>
                                                                                                                                        
 <th>SubKategori Penerima</th>
                                                                                                                                        
 <th>Nama Penerima</th>
                                                                                                                                        
 <th>Npwp Penerima</th>
                                                                                                                                        
 <th>Telp Penerima</th>
                                                                                                                                        
 <th>Alamat Penerima</th>
                                                                                                                                        
 <th>Pos Penerima</th>
                                                                                                                                        
 <th>Prov Penerima</th>
                                                                                                                                        
 <th>Kab Penerima</th>
                                                                                                                                        
 <th>Kec Penerima</th>
                                                                                                                                        
 <th>Kel Penerima</th>
                                                                                                                                        
 <th>Rt Penerima</th>
                                                                                                                                        
 <th>Rw Penerima</th>
                                                                                                                                        
 <th>Nomor Akta</th>
                                                                                                                                        
 <th>Tgl Akta</th>
                                                                                                                                        
 <th>Nama Notaris</th>
                                                                                                                                        
 <th>Kedudukan Notaris</th>
                                                                                                                                        
 <th>Isi Perjanjian</th>
                                                                                                                                        
 <th>Nilai PenjaminFidusia</th>
                                                                                                                                        
 <th>Berdasarkan</th>
                                                                                                                                        
 <th>Waktu PerjanjianAwal</th>
                                                                                                                                        
 <th>Waktu PerjanjianAhir</th>
                                                                                                                                        
 <th>Kategori Objek</th>
                                                                                                                                        
 <th>Jumlah Roda</th>
                                                                                                                                        
 <th>Merk Objek</th>
                                                                                                                                        
 <th>Tipe Objek</th>
                                                                                                                                        
 <th>No Rangka</th>
                                                                                                                                        
 <th>No Mesin</th>
                                                                                                                                        
 <th>Bukti Objek</th>
                                                                                                                                        
 <th>Nilai Objek</th>
                                                                                                                                        
 <th>Nilai Penjamin</th>
                                                                                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="t in data">
                                                                                                            
 <td><input class="check_row" type="checkbox" name="checkbox_t.id" ng-checked="checkbox" ng-click="updateSelection($event, t.id)" title="Select"></td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                    
 <td>@{{t.no_kontrak}}</td>
                                                                                                                                                                                                    
 <td>@{{t.ketegori_fidusia}}</td>
                                                                                                                                                                                                    
 <td>@{{t.jenis_fidusia}}</td>
                                                                                                                                                                                                    
 <td>@{{t.jk_pemberiFidusia}}</td>
                                                                                                                                                                                                    
 <td>@{{t.jenis_penggunaa}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nama_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nik_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.telp_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.alamat_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.pos_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.prov_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kab_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kec_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kel_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.rt_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.rw_pemberi}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nama_debitur}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kategori_penerimaFidusia}}</td>
                                                                                                                                                                                                    
 <td>@{{t.subKategori_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nama_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.npwp_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.telp_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.alamat_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.pos_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.prov_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kab_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kec_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kel_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.rt_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.rw_penerima}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nomor_akta}}</td>
                                                                                                                                                                                                    
 <td>@{{t.tgl_akta}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nama_notaris}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kedudukan_notaris}}</td>
                                                                                                                                                                                                    
 <td>@{{t.isi_perjanjian}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nilai_penjaminFidusia}}</td>
                                                                                                                                                                                                    
 <td>@{{t.berdasarkan}}</td>
                                                                                                                                                                                                    
 <td>@{{t.waktu_perjanjianAwal}}</td>
                                                                                                                                                                                                    
 <td>@{{t.waktu_perjanjianAhir}}</td>
                                                                                                                                                                                                    
 <td>@{{t.kategori_objek}}</td>
                                                                                                                                                                                                    
 <td>@{{t.jumlah_roda}}</td>
                                                                                                                                                                                                    
 <td>@{{t.merk_objek}}</td>
                                                                                                                                                                                                    
 <td>@{{t.tipe_objek}}</td>
                                                                                                                                                                                                    
 <td>@{{t.no_rangka}}</td>
                                                                                                                                                                                                    
 <td>@{{t.no_mesin}}</td>
                                                                                                                                                                                                    
 <td>@{{t.bukti_objek}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nilai_objek}}</td>
                                                                                                                                                                                                    
 <td>@{{t.nilai_penjamin}}</td>
                                                                                                
                                                                                                            
                                        <td>
                                            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}" aria-haspopup="true" aria-expanded="false">
                                                <button class="md-btn mdn-btn-small"> Actions <i class="material-icons">expand_more</i></button>
                                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-bottom" style="">
                                                    <ul class="uk-nav uk-nav-dropdown">
                                                        <li class="edit-row">
                                                            <a href="{{ base_url("cms/$module/edit") }}/@{{t.id}}" title="Edit"><i class="material-icons">mode_edit</i> Edit</a>
                                                        </li>
                                                        <li ng-click="deleteClick(t.id)">
                                                            <a href="" title="Delete"><i class="material-icons">delete_forever</i> Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="uk-grid" data-uk-grid-margin="" style="margin-top: 30px;">
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div class="uk-input-group">
                                <select class="md-input" ng-change="changedPerPage()" data-ng-options="o.name for o in optionPerPage" data-ng-model="selectedOptionPerPage"></select>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div style="margin-top:15px;" class="uk-input-group"> Page <span id="page-starts-from">@{{pageStart}}</span> from <span id="total_items">@{{maxPage}}</span> Total Pages</div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div class="uk-input-group">
                                <div class="md-input-wrapper md-input-filled">
                                    <input class="md-input" name="tb_crud_page" type="text" value="@{{pageStart}}" id="tb_crud_page" disabled>
                                    <span class="md-input-bar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-2">
                            <div style="margin-top:15px;" class="uk-input-group"> Total Data @{{ totalRows | number }}</div>
                        </div>
                    </div>

                    <ul class="pager" style="text-align: center;">
                        <li class="md-btn md-btn-wave" ng-click="startPageClick()" style="float: left;"><a href="" >« First</a></li>
                        <li class="md-btn md-btn-wave" ng-click="prevPageClick()"><a href="" >« Prev</a></li>
                        <li class="md-btn md-btn-wave" ng-click="nextPageClick()"><a href="" >Next »</a></li>
                        <li class="md-btn md-btn-wave" ng-click="endPageClick()" style="float: right;"><a href="" >Last »</a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function showBox() {
            document.getElementById('page_content_inner').style.display = 'block';
        }

        var app = angular.module( '{{ $module }}', ['ngSanitize']);
        app.controller('listController',function($scope, $http)
        {
            $scope.spinner = true;
            $scope.perPage = 20;
            $scope.totalRows = 0;
            $scope.pageStart = 1;
            $scope.pageEnd = 0;
            $scope.data = [];
            $scope.columns = [];
            $scope.maxPage = 0;
            $scope.is_search = false;
            $scope.selected = [];
            $scope.alertBox = false;

            /*-------start checkbox operation---------*/
            var updateSelected = function(action, id) {
                if (action === 'add' && $scope.selected.indexOf(id) === -1) {
                    $scope.selected.push(id);
                }
                if (action === 'remove' && $scope.selected.indexOf(id) !== -1) {
                    $scope.selected.splice($scope.selected.indexOf(id), 1);
                }
            };

            $scope.updateSelection = function($event, id) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                updateSelected(action, id);
            };

            $scope.selectAll = function($event) {
                var checkbox = $event.target;
                var action = (checkbox.checked ? 'add' : 'remove');
                for ( var i = 0; i < $scope.data.length; i++) {
                    var entity = $scope.data[i];
                    updateSelected(action, entity.id);
                }
            };

            $scope.getSelectedClass = function(entity) {
                return $scope.isSelected(entity.id) ? 'selected' : '';
            };
            /*--------checkbox operation----------*/

            $scope.readData = function(page) {
                $scope.spinner = false;
                var query = '?limit='+$scope.perPage;
                if(page)query += '&page='+page;
                if($scope.is_search){
                    query += '&col='+$scope.selectedOption;
                    query += '&q='+$scope.q;
                }
                $http({
                    method: 'GET',
                    url: cms_url+"/get"+query
                }).then(function successCallback(response) {
                    $scope.data = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                    $scope.updateRowData();
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            $scope.updateRowData = function() {
                var query = '';
                if($scope.is_search){
                    query += '?col='+$scope.selectedOption;
                    query += '&q='+$scope.q;
                }
                $http({
                    method: 'GET',
                    url: cms_url+"/rows"+query
                }).then(function successCallback(response) {
                    $scope.spinner = true;
                    $scope.totalRows = response.data;
                    $scope.maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                }, function errorCallback(response) {
                    $scope.spinner = true;
                    console.log(response);
                });
            };

            function showAlert(val) {
                UIkit.modal.alert( val );
            }

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
                $scope.selectedOption = document.getElementById("search-column").value;
                $scope.spinner = false;
                $scope.is_search = true;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };

            $scope.reset = function () {
                $scope.spinner = false;
                $scope.is_search = false;
                $scope.perPage = 20;
                $scope.readData($scope.pageStart);
            };

            $scope.changedPerPage = function() {
                $scope.perPage = $scope.selectedOptionPerPage.value;
                $scope.readData($scope.pageStart);
            };

            $scope.deleteClickBulkAction = function() {
                var scope_selection = $scope.selected;
                if( scope_selection.length > 0 ){
                    var id_to_delete = scope_selection.join('-');
                    UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                        $scope.spinner = false;
                        $http({
                            method: 'GET',
                            url: cms_url+"/delete/"+id_to_delete
                        }).then(function successCallback(response) {
                            $scope.selected = [];
                            $scope.spinner = true;
                            if( response.status === 200 ){
                                $scope.alertMessage = response.data;
                                $scope.alertClass = 'uk-alert-success';
                                $scope.alertBox = true;
                                $scope.readData();
                            }else{
                                $scope.alertMessage = response.data;
                                $scope.alertClass = 'uk-alert-danger';
                                $scope.alertBox = true;
                            }
                        }, function errorCallback(response) {
                            $scope.spinner = true;
                            console.log(response);
                        });
                    });
                }else{
                    showAlert('No Data Selected!');
                }
            };

            $scope.deleteClick = function(id_to_delete) {
                UIkit.modal.confirm('Are you sure that you want to delete this record?', function(){
                    $scope.spinner = false;
                    $http({
                        method: 'GET',
                        url: cms_url+"/delete/"+id_to_delete
                    }).then(function successCallback(response) {
                        $scope.spinner = true;
                        if( response.status === 200 ){
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-success';
                            $scope.alertBox = true;
                            $scope.readData();
                        }else{
                            $scope.alertMessage = response.data;
                            $scope.alertClass = 'uk-alert-danger';
                            $scope.alertBox = true;
                        }
                    }, function errorCallback(response) {
                        $scope.spinner = true;
                        console.log(response);
                    });
                });
            };

            $scope.nextPageClick = function () {
                var maxPage = Math.ceil($scope.totalRows/$scope.perPage);
                if($scope.pageStart < maxPage){
                    $scope.spinner = false;
                    $scope.pageStart +=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.prevPageClick = function () {
                if( $scope.pageStart > 1 ){
                    $scope.spinner = false;
                    $scope.pageStart -=1;
                    $scope.readData($scope.pageStart);
                }
            };
            $scope.startPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = 1;
                $scope.readData($scope.pageStart);
            };
            $scope.endPageClick = function () {
                $scope.spinner = false;
                $scope.pageStart = Math.ceil($scope.totalRows/$scope.perPage);
                $scope.readData($scope.pageStart);
            };

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            $scope.readData();
            showBox();
        });
    </script>
@endsection
