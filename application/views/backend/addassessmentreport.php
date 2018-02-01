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
                                <label class="col-md-4 ">Nomor Pendaftaran</label>
                                <label class="col-md-8 "> : <?php echo $assessment->reg_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Nama Assesse</label>
                                <label class="col-md-8 "> : <?php echo $assessment->reg_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Nomor Urut</label>
                                <label class="col-md-8 "> : <?php echo $assessment->seat_number; ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="form-section">Data assessment</h3>

                            <div class="form-group2">
                                <label class="col-md-4 ">Nomor Assessment</label>
                                <label class="col-md-8 "> : <?php echo $assessment->assessment_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jabatan / Tahun</label>
                                <label class="col-md-8 ">  : <?php echo $assessment->position; ?> / <?php echo $assessment->year; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Tanggal / Jam</label>
                                <label class="col-md-8 "> : <?php echo $date_info; ?> / <?php echo $time; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jenis</label>
                                <label class="col-md-8 "> : <?php echo $assessment->assessment_name; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Ruang </label>
                                <label class="col-md-8 "> : <?php echo $assessment->room; ?></label>
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
                    <form role="form" class="addreportform" action="<?php echo base_url()?>backend/addreportact" method="POST" enctype="multipart/form-data" >
                        <input type="hidden" name="id_assessment_data" value="<?php echo $assessment->id; ?>">
                        <input type="hidden" name="id_assessment" value="<?php echo $assessment->id_assessment; ?>">
                        <input type="hidden" name="assessment_type" value="<?php echo $assessment->type; ?>">
                        <input type="hidden" name="id_assessor" value="<?php echo $assessment->id_assessor; ?>">

                        <div class="form-body">
                            <div id="message_error" class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                Anda memiliki beberapa kesalahan. Silakan cek di formulir bawah ini!
                            </div>
                            <div id="message_success" class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button>
                                Validasi formulir Anda berhasil! Data PIN sudah dibuat.
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
                                                        <tbody class="parentfield">
                                                            <?php if ($assessment->status < 1 ) : ?>
                                                                <?php if ($report_comp = get_report_comp($assessment->id_assessment,'admin')) : ?>
                                                                    <?php
                                                                    $parent = $report_comp['parent'];
                                                                    $param = $report_comp['param'];
                                                                    foreach ($parent as $p => $key ) {?>
                                                                        <tr class="parentfielditem">
                                                                            <td><a class="closeparent close" data-close="parentfielditem"></a></td>
                                                                            <td><input type="text" class="form-control" name="parent[<?php echo $p;?>]" placeholder="Nama Kompetensi" value="<?php echo $key;?>"></td>
                                                                            <td>
                                                                                <table class="table paramfield-table radio-list" >
                                                                                    <tbody class="paramfield" parent="<?php echo $p;?>" child="<?php echo sizeof($param[$key]);?>">
                                                                                        <?php foreach ($param[$key] as $pr => $value) {?>
                                                                                        <tr class="paramfielditem">
                                                                                            <td>
                                                                                                <div class="input-group">
                                                                                                    <div class="icheck-list">
                                                                                                        <input type="radio" id="level<?php echo $p.$pr;?>" name="level[<?php echo $p;?>][]" value="<?php echo $value['field'];?>" class="icheck" data-radio="iradio_flat-grey">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="param[<?php echo $p;?>][]" id-radio="level<?php echo $p.$pr;?>" class="form-control level-title" placeholder="Nama Level" value="<?php echo $value['field'];?>">
                                                                                            </td>
                                                                                            <td><textarea type="text" name="paramtext[<?php echo $p;?>][]" class="form-control" placeholder="Keterangan" value="<?php echo $value['field_text'];?>"><?php echo $value['field_text'];?></textarea></td>
                                                                                            <!-- <td><a class="closeparam close" data-close="paramfielditem"></a></td> -->
                                                                                        </tr>
                                                                                        <?php }?>
                                                                                    </tbody>
                                                                                </table>
                                                                                <!-- <a href="javascript:;" class="btn btn-icon-only green addrowparam"><i class="fa fa-plus"></i></a> -->
                                                                            </td>   
                                                                        </tr>
                                                                     <?php } ?>
                                                                <?php else :?>
                                                                <tr class="parentfielditem">
                                                                    <td><a class="closeparent close" data-close="parentfielditem"></a></td>
                                                                    <td><input type="text" class="form-control" name="parent[0]" placeholder="Nama Kompetensi" value=""></td>
                                                                    <td>
                                                                        <table class="table paramfield-table radio-list" >
                                                                            <tbody class="paramfield" parent="0" child="1">
                                                                                <?php for ($i=0; $i < 5; $i++) { ?>
                                                                                   <tr class="paramfielditem">
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level0<?php echo $i;?>" name="level[0][]" value="" class="icheck" data-radio="iradio_flat-grey">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" name="param[0][]" id-radio="level0<?php echo $i;?>" class="form-control level-title" placeholder="Nama Level" value="">
                                                                                    </td>
                                                                                    <td><textarea type="text" name="paramtext[0][]" class="form-control" placeholder="Keterangan" value=""></textarea></td>
                                                                                    <!-- <td><a class="closeparam close" data-close="paramfielditem"></a></td> -->
                                                                                </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                        <!-- <a href="javascript:;" class="btn btn-icon-only green addrowparam"><i class="fa fa-plus"></i></a> -->
                                                                    </td>   
                                                                </tr>
                                                                <?php endif?>
                                                            <?php else:?>
                                                                <?php if ($report_comp = get_report_comp($assessment->id_assessment,$assessment->id_assessor,$assessment->id)) : ?>
                                                                    <?php
                                                                    $parent = $report_comp['parent'];
                                                                    $param = $report_comp['param'];
                                                                    foreach ($parent as $p => $key ) {?>
                                                                        <tr class="parentfielditem">
                                                                            <td><a class="closeparent hide close" data-close="parentfielditem"></a></td>
                                                                            <td><input type="text" class="form-control" name="parent[<?php echo $p;?>]" placeholder="Nama Kompetensi" value="<?php echo $key;?>" readonly></td>
                                                                            <td>
                                                                                <table class="table paramfield-table radio-list" >
                                                                                    <tbody class="paramfield" parent="<?php echo $p;?>" child="<?php echo sizeof($param[$key]);?>">
                                                                                        <?php foreach ($param[$key] as $pr => $value) {?>
                                                                                        <tr class="paramfielditem">
                                                                                            <td>
                                                                                                <div class="input-group">
                                                                                                    <div class="icheck-list">
                                                                                                        <input type="radio" id="level<?php echo $p.$pr;?>" name="level[<?php echo $p;?>][]" value="<?php echo $value['field'];?>" class="icheck" data-radio="iradio_flat-grey" <?php if ($value['value'] == 1) echo 'checked="checked"' ?> readonly>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text" name="param[<?php echo $p;?>][]" id-radio="level<?php echo $p.$pr;?>>" class="form-control level-title" placeholder="Nama Level" value="<?php echo $value['field'];?>" readonly>
                                                                                            </td>
                                                                                            <td><textarea type="text" name="paramtext[<?php echo $p;?>][]" class="form-control" placeholder="Keterangan" value="<?php echo $value['field_text'];?>" readonly><?php echo $value['field_text'];?></textarea></td>
                                                                                            <!-- <td><a class="closeparam hide close" data-close="paramfielditem"></a></td> -->
                                                                                        </tr>
                                                                                        <?php }?>
                                                                                    </tbody>
                                                                                </table>
                                                                                <!-- <a href="javascript:;" class="btn btn-icon-only disabled green addrowparam"><i class="fa fa-plus"></i></a> -->
                                                                            </td>   
                                                                        </tr>
                                                                     <?php } ?>
                                                                <?php else :?>
                                                                <tr class="parentfielditem">
                                                                    <td><a class="closeparent close" data-close="parentfielditem"></a></td>
                                                                    <td><input type="text" class="form-control" name="parent[0]" placeholder="Nama Kompetensi" value=""></td>
                                                                    <td>
                                                                        <table class="table paramfield-table radio-list" >
                                                                            <tbody class="paramfield" parent="0" child="5">
                                                                                <?php for ($i=0; $i < 5; $i++) { ?>
                                                                                <tr class="paramfielditem">
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level00" name="level[0][]" value="" class="icheck" data-radio="iradio_flat-grey">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="text" name="param[0][]" id-radio="level00>" class="form-control level-title" placeholder="Nama Level" value="">
                                                                                    </td>
                                                                                    <td><textarea type="text" name="paramtext[0][]" class="form-control" placeholder="Keterangan" value=""></textarea></td>
                                                                                    <!-- <td><a class="closeparam close disabled" data-close="paramfielditem"></a></td> -->
                                                                                </tr>
                                                                                <?php }?>
                                                                            </tbody>
                                                                        </table>
                                                                        <!-- <a href="javascript:;" class="btn btn-icon-only green disabled addrowparam "><i class="fa fa-plus" ></i></a> -->
                                                                    </td>   
                                                                </tr>
                                                                <?php endif?>
                                                            <?php endif?>

                                                        </tbody>
                                                    </table>
                                                    <a href="javascript:;" class="btn btn-icon-only green <?php if($assessment->status >=1) echo 'disabled'; ?> addrowparent">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            if ($assessment->type == 1 ) {
                                $this->load->view(VIEW_BACK.'reportlgd');
                            } elseif ($assessment->type == 2 ) {
                                $this->load->view(VIEW_BACK.'reportwwc');
                            } elseif ($assessment->type ==  3) {
                                $this->load->view(VIEW_BACK.'reportgames');
                            }
                             ?>
                            <!-- end form -->
                            <div class="clearfix">
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