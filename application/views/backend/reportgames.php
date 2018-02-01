<div class="col-md-12">
    <!-- Begin: life time stats -->
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">Form Observasi Games
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>
            </div>
        </div>
        <div class="portlet-body clearfix form">
            <div class="col-md-12">
                <div class="form-group col-md-6">
                    <label class="control-label">ASSESSE YANG DIOBSERVASI</label>
                    <?php 
                        if ( $assessment->status < 1) {
                            echo '<textarea rows="20" class="form-control" name="note_assesse" placeholder="Catatan untuk assesse yang diobservasi" style="resize: vertical;"></textarea>';
                        } else{
                            echo '<textarea rows="20" class="form-control" name="note_assesse" placeholder="'.$assessment->note_assesse.'" value="'.$assessment->note_assesse.'" style="resize: vertical;" readonly>'.$assessment->note_assesse.'</textarea> ';
                        }
                        ?>
                </div>
                <div class="form-group col-md-6">
                    <label class="control-label">ASSESSE LAINNYA</label>
                    <?php
                    if ( $assessment->status < 1) {
                        $part =  get_part_by_assessment($assessment->id_assessment);
                        if ($part) {
                            foreach ($part as $p) {
                                if ($p->seat_number == $assessment->seat_number) continue;
                                echo '<label class="control-label">ASSESSE '.$p->seat_number.' ( '.$p->reg_name.' )</label>';
                                echo '<textarea rows="2" class="form-control" name="note_assesse_other['.$p->seat_number.']" placeholder="Catatan untuk assesse '.$p->seat_number.'" style="resize: vertical;"></textarea>'; 
                            }
                        }
                    } else {
                        $note_other = unserialize($assessment->note_assesse_other);
                        $part =  get_part_by_assessment($assessment->id_assessment);
                        if ($part) {
                            foreach ($part as $p) {
                                if ($p->seat_number == $assessment->seat_number) continue;
                                echo '<label class="control-label">ASSESSE '.$p->seat_number.' ( '.$p->reg_name.' )</label>';
                                echo '<textarea rows="2" class="form-control" name="note_assesse_other['.$p->seat_number.']" placeholder="Catatan untuk assesse '.$p->seat_number.'" value="'.$note_other[$p->seat_number].'" style="resize: vertical;" readonly>'.$note_other[$p->seat_number].'</textarea>'; 
                            }
                        }
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
