 BEGIN CONFIGURATION MODAL FORM-->
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
   <!--  <div class="page-toolbar">
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
                                <form action="<?php echo base_url()?>register/upload" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    
                                    <div class="form-body">
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
                                                <button type="submit" class="btn green">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- END FORM-->
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