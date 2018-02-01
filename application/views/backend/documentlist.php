
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
			Data Dokumen Pendaftaran
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>backend">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Pendaftaran</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Data Dokumen</a>
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
	                        <div class="caption">Data Dokumen Registrasi
	                            
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
								<?php if ($id_reg != 0 ) : ?>
									<div class="table-actions-wrapper">
                                <a href="<?php echo base_url('backend/documentlist'); ?>" class="btn btn-success">Back</a>
                            	</div>
								 <table class="table table-striped table-bordered table-advance dataTable table-hover" id="list_my_document" data-url="<?php echo base_url('backend/user_documentlist/' . $id_reg); ?>">
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
                        <?php else : ?>
                        	<table class="table table-striped table-bordered table-advance dataTable table-hover" id="list_document" data-url="<?php echo base_url('backend/user_documentlist/'); ?>">
                                <thead>
        							<tr role="row" class="heading">
                                        <th width="5%" style="text-align: center;">Nomor</th>
                                        <th width="10%" style="text-align: center;">Nama</th>
                                        <th width="10%" style="text-align: center;">Posisi</th>
                                        <th width="15%" style="text-align: center;">Aksi</th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_number" /></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="search_name" /></td>
        								<td><input type="text" class="form-control form-filter input-sm" name="search_position" /></td>
        								<td style="text-align: center;">
                                            <button class="btn btn-sm blue filter-submit margin-bottom" id="mydoc_btn"><i class="fa fa-search"></i> Search</button>
                                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Reset</button>
        								</td>
        							</tr>
                                </thead>
                                <tbody><!-- Data Will Be Placed Here --></tbody>
                            </table>
                        <?php endif ?>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->