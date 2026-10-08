<section class="post all_post">
    <div class="container">
        <div class="row">
            <div class="row-md-12">
                <h1>Статьи</h1>
            </div>
        </div><?php
        foreach($articles as $k => $v)
        { ?>
        <article class="article">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 img-holder">
                    <a href="<?= URL::base(); ?>articles/item/<?= $v->translit; ?>.html">
                        <img src="<?= URL::base(); ?>public/articles/<?= $v->id; ?>/<?= $v->photo; ?>" alt="<?= $v->name; ?>">
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-8 post-cnt">
                    <h2><?= $v->name; ?></h2>
                    <p><?= $v->caption; ?></p>
                    <a href="<?= URL::base(); ?>articles/item/<?= $v->translit; ?>.html">Подробнее...</a>
                </div>
            </div>
        </article><?php
        } ?>
    </div>
</section>