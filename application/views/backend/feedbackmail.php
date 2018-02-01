<h1> Laporan Assessment <?php echo $assessment->reg_name?> </h1>
                               <br>
                               <br>
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
                                <label class="col-md-8 "> : <?php echo $assessment->assessment_number; ?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jabatan / Tahun</label>
                                <label class="col-md-8 ">  : <?php echo $assessment->position?> / <?php echo $assessment->year?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Tanggal / Jam</label>
                                <label class="col-md-8 "> : <?php echo get_date_text($assessment->date)?> / <?php echo get_time_text($assessment->time)?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Jenis</label>
                                <label class="col-md-8 "> : <?php echo $assessment->assessment_name?></label>
                            </div>
                            <div class="form-group2">
                                <label class="col-md-4 ">Moderator </label>
                                <label class="col-md-8 "> : <?php echo $assessment->mod_name?></label>
                            </div>
                        </div>
                        <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <td colspan="4"><center>Nilai Akhir Kompetensi</center></td>
                                        </tr>
                                        <tr>
                                            <th width="5%"><center>NO</center></th>
                                            <th width="30%"><center>Kompetensi</center></th>
                                            <th width="10%"><center>Nilai</center></th>
                                            <th width="40%"><center>Keterangan</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($report_comp = get_report_comp_report($assessment->id_assessment,'all',$assessment->id)) {
                                            $parent = $report_comp['parent'];
                                            $param = $report_comp['param'];
                                            $i = 1;
                                            foreach ($parent as $p => $value) {?>
                                            <tr>
                                                <td><center><?php echo $i;?></center></td>
                                                <td><center><?php echo $value;?></center></td>
                                                <td><center><?php echo $param[$value]['field'];?></center></td>
                                                <td><?php echo $param[$value]['field_text'];?></td>
                                            </tr>
                                         <?php
                                            $i++;
                                            }
                                        } ?>
                                    </tbody>
                                <hr>

                                </table>
                                <h2> Nilai Observasi Assessor</h2>
                                <table>
                                <thead>
                                </thead>
                                <tbody>
                                    <tr style="min-height: 300px">
                                         <td width="50%""><h3>Observasi Assessor</h3></td>
                                    </tr>
                                    <tr style="margin-bottom: : 40px">
                                        <td><?php echo $assessment->note_assesse; ?></td>
                                    </tr>
                                    <tr style="min-height: 300px">
                                         <td width="50%""><h3>Observasi Assessor Lain</h3></td>
                                    </tr>
                                    <tr>
                                        <td><?php
                                        // $note_other = unserialize($row->note_assesse_other);
                                        $part =  get_part_by_assessment($assessment->id_assessment);
                                        $note_other = get_othernote_data($assessment->id_assessment);
                                        if ($part) {
                                            foreach ($part as $p) {
                                                if ($p->seat_number == $assessment->seat_number) continue;
                                                    echo '<b>ASSESSOR '.$p->seat_number.' ( '.$p->assessor_name.' )</b> <br>';
                                                    echo '<p>'.$note_other[$assessment->seat_number][$p->seat_number].'</p>'; 
                                                    echo '<br><br>';
                                                }
                                            }
                                         ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>