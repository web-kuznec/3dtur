<div class="tab_container">
    <div class="m10"></div>
    <div id="news">
        <?php if($pages->count() > 0)
        { ?>
            <table class="special-table">
                <tr>
                    <th style="width:40px;">№</th>
                    <th>Название</th>
                    <th style="width:40px;">Статус</th>
                    <th style="width:60px;">Тип</th>
                    <th style="width:130px;">Дата</th>
                    <th style="width:85px;"></th>
                </tr>
                    <?php foreach($pages as $key => $val)
                    { ?>
                        <tr>
                            <td><?= $val->page_id; ?></td>
                            <td><?= $val->name; ?></td>
                            <td><?php if($val->status == '1') { ?>
                                <img id="str_img1" src="<?= URL::base('http', TRUE); ?>public/images/st_on_16.png">
                            <?php } else { ?>
                                <img id="str_img1" src="<?= URL::base('http', TRUE); ?>public/images/st_off_16.png">
                            <?php } ?>
                            </td>
                            <td><?= $val->action; ?></td>
                            <td><?= date('d.m.Y H:i',strtotime($val->date_update)); ?></td>
                            <td>
                                <div class="fright  ml5">
                                    <a onclick="news_recovery('<?= $val->id; ?>');" title="Восстановление">
                                        <img src="<?php URL::base('http', TRUE); ?>/public/images/edit.png" />
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5"><?= $val->text; ?></td>
                        </tr>
                    <?php } ?>
            </table>
        <?php } else { ?>
            <div>История умалчивает страницы ;)</div><?php
        } ?>
    </div>
</div>