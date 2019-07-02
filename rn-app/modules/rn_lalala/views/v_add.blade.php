@extends('app')
@section('body')
    <div id="page_content" ng-controller="addController">
        <div class="loading" ng-hide="spinner"></div>
        <div id="page_heading">
            <h1>Add <a href="cms/{{ $module }}" class="md-btn mdn-btn-small pull-right return-to-list">Back to list</a>
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
                                                                                                                                                                                                                                                
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-no_kontrak">No Kontrak</label>
                                            <input class="md-input" id="field-no_kontrak" name="no_kontrak" type="text" value="" maxlength="20" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-ketegori_fidusia">Ketegori Fidusia</label>
                                            <input class="md-input" id="field-ketegori_fidusia" name="ketegori_fidusia" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-jenis_fidusia">Jenis Fidusia</label>
                                            <input class="md-input" id="field-jenis_fidusia" name="jenis_fidusia" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-jk_pemberiFidusia">Jk PemberiFidusia</label>
                                            <input class="md-input" id="field-jk_pemberiFidusia" name="jk_pemberiFidusia" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-jenis_penggunaa">Jenis Penggunaa</label>
                                            <input class="md-input" id="field-jenis_penggunaa" name="jenis_penggunaa" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nama_pemberi">Nama Pemberi</label>
                                            <input class="md-input" id="field-nama_pemberi" name="nama_pemberi" type="text" value="" maxlength="80" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nik_pemberi">Nik Pemberi</label>
                                            <input class="md-input" id="field-nik_pemberi" name="nik_pemberi" type="text" value="" maxlength="50" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-telp_pemberi">Telp Pemberi</label>
                                            <input class="md-input" id="field-telp_pemberi" name="telp_pemberi" type="text" value="" maxlength="20" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="alamat_pemberi">Alamat Pemberi</label>
                                            <textarea id="alamat_pemberi" name="alamat_pemberi" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['alamat_pemberi'])delete CKEDITOR.instances['alamat_pemberi'];
                                                CKEDITOR.replace( 'alamat_pemberi' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-pos_pemberi">Pos Pemberi</label>
                                            <input class="md-input" id="field-pos_pemberi" name="pos_pemberi" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-prov_pemberi">Prov Pemberi</label>
                                            <input class="md-input" id="field-prov_pemberi" name="prov_pemberi" type="text" value="" maxlength="50" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kab_pemberi">Kab Pemberi</label>
                                            <input class="md-input" id="field-kab_pemberi" name="kab_pemberi" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kec_pemberi">Kec Pemberi</label>
                                            <input class="md-input" id="field-kec_pemberi" name="kec_pemberi" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kel_pemberi">Kel Pemberi</label>
                                            <input class="md-input" id="field-kel_pemberi" name="kel_pemberi" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-rt_pemberi">Rt Pemberi</label>
                                            <input class="md-input" id="field-rt_pemberi" name="rt_pemberi" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-rw_pemberi">Rw Pemberi</label>
                                            <input class="md-input" id="field-rw_pemberi" name="rw_pemberi" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nama_debitur">Nama Debitur</label>
                                            <input class="md-input" id="field-nama_debitur" name="nama_debitur" type="text" value="" maxlength="80" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kategori_penerimaFidusia">Kategori PenerimaFidusia</label>
                                            <input class="md-input" id="field-kategori_penerimaFidusia" name="kategori_penerimaFidusia" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-subKategori_penerima">SubKategori Penerima</label>
                                            <input class="md-input" id="field-subKategori_penerima" name="subKategori_penerima" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nama_penerima">Nama Penerima</label>
                                            <input class="md-input" id="field-nama_penerima" name="nama_penerima" type="text" value="" maxlength="80" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-npwp_penerima">Npwp Penerima</label>
                                            <input class="md-input" id="field-npwp_penerima" name="npwp_penerima" type="text" value="" maxlength="50" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-telp_penerima">Telp Penerima</label>
                                            <input class="md-input" id="field-telp_penerima" name="telp_penerima" type="text" value="" maxlength="20" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="alamat_penerima">Alamat Penerima</label>
                                            <textarea id="alamat_penerima" name="alamat_penerima" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['alamat_penerima'])delete CKEDITOR.instances['alamat_penerima'];
                                                CKEDITOR.replace( 'alamat_penerima' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-pos_penerima">Pos Penerima</label>
                                            <input class="md-input" id="field-pos_penerima" name="pos_penerima" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-prov_penerima">Prov Penerima</label>
                                            <input class="md-input" id="field-prov_penerima" name="prov_penerima" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kab_penerima">Kab Penerima</label>
                                            <input class="md-input" id="field-kab_penerima" name="kab_penerima" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kec_penerima">Kec Penerima</label>
                                            <input class="md-input" id="field-kec_penerima" name="kec_penerima" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kel_penerima">Kel Penerima</label>
                                            <input class="md-input" id="field-kel_penerima" name="kel_penerima" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-rt_penerima">Rt Penerima</label>
                                            <input class="md-input" id="field-rt_penerima" name="rt_penerima" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-rw_penerima">Rw Penerima</label>
                                            <input class="md-input" id="field-rw_penerima" name="rw_penerima" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nomor_akta">Nomor Akta</label>
                                            <input class="md-input" id="field-nomor_akta" name="nomor_akta" type="text" value="" maxlength="50" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nama_notaris">Nama Notaris</label>
                                            <input class="md-input" id="field-nama_notaris" name="nama_notaris" type="text" value="" maxlength="80" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kedudukan_notaris">Kedudukan Notaris</label>
                                            <input class="md-input" id="field-kedudukan_notaris" name="kedudukan_notaris" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="isi_perjanjian">Isi Perjanjian</label>
                                            <textarea id="isi_perjanjian" name="isi_perjanjian" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['isi_perjanjian'])delete CKEDITOR.instances['isi_perjanjian'];
                                                CKEDITOR.replace( 'isi_perjanjian' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nilai_penjaminFidusia">Nilai PenjaminFidusia</label>
                                            <input class="md-input" id="field-nilai_penjaminFidusia" name="nilai_penjaminFidusia" type="text" value="" maxlength="10" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="berdasarkan">Berdasarkan</label>
                                            <textarea id="berdasarkan" name="berdasarkan" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['berdasarkan'])delete CKEDITOR.instances['berdasarkan'];
                                                CKEDITOR.replace( 'berdasarkan' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-kategori_objek">Kategori Objek</label>
                                            <input class="md-input" id="field-kategori_objek" name="kategori_objek" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="jumlah_roda">Jumlah Roda</label>
                                            <textarea id="jumlah_roda" name="jumlah_roda" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['jumlah_roda'])delete CKEDITOR.instances['jumlah_roda'];
                                                CKEDITOR.replace( 'jumlah_roda' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-merk_objek">Merk Objek</label>
                                            <input class="md-input" id="field-merk_objek" name="merk_objek" type="text" value="" maxlength="30" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-tipe_objek">Tipe Objek</label>
                                            <input class="md-input" id="field-tipe_objek" name="tipe_objek" type="text" value="" maxlength="80" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-no_rangka">No Rangka</label>
                                            <input class="md-input" id="field-no_rangka" name="no_rangka" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-no_mesin">No Mesin</label>
                                            <input class="md-input" id="field-no_mesin" name="no_mesin" type="text" value="" maxlength="100" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="bukti_objek">Bukti Objek</label>
                                            <textarea id="bukti_objek" name="bukti_objek" ></textarea>
                                            <script>
                                                if(CKEDITOR.instances['bukti_objek'])delete CKEDITOR.instances['bukti_objek'];
                                                CKEDITOR.replace( 'bukti_objek' ,{filebrowserBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserUploadUrl : '{{ base_url('assets/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}',filebrowserImageBrowseUrl : '{{ base_url('assets/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=dsflFWR9u2xQa') }}'});
                                            </script>
                                        </div>

                                                                                                                                                                                                                                                                                                                                
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nilai_objek">Nilai Objek</label>
                                            <input class="md-input" id="field-nilai_objek" name="nilai_objek" type="number" value="" maxlength="11" />
                                        </div>
                                                                                                                                                                                                                                                                                                                                                                        
                                        <div class="uk-form-row">
                                            <label class="uk-form-label" for="field-nilai_penjamin">Nilai Penjamin</label>
                                            <input class="md-input" id="field-nilai_penjamin" name="nilai_penjamin" type="number" value="" maxlength="11" />
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-tgl_akta">Tgl Akta</label>
                                    <input class="datepic" id="field-tgl_akta" name="tgl_akta" type="text" value="" maxlength="" />
                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-waktu_perjanjianAwal">Waktu PerjanjianAwal</label>
                                    <input class="datepic" id="field-waktu_perjanjianAwal" name="waktu_perjanjianAwal" type="text" value="" maxlength="" />
                                </div>
                                                                                                                                                                                                                                                                                                
                                <div class="uk-form-row">
                                    <label class="uk-form-label" for="field-waktu_perjanjianAhir">Waktu PerjanjianAhir</label>
                                    <input class="datepic" id="field-waktu_perjanjianAhir" name="waktu_perjanjianAhir" type="text" value="" maxlength="" />
                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
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
        app.controller('addController',function($scope, $http)
        {
            $scope.alertBox = false;
            $scope.spinner = true;
            $scope.data = [];
            $scope.columns = [];
            $scope.module = "{{$module}}";

            $scope.hideAlert = function () {
                $scope.alertBox = false;
            };

            
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
@endsection
