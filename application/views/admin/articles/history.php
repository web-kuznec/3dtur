<div class="tab_container">
    <div class="m10"></div>
    <div id="news">
        <?php if($articles->count() > 0)
        { ?>
            <table class="special-table">
                <tr>
                    <th style="width:40px;">№</th>
                    <th>Название</th>
                    <th style="width:60px;">Тип</th>
                    <th style="width:130px;">Дата</th>
                    <th style="width:85px;"></th>
                </tr>
                    <?php foreach($articles as $key => $val)
                    { ?>
                        <tr>
                            <td><?= $val->article_id; ?></td>
                            <td><?= $val->name; ?></td>
                            <td><?= $val->action; ?></td>
                            <td><?= date('d.m.Y H:i',strtotime($val->date_history)); ?></td>
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
                            <td colspan="4"><?= $val->text; ?></td>
                        </tr>
                    <?php } ?>
            </table>
        <?php } else
        {
            echo "<div>История умалчивает статьи ;)</div>";
        } ?>
    </div>
</div>