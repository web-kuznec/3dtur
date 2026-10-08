<div class="tab_container">
    <div class="m10"></div>
    <div id="news">
        <table class="special-table">
            <tr>
                <th style="width:40px;">id</th>
                <th>Логин</th>
                <th style="width:150px;">e-mail</th>
                <th style="width:100px;">Группа</th>
                <th style="width:50px;"></th>
            </tr>
            <?php if(isset($users))
            {
                foreach($users as $key => $val)
                { 
                    if($val->status == 1)
                        $ist = "st_on_16.png";
                    else
                        $ist = "st_off_16.png";
                    ?>
                    <tr>
                        <td><?= $val->id; ?></td>
                        <td><?= $val->username; ?></td>
                        <td><?= $val->email; ?></td>
                        <td><?= $val->name; ?></td>
                        <td>
                            <div class="fright ml5">
                                <a onclick="dell_user(<?= $val->id; ?>)" title="Удалить">
                                    <img src="<?php URL::base('http', TRUE); ?>/public/images/dell.png" />
                                </a>
                            </div>
                            <div class="fright ml5">
                                <a id="str_a<?= $val->id; ?>" onclick="stat_user('<?= $val->id; ?>', '<?= $val->status; ?>')" title="Вкл/Выкл">
                                    <img id="str_img<?= $val->id; ?>" src="<?php URL::base('http', TRUE); ?>/public/images/<?= $ist; ?>" />
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