<div class="advantages" id="advantages">
    <div class="parallax-window" data-parallax="scroll" data-image-src="/public/www/img/bg2.png"></div>
    <section>
    <h1><a class="anchor" href="#advantages"><?= $info->name; ?></a></h1>
    <ul class="fa-ul"><?php
        foreach($advances as $k => $v)
        { ?>
            <li><t><i class="fas fa-li <?= $v->awesome; ?>"></i> <?= $v->h; ?></t> <?= $v->p; ?></li><?php
        } ?>
    </ul>
    </section>
</div>