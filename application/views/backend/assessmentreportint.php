<?php 
// $date = $assessment_report[0]->date;
// $day = date('D', strtotime($date));
// $month = date('M', strtotime($date));
// $day_number = date('j', strtotime($date));
// $year_number = date('Y', strtotime($date));
// $dayList = array(
//     'Sun' => 'Minggu',
//     'Mon' => 'Senin',
//     'Tue' => 'Selasa',
//     'Wed' => 'Rabu',
//     'Thu' => 'Kamis',
//     'Fri' => 'Jumat',
//     'Sat' => 'Sabtu'
// );
// $monthList = array(
//     'Jan' => 'Januari',
//     'Feb' => 'Februari',
//     'Mar' => 'Maret',
//     'Apr' => 'April',
//     'May' => 'Mei',
//     'Jun' => 'Juni',
//     'Jul' => 'Juli',
//     'Aug' => 'Agustus',
//     'Sep' => 'September',
//     'Oct' => 'Oktober',
//     'Nov' => 'November',
//     'Dec' => 'Desember',
// );
// $day_name = $dayList[$day];
// $month_name = $monthList[$month];
// $date_info = $day_name.', '.$day_number.' '.$month_name.' '.$year_number;
// $time = $assessment_report[0]->time;
// $time = date('G:i', strtotime($time));
 ?>
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
            <a href="#">Laporan Integrasi</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Laporan Integrasi Gabungan
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
                <div role="form" id="assessment_reportdata" action="" class="clearfix form-horizontal">
                    <div class="form-body">
                        <div class="col-md-6">
                            <?php if($reportint):?>
                            <h3 class="form-section">Data Assesse</h3>

                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Peserta <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $reportint[0]->reg_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Peserta <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $reportint[0]->reg_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Jabatan / Tahun  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $reportint[0]->reg_position; ?> / <?php echo $reportint[0]->program_year; ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="form-section">Data Program</h3>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Program  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $reportint[0]->program_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Judul Program  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $reportint[0]->program_title; ?></label>
                            </div>
                        </div>
                    <?php else:?>
                        <h3>Belum ada data</h3>
                    <?php endif?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
    </div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption text-center">RANGKUMAN NILAI KOMPETENSI 
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
            <?php 
            $compe = array();

            if ($reportint):?>
                <?php $competences = $this->model_member->get_competence_report_int($reportint[0]->id_program,$reportint[0]->reg_id);?>
                <?php if($competences):?>
                <?php
                    $tools['type'] = array();
                    $tools['name'] = array();
                 foreach ($competences as $competence) {
                    if(!in_array($competence->assessment_type,$tools['type'])){
                        array_push($tools['type'], $competence->assessment_type);
                        array_push($tools['name'], $competence->assessment_name);
                    }
                    if(!in_array($competence->competence_name, $compe)){
                        $compe[$competence->competence_name]=array();
                    }
                }
                    // var_dump($comp); 

                ?>
                <table class="table table-bordered dataTable " id="datasummary">
                    <thead>
                        <tr>
                            <th width="40%"><center>Nama Kompetensi</center></th>
                            <?php 
                            $count = sizeof($tools['name']);
                            $comp = array();
                            // var_dump($count);
                            for($i=0;$i<$count;$i++) { ?>
                            <th width="15%"><center><?php echo $tools['name'][$i];?></center></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $level = array();
                        foreach ($competences as $row ) {
                                    foreach ($tools['type'] as $key) {
                                            // $comp['comp'] = $
                                            // $comp[$key] = $row->level;
                                            if ($key == $row->assessment_type){
                                                $level[$key] = $row->level;
                                            }
                                    }
                                    $compe[$row->competence_name] = $level;
                                }
                        foreach ($compe as $competence_name => $arrlevel) {?>
                           <tr>
                            <td><?php echo $competence_name; ?></td>
                                <?php foreach ($arrlevel as $level) {?>
                                   <td><?php echo $level; ?></td>
                                
                        <?php }}
                         ?>
                            
                    </tbody>
                </table>
                <?php else:?>
                    <h4>Belum ada data</h4>
                <?php endif;?>
            <?php else:?>
                <h3> Belum ada data </h3>
            <?php endif ?>
            </div>
        </div>
    </div>
</div>


<?php
// if ($assessment_report[0]->form_type == 1 ) {
//     $this->load->view(VIEW_BACK.'reporttooltype1');
// } elseif ($assessment_report[0]->form_type == 2 ) {
//     $this->load->view(VIEW_BACK.'reporttooltype2');
// } 
 ?>

 <?php 
 // $this->load->view(VIEW_BACK.'reportcompetencetool'); ?>
<div class="clearfix">
            </div>
<?php if($reportint):?>
<?php if($user->id == $reportint[0]->id_moderator ): ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">Laporan Integrasi Gabungan
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body clearfix">
                <?php 
                // if ($assessment_report[0]->form_type == 1 ):
                $row = $reportint[0] ?>
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
                            <form role="form" class="addreportfinal" id="addreportint" action="<?php echo base_url()?>backend/addreportfinalintact" method="POST" enctype="multipart/form-data" >
                                <input type="hidden" name="id_assessment_data" value="<?php echo $row->id; ?>">
                                <input type="hidden" name="id_assessment" value="<?php echo $row->id_assessment; ?>">
                                <!-- <input type="hidden" name="assessment_type" value="<?php echo $row->type; ?>"> -->
                                <!-- <input type="hidden" name="id_assessor" value="<?php echo $row->id_assessor; ?>"> -->
                                <!-- <input type="hidden" name="id_moderator" value="<?php echo $row->id_moderator; ?>"> -->
                                <input type="hidden" name="id_registration" value="<?php echo $row->id_registration; ?>">
                                <input type="hidden" name="id_program" value="<?php echo $row->id_program; ?>">
                                <!-- <input type="hidden" name="form_type" value="<?php echo $row->form_type; ?>"> -->
                                

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
                                                        if ( $row->reg_status < 4) {
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
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey" required oninvalid="this.setCustomValidity(&apos;Please Enter valid email&apos;)"
                                                                                                 oninput="setCustomValidity(&apos;&apos;)">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
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
                                                                $competencereport = $this->model_member->get_competence_report_final($row->id_program,$row->id_registration,$competence->id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $selected = ($competencereport->level == $lev->level ? 'checked="checked"' : '');
                                                                    $text = ($competencereport->level == $lev->level ? $competencereport->evidence : '');
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey"'.$selected.' disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
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
                                if ( $row->reg_status < 4) {
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
<?php endif?>
<!-- end form -->
<!-- END PAGE HEADER