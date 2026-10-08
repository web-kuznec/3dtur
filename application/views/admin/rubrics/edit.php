<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<article class="content item-editor-page">
    <div class="tab_container">
        <form name="item" id="form_edit" method="POST">
            <div class="card card-block"><?php
                foreach($rubrics as $k => $v)
                { ?>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Название:</label>
                                <input type="text" name="name" class="form-control boxed" value="<?= $v->name; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Транслит:</label>
                                <input name="translation" type="text" class="form-control boxed" value="<?= $v->translation; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Сортировка:</label>
                                <input type="text" name="sort" class="form-control boxed" value="<?= $v->sort; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="<?= $v->id; ?>">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </div>
                    </div><?php
                } ?>
            </div>
        </form>
    </div>
</article>