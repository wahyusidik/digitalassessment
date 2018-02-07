<?php 
$date = $assessment_report[0]->date;
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
$time = $assessment_report[0]->time;
$time = date('G:i', strtotime($time));
$data = array();
foreach ($assessment_report as $row ) {
    if(!isset($data[$row->id])) $data[$row->id]=array();
    array_push($data[$row->id],$row);
}
 ?>
<?php foreach ($assessment_report as $row ) { ?>
 <!--BEGIN CONFIGURATION MODAL FORM-->
<div class="modal fade evidencedetail" id="evidencedetail<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Detail Laporan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($row->type == 1 ): ?>
                        <ul class="nav nav-tabs">
                            <?php 
                            $active = 'active';?>
                            <li class="active">
                                <a href="#reportassessor<?php echo $row->id.$row->seat_number ?>" data-toggle="tab">
                                <?php echo $row->assessor_name; ?></a>
                            </li>
                            <?php
                            $part =  get_part_by_assessment($row->id_assessment);
                            $note_other = get_othernote_data($row->id_assessment);
                            if ($part) {
                                foreach ($part as $p) {
                                    if ($p->seat_number == $row->seat_number) continue; ?>
                                        <li class="">
                                            <a href="#reportassessor<?php echo $row->id.$p->seat_number ?>" data-toggle="tab">
                                            <?php echo $p->assessor_name; ?></a>
                                        </li>
                            <?php
                                }
                            } ?>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="reportassessor<?php echo $row->id.$row->seat_number; ?>">
                                <div class="col-md-12">
                                    <p><b>Observasi :</b></p>
                                <p>
                                    <?php echo $row->note_assesse; ?>
                                </p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>NILAI KOMPETENSI</b></p>
                                    <table class="table table-responsive table-bordered table-hover table-striped">
                                        <tr>
                                            <th>Nama Kompetensi</th>
                                            <th>Nilai</th>
                                            <th>Evidence</th>
                                        </tr>
                                <?php   
                                    $competences = get_competence_template($row->position);
                                    foreach ($competences as $competence) {
                                        $reportdata = $this->model_member->get_competence_report($row->id_assessment,$row->id,$competence->id); ?>
                                        <tr>
                                            <td><?php echo $reportdata->name;?></td>
                                            <td>Level <?php echo $reportdata->level;?></td>
                                            <td><?php echo $reportdata->evidence;?></td>
                                        </tr>
                                    <?php } ?>
                                    </table>
                                </div>
                            </div>
                            <?php
                            $part =  get_part_by_assessment($row->id_assessment);
                            $note_other = get_othernote_data($row->id_assessment);
                            if ($part) {
                                foreach ($part as $p) {
                                    if ($p->seat_number == $row->seat_number) continue; ?>
                                        <div class="tab-pane" id="reportassessor<?php echo $row->id.$p->seat_number;?>">
                                            <div class="col-md-12">
                                                <p><b>Observasi :</b></p>
                                                <p>
                                                    <?php echo $note_other[$row->seat_number][$p->seat_number];?>
                                                </p>
                                            </div>
                                        </div>
                            <?php
                                }
                            } ?>
                        </div>
                        <?php elseif($row->type == 2): ?>
                            <ul class="nav nav-tabs">
                                <?php 
                                $active = 'active';
                                $active_pan  = 'active in';
                                ?>
                                <?php foreach ($assessment_report as $r ) { ?>
                                    <li class="<?php echo $active; ?>">
                                        <a href="#reportassessor<?php echo $row->id.$r->id.$r->id_assessor?>" data-toggle="tab">
                                        <?php echo $r->assessor_name; ?></a>
                                    </li>
                                <?php
                                $active = '';
                                    }
                                ?>
                            </ul>
                            <div class="tab-content">
                            <?php foreach ($assessment_report as $ra ) { ?>
                            <div class="tab-pane <?php echo $active_pan; ?>" id="reportassessor<?php echo $row->id.$ra->id.$ra->id_assessor; ?>">
                                <div class="col-md-12">
                                    <p><b>Observasi :</b></p>
                                <p>
                                    <?php echo $ra->notes; ?>
                                </p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>NILAI KOMPETENSI</b></p>
                                    <table class="table table-responsive table-bordered table-hover table-striped">
                                        <tr>
                                            <th>Nama Kompetensi</th>
                                            <th>Nilai</th>
                                            <th>Evidence</th>
                                        </tr>
                                <?php   
                                    $competences = get_competence_template($row->position);
                                    foreach ($competences as $competence) {
                                        $reportdata = $this->model_member->get_competence_report($ra->id_assessment,$ra->id,$competence->id); ?>
                                         <tr>
                                            <td><?php echo $reportdata->name;?></td>
                                            <td>Level <?php echo $reportdata->level;?></td>
                                            <td><?php echo $reportdata->evidence;?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                </div>
                            </div>
                            <?php
                            $active_pan='';
                                } ?>
                            </div>
                        <?php endif ;?>
                           
                        <div class="clearfix margin-bottom-20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php } ?>
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
            <a href="#">Laporan Assessmentt</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Rangkuman Laporan Assessment <?php echo $assessment_report[0]->assessment_name; ?>
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
                        <div class="col-md-8">
                            <h3 class="form-section">Data Assessment</h3>

                            <div class="form-group2">
                                <label class="col-md-4 ">Nomor Assessment</label>
                                <label class="col-md-8 "> : <?php echo $assessment_report[0]->assessment_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jabatan / Tahun</label>
                                <label class="col-md-8 ">  : <?php echo $assessment_report[0]->position_name; ?> / <?php echo $assessment_report[0]->year; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Tanggal / Jam</label>
                                <label class="col-md-8 "> : <?php echo $date_info; ?> / <?php echo $time; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jenis</label>
                                <label class="col-md-8 "> : <?php echo $assessment_report[0]->assessment_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Ruang </label>
                                <label class="col-md-8 "> : <?php echo $assessment_report[0]->room; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Lead Assessor </label>
                                <label class="col-md-8 "> : <?php echo $assessment_report[0]->mod_name; ?></label>
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
                <table class="table table-bordered dataTable " id="datasummary">
                    <thead>
                        <tr>
                            <th width="40%"><center>Nama Assesse</center></th>
                            <?php $col = 0 ;?>
                            <?php if ($competences = get_competence_template($assessment_report[0]->position) ) {
                                    // print_r($competences);
                                    foreach ($competences as $competence) {?>
                                    <th><center><?php echo $competence->name; ?></center></th>
                                    <?php $col++; }
                                    ?>
                            <?php } elseif($report_comp = get_report_comp_report($assessment_report[0]->id_assessment,'admin')) { 
                                $parent = $report_comp['parent'];
                                $param = $report_comp['param'];
                                foreach ($parent as $p => $value) {?>
                                <th><center><?php echo $value; ?></center></th>
                            <?php $col++; } } ?>
                            <th width="40%"><center>Nama Assessor</center></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assessment_report as $row ) { ?>
                            <tr>
                            <td><a class="btn default" data-toggle="modal" href="#evidencedetail<?php echo $row->id?>"><?php echo $row->reg_name; ?></a></td>
                            <?php   
                                $competences = get_competence_template($row->position);
                                foreach ($competences as $competence) {
                                    $reportdata = $this->model_member->get_competence_report($row->id_assessment,$row->id,$competence->id); ?>
                                    <td><center><?php echo ($reportdata ? $reportdata->level : ''); ?></center></td>
                            <?php } ?>
                            <td><?php echo $row->assessor_name; ?></td>
                           </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php
if ($assessment_report[0]->form_type == 1 ) {
    $this->load->view(VIEW_BACK.'reporttooltype1');
} elseif ($assessment_report[0]->form_type == 2 ) {
    $this->load->view(VIEW_BACK.'reporttooltype2');
} 
 ?>

 <?php $this->load->view(VIEW_BACK.'reportcompetencetool'); ?>
<div class="clearfix">
            </div>
<!-- end form -->
<!-- END PAGE HEADER