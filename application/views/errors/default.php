<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>404 - Страница не найдена</title>
        <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/public/css/normalize.css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/public/css/bootstrap.css">
        <link rel="stylesheet" href="/public/css/main.css?v=5" media="screen" type="text/css">
        <link rel="stylesheet" href="/public/css/gallery.css?v=5">
        <link rel="stylesheet" href="/public/css/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/public/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    </head>
    <body>
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a class="navbar-brand" href="/">
                            <img src="<?= URL::base('http'); ?>public/images/logo.png">
                        </a>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 top-centr">
                        <i class="fa fa-mobile fa-2x"></i> <a itemprop="telephone" class="color_animation" href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 but_order">
                        <div class="ex_hover"><a id="top_call_p" class="script_help show_modal">
                                <img src="<?= URL::base('http'); ?>public/images/button.png">
                            </a></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text_top">
                        <p><?= $text_top; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Меню</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <?= $menu; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <section class="static">
            <div class="container">
                <h1>404 - Страница не найдена</h1>
                <p>Такая страница не найдена.</p>
                <p>Попробуйте воспользоваться навигацией сверху, чтобы найти нужную для Вас информацию.</p>
            </div>
        </section>
        <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center"><?= $text_bottom; ?></p></div>
                <div class="col-md-4">
                    <p class="sub-footer-text text-center">
                        <a itemprop="telephone" class="color_animation" href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                    </p>
                    <p class="sub-footer-text text-center">
                        <a class="top-mail" itemprop="email" href="maito:<?= $email; ?>"><?= $email; ?></a>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <p id="bo_call" class="show_modal sub-footer-text"><a>Обратный звонок</a></p>
                    <script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
                    <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki"></div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="/public/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="/public/js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="/public/js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="/public/js/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="/public/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="/public/js/jquery.bpopup.min.js"></script>
        <script type="text/javascript" src="/public/fancybox/jquery.fancybox-1.3.4.js"></script>
        <link rel="stylesheet" type="text/css" href="/public/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <script type="text/javascript" src="/public/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="/public/js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="/public/js/imagesloaded.js"></script>
        <script type="text/javascript" src="/public/js/classie.js"></script>
        <script type="text/javascript" src="/public/js/AnimOnScroll.js"></script>

        <div class="popup_modal" id="form_modals">
            <p id="script_help" style="display: none;"></p>
            <p class="h_form_modal">ОСТАВЬТЕ ЗАЯВКУ</p>
            <p>и наш специалист свяжется с Вами</p>
            <form action="/send" method="post" id="hidden_form">
                <input name="name" type="text" placeholder="ИМЯ" id="hidden_name" />
                <input name="phone" type="text" placeholder="ТЕЛЕФОН" id="hidden_telephone" />
                <input name="email" type="text" placeholder="E-MAIL" id="hidden_email" />
                <input type="submit" value="ОТПРАВИТЬ" class="ex_hover" />
            </form>
            <script type="text/javascript">
                $('#hidden_telephone').mask("+7 999-999-99-99");
                $('#main_telephone_3').mask("+7 999-999-99-99");
            </script>
        </div>

        <script type="text/javascript">
            $(function () {
                $('.close').click(function () {
                    $('.popup_modal').bPopup().close();
                });
            });

            $(function () {
                $('.show_modal').click(function () {
                    $('#form_modals').bPopup({
                        speed: 650,
                        transition: 'slideIn'
                    });
                });
            });
            new AnimOnScroll(document.getElementById('grid'), {
                minDuration: 0.4,
                maxDuration: 1.7,
                viewportFactor: 0.2
            });
        </script>
        <script type="text/javascript" charset="utf-8">
            var $ = jQuery.noConflict();
            $(window).load(function () {
                $('.flexslider').flexslider({
                    animation: "fade"
                });

                $(function () {
                    $('.show_menu').click(function () {
                        $('.menu').fadeIn();
                        $('.show_menu').fadeOut();
                        $('.hide_menu').fadeIn();
                    });
                    $('.hide_menu').click(function () {
                        $('.menu').fadeOut();
                        $('.show_menu').fadeIn();
                        $('.hide_menu').fadeOut();
                    });
                });
                $(document).ready(function () {
                    $(".jmyk").fancybox({
                        'width': 1024,
                        'height': 577,
                        'autoScale': false,
                        'transitionIn': 'none',
                        'transitionOut': 'none',
                        'type': 'iframe'
                    });
                });
            });
        </script>
    </body>
</html>