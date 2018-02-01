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
            <a href="#">Laporan assessment_report</a>
        </li>
    </ul>
    <!-- <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm btn-default" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div> -->
</div>
<h3 class="page-title">
Laporan Akhir Assessment
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
                                <label class="col-md-8 ">  : <?php echo $assessment_report[0]->position; ?> / <?php echo $assessment_report[0]->year; ?></label>
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
                                <label class="col-md-4 ">Moderator </label>
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
                <div class="caption text-center">RANGKUMAN NILAI DISKUSI
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
                            <?php if ($report_comp = get_report_comp($assessment_report[0]->id_assessment,'all')) { ?>
                                <?php
                                $parent = $report_comp['parent'];
                                $param = $report_comp['param'];
                                foreach ($parent as $p => $value) {?>
                                <th><center><?php echo $value; ?></center></th>
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
                            <?php $colp = 0 ?>

                            <?php   if ($report_comp_data=get_report_comp_report($row->id_assessment,'all',$row->id)):
                                    $parentdata = $report_comp_data['parent'];
                                    $paramdata = $report_comp_data['param'];
                                    // var_dump($paramdata);
                                    ?>
                            <tr style=" text-align: center;">
                                <td><?php echo $row->reg_name; ?></td>
                                <?php foreach ($parentdata as $p => $value) {?>
                                <td><center><?php echo ($paramdata[$value]['field'] ? $paramdata[$value]['field'] : '') ;?></center></td>
                                <?php $colp++; }?>
                                <?php while($colp<$col){ echo '<td></td>'; $colp++;}?>
                                <td><?php echo $row->assessor_name; ?></td>
                            </tr>
                            <?php elseif ($report_comp = get_report_comp_report($row->id_assessment,'admin')) :

                                    $parentdata = $report_comp['parent'];
                                    $paramdata = $report_comp['param'];
                                    ?>
                            <tr style=" text-align: center;">
                                <td><?php echo $row->reg_name; ?></td>
                                <?php foreach ($parentdata as $p => $value) {?>
                                <!-- <td><center><?php echo ($paramdata[$value]['field'] ? $paramdata[$value]['field'] : '') ;?></center></td> -->
                                <td><center></center></td>
                                <?php $colp++; }?>
                                <?php while($colp<$col){ echo '<td></td>'; $colp++;}?>
                                <td><center><?php echo $row->assessor_name; ?></center></td>
                            </tr>
                        <?php endif ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
if ($assessment_report[0]->type == 1 ) {
    $this->load->view(VIEW_BACK.'reportfinallgd');
} elseif ($assessment_report[0]->type == 2 ) {
    $this->load->view(VIEW_BACK.'reportfinalwwc');
} elseif ($assessment_report[0]->type ==  3) {
    $this->load->view(VIEW_BACK.'reportfinalgames');
}
 ?>
<!-- end form -->
<!-- END PAGE HEADER