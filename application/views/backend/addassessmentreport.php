<?php 
$date = $assessment->date;
$day = date('D', strtotime($date));
$month = date('M', strtotime($date));
$day_number = date('j', strtotime($date));
$year_number = date('Y', strtotime($date));
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);
$monthList = array(
    'Jan' => 'Januari',
    'Feb' => 'Februari',
    'Mar' => 'Maret',
    'Apr' => 'April',
    'May' => 'Mei',
    'Jun' => 'Juni',
    'Jul' => 'Juli',
    'Aug' => 'Agustus',
    'Sep' => 'September',
    'Oct' => 'Oktober',
    'Nov' => 'November',
    'Dec' => 'Desember',
);
$day_name = $dayList[$day];
$month_name = $monthList[$month];
$date_info = $day_name.', '.$day_number.' '.$month_name.' '.$year_number;
$time = $assessment->time;
$time = date('G:i', strtotime($time));
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
            <a href="#">Laporan Assessment</a>
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
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                </div>
            </div>
            <div class="portlet-body">
                <div id="assessmentdata" class="clearfix form-horizontal">
                    <div class="assessmentinfo">
                        <div class="col-md-6">
                            <h3 class="form-section">Data Assesse</h3>

                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Pendaftaran  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->reg_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nama Assesse  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->reg_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Urut  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->seat_number; ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="form-section">Data assessment</h3>

                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Nomor Assessment  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->assessment_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Jabatan / Tahun  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->position_name; ?> / <?php echo $assessment->year; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Tanggal / Jam  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12" ><?php echo $date_info; ?> / <?php echo $time; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Jenis  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->assessment_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 col-sm-4 col-xs-12">Ruang  <span style="float:right" > : </span></label>
                                <label class="col-md-8 col-sm-8 col-xs-12"><?php echo $assessment->room; ?></label>
                            </div>
                        </div>
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
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR PENCATATAN DAN PENILAIAN DISKUSI
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="table-container">
                    <form role="form" class="addreportform" action="<?php echo base_url()?>backend/addreportact" method="POST" enctype="multipart/form-data" data-type ="<?php echo $assessment->form_type ;?>">
                        <input type="hidden" name="id_assessment_data" value="<?php echo $assessment->id; ?>">
                        <input type="hidden" name="id_assessment" value="<?php echo $assessment->id_assessment; ?>">
                        <input type="hidden" name="assessment_type" value="<?php echo $assessment->type; ?>">
                        <input type="hidden" name="id_assessor" value="<?php echo $assessment->id_assessor; ?>">
                        <input type="hidden" name="form_type" value="<?php echo $assessment->form_type; ?>">

                        <div class="form-body">
                            <div id="message_error" class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                            </div>
                            <div id="message_success" class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button>
                                Validasi formulir Anda berhasil! Data PIN sudah dibuat.
                            </div>
                            <?php 
                            if ($assessment->form_type == 1 ) {
                                $this->load->view(VIEW_BACK.'reporttype1');
                            } elseif ($assessment->form_type == 2 ) {
                                $this->load->view(VIEW_BACK.'reporttype2');
                            }
                             ?>
                            <!-- end form -->
                            <div class="clearfix">
                            </div>
                            <!-- begin form -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Begin: life time stats -->
                                    <div class="portlet box blue">
                                        <div class="portlet-title">
                                            <div class="caption">Form Penilaian Kompetensi
                                            </div>
                                        </div>
                                        <div class="portlet-body clearfix form">
                                            <div class="col-md-12"">
                                                <div class="table-container comp-form"  id="">
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
                                                        if ( $assessment->status < 1) {
                                                        $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($assessment->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {
                                                                $competence = $this->model_member->get_competence($id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $row ) {
                                                                    $count = $child+1;
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$row->level.'" class="icheck level" data-radio="iradio_flat-grey" required oninvalid="this.setCustomValidity(&apos;Please Enter valid email&apos;)"
                                                                                                 oninput="setCustomValidity(&apos;&apos;)">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$row->definition.'" data-original-title="Keterangan">'.$count.'. '.$row->title.'<p>
                                                                                    </td>
                                                                                    <td width="50%"><textarea type="text" name="paramtext['.$competence->id.']['.$row->level.']" class="form-control" placeholder="Keterangan" value="" disabled  style="resize:vertical"></textarea></td>
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
                                                            $competencedata =  $this->model_member->get_competence_profil($assessment->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {

                                                                $competence = $this->model_member->get_competence($id);
                                                                $competencereport = $this->model_member->get_competence_report($assessment->id_assessment,$assessment->id,$competence->id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $row ) {
                                                                    $count = $child+1;
                                                                    $selected = ($competencereport->level == $row->level ? 'checked="checked"' : '');
                                                                    $text = ($competencereport->level == $row->level ? $competencereport->evidence : '');
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$row->level.'" class="icheck level" data-radio="iradio_flat-grey"'.$selected.' disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$row->definition.'" data-original-title="Keterangan">'.$count.'. '.$row->title.'<p>
                                                                                    </td>
                                                                                    <td width="50%"><textarea style="resize:vertical" type="text" name="paramtext['.$competence->id.']['.$row->level.']" class="form-control" placeholder="Keterangan" value="" readonly style="resize:vertical">'.$text.'</textarea></td>
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
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php if ( $assessment->status < 1) { ?>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn green">Simpan</button>
                                    <!-- <button type="button" class="btn default">Cancel</button> -->
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>


<!-- END PAGE HEADER