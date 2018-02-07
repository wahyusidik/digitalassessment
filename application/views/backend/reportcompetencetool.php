<!-- Modal -->
<div class="modal fade" id="textareafocus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form id="cities-form" action="#" method="post">
            <textarea name="content" type="text" value=""></textarea>
       </form>
      </div>
      <div class="modal-footer">
         <span class="error"></span>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="submit" type="button" class="btn btn-primary">Submit Cities</button>
      </div>
    </div>
  </div>
</div>
<?php if($user->id == $assessment_report[0]->id_moderator ): ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <?php if($assessment_report[0]->assessment_status >= 1):?>

        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">Laporan Individu Assessment
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body clearfix">
                <?php if ($assessment_report[0]->form_type == 1 ): ?>
                <?php foreach ($assessment_report as $row) { ?>
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption text-center">Laporan Individu Assessment <?php echo $row->reg_name;?>
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
                                <input type="hidden" name="id_moderator" value="<?php echo $row->id_moderator; ?>">
                                <input type="hidden" name="id_registration" value="<?php echo $row->id_registration; ?>">
                                <input type="hidden" name="id_program" value="<?php echo $row->id_program; ?>">
                        <input type="hidden" name="form_type" value="<?php echo $row->form_type; ?>">
                                

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
                                                        <tbody class="parentfieldreport">
                                                        <?php
                                                        if ( $row->status < 2) {
                                                        $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {
                                                                $competence = $this->model_member->get_competence($id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey" required oninvalid="this.setCustomValidity(&apos;Please Enter valid email&apos;)"
                                                                                                 oninput="setCustomValidity(&apos;&apos;)">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td>
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            } else {

                                                            $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {

                                                                $competence = $this->model_member->get_competence($id);
                                                                $competencereport = $this->model_member->get_competence_report_tool($row->id_assessment,$row->id_registration,$competence->id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $selected = ($competencereport->level == $lev->level ? 'checked="checked"' : '');
                                                                    $text = ($competencereport->level == $lev->level ? $competencereport->evidence : '');
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey"'.$selected.' disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td >
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            }?>
                                                        </tbody>
                                                    </table>
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
            <?php elseif ($assessment_report[0]->form_type == 2): ?>
                <?php $row = $assessment_report[0] ?>
                <div class="col-lg-12 col-md-12">
                    <div class="portlet box blue-steel">
                        <div class="portlet-title">
                            <div class="caption text-center">Laporan Individu Assessment <?php echo $row->reg_name;?>
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
                                <input type="hidden" name="id_moderator" value="<?php echo $row->id_moderator; ?>">
                                <input type="hidden" name="id_registration" value="<?php echo $row->id_registration; ?>">
                                <input type="hidden" name="form_type" value="<?php echo $row->form_type; ?>">
                                <input type="hidden" name="id_program" value="<?php echo $row->id_program; ?>">
                                

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
                                                        <tbody class="parentfieldreport">
                                                        <?php
                                                        if ( $row->status < 2) {
                                                        $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {
                                                                $competence = $this->model_member->get_competence($id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey" required oninvalid="this.setCustomValidity(&apos;Please Enter valid email&apos;)"
                                                                                                 oninput="setCustomValidity(&apos;&apos;)">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                    
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td>
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            } else {

                                                            $list = '';
                                                            $competencedata =  $this->model_member->get_competence_profil($row->position);
                                                            if ($competencedata || !empty($competencedata)){
                                                                $competencedata = explode(',', $competencedata->competences);
                                                                $parent = 0;
                                                                foreach ($competencedata as $id ) {

                                                                $competence = $this->model_member->get_competence($id);
                                                                $competencereport = $this->model_member->get_competence_report_tool($row->id_assessment,$row->id_registration,$competence->id);
                                                                $level = $this->model_member->get_competence_level($competence->id);
                                                                $levels = '';
                                                                $child = 0;
                                                                foreach ($level as $lev ) {
                                                                    $count = $child+1;
                                                                    $selected = ($competencereport->level == $lev->level ? 'checked="checked"' : '');
                                                                    $text = ($competencereport->level == $lev->level ? $competencereport->evidence : '');
                                                                    $levels.=   '<tr class="paramfielditem">
                                                                                    <td width="5%">
                                                                                        <div class="input-group">
                                                                                            <div class="icheck-list">
                                                                                                <input type="radio" id="level'.$parent.$child.'" name="competences['.$competence->id.']" value="'.$lev->level.'" class="icheck level" data-radio="iradio_flat-grey"'.$selected.' disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td width="45%">
                                                                                        <p class="popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$lev->definition.'" data-original-title="Keterangan">'.$count.'. '.$lev->title.'<p>
                                                                                    </td>
                                                                                    <td width="50%"><textarea style="resize:vertical" type="text" name="paramtext['.$competence->id.']['.$lev->level.']" class="form-control" placeholder="Keterangan" value="" readonly style="resize:vertical">'.$text.'</textarea></td>
                                                                                </tr>';
                                                                    $child++;
                                                                }
                                                                   $list .= '
                                                                   <tr class="parentfielditem">
                                                                        <td><!--<a class="closeparent close" data-close="parentfielditem"></a>--></td>
                                                                        <td>
                                                                            <!--<input type="text" class="form-control" name="parent['.$parent.']" placeholder="'.$competence->name.'" value="'.$competence->name.'" disabled readonly>-->
                                                                            <h2>'.$competence->name.'</h2>
                                                                            <br><p>'.$competence->definition.'</p>
                                                                        </td>
                                                                        <td>
                                                                            <table class="table paramfield-table radio-list" >
                                                                                <tbody class="paramfield" parent="0" child="1">
                                                                                '.$levels.'
                                                                                </tbody>
                                                                            </table>
                                                                        </td>   
                                                                    </tr>';
                                                                    $parent++;
                                                                }
                                                                echo $list;
                                                            }
                                                            }?>
                                                        </tbody>
                                            </table>
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
            <?php endif?>
            </div>
        </div>
    <?php else: ?>
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption text-center">LEMBAR Laporan Assessment - LAPORAN BELUM LENGKAP
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
