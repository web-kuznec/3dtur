<section class="certificate" id="certificate">
    <h1><a class="anchor" href="#certificate"><?= $info->name ?></a></h1>
    <?= $info->text1 ?>
    <p>
        Более подробная информация о виртуальных турах <a class="btn btn-warning bbtn-certificate">Google</a> и <a class="btn btn-warning bbtn-certificate">Yandex</a>
    </p>
    <div class="window-pano">
        <div class="slide">
            <div class="google">
                <picture>
                    <source srcset="/public/www/img/window-google@x1.png">
                    <img src="/public/www/img/window-google@x1.jpg" alt="Пример размещения на картах Google">
                </picture>
            </div>
        </div>
        <div class="yandex">
            <picture>
                <source srcset="/public/www/img/window-yandex@x1.png">
                <img src="/public/www/img/window-yandex@x1.jpg" alt="Пример размещения на Яндекс картах">
            </picture>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <img src="/public/images/main/<?= $info->img1 ?>">
        </div>
        <div class="col-12 col-md-6">
            <img src="/public/images/main/<?= $info->img2 ?>">
        </div>
    </div>
</section>