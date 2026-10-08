<div class="tab_container">
    <table class="tablesorter" cellspacing="0">
        <thead>
            <tr>
                <th class="header" style="width:40px;">№</th>
                <th class="header" style="width:180px;">Название</th>
                <th class="header">Группа</th>
                <th class="header" style="width:140px;">Действие</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($modules as $key => $val)
            { ?>
            <tr>
                <td><?= $val->id; ?></td>
                <td><?= $val->name; ?></td>
                <td>
                    <?php 
                    foreach($link_role as $link => $role)
                    {
                        if($val->id == $role->module_id)
                        { ?>
                            <div class="lmr" id="role_<?= $role->module_id; ?>" >
                                <?php if($role->tag != 'admin')
                                { ?>
                                    <div class="mod_role">
                                        <div class="fleft" style="padding-top:3px;"><?= $role->name; ?>&nbsp;&nbsp;</div>
                                        <div class="fright" style="padding-top:3px;">
                                            <a onclick="dell_rolem('<?= $role->module_id; ?>', '<?= $role->role_id; ?>');" title='Удалить'>
                                                <img src="<?= URL::base('http', TRUE); ?>public/css/admin/images/icn_logout.png" />
                                            </a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                        <?php }
                    } ?>
                </td>
                <td>
                    <?php
                    $groups2 = $groups;
                    foreach($groups2 as $k => $v)
                    {
                        foreach($link_role as $link => $role)
                        {
                            if(($role->role_id == $v['id']) && ($role->module_id == $val->id))
                            {
                                unset($groups2[$k]);
                                //break;
                            }
                        }
                    }
                    ?>
                    <select id="srole_<?= $val->id; ?>" onchange="add_rolemod(<?= $val->id; ?>);">
                        <option value = "0" selected disabled>Добавить</option>
                        <?php foreach($groups2 as $r => $v) {
                            echo "<option value = ".$v['id'].">".$v['name']."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>