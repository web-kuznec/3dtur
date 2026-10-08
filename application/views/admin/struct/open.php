<div class="struct" id="struct_<?= $id; ?>">
    <div class="fleft">
        <div class="struct_name" style="padding-left:<?= ($level)*10; ?>px;">
            <?php if($cur == 1) { ?>
                <a class="vloj" id="aplus_<?= $id; ?>" onclick="close_struct(<?= $id; ?>);">
                    <img id="plus_<?= $id; ?>" src="<?= URL::base(); ?>public/images/minus.gif" />
                </a>&nbsp;
            <?php 

            } else { ?>
                <a class="vloj" id="aplus_<?= $id; ?>" onclick="display_struct(<?= $id; ?>);">
                    <img id="plus_<?= $id; ?>" src="<?= URL::base(); ?>public/images/plus.gif" />
                </a>&nbsp;
            <?php } ?>
            <a id="name_page_<?= $id; ?>" href="#"><?= $name; ?></a>
        </div>
    </div>
    <div class="fright">
        <div class="fright ml5">
            <a onclick="dell_page(<?= $id; ?>)" title="Удалить">
                <img src="<?= URL::base(); ?>public/images/dell.png" />
            </a>
        </div>
        <div class="fright ml5">
            <?php if($status == 0) { ?>
                <a id="str_a<?= $id; ?>" onclick="stat_page('<?= $id; ?>', '<?= $status; ?>')" title="Вкл/Выкл">
                    <img id="str_img<?= $id; ?>" src="<?= URL::base(); ?>public/images/st_off_16.png" />
                </a>
            <?php } else { ?>
                <a id="str_a<?= $id; ?>" onclick="stat_page('<?= $id; ?>', '<?= $status; ?>')" title="Вкл/Выкл">
                    <img id="str_img<?= $id; ?>" src="<?= URL::base(); ?>public/images/st_on_16.png" />
                </a>
            <?php } ?>
        </div>
        <div class="fright ml5">
            <a href="<?= URL::base(); ?>admin/struct/edit/<?= $id; ?>" title="Редактировать">
                <img src="<?= URL::base(); ?>public/images/edit.png" />
            </a>
        </div>
        <div class="fright ml5">
            <a href="<?= URL::base(); ?>admin/struct/add/<?= $id; ?>" title="Добавить">
                <img src="<?= URL::base(); ?>public/images/edit_add.png" />
            </a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>