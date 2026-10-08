<div class="tab_container">
    <div id="structure">
    <?php foreach($works as $key) { ?>
        <div class="struct" id="struct_<?= $key->id; ?>">
            <div class="fleft">
                <div class="struct_name">
                    <a id="name_page_<?= $key->id; ?>" href="<?= URL::base(); ?>admin/<?= $controller; ?>/edit/<?= $key->id; ?>"><?= $key->name; ?></a>
                </div>
            </div>
            <div class="fright">
                <div class="fright ml5">
                    <a onclick="dell_work('<?= $key->id; ?>')" title="Удалить">
                        <img src="<?= URL::base(); ?>public/images/dell.png" />
                    </a>
                </div>
                <div class="fright ml5">
                    <?php if($key->status == 0) { ?>
                        <a id="str_a<?= $key->id; ?>" onclick="stat_work('<?= $key->id; ?>', '1')" title="Вкл/Выкл">
                            <img id="str_img<?= $key->id; ?>" src="<?= URL::base(); ?>public/images/st_off_16.png" />
                        </a>
                    <?php } else { ?>
                        <a id="str_a<?= $key->id; ?>" onclick="stat_work('<?= $key->id; ?>', '0')" title="Вкл/Выкл">
                            <img id="str_img<?= $key->id; ?>" src="<?= URL::base(); ?>public/images/st_on_16.png" />
                        </a>
                    <?php } ?>
                </div>
                <div class="fright ml5">
                    <a href="<?= URL::base(); ?>admin/<?= $controller; ?>/edit/<?= $key->id; ?>" title="Редактировать">
                        <img src="<?= URL::base(); ?>public/images/edit.png" />
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div><?php
    } ?>
    </div>
</div>
<script type="text/javascript">
    function dell_work(id) {
        if(confirm("Братан, че серьезно удалить работу? ;)")) {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                data: {id:id},
                url: '/ajax/ajax/works/dell',
                success: function() {
                    document.location.reload();
                }
            });
        }
    }
    
    function stat_work(id, status) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            data: {id:id, status:status},
            url: '/ajax/ajax/works/status',
            success: function() {
                document.location.reload();
            }
        });
    }
</script>