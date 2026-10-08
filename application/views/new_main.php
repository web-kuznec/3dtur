<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title; ?></title>
        <?= $styles; ?>
        <?php if(!empty($description)) { ?><meta name="description" content="<?= $description; ?>"><?php } ?>
        <?php if(!empty($keywords)) { ?><meta name="keywords" content="<?= $keywords; ?>"><?php } ?>
    </head>
    <body class="main">
        <header>
            <nav>
                <a href="/" title="<?= $title; ?>"><img src="/public/www/img/logo.png"></a>
                <a class="bars" data-toggle="collapse" href="#menu"><i class="fas fa-bars"></i></a>
                <ul class="menu collapse" id="menu">
                    <?= $menu; ?>
                </ul>
            </nav>
            <content style="pointer-events: none;">
                <div class="row">
                    <div class="col-12 col-xl-9">
                        <h1><?= $text_top; ?></h1>
                        <p class="h2"><?= $text_top2; ?></p>
                    </div>
                    <div class="col-12" style="pointer-events: all;">
                        <a class="anchor" href="#form"><button class="btn btn-warning"><?= $button_label; ?></button></a>
                    </div>
                </div>
                <div class="col-12 phone">
                    <p><a href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                        <a class="pc_viber" title="Viber" href="viber://chat?number=<?= str_replace('+', '', $phone); ?>"> <img class="social" src="/public/www/img/purple_Purple_icon.png"></a>
                        <a title="WhatsApp" href="whatsapp://send?phone=<?= $phone; ?>"> <img class="social" src="/public/www/img/WhatsApp_Logo_1.png"></a>
                    </p>
                </div>
            </content>
            <div class="arrow"><a class="anchor" href="#text_block"><img src="/public/www/img/more.svg"></a></div>
        </header>
        <?= $content; ?>
        <footer>
            <div class="row content">
                <div class="col-12 col-md-4">
                    <p><?= $text_bottom; ?></p>
                </div>
                <div class="col-12 col-md-4">
                    <p><b><a itemprop="telephone" href="tel:<?= $phone; ?>"><?= $phone; ?></a></b><br><a itemprop="email" href="maito:<?= $email; ?>"><?= $email; ?></a></p>
                </div>
                <div class="col-12 col-md-4">
                    <p>Обратный звонок<br>
                        <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
                        <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki"></div>
                    </p>
                </div>
            </div>
        </footer>
        <?= $scripts; ?>
    </body>
</html>