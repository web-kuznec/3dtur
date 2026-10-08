<section id="work">
    <div class="starter_container bg">
        <div class="container">
            <div class="slider_container">
                <div class="flexslider">
                    <ul class="slides"><?php
                        foreach($slider as $k => $v) { ?>
                            <li itemscope itemtype="http://schema.org/ImageObject">
                                <a title="<?= $v->name; ?>" href="<?= URL::base(); ?>panorama/<?= $v->translit; ?>/index.html"><img itemprop="contentUrl" src="<?= URL::base(); ?>public/works/<?= $v->id; ?>/<?= $v->photo; ?>" alt="<?= $v->name; ?>" title="<?= $v->name; ?>"></a>
                                <div class="flex-caption">
                                    <div class="caption_title_line">
                                        <h2 itemprop="name"><?= $v->slide_h; ?></h2>
                                        <p itemprop="description"><?= $v->slide_descr; ?></p>
                                    </div>
                                </div>
                            </li><?php
                        } ?>
                    </ul>
                </div>
            </div>
            <h1><?= $sl1->h1; ?></h1>
            <div class="main"><?= $sl1->text1; ?></div>
            <?php if($sl1->text2) { ?>
                <p class="stat_advance"><?= $sl1->text2; ?></p><?php
            }?>
        </div>
    </div>
</section>