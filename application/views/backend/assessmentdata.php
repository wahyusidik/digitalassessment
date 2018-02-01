 <!--BEGIN CONFIGURATION MODAL FORM-->
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
            <a href="#">Detail Data Assessment</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Detail Data Assessment
</h3>
<div class="clearfix">
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" id="assessmentdata" action="" class="form-horizontal">
                    <div class="form-body">
                        <h3 class="form-section">Data assessment</h3>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nomor</label>
                            <div class="col-md-4">
                                <input value="<?php echo $assessment['assessment_data']->number; ?>" type="text" class="form-control" name="number" placeholder="Nomor Assessment" readonly="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jabatan</label>
                            <div class="col-md-4">
                                <input value="<?php echo $assessment['assessment_data']->position; ?>" type="text" class="form-control" name="position" placeholder="Jabatan"  readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tahun</label>
                            <div class="col-md-4">
                                <input value="<?php echo $assessment['assessment_data']->year; ?>" type="text" class="form-control" name="position" placeholder="Jabatan" readonly>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jenis</label>
                            <div class="col-md-4">
                                <input value="<?php echo $assessment['assessment_data']->name; ?>" type="text" class="form-control" name="position" placeholder="Jenis" readonly>
                                
                            </div>
                        </div>
                        <h3 class="form-section">Informasi Waktu dan Tempat Pelaksanaan</h3>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-4">

                                <input value="<?php echo $assessment['assessment_data']->date; ?>" type="text" class="form-control" name="position" placeholder="Tanggal" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jam</label>
                            <div class="col-md-4">

                                <input value="<?php echo $assessment['assessment_data']->time; ?>" type="text" class="form-control" name="position" placeholder="Tanggal" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ruangan</label>
                            <div class="col-md-4">
                                <input value="<?php echo $assessment['assessment_data']->room; ?>" type="text" class="form-control" name="room" placeholder="ruangan" readonly>
                            </div>
                        </div>
                    </div>
                </form>
                <h3 class="form-section">Data Peserta</h3>
                <div class="form-group">
                    <label class="col-md-2 control-label">Moderator</label>
                    <div class="col-md-4">
                        <input value="<?php echo $assessment['assessment_data']->mod_name; ?>" type="text" class="form-control" name="moderator" placeholder="ruangan" readonly>
                    </div>
                </div>
                <div class=" col-md-10">
                    <table class="table table-striped table-bordered table-advance dataTable table-hover" id="list_assesment_part" data-url="">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="5%" class="sorting" style="text-align: center;">Nomor Kursi</th>
                                <th width="5%" class="sorting" style="text-align: center;">Nomor Pendaftaran</th>
                                <th width="10%" class="sorting" style="text-align: center;">Nama Peserta</th>
                                <th width="10%" class="sorting" style="text-align: center;">Nama Assessor</th>
                                <!-- <th width="15%" class="sorting" style="text-align: center;">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($assessment['assessment_participant']){
                                    $table_data = "";
                                    foreach ($assessment['assessment_participant'] as $row ) { 
                                    $table_data .= 
                                        '<tr>
                                        <td>'.$row->seat_number.'</td>'.
                                        '<td>'.$row->reg_number.'</td>'.
                                        '<td>'.$row->reg_name.'</td>'.
                                        '<td>'.$row->assessor_name.'</td>
                                        
                                        </tr>';
                                    }
                                    echo $table_data;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="clearfix">
            </div>
<!-- END PAGE HEADER