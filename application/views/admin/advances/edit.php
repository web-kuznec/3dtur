<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<article class="content item-editor-page">
    <div class="tab_container">
        <form name="item" id="form_edit" method="POST">
            <div class="card card-block"><?php
                foreach($advance as $k => $v)
                { ?>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Иконка:</label>
                                <input type="text" name="awesome" class="form-control boxed" value="<?= $v->awesome; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Заголовок:</label>
                                <input type="text" name="h" class="form-control boxed" value="<?= $v->h; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Текст:</label>
                                <input type="text" name="p" class="form-control boxed" value="<?= $v->p; ?>">
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