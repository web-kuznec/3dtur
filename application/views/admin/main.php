<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Панель управления</title>
        <link rel="shortcut icon" href="<?= URL::base(); ?>public/images/favicon.ico" type="image/x-icon">
        <?= $styles; ?>
        <?= $scripts; ?>
        <script src="<?= URL::base(); ?>public/js/kuznya.js" type="text/javascript"></script>
    </head>
    <body>
        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="<?= URL::base(); ?>admin/">Панель управления</a></h1>
                <h2 class="section_title"><a href="<?= URL::base(); ?>" target="_blank">Главная</a></h2>
                <div class="btn_view_site"><a onclick="exitus();">Выход</a></div>
            </hgroup>
        </header> <!-- end of header bar -->

        <aside id="sidebar" class="column">
            <?php if(!empty($menu)) echo $menu; ?>
        </aside><!-- end of sidebar -->
        <section id="main" class="column">
            <article class="module width_full">
                <header>
                    <div class="fleft">
                        <h3><?php if(!empty($name)) echo $name; ?></h3>
                    </div>
                    <div class="fright">
                        <?php if(!empty($action)) echo $action; ?>
                    </div>
                    <div class="clear"></div>
                </header>
                <div class="module_content">
                    <?php if(!empty($content)) echo $content; ?>
                    <div class="clear"></div>
                </div>
            </article><!-- end of stats article -->
            <div class="spacer"></div>
        </section>
    </body>
</html>