<section id="works" class="works">
    <h1><a class="anchor" href="#works"><?= $info->name; ?></a></h1>
    <?= $info->text1; ?>
    <div class="works-grid"><?php
        foreach($works as $w => $s)
        { ?>
            <div class="work" style="background-image:linear-gradient(to bottom, rgba(0,0,0,0) 40%, rgba(0,0,0,0.9)), url('/public/works/<?= $s->id; ?>/<?= $s->photo; ?>'); ">
                <div class="hover">
                    <a href="/panorama/<?= $s->translit; ?>/index.html" class="btn btn-warning">Смотреть</a>
                </div>
                <div class="text">
                    <h3><?= $s->slide_h; ?></h3>
                    <span class="title"><h3><?= $s->slide_descr; ?></h3></span>
                </div>
            </div><?php
        } ?>
    </div>
</section>