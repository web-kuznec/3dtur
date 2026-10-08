<section id="last_works">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Портфолио</h1>
            </div>
        </div>
        <div class="row rubrics-filter">
            <div class="col-sm-12 rubrics-filter-toolbar">
                <div class="rubrics-filter-toolbar__rubric">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Выбрать рубрику <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?= URL::base(); ?>works">Показать всё</a></li><?php
                            foreach ($rubrics as $r) {
                                if (empty($r->translation)) {
                                    continue;
                                } ?>
                                <li<?= ($rubrication == $r->translation) ? ' class="active"' : ''; ?>>
                                    <a href="<?= URL::base(); ?>works/<?= $r->translation; ?>"><?= $r->name; ?></a>
                                </li><?php
                            } ?>
                        </ul>
                    </div>
                </div>
                <?= View::factory('works/search_form')
                    ->set('search_action', URL::base().'works/'.$rubrication)
                    ->set('search', isset($search) ? $search : NULL); ?>
            </div>
        </div>
        <div class="row"><?php
            foreach ($works as $k => $v) { ?>
                <div class="col-md-4 col-sm-6 col-xs-12 item">
                    <a href="<?= URL::base(); ?>panorama/<?= $v->translit; ?>/index.html">
                    <div class="img_conteiner">
                        <img src="<?= URL::base() ?>public/works/<?= $v->id; ?>/<?= $v->photo; ?>">
                        <div class="img_hover3">
                            <div class="img_hover"></div>
                            <div class="img_hover2">
                                
                                <div class="container_table">
                                    <div class="container_ceil">
                                        <img class="whorig" src="<?= URL::base(); ?>public/images/lg.png">Посмотреть виртуальный тур
                                    </div>
                                </div>
                                
                            </div>
                        </div>    
                    </div>
                    </a>
                    <h3><?= $v->slide_h; ?></h3>
                    <p><?= $v->slide_descr; ?></p>
                </div><?php
            } ?>
        </div>
        <div class="row">
            <div class="col-md-12"><?= $pagination; ?></div>
        </div>
    </div>
</section>