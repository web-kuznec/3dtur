<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<div class="tab_container">
    <form method="POST">
        <div class="form-group">
            <label for="name">Название </label>
            <input type="text" class="form-control" id="name" name="name" required="required">
        </div>
        <div class="form-group">
            <label for="url">URL * <a onclick="translit('name', 'pages', 'url');">Получить автоматически</a></label>
            <input type="text" id="url" name="url" class="form-control boxed" />
        </div>
        <div class="form-group">
            <label for="name_menu">Название в меню</label>
            <input type="text" class="form-control" name="name_menu">
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" name="title" >
        </div>
        <div class="form-group">
            <label for="keywords">keywords</label>
            <input type="text" class="form-control" name="keywords" >
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea class="form-control" id="text" name="text" rows="7"></textarea>
        </div>
        <div class="form-group">
            <label for="seo">SEO описание</label>
            <textarea class="form-control" name="seo" rows="7"></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Статус</label>
            <input style="width:15px;" type="checkbox" class="form-control" name="status" title="Показывать/не показывать">
        </div>
        <div class="status-group">
            <label for="in_menu">Отображать пункт меню</label>
            <input style="width:15px;" type="checkbox" class="form-control" name="in_menu" title="Показывать/не показывать пункт меню">
        </div>
        <div class="form-group">
            <label for="in_route">Роут</label>
            <input style="width:15px;" type="checkbox" class="form-control" name="in_route" title="Добавить чтобы отображался ваш текст, а не системный">
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script type="text/javascript">
$(function () {
    CKEDITOR.replace('text');
});
</script>