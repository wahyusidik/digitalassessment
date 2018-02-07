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
        <li>
            <a href="#">Laporan Integrasi Assessment</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Laporan Integrasi Assessment
</h3>
<div class="clearfix">
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box green-haze">
            <!-- BEGIN UPLOAD -->
            <div class="portlet-title ">
                <div class="caption">
                    
                </div>
            </div>            
            <div class="portlet-body util-btn-margin-bottom-5">
                <table class="table table-striped table-bordered table-advance dataTable table-hover" id="myassessment" data-url="<?php echo base_url('backend/assessmentmine/').$user->id.''; ?>">
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
<?php if($user->id == $assessment_report[0]->id_moderator ): ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <?php if($assessment_report[0]->assessment_status >= 1):?>

        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">Laporan Individu Assessment
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body clearfix">
                <?php if ($assessment_report[0]->form_type == 1 ): ?>
                <!-- <?php foreach ($assessment_report as $row) { ?> -->
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption text-center">Laporan Integrasi Peserta
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title=" " title="buka/tutup">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" class="addreportfinal" id="addreportint" action="<?php echo base_url()?>backend/addreportintact" method="POST" enctype="multipart/form-data" >
                                <input type="hidden" name="id_assessment_data" value="<?php echo $row->id; ?>">
                                <input type="hidden" name="id_assessment" value="<?php echo $row->id_assessment; ?>">
                                <input type="hidden" name="assessment_type" value="<?php echo $row->type; ?>">
                                <input type="hidden" name="id_assessor" value="<?php echo $row->id_assessor; ?>">
                                <input type="hidden" name="id_moderator" value="<?php echo $row->id_moderator; ?>">
                                <input type="hidden" name="id_registration" value="<?php echo $row->id_registration; ?>">
                                <input type="hidden" name="id_program" value="<?php echo $row->id_program; ?>">
                        <input type="hidden" name="form_type" value="<?php echo $row->form_type; ?>">
                                

                                <div class="form-body">
                                    <div id="message_error" class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                                    </div>
                                    <div id="message_success" class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button>
                                        Validasi formulir Anda berhasil! Data PIN sudah dibuat.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table parentfield-table addassessment-table">
                                                        <thead>
                                                            <tr>
                                                                <th width="5%"></th>
                                                                <th  width="40%">
                                                                    Nama Kompetensi
                                                                </th>
                                                                <th width="50%">
                                                                    Nilai
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="parentfieldreport">
                                                        <?php
                                                        if ( $row->status < 2) {
                                                        $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {
                                                                $competence = $this->model_member->get_competence($id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey" required oninvalid="this.setCustomValidity(&apos;Please Enter valid email&apos;)"
                                                                                                 oninput="setCustomValidity(&apos;&apos;)">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                    <td><textarea type="text" name="paramtext['.$competence->id.']['.$lev->level.']" class="form-control" placeholder="Keterangan" value="" disabled  style="resize:vertical"></textarea></td>
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td>
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            } else {

                                                            $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {

                                                                $competence = $this->model_member->get_competence($id);
                                                                $competencereport = $this->model_member->get_competence_report_tool($row->id_assessment,$row->id_registration,$competence->id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $selected = ($competencereport->level == $lev->level ? 'checked="checked"' : '');
                                                                    $text = ($competencereport->level == $lev->level ? $competencereport->evidence : '');
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey"'.$selected.' disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                    <td><textarea style="resize:vertical" type="text" name="paramtext['.$competence->id.']['.$lev->level.']" class="form-control" placeholder="Keterangan" value="" readonly style="resize:vertical">'.$text.'</textarea></td>
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td>
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            }?>
                                                        </tbody>
                                                    </table>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                if ( $row->status <= 2) {
                                    echo '
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn green">Simpan</button>
                                                <!-- <button type="button" class="btn default">Cancel</button> -->
                                            </div>
                                        </div>
                                    </div>';
                                } else{
                                    echo '';
                                }
                                    ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <!-- <?php } ?> -->
            <?php endif?>
            </div>
        </div>
    <?php else: ?>
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR Laporan Assessment - LAPORAN BELUM LENGKAP
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
    </div> 
</div>
<?php endif ?>
<!-- END PAGE HEADER