<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<div class="tab_container">
    <h1>Редактирование страницы</h1>
    <form method="POST"><?php
    foreach($page as $k => $v)
    { ?>
        <div class="form-group">
            <label for="name">Название </label>
            <input type="text" value="<?= htmlspecialchars($v->name,ENT_QUOTES); ?>" class="form-control" name="name" required="required">
        </div>
        <div class="form-group">
            <label for="url">Название в меню</label>
            <input type="text" value="<?= $v->name_menu; ?>" class="form-control" name="name_menu">
        </div>
        <div class="form-group">
            <label for="url">title</label>
            <input type="text" value="<?= $v->title; ?>" class="form-control" name="title" >
        </div>
        <div class="form-group">
            <label for="url">keywords</label>
            <input type="text" value="<?= $v->keywords; ?>" class="form-control" name="keywords" >
        </div>
        <div class="form-group">
            <label for="url">description</label>
            <textarea class="form-control" name="description" rows="3"><?= $v->description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea class="form-control" id="text" name="text" rows="7"><?= htmlspecialchars($v->text,ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
            <label for="text">SEO описание</label>
            <textarea class="form-control" name="seo" rows="7"><?= htmlspecialchars($v->seo,ENT_QUOTES); ?></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Статус</label>
            <input <?php if($v->status == 1) { echo "checked"; } ?> style="width:15px;" type="checkbox" class="form-control" name="status" title="Показывать/не показывать">
        </div>
        <div class="form-group">
            <label for="photo">Отображать пункт меню</label>
            <input <?php if($v->in_menu == 1) { echo "checked"; } ?> style="width:15px;" type="checkbox" class="form-control" name="in_menu" title="Показывать/не показывать пункт меню">
        </div>
        <div class="form-group">
            <label for="photo">Роут</label>
            <input <?php if($v->in_route == 1) { echo "checked"; } ?> style="width:15px;" type="checkbox" class="form-control" name="in_route" title="Добавить чтобы отображался ваш текст, а не системный">
        </div>
        <input type="hidden" name="id" id="id" value="<?= $v->id; ?>">
        <button type="submit" class="btn btn-success">Сохранить</button><?php
    } ?>
    </form>
</div>
<!--<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>-->
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script type="text/javascript">
$(function () {
    CKEDITOR.replace('text');
});
</script>