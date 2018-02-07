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