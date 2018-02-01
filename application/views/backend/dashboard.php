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
            <a href="<?php echo base_url();?>backend">Beranda</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
SELAMAT DATANG, <?php echo $user->name ;?>
</h3>
<div class="clearfix">
            </div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box green-haze">
            <!-- BEGIN UPLOAD -->
            <div class="portlet-title ">
                <div class="caption">
                    <?php if (get_login_type()==0 || get_login_type()==3): ?>
                      Jadwal Assessment Minggu Ini
                  <?php else: ?>
                    Jadwal Assessment Anda Minggu Ini
                <?php endif ?>
                </div>
            </div>            
            <div class="portlet-body util-btn-margin-bottom-5">
                <table class="table table-striped table-bordered table-advance dataTable table-hover" id="myassessment" data-url="<?php echo base_url('backend/assessmentmine/').(get_login_type()==0 || get_login_type()==3 ? '' : $user->id); ?>">
                    <thead>
                        <tr role="row" class="heading">
                            <th width="15%" style="text-align: center;">Tanggal</th>
                            <th width="10%" style="text-align: center;">Jam</th>
                            <th width="10%" style="text-align: center;">Nomor</th>
                            <th width="15%" style="text-align: center;">Jenis</th>
                            <th width="10%" style="text-align: center;">Posisi</th>
                            <th width="10%" style="text-align: center;">Ruangan</th>
                            <th width="15%" style="text-align: center;">Status</th>
                            <th width="15%" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody><!-- Data Will Be Placed Here --></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
            </div>
<!-- END PAGE HEADER