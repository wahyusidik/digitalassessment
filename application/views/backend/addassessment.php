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
						<a href="#">Tambah Assesment</a>
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
                        	<div class="caption">Tambah Assesment
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

								<form role="form" id="addassessment" action="<?php echo base_url()?>backend/addassessmentact" method="POST" enctype="multipart/form-data" class="form-horizontal">
									<div class="form-body">
                                        <div id="message_error" class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                                        </div>
                                        <div id="message_success" class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Validasi formulir Anda berhasil! Data PIN sudah dibuat.
                                        </div>
                                        <h3 class="form-section">Data Program Assesment</h3>
                                        <div class="form-group">
											<label class="col-md-3 control-label">Pilih Program</label>
											<div class="col-md-4">
												<select class="form-control" name="program" id="program" data-url="<?php echo base_url('backend/getprogramposition'); ?>" data-position="<?php echo base_url('backend/getprogramposition'); ?>">
                			                        <?php
                			                        	$programs = $this->model_member->get_data('assessment_program');
                			                        	$prog='';
                			                        	foreach ($programs as $row ) {
                			                        		$prog .= '<option value="'.$row->id.'">'.$row->title.'</option>';
                			                        	}
                			                        	echo $prog;
                			                        	?>
                			                    </select>
											</div>
										</div>
                                        <h3 class="form-section">Data Assesment</h3>
                                        <div class="form-group">
											<label class="col-md-3 control-label">Nomor</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="number" placeholder="Nomor Assessment" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Jabatan</label>
											<div class="col-md-4">
												<input type="hidden" class="form-control programposition" data-live-search="true" name="position" id="position" placeholder="Jabatan" data-url="<?php echo base_url('backend/getcompetence'); ?>" search-url="<?php echo base_url('backend/getprogramposition'); ?>" data-tools="<?php echo base_url('backend/getpositiontools'); ?>">
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
										<div class="form-group">
											<label class="col-md-3 control-label">Jenis</label>
											<div class="col-md-4">
												<select class="form-control positiontools" name="type" id="type" data-url="<?php echo base_url('backend/getformpart'); ?>" >
													<?php 
													$tooloption = '<option value="">Pilih jenis assessment</option>';
													$tools = get_assessment_type();
													if ($tools){
														foreach ($tools as $tools ) {
															$tooloption .= '<option value="'.$tools->id.'">'.$tools->name.'</option>';
														}
													} else{
														$tooloption .= '<option value=""> Tidak ada pilihan tool</option>';
													}
													echo $tooloption;
													?>
													
												</select>
												<!-- <input type="hidden" class="form-control positiontools" name="type" id="type" data-url="<?php echo base_url('backend/getformpart'); ?>" search-url="<?php echo base_url('backend/getpositiontools'); ?>"> -->
											</div>
										</div>
                                        <h3 class="form-section">Informasi Waktu dan Tempat Pelaksanaan</h3>
										<div class="form-group">
                                            <label class="control-label col-md-3">Tanggal</label>
                                            <div class="col-md-3">
                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                    <input type="text" class="form-control" name="date"  >
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
											<label class="control-label col-md-3">Jam</label>
											<div class="col-md-3">
												<div class="input-group">
													<input type="text" class="form-control timepicker timepicker-24" name="time" >
													<span class="input-group-btn">
													<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Ruangan</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="room" placeholder="Ruangan" >
											</div>
										</div>
                                        <h3 class="form-section">Data Peserta</h3>
                                        <div class="partlist" id="partlist">
                                        	<h5> Silakan Pilih Tipe Assessment Terlebih Dahulu</h5>
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