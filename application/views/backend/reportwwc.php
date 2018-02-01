<div class="col-lg-12 col-md-12">
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption text-center">LEMBAR HASIL WAWANCARA
            </div>
            <div class="tools">
                <a href="javascript:;" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body clearfix">
            <div class="form-body">
                <div class="form-group col-md-12">
                    <label class="control-label">CATATAN</label>
                    <div class="">
                        <?php 
                            if ( $assessment->status < 1) {
                                echo '<textarea rows="20" class="form-control" name="notes" placeholder="Catatan untuk assesse yang diobservasi" style="resize: vertical;"></textarea>';
                            } else{
                                echo '<textarea rows="20" class="form-control" name="notes" placeholder="'.$assessment->notes.'" value="'.$assessment->notes.'" style="resize: vertical;" readonly>'.$assessment->notes.'</textarea> ';
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>