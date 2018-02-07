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
Laporan Akhir Program <?php echo $program->title; ?>
</h3>

<div class="clearfix">
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    Laporan Program Assessment
                </div>
            </div>
            <div class="portlet-body">
                <div role="form" id="assessment_reportdata" action="" class="clearfix form-horizontal">
                    <div class="form-body">
                        <div class="col-md-8">
                            <h3 class="form-section">Data Program</h3>

                            <div class="form-group2">
                                <label class="col-md-4 ">Nomor Program Assessment</label>
                                <label class="col-md-8 "> : <?php echo $program->number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Judul Program Assessment</label>
                                <label class="col-md-8 "> : <?php echo $program->title; ?></label>
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
<?php if ($program_report):?>
    <?php
    $position = array();

    foreach ($program_report as $report) {
        if(!in_array($report->position, $position)){
            array_push($position, $report->position);
        }
    }
 ?>
<?php 
$id_program = $program_report[0]->id_program;
foreach ($position as $pos) {

        $programdata = $this->model_member->get_report_program($id_program,'',$pos);
  ?>
    <div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue-steel">
            <div class="portlet-title">
                <div class="caption text-center">RANGKUMAN NILAI AKHIR KOMPETENSI POSISI <?php echo strtoupper($programdata[0]->position_name); ?>
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
                            <?php if ($competences = get_competence_template($programdata[0]->position) ) {
                                    // print_r($competences);
                                    foreach ($competences as $competence) {?>
                                    <th><center><?php echo $competence->name; ?></center></th>
                                    <?php $col++; }
                                    ?>
                            <?php } elseif($report_comp = get_report_comp_report($programdata[0]->id_assessment,'admin')) { 
                                $parent = $report_comp['parent'];
                                $param = $report_comp['param'];
                                foreach ($parent as $p => $value) {?>
                                <th><center><?php echo $value; ?></center></th>
                            <?php $col++; } } ?>
                            <th width="40%"><center>Nama Lead</center></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($programdata as $row ) { ?>
                            <tr>
                            <td><?php echo $row->reg_name; ?></td>
                            <?php   
                                $competences = get_competence_template($row->position);
                                foreach ($competences as $competence) {
                                    $reportdata = $this->model_member->get_competence_report_final($row->id_program,$row->id_registration,$competence->id); ?>
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
<?php } ?>
<?php else: ?>
    <h4> Belum ada data laporan</h4>
<?php endif ?>
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
<!-- end form -->
<!-- END PAGE HEADER