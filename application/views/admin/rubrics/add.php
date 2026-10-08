<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<article class="content item-editor-page">
    <div class="tab_container">
        <form name="item" action="<?= URL::base(); ?>admin/rubrics/add" method="POST">
            <div class="card card-block">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Название:</label>
                            <input type="text" name="name" class="form-control boxed" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Транслит:</label>
                            <input type="text" name="translation" class="form-control boxed" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label text-xs-right">Сортировка:</label>
                            <input type="text" name="sort" class="form-control boxed" value="">
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