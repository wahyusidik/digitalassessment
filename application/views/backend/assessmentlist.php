
            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
            Data Assessment
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?php echo base_url();?>backend">Beranda</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Assessment</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Data Assessment</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">Data Daftar Assessment
                                
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container" id="doclist">
                                <div id="message_error" class="alert alert-danger display-hide">
                                </div>
                                <div id="message_success" class="alert alert-success display-hide">
                                </div>
                                <!-- <div class="table-actions-wrapper">
                                    <span>
                                    </span>
                                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                                        <option value="">Select...</option>
                                        <option value="Cancel">Cancel</option>
                                        <option value="Cancel">Hold</option>
                                        <option value="Cancel">On Hold</option>
                                        <option value="Close">Close</option>
                                    </select>
                                    <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                                </div> -->
                                    <div class="table-actions-wrapper">
                                
                                </div>
                                 <table class="table table-striped table-bordered table-advance dataTable table-hover" id="listassessment" data-url="<?php echo base_url('backend/assessmentlistdata/'); ?>">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%" style="text-align: center;">Nomor</th>
                                <th width="10%" style="text-align: center;">Jenis</th>
                                <th width="10%" style="text-align: center;">Tanggal</th>
                                <th width="15%" style="text-align: center;">Jam</th>
                                <th width="15%" style="text-align: center;">Ruangan</th>
                                <th width="15%" style="text-align: center;">Aksi</th>
                                    </tr>
                                    <tr role="row" class="filter">
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
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_room" /></td>
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
                    <!-- End: life time stats -->
                </div>
            </div>
            <!-- END PAGE CONTENT-->