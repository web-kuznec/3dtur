<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<article class="content item-editor-page">
    <div class="tab_container">
        <form name="item" action="<?= URL::base(); ?>admin/advances/add" method="POST">
            <div class="card card-block">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Иконка:</label>
                            <input type="text" name="awesome" class="form-control boxed" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Заголовок:</label>
                            <input type="text" name="h" class="form-control boxed" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Текст:</label>
                            <input type="text" name="p" class="form-control boxed" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</article>