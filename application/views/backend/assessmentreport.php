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
            <a href="#">Assessment</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Laporan Assessment
</h3>
<div class="clearfix">
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box green-haze">
            <!-- BEGIN UPLOAD -->
            <div class="portlet-title ">
                <div class="caption">
                    Jadwal Assessment Anda
                </div>
            </div>            
            <div class="portlet-body util-btn-margin-bottom-5">
                <table class="table table-striped table-bordered table-advance dataTable table-hover" id="myassessment" data-url="<?php echo base_url('backend/assessmentmine/').$user->id.'/1'; ?>">
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
                        <tr role="row" class="filter">
                            <td>
                                <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control form-filter input-sm" readonly name="search_date_min" placeholder="Dari" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                                <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control form-filter input-sm" readonly name="search_date_max" placeholder="Sampai" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                        <input type="text" class="form-control timepicker timepicker-24" placeholder="min" name="search_time_min" >
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" value="" class="form-control timepicker timepicker-24" placeholder="max" name="search_time_max" value="" >
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                    </div>
                            </td>
                            <td><input type="text" class="form-control form-filter input-sm" name="search_number" /></td>
                            <td>
                                <select name="search_type" class="form-control form-filter input-sm">
                                    <option value=''>Pilih jenis assessment</option>
                                    <?php
                                        $assessment_types = get_assessment_type();
                                        if ($assessment_types || !empty($assessment_types)){
                                            $types = "";
                                            foreach($assessment_types as $row){
                                                $types .= '<option value="'.$row->id.'">'.$row->name.'</option>';
                                            }
                                            echo $types;
                                        } else {
                                            echo "<option value=''>Tidak ada pilihan assessment</option>";
                                        } ?>
                                </select>
                            </td>
                            <td><input type="text" class="form-control form-filter input-sm" name="search_position" /></td>
                            <td><input type="text" class="form-control form-filter input-sm" name="search_room" /></td>
                            <td><input type="text" class="form-control form-filter input-sm" name="search_status" /></td>
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
<div class="clearfix">
            </div>
            </div>
<!-- END PAGE HEADER