<!-- BEGIN CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                 Widget settings form goes here
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
        <!-- /.modal -->
<!-- END CONFIGURATION MODAL FORM-->
<!-- BEGIN PAGE HEADER-->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Beranda</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Unggah Dokumen</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Pendaftaran <small>Unggah Dokumen</small>
</h3>
<div class="clearfix">
            </div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet">
            <!-- BEGIN UPLOAD -->
            <div class="portlet-title"><div class="caption">Lengkapi Dokumen Perysaratan</div></div>            
            <div class="portlet-body">
                <div class="table-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="alert alert-success" id="success-alert" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>Success! </strong>
                                Data PIN Registrasi berhasil diupload.                                
                            </div>                            
                            <div class="alert alert-warning">Unggah berkas persyaratan dengan lengkap. Jenis file yang diperbolehkan (.pdf, .doc, .jpg, .jpeg). Besar file maksimal 20 MB</div>
                          
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form role="form" id="uploadfile-form" action="<?php echo base_url()?>register/upload" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    
                                    <div class="form-body">
                                        <div id="message_error" class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                                        </div>
                                        <div id="message_success" class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Validasi formulir Anda berhasil! Data PIN sudah dibuat.
                                        </div>
                                        <?php $count = 6;
                                            for ($i = 1 ; $i<=6 ; $i++){ ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Dokumen <?php echo $i; ?></label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group input-large">
                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                            <span class="fileinput-filename"> </span>
                                                        </div>
                                                        <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new"> Select file </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="hidden" name="type[]" value="">
                                                            <input type="file" class="input-doc" id="document<?php echo $i; ?>" type-doc="document<?php echo $i; ?>" name="document<?php echo $i; ?>" accept=".jpg,.jpeg,.png,.pdf,.doc,.docs"> </span>
                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <div class="form-actions top">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="button" class="btn green upload_submit" id="upload_submit">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                            <div class="portlet">
                                <div class="portlet-title">
                                <div class="caption">Data Dokumen Tersimpan
                                    
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-advance dataTable table-hover" id="list_my_document" data-url="<?php echo base_url('backend/user_documentlist/' . $user->id); ?>">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%" style="text-align: center;">Nomor</th>
                                            <th width="10%" style="text-align: center;">Tipe</th>
                                            <th width="10%" style="text-align: center;">Nama</th>
                                            <th width="15%" style="text-align: center;">Status</th>
                                            <th width="15%" style="text-align: center;">Aksi</th>
                                        </tr>
                                        <tr role="row" class="filter">
                                            <td><input type="text" class="form-control form-filter input-sm" name="search_number" /></td>
                                            <td>
                                                <select name="search_type" class="form-control form-filter input-sm">
                                                    <option value="">Pilih...</option>
                                                    <?php $i = 6;
                                                    for ($i=1; $i <= 6 ; $i++) { ?>
                                                        <option value="document<?php echo $i;?>">Dokumen <?php echo $i;?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-filter input-sm" name="search_name" /></td>
                                            <td>
                                                <select name="search_status" class="form-control form-filter input-sm">
                                                    <option value="">Pilih...</option>
                                                    <option value="0"><center><span class="label label-sm label-warning">Dicek</span></center></option>
                                                    <option value="1"><center><span class="label label-sm label-success">Diterima</span></center></option>
                                                    <option value="2"><center><span class="label label-sm label-danger">Ditolak</span></center></option>
                                                   
                                                </select>
                                            </td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm blue filter-submit margin-bottom" id="mydoc_btn"><i class="fa fa-search"></i> Search</button>
                                                <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody><!-- Data Will Be Placed Here --></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
            </div>
<!-- END PAGE HEADER