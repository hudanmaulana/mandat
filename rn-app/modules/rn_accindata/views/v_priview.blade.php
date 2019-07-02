@extends('app')
@section('body')
	<div class="page" id="page_content" ng-controller="editController">
		<div class="page-header">
			<h1 class="page-title">Form {{ $title }} {{$subject}}</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ base_url() }}rn/{{$module}}">{{$subject}}</a></li>
				<li class="breadcrumb-item active">{{$module}}</li>
			</ol>
		</div>
		<div class="page-content">
			<div class="panel">
				<div class="panel-body container-fluid">
					<div class="row row-lg">
						<div class="col-md-12">
							<div class="example-wrap">
								<div class="example">

										<div class="row">
											<div class="col-md-6">
												<div class="form-group form-material"><label class="form-control-label">No Kontrak :
													</label><input readonly class="form-control" type="text" name="no_kontrak" value="{{ $no_kontrak }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Ketegori Fidusia :
													</label><input readonly class="form-control" type="text" name="ketegori_fidusia" value="{{ $ketegori_fidusia }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Jenis Fidusia :
													</label><input readonly class="form-control" type="text" name="jenis_fidusia" value="{{ $jenis_fidusia }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Jk PemberiFidusia :
													</label><input readonly class="form-control" type="text" name="jk_pemberiFidusia" value="{{ $jk_pemberiFidusia }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Jenis Penggunaa :
													</label><input readonly class="form-control" type="text" name="jenis_penggunaa" value="{{ $jenis_penggunaa }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nama Pemberi :
													</label><input readonly class="form-control" type="text" name="nama_pemberi" value="{{ $nama_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nik Pemberi :
													</label><input readonly class="form-control" type="text" name="nik_pemberi" value="{{ $nik_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Telp Pemberi :
													</label><input readonly class="form-control" type="text" name="telp_pemberi" value="{{ $telp_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Pos Pemberi :
													</label><input readonly class="form-control" type="text" name="pos_pemberi" value="{{ $pos_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Prov Pemberi :
													</label><input readonly class="form-control" type="text" name="prov_pemberi" value="{{ $prov_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kab Pemberi :
													</label><input readonly class="form-control" type="text" name="kab_pemberi" value="{{ $kab_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kec Pemberi :
													</label><input readonly class="form-control" type="text" name="kec_pemberi" value="{{ $kec_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kel Pemberi :
													</label><input readonly class="form-control" type="text" name="kel_pemberi" value="{{ $kel_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Rt Pemberi :
													</label><input readonly class="form-control" type="text" name="rt_pemberi" value="{{ $rt_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Rw Pemberi :
													</label><input readonly class="form-control" type="text" name="rw_pemberi" value="{{ $rw_pemberi }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nama Debitur :
													</label><input readonly class="form-control" type="text" name="nama_debitur" value="{{ $nama_debitur }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kategori PenerimaFidusia :
													</label><input readonly class="form-control" type="text" name="kategori_penerimaFidusia" value="{{ $kategori_penerimaFidusia }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														SubKategori Penerima :
													</label><input readonly class="form-control" type="text" name="subKategori_penerima" value="{{ $subKategori_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nama Penerima :
													</label><input readonly class="form-control" type="text" name="nama_penerima" value="{{ $nama_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Npwp Penerima :
													</label><input readonly class="form-control" type="text" name="npwp_penerima" value="{{ $npwp_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Telp Penerima :
													</label><input readonly class="form-control" type="text" name="telp_penerima" value="{{ $telp_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Pos Penerima :
													</label><input readonly class="form-control" type="text" name="pos_penerima" value="{{ $pos_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Prov Penerima :
													</label><input readonly class="form-control" type="text" name="prov_penerima" value="{{ $prov_penerima }}" />
												</div>

												<div class="form-group form-material"> 													<label class="form-control-label">
														Kab Penerima :
													</label><input readonly class="form-control" type="text" name="kab_penerima" value="{{ $kab_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kec Penerima :
													</label><input readonly class="form-control" type="text" name="kec_penerima" value="{{ $kec_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kel Penerima :
													</label><input readonly class="form-control" type="text" name="kel_penerima" value="{{ $kel_penerima }}" />
												</div>
											</div>

											<div class="col-md-6">

												<div class="form-group form-material"> 													<label class="form-control-label">
														Rt Penerima :
													</label><input readonly class="form-control" type="text" name="rt_penerima" value="{{ $rt_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Rw Penerima :
													</label><input readonly class="form-control" type="text" name="rw_penerima" value="{{ $rw_penerima }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nomor Akta :
													</label><input readonly class="form-control" type="text" name="nomor_akta" value="{{ $nomor_akta }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Tgl Akta :
													</label><input readonly class="form-control" type="text" name="tgl_akta" value="{{ $tgl_akta }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nama Notaris :
													</label><input readonly class="form-control" type="text" name="nama_notaris" value="{{ $nama_notaris }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kedudukan Notaris :
													</label><input readonly class="form-control" type="text" name="kedudukan_notaris" value="{{ $kedudukan_notaris }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nilai PenjaminFidusia :
													</label><input readonly class="form-control" type="text" name="nilai_penjaminFidusia" value="{{ $nilai_penjaminFidusia }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Waktu PerjanjianAwal :
													</label><input readonly class="form-control" type="text" name="waktu_perjanjianAwal" value="{{ $waktu_perjanjianAwal }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Waktu PerjanjianAhir :
													</label><input readonly class="form-control" type="text" name="waktu_perjanjianAhir" value="{{ $waktu_perjanjianAhir }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Kategori Objek :
													</label><input readonly class="form-control" type="text" name="kategori_objek" value="{{ $kategori_objek }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Merk Objek :
													</label><input readonly class="form-control" type="text" name="merk_objek" value="{{ $merk_objek }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Tipe Objek :
													</label><input readonly class="form-control" type="text" name="tipe_objek" value="{{ $tipe_objek }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														No Rangka :
													</label><input readonly class="form-control" type="text" name="no_rangka" value="{{ $no_rangka }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														No Mesin :
													</label><input readonly class="form-control" type="text" name="no_mesin" value="{{ $no_mesin }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nilai Objek :
													</label><input readonly class="form-control" type="text" name="nilai_objek" value="{{ $nilai_objek }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Nilai Penjamin :
													</label><input readonly class="form-control" type="text" name="nilai_penjamin" value="{{ $nilai_penjamin }}" />
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Alamat Pemberi :
													</label>	<textarea readonly class="form-control" name="alamat_pemberi">{{ $alamat_pemberi }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Alamat Penerima :
													</label>	<textarea readonly class="form-control" name="alamat_penerima">{{ $alamat_penerima }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Isi Perjanjian :
													</label>	<textarea readonly class="form-control" name="isi_perjanjian">{{ $isi_perjanjian }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Berdasarkan :
													</label>	<textarea readonly class="form-control" name="berdasarkan">{{ $berdasarkan }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Jumlah Roda :
													</label>	<textarea readonly class="form-control" name="jumlah_roda">{{ $jumlah_roda }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Bukti Objek :
													</label> <textarea readonly class="form-control" name="bukti_objek">{{ $bukti_objek }}</textarea>
												</div>
												<div class="form-group form-material"> 													<label class="form-control-label">
														Status :
													</label> <textarea readonly class="form-control" name="bukti_objek">{{ $status }}</textarea>
												</div>
												<div class="form-group form-material">
													@if( $status=='terupload')
														<a id="showmenu" style="color:#fff!important;" class="btn btn-primary">Update Status</a>
													@endif
													<a href="{{base_url()}}rn/{{$module}}" class="btn btn-danger">Close</a>
												</div>
												<form id="form" action="" method="post" autocomplete="off" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="return false;">
													<div style="display: none;" class="menus">
														<div class="form-group form-material"><label class="form-control-label">
																Catatan
															</label><input placeholder="deskripsi"  class="form-control" type="hidden" name="no_kontrak" value="{{ $no_kontrak }}" /><textarea  class="form-control" name="alasan"></textarea>

														</div>
														<div class="form-group form-material"><label class="form-control-label">
																<label class="form-control-label">
																	Status
																</label>
														<select name="status" class="form-control">
															<option value="" selected>---Pilih----</option>
															<option value="terkirim" >terkirim</option>
															<option value="diterima" >diterima</option>
															<option value="proses_fidusia" >proses fidusia</option>
															<option value="terdaftar" >terdaftar</option>
														</select>
															</div>
														<div class="form-group form-material"> <button type="button" class="btn btn-primary" ng-click="mySave()">Simpan</button>
														</div>
													</div>

												</form>
											</div>

										</div>

										{{--										<input readonly type="hidden" name="id" value="{{ $id }}">--}}



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
		$(document).ready(function() {
			$('#showmenu').click(function() {
				$('.menus').toggle("slide");
			});
		});
		var app = angular.module( '{{$module}}', ['ngSanitize']);
		app.controller('editController',function($scope, $http)
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
				$http({
					url: rn_url+"/{{ $action }}",
					method: "POST",
					headers: {'Content-Type': 'application/x-www-form-urlencoded'},
					data: formData
				}).then(function successCallback(response) {
					var result = response.data;
					if( result.status === 'success'){
						toastr.success(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'error'){
						toastr.error(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'info'){
						toastr.info(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}else if( result.status === 'warning'){
						toastr.warning(result.message);
						if (typeof result.callback_url !== "undefined") {
							setTimeout(function () {
								window.location = result.callback_url;
							}, 500);
						}
					}
					else {
						$.each(result.message,  function(key, val) {
							toastr.error(val);
						});
					}
				}, function errorCallback(response) {
					console.log(response);
					toastr.alert('Oops error, please refresh this page');
				});
			};
		});
	</script>
@endsection
