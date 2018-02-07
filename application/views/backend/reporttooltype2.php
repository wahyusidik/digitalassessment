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
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption text-center">LEMBAR PENCATATAN DAN PENILAIAN Peserta  ( <?php echo $assessment_report[0]->reg_name ?> )
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
                                        <th width="50%" style="text-align: center;">Assessor</th>
                                        <th width="50%" style="text-align: center;">Observasi Assessor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($assessment_report as $row ) { ?>
                                    <tr style="min-height: 300px">
                                        <td><?php echo $row->assessor_name; ?></td>
                                        <td><?php echo ($row->notes? $row->notes : '') ; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php if($login_type == 3 ) : ?>
                            <a href="<?php echo base_url('backend/sendfeedbackreport/'.$$assessment_report[0]->id);?>" class="btn btn-lg green sendfeedback">
                                Kirim Feedback <i class="fa fa-envelope"></i>
                            </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div> 
                <div class="clearfix">
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="clearfix">
</div>
<div class="clearfix">
            </div>