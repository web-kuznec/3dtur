<section id="advances">
    <div class="container">
        <h2><?= $sl2->h1; ?></h2>
        <div class="row">
            <ul class="grid effect-2" id="grid"><?php
                foreach($advances as $k => $v)
                { ?>
                    <li><i class="fa <?= $v->awesome; ?>"></i><span><?= $v->h; ?></span> <?= $v->p; ?></li><?php
                } ?>
            </ul>
        </div>
    </div>
</section>