<h3>Разделы</h3>
<ul class="toggle"><?php 
    foreach($menu as $key)
    {
        if($key['gruppa'] == 1)
        { ?>
            <li class="icn_tags"><a title = "<?= $key['descr']; ?>" href="<?= URL::base('http', TRUE); ?>admin/<?= $key['tag']; ?>/"><?= $key['name']; ?></a></li><?php 
        }
    } ?>
</ul>
<h3>Админка</h3>
<ul class="toggle"><?php 
    foreach($menu as $key)
    {
        if($key['gruppa'] == 3)
        { ?>
            <li class="icn_tags"><a title = "<?= $key['descr']; ?>" href="<?= URL::base('http', TRUE); ?>admin/<?= $key['tag']; ?>/"><?= $key['name']; ?></a></li><?php 
        }
    } ?>
</ul>
<hr />