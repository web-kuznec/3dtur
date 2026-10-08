<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>
        <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/public/css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/public/css/bootstrap.css">
        <link rel="stylesheet" href="/public/css/main.css?v=3" media="screen" type="text/css">
        <link rel="stylesheet" href="/public/css/gallery.css?v=6">
        <link rel="stylesheet" href="/public/css/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if(!empty($description)) { ?><meta name="description" content="<?= htmlspecialchars($description); ?>"><?php } ?>
        <?php if(!empty($keywords)) { ?><meta name="keywords" content="<?= htmlspecialchars($keywords); ?>"><?php } ?>
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
    <body>
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a class="navbar-brand" href="/">
                            <img src="/public/images/logo.png">
                        </a>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12 top-centr">
                        <a class="pc_viber" title="Viber" href="viber://chat?number=<?= str_replace('+', '', $phone); ?>"> <i class="fab fa-viber"></i></a>
                        <a title="WhatsApp" href="whatsapp://send?phone=<?= $phone; ?>"> <i style="color:#00e676;" class="fab fa-whatsapp"></i></a>
                        <i class="fas fa-mobile"></i> <a itemprop="telephone" class="color_animation" href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6 but_order">
                        <div class="ex_hover"><a id="top_call_p" class="script_help show_modal">
                            <img src="/public/images/button.png">
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
                        <div class="top-centr-mobile">
                            <a class="mobile_viber" title="Viber" href="viber://add?number=<?= str_replace('+', '', $phone); ?>"> <i style="color:#fff;" class="fab fa-viber"></i></a>
                            <a title="WhatsApp" href="whatsapp://send?phone=<?= $phone; ?>"> <i style="color:#00e676;" class="fab fa-whatsapp"></i></a>
                            <i class="fas fa-mobile"></i> <a itemprop="telephone" class="color_animation" href="tel:<?= $phone; ?>"><?= $phone; ?></a>
                        </div>
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
        <?= $content; ?>
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
        <script type="text/javascript" src="/public/js/jquery.flexslider-min.js?v"></script>
        <script type="text/javascript" src="/public/js/jquery.bpopup.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/public/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <script type="text/javascript" src="/public/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="/public/js/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="/public/js/imagesloaded.js"></script>
        <script type="text/javascript" src="/public/js/classie.js"></script>
        <script type="text/javascript" src="/public/js/AnimOnScroll.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div class="popup_modal" id="form_modals">
            <p id="script_help" style="display: none;"></p>
            <p class="h_form_modal">ОСТАВЬТЕ ЗАЯВКУ</p>
            <p>и наш специалист свяжется с Вами</p>
            <form action="/send" method="post" id="hidden_form">
                <input name="name" type="text" placeholder="ИМЯ" id="hidden_name" />
                <input name="phone" type="text" placeholder="ТЕЛЕФОН" id="hidden_telephone" />
                <input name="email" type="text" placeholder="E-MAIL" id="hidden_email" />
                <div style="margin:5px 37px 5px 37px;" class="g-recaptcha" data-sitekey="6LcJWdUUAAAAAMEgFTqaiGQzG2fd4Brqtju6TF9M"></div>
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
            $(function () {
                function worksSearchFormDisplay($form, show) {
                    if (window.matchMedia('(max-width: 767px)').matches) {
                        $form.css('display', show ? 'block' : 'none');
                    } else {
                        $form.css('display', '');
                    }
                }

                $('.works-search-wrap.is-open .works-search-form').each(function () {
                    worksSearchFormDisplay($(this), true);
                });

                $(document).on('click', '.works-search-toggle', function () {
                    var $wrap = $(this).closest('.works-search-wrap');
                    var $form = $wrap.find('.works-search-form');
                    var isOpen = !$wrap.hasClass('is-open');

                    $wrap.toggleClass('is-open');
                    $wrap.closest('.rubrics-filter-toolbar').toggleClass('is-search-open', isOpen);
                    $(this).attr('aria-expanded', isOpen);
                    worksSearchFormDisplay($form, isOpen);

                    if (isOpen) {
                        $form.find('input[name="search"]').focus();
                    }
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
            });
        </script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(34175745, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<!-- /Yandex.Metrika counter -->
      <script type='text/javascript'>
(function () {
    window['yandexChatWidgetCallback'] = function() {
        try {
            window.yandexChatWidget = new Ya.ChatWidget({
                guid: 'ee9feed9-7ac9-4018-b1d4-7513af4e37bf',
                buttonText: 'Напишите нам, мы в сети!',
                title: 'Чат',
                theme: 'dark',
                collapsedDesktop: 'never',
                collapsedTouch: 'always'
            });
        } catch(e) { }
    };
    var n = document.getElementsByTagName('script')[0],
        s = document.createElement('script');
    s.async = true;
    s.charset = 'UTF-8';
    s.src = 'https://chat.s3.yandex.net/widget.js';
    n.parentNode.insertBefore(s, n);
})();
</script>
      
<!-- Pixel -->
<script type="text/javascript">
    (function (d, w) {
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script");
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://qoopler.ru/index.php?ref="+d.referrer+"&page=" + encodeURIComponent(w.location.href);
            n.parentNode.insertBefore(s, n);
    })(document, window);
</script>
<!-- /Pixel -->      
      
    </body>
</html>