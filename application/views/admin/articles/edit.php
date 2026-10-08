<link rel="stylesheet" href="<?= URL::base(); ?>public/js/datepicker/datepicker3.css" type="text/css">
<div class="tab_container">
<h3>Редактирование статьи</h3>
<form id="news_new" class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="name">Заголовок статьи *</label>
            <input type="text" id="name" name="name" class="form-control boxed" value="<?= $article->name; ?>" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="url">URL * <a onclick="translit('name', 'articles', 'url');">Получить автоматически</a></label>
            <input type="text" id="url" name="url" class="form-control boxed" value="<?= $article->translit; ?>" />
        </div>
    </div> 
    <div class="form-group row">
        <div class="col-sm-12">
            <?php if(!empty($img)) { 
                foreach($img as $i => $m)
                { ?>
                    <div id="img_<?= $m->id; ?>">
                        <p><img src="<?= URL::base() ?>public/articles/<?= $article->id; ?>/<?= $m->photo; ?>"></p>
                        <p><a onclick="dell_img_art(<?= $m->id; ?>)">Удалить фотографию</a></p>
                    </div><?php
                }
            } ?>
            <label class="form-control-label text-xs-right" for="image">Изображение</label>
            <input type="file" name="image" class="form-control boxed" />
        </div>
    </div> 
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_name">Дата начала показа</label>
            <input type="text" autocomplete="off" id="date" name="date" class="form-control boxed" value="<?= date('d-m-Y',strtotime($article->date)); ?>" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_tizer">Краткое описание*</label>
            <textarea class="form-control boxed" id="tizer" name="tizer"><?= $article->caption; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_text">Полное описание*</label>
            <textarea class="form-control boxed" id="text" name="text"><?= $article->text; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_title">title</label>
            <textarea class="form-control boxed" id="title" name="title"><?= $article->title; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_keywords">keywords</label>
            <textarea class="form-control boxed" id="keywords" name="keywords"><?= $article->keywords; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_description">description</label>
            <textarea class="form-control boxed" id="description" name="description"><?= $article->description; ?></textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <label class="form-control-label text-xs-right" for="news_status">Статус</label>
            <input style="width:auto;width:30px;" <?php if($article->status == 1) { echo 'checked="checked"'; } ?> type="checkbox" id="status" name="status" class="form-control boxed" />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <input type="hidden" name="id" value="<?= $article->id; ?>">
            <button class="btn-primary btn" type="submit" >Редактировать статью</button>
        </div>
    </div>
</form>
</div>
<script src="<?= URL::base(); ?>public/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?= URL::base(); ?>public/js/datepicker/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
<!--<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>-->
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
$('#date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
});
$(function () {
    CKEDITOR.replace('text');
});
function dell_img_art(id) {
    if (confirm("Удалить фотку?")) {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            data: {id:id},
            url: '/ajax/ajax/articles/dell_img',
            success: function() {
                $('#img_'+id).remove();
            }
        });
    }
}
</script>