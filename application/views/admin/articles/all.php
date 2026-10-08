<div class="tab_container">
    <div class="m10"></div>
    <div id="news">
        <table class="special-table">
            <tr>
                <th style="width:40px;">№</th>
                <th>Название</th>
                <th style="width:130px;">Дата</th>
                <th style="width:85px;"></th>
            </tr>
            <?php if(isset($articles))
            {
                foreach($articles as $key => $val)
                { 
                    if($val->status == 1)
                        $ist = "st_on_16.png";
                    else
                        $ist = "st_off_16.png";
                    ?>
                    <tr>
                        <td><?= $val->id; ?></td>
                        <td><?= $val->name; ?></td>
                        <td><?= date('d.m.Y H:i',strtotime($val->date)); ?></td>
                        <td>
                            <div class="fright ml5">
                                <a onclick="dell_articles(<?= $val->id; ?>)" title="Удалить">
                                    <img src="<?php URL::base(); ?>/public/images/dell.png" />
                                </a>
                            </div>
                            <div class="fright ml5">
                                <a id="str_a<?= $val->id; ?>" onclick="stat_articles('<?= $val->id; ?>', '<?= $val->status; ?>')" title="Вкл/Выкл">
                                    <img id="str_img<?= $val->id; ?>" src="<?php URL::base(); ?>/public/images/<?= $ist; ?>" />
                                </a>
                            </div>
                            <div class="fright  ml5">
                                <a href="<?= URL::base(); ?>admin/articles/edit/<?= $val->id; ?>" title="Редактировать">
                                    <img src="<?php URL::base(); ?>/public/images/edit.png" />
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
<script>
function dell_articles(id) {
    if (confirm("Удалить статью?")) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            data: {id:id},
            url: '/ajax/ajax/articles/dell',
            success: function() {
                document.location.reload();
            }
        });
    }
}

function stat_articles(id,status) {
    $.ajax({
        type: 'POST',
        dataType: 'html',
        data: {id:id,status:status},
        url: '/ajax/ajax/articles/status',
        success: function() {
            document.location.reload();
        }
    });
}
</script>