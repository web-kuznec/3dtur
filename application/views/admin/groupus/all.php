<div class="tab_container">
    <div class="m10"></div>
    <div id="groupus">
        <table class="special-table">
            <tr>
                <th style="width:40px;">№</th>
                <th style="width:150px;">Название</th>
                <th>Описание</th>
                <th style="width:70px;"></th>
            </tr>
            <?php if(isset($groups))
            {
                foreach($groups as $key => $val)
                { 
                    if($val->status == 1)
                        $ist = "st_on_16.png";
                    else
                        $ist = "st_off_16.png";
                    ?>
                    <tr>
                        <td><?= $val->id; ?></td>
                        <td><?= $val->name; ?></td>
                        <td><?= $val->description; ?></td>
                        <td>
                            <div class="fright ml5">
                                <a onclick="dell_groupus(<?= $val->id; ?>)" title="Удалить">
                                    <img src="<?php URL::base('http', TRUE); ?>/public/images/dell.png" />
                                </a>
                            </div>
                            <div class="fright ml5">
                                <a id="str_a<?= $val->id; ?>" onclick="stat_groupus('<?= $val->id; ?>', '<?= $val->status; ?>')" title="Вкл/Выкл">
                                    <img id="str_img<?= $val->id; ?>" src="<?php URL::base('http', TRUE); ?>/public/images/<?= $ist; ?>" />
                                </a>
                            </div>
                            <div class="fright  ml5">
                                <a onclick="edit_groupus('<?= $val->id; ?>');" title="Редактировать">
                                    <img src="<?php URL::base('http', TRUE); ?>/public/images/edit.png" />
                                </a>
                            </div>
                            <div class="clear"></div>
                        </td>
                    </tr>
                <?php }
            } ?>
        </table>
    </div>
</div>