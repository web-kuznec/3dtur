<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<div class="tab_container">
    <h1>Настройки</h1>
    <form name="item" id="form_edit" method="POST" enctype="multipart/form-data"><?php
        foreach($settings as $k => $v)
        { ?>
            <div class="form-group">
                <label for="name">Текст в шапке </label>
                <input type="text" value="<?= htmlspecialchars($v->text_top,ENT_QUOTES); ?>" class="form-control" name="text_top" placeholder="Текст в шапке">
            </div>
            <div class="form-group">
                <label for="name">Телефон </label>
                <input type="text" value="<?= $v->phone; ?>" class="form-control" name="phone" placeholder="Телефон">
            </div>
            <div class="form-group">
                <label for="name">E-mail </label>
                <input type="text" value="<?= $v->email; ?>" class="form-control" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="name">title </label>
                <input type="text" value="<?= htmlspecialchars($v->title,ENT_QUOTES); ?>" class="form-control" name="title" placeholder="title">
            </div>
            <div class="form-group">
                <label for="name">keywords </label>
                <input type="text" value="<?= $v->keywords; ?>" class="form-control" name="keywords" placeholder="keywords">
            </div>
            <div class="form-group">
                <label for="text">description </label>
                <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($v->description,ENT_QUOTES); ?></textarea>
            </div>
            <div class="form-group">
                <label for="text">Текст внизу </label>
                <textarea class="form-control" name="text_bottom" rows="3"><?= htmlspecialchars($v->text_bottom,ENT_QUOTES); ?></textarea>
            </div>
            <input type="hidden" name="id" value="<?= $v->id; ?>">
            <button type="submit" class="btn btn-success">Сохранить</button><?php
        } ?>
    </form>
</div>