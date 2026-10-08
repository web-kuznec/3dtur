<section class="post">
    <div class="container">
        <div class="breadcrumb"><a href="<?= URL::base(); ?>">Главная</a> » <a href="<?= URL::base()."articles"; ?>">Статьи</a></div>
        <div class="row">
            <div class="row-md-12">
                <h1><?= $name; ?></h1>
            </div>
        </div>
        <div class="row">
            <article class="article">
                <div class="col-md-12 bl">
                    <?= $text; ?>
                </div>
                <div class="col-md-12 bl">
                    <dd><?= date('d-m-Y', strtotime($date)); ?></dd>
                </div>
            </article>
        </div>
    </div>
</section>