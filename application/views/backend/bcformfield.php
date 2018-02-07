   <!-- <?php if ($assessment->status < 1 ) : ?>
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
                                                                                            <!-- <td><a class="closeparam hide close" data-close="paramfielditem"></a></td>     
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
                                                            <?php endif?> -->