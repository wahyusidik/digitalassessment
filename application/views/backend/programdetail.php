
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
            Data Peserta Program Assessment
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
                        <a href="#">Data Peserta Program Assessment</a>
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
                            <div class="caption">Data Peserta Program Assessment
                                
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
                                 <table class="table table-striped table-bordered table-advance dataTable table-hover" id="programdetail" data-url="<?php echo base_url('backend/programdetaildata/'.$id_program); ?>">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%" style="text-align: center;">Nomor</th>
                                <th width="10%" style="text-align: center;">Judul</th>
                                <th width="10%" style="text-align: center;">Jabatan</th>
                                <th width="10%" style="text-align: center;">Nomor Peserta</th>
                                <th width="10%" style="text-align: center;">Nama Peserta</th>
                                <th width="15%" style="text-align: center;">Aksi</th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_number" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_title" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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