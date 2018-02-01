<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR PENCATATAN DAN PENILAIAN PESERTA
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
            <?php foreach ($assessment_report as $row ) { ?>
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption text-center">LEMBAR PENCATATAN DAN PENILAIAN Peserta  ( <?php echo $row->reg_name ?> )
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-advance dataTable table-hover">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="50%" style="text-align: center;">Observasi Assessor</th>
                                        <th width="50%" style="text-align: center;">Observasi Assessor Lain</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="min-height: 300px">
                                        <td><?php echo $row->note_assesse; ?></td>
                                        <td><?php
                                        // $note_other = unserialize($row->note_assesse_other);
                                        $part =  get_part_by_assessment($row->id_assessment);
                                        $note_other = get_othernote_data($row->id_assessment);
                                        if ($part) {
                                            foreach ($part as $p) {
                                                if ($p->seat_number == $row->seat_number) continue;
                                                    echo '<b>ASSESSOR '.$p->seat_number.' ( '.$p->assessor_name.' )</b> <br>';
                                                    echo '<p>'.$note_other[$row->seat_number][$p->seat_number].'</p>'; 
                                                    echo '<br><br>';
                                                }
                                            }
                                         ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if($login_type == 3 ) : ?>
                            <a href="<?php echo base_url('backend/sendfeedbackreport/'.$row->id);?>" class="btn btn-lg green sendfeedback">
                                Kirim Feedback <i class="fa fa-envelope"></i>
                            </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div> 
                <div class="clearfix">
                </div>
            <?php } ?>
            </div>
        </div>
    </div> 
</div>
<div class="clearfix">
</div>
<div class="clearfix">
            </div>
<?php if($user->id == $assessment_report[0]->id_moderator ): ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <?php if($assessment_report[0]->assessment_status >= 1):?>

        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR INTEGRASI AKHIR
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <?php foreach ($assessment_report as $row) { ?>
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption text-center">LEMBAR INTEGRASI AKHIR <?php echo $row->reg_name;?>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title=" " title="buka/tutup">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <h3 class="form-section">Data Assessment</h3>

                            <div class="form-group2 clearfix">
                                <label class="col-md-4 ">Nomor Assesse</label>
                                <label class="col-md-8 "> : <?php echo $row->reg_number; ?></label>
                            </div>
                            <div class="form-group2 clearfix">
                                <label class="col-md-4 ">Nama</label>
                                <label class="col-md-8 "> : <?php echo $row->reg_name; ?></label>
                            </div>
                            <div class="form-group2 clearfix">
                                <label class="col-md-4 ">Nomor Urut</label>
                                <label class="col-md-8 "> : <?php echo $row->seat_number; ?></label>
                            </div>
                            <form role="form" class="addreportfinal" id="addreportfinal<?php echo $row->seat_number; ?>" action="<?php echo base_url()?>backend/addreportfinalact" method="POST" enctype="multipart/form-data" >
                                <input type="hidden" name="id_assessment_data" value="<?php echo $row->id; ?>">
                                <input type="hidden" name="id_assessment" value="<?php echo $row->id_assessment; ?>">
                                <input type="hidden" name="assessment_type" value="<?php echo $row->type; ?>">
                                <input type="hidden" name="id_assessor" value="<?php echo $row->id_assessor; ?>">

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
                                            <?php if ($report_comp = get_report_comp($row->id_assessment,'all',$row->id)) : ?>
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
                                                                                <td><textarea type="text" name="paramtext[<?php echo $p;?>][]" class="form-control" placeholder="Keterangan" value="<?php echo $value['field_text'];?>" ><?php echo $value['field_text'];?></textarea></td>
                                                                                <!-- <td><a class="closeparam hide close" data-close="paramfielditem"></a></td> -->
                                                                            </tr>
                                                                            <?php }?>
                                                                        </tbody>
                                                                    </table>
                                                                    <a href="javascript:;" class="btn btn-icon-only hide disabled green addrowparam"><i class="fa fa-plus"></i></a>
                                                                </td>   
                                                            </tr>

                                                 <?php } ?>
                                                </tbody>
                                            </table>
                                            <a href="javascript:;" class="btn btn-icon-only green disabled hide addrowparent">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <?php else :?>
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
                                                </tbody>
                                            </table>
                                            <a href="javascript:;" class="btn btn-icon-only green  addrowparent">
                                            <i class="fa fa-plus"></i>
                                            </a>
                                            <?php endif?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    if ( $row->status < 2) {
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
                <?php } ?>
            </div>
        </div>
    <?php else: ?>
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR INTEGRASI AKHIR - LAPORAN BELUM LENGKAP
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
