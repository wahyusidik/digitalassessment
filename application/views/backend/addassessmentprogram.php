<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="save_assesment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Simpan Data Assesment ?</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue" id="do_save_assesment">Simpan</button>
							<button type="button" class="btn default" data-dismiss="modal">Batal</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">Assesment</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>backend">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Assessment</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Tambah Program Assesment</a>
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
                        	<div class="caption">Tambah Program Assesment
	                        </div>
	                    </div>
						<div class="portlet-body form">
							<div class="table-container" id="">
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

								<form role="form" id="addassessmentprogram" action="<?php echo base_url()?>backend/addassessmentprogramact" method="POST" enctype="multipart/form-data" class="form-horizontal">
									<div class="form-body">
                                        <div id="message_error" class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                                        </div>
                                        <div id="message_success" class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Validasi formulir Anda berhasil! Data PIN sudah dibuat.
                                        </div>
                                        <h3 class="form-section">Data Assesment</h3>
                                        <div class="form-group">
											<label class="col-md-3 control-label">Nomor</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="number" placeholder="Nomor Program Assessment" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Judul Program</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="title" placeholder="Judul Program Assessment" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Jabatan</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="position" placeholder="Jabatan" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Tahun</label>
											<div class="col-md-4">
												<select class="form-control" name="year" id="year">
                			                        <?php
                			                        	$year = date('Y');
                			                        	$years='';
                			                        	for ($i=$year; $i < $year+5; $i++) { 
                			                        		$years .= '<option value="'.$i.'">'.$i.'</option>';
                			                        	}
                			                        	echo $years;
                			                        	?>
                			                    </select>
											</div>
										</div>
                                        <h3 class="form-section">Informasi Waktu Pelaksanaan</h3>
										<div class="form-group">
											<label class="control-label col-md-3">Tanggal</label>
											<div class="col-md-4">
												<div class="input-group input-large date-picker input-daterange" data-date-format="yyyy/mm/dd">
													<input type="text" class="form-control" name="datestart">
													<span class="input-group-addon">
													Sampai </span>
													<input type="text" class="form-control" name="dateend">
												</div>
												<!-- /input-group -->
												<span class="help-block">
												Pilih tanggal </span>
											</div>
										</div>
                                        <h3 class="form-section">Periode Unggah Dokumen Persyaratan</h3>
                                        <div class="form-group">
											<label class="control-label col-md-3">Tanggal</label>
											<div class="col-md-4">
												<div class="input-group input-large date-picker input-daterange" data-date-format="yyyy/mm/dd">
													<input type="text" class="form-control" name="uploadstart">
													<span class="input-group-addon">
													Sampai </span>
													<input type="text" class="form-control" name="uploadend">
												</div>
												<!-- /input-group -->
												<span class="help-block">
												Pilih tanggal </span>
											</div>
										</div>
                                        <h3 class="form-section">Daftar Dokumen Peryaratan</h3>
                                        <div class="doc-list" id="doc-list">
	                                        <div class="form-group doc-item">
												<label class="col-md-3 control-label"> <a class="closerowdoc" data-close="doc-item">x</a> Dokumen</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="docs[]" placeholder="Jenis Dokumen" >

												</div>
											</div>
						                </div>
						                <a href="javascript:;" class="btn green addrowdoc">
						                        <i class="fa fa-plus"></i> Tambah Dokumen Persyaratan
						                    </a>
                                        <h3 class="form-section">Pilihan Tools</h3>
						                <div class="form-group">
										<label class="control-label col-md-3">Pilih Tools yang Digunakan</label>
										<div class="col-md-4">
											<select id="toolsmultiselect" name="tools[]" class="form-control select2" multiple>
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
                                            </div>
                                        </div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-12 text-center">
												<button type="submit" class="btn green">Simpan</button>
												<button type="button" class="btn default">Cancel</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>