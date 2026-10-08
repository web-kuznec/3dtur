<link rel="stylesheet" href="<?= URL::base(); ?>public/js/datepicker/datepicker3.css" type="text/css">
<div class="tab_container">
<h3>Добавление статьи</h3>
<form id="news_new" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="name">Заголовок статьи *</label>
            <input type="text" id="name" name="name" class="form-control boxed" value="" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="url">URL * <a onclick="translit('name', 'articles', 'url');">Получить автоматически</a></label>
            <input type="text" id="url" name="url" class="form-control boxed" />
        </div>
    </div> 
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="image">Изображение</label>
            <input type="file" name="image" class="form-control boxed" />
        </div>
    </div> 
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_name">Дата начала показа</label>
            <input type="text" autocomplete="off" id="date" name="date" class="form-control boxed" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_tizer">Краткое описание*</label>
            <textarea class="form-control boxed" id="tizer" name="tizer"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_text">Полное описание*</label>
            <textarea class="form-control boxed" id="text" name="text"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_title">title</label>
            <textarea class="form-control boxed" id="title" name="title"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_keywords">keywords</label>
            <textarea class="form-control boxed" id="keywords" name="keywords"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_description">description</label>
            <textarea class="form-control boxed" id="description" name="description"></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_status">Статус</label>
            <input style="width:auto;width:30px;" checked="checked" type="checkbox" id="status" name="status" class="form-control boxed" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <button class="btn-primary btn" type="submit" >Добавить статью</button>
        </div>
    </div>
</form>
</div>
<script src="<?= URL::base(); ?>public/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= URL::base(); ?>public/js/datepicker/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
$('#date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
});
$(function () {
    CKEDITOR.replace('text');
});
</script>