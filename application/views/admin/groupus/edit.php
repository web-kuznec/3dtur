<div id="window_admin_large">
    <div class="fleft">
        <h3>Редактирование группы пользователя</h3>
    </div>
    <div class="fright">
        <a onclick="close_div('div_fix', 'div_abs');">Закрыть</a>
    </div>
    <div class="clear"></div>
    <form id="groupus_edit" onSubmit="groupus_check('update_groupus'); return false;" >
        <div class="labeled">Название</div>
        <div class="fleft">
            <input type="text" id="groupus_name" name="groupus_name" class="inptext99" value="<?= $name; ?>" />
        </div>
        <div class="clear"></div>
        <div class="otst"></div>
        <div class="labeled">Описание</div>
        <div class="fleft">
            <input type="text" id="groupus_desc" name="groupus_desc" class="inptext99" value="<?= $description; ?>" />
        </div>
        <div class="clear"></div>
        <div class="otst"></div>
        <div class="labeled">Статус</div>
        <div class="fleft">
            <input <?php if(!empty($status)) { echo "checked"; } ?> type="checkbox" name="groupus_status" >
        </div>
        <div class="clear"></div>
        <div class="fright">
            <input type="hidden" name="groupus_id" value="<?= $id ?>" >
            <button class="button" type="submit" >Сохранить</button>
        </div>
        <div class="clear"></div>
    </form>
</div>