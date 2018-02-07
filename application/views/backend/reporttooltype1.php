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