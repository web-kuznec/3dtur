<script src="<?= URL::base(); ?>public/js/admin/struct/struct.js" type="text/javascript"></script>
<div class="tab_container">
    <div id="structure">
    <?php foreach($pages as $key) {
        if($key->parent == NULL)
        { ?>
            <div class="struct" id="struct_<?= $key->id; ?>">
                <div class="fleft">
                    <div class="struct_name">
                        <a class="vloj" id="aplus_<?= $key->id; ?>" onclick="display_struct(<?= $key->id; ?>);">
                            <img id="plus_<?= $key->id; ?>" src="<?= URL::base(); ?>public/images/plus.gif">
                        </a>&nbsp;
                        <a href="<?= URL::base(); ?>admin/struct/edit/<?= $key->id; ?>" title="Редактировать"><?= $key->name; ?></a>
                    </div>
                </div>
                <div class="fright">
                    <div class="fright ml5">
                        <a onclick="dell_page('<?= $key->id; ?>')" title="Удалить">
                            <img src="<?= URL::base(); ?>public/images/dell.png" />
                        </a>
                    </div>
                    <div class="fright ml5">
                        <?php if($key->status == 0) { ?>
                            <a id="str_a<?= $key->id; ?>" onclick="stat_page('<?= $key->id; ?>', '<?= $key->status; ?>')" title="Вкл/Выкл">
                                <img id="str_img<?= $key->id; ?>" src="<?= URL::base(); ?>public/images/st_off_16.png" />
                            </a>
                        <?php } else { ?>
                            <a id="str_a<?= $key->id; ?>" onclick="stat_page('<?= $key->id; ?>', '<?= $key->status; ?>')" title="Вкл/Выкл">
                                <img id="str_img<?= $key->id; ?>" src="<?= URL::base(); ?>public/images/st_on_16.png" />
                            </a>
                        <?php } ?>
                    </div>
                    <div class="fright ml5">
                        <a href="<?= URL::base(); ?>admin/struct/edit/<?= $key->id; ?>" title="Редактировать">
                            <img src="<?= URL::base(); ?>public/images/edit.png" />
                        </a>
                    </div>
                    <div class="fright ml5">
                        <a href="<?= URL::base(); ?>admin/struct/add/<?= $key->id; ?>" title="Добавить">
                            <img src="<?= URL::base(); ?>public/images/edit_add.png" />
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        <?php }
    } ?>
    </div>
</div>
<script type="text/javascript">
function stat_page(id, status) {
    $.ajax({
        type: 'POST',
        dataType: 'html',
        data: {id: id, status: status},
        url: '/ajax/ajax/struct/status',
        success: function(data) {
            if(status == 0) {
                $('#str_a'+id).bind('click', function() {
                    stat_page(id, '1');
                });
                $('#str_img'+id).attr("src", "http://"+domen+"/public/images/st_on_16.png ");
            } else {
                $('#str_a'+id).bind('click', function() {
                    stat_page(id, '0');
                });
                $('#str_img'+id).attr("src", "http://"+domen+"/public/images/st_off_16.png ");
            }
        }
    });
}
function dell_page(id) {
    if(confirm("Удалить страницу?")) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            data: {id: id},
            url: '/ajax/ajax/struct/dell',
            success: function(data) {
                document.location.reload();
            }
        });
    }
}
</script>