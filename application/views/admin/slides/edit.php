<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<article class="content item-editor-page">
    <div class="tab_container">
        <form name="item" method="POST" enctype="multipart/form-data">
            <div class="card card-block"><?php
                foreach($slide as $k => $v)
                { ?>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">h1:</label>
                                <input type="text" name="h1" class="form-control boxed" value="<?= htmlspecialchars($v->h1); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">text1:</label>
                                <textarea class="form-control boxed" id="text" name="text1"><?= htmlspecialchars($v->text1); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">h2:</label>
                                <input type="text" name="h2" class="form-control boxed" value="<?= htmlspecialchars($v->h2); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">text2:</label>
                                <textarea class="form-control boxed" name="text2"><?= htmlspecialchars($v->text2); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">h3:</label>
                                <input type="text" name="h3" class="form-control boxed" value="<?= htmlspecialchars($v->h3); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">text3:</label>
                                <textarea class="form-control boxed" name="text3"><?= htmlspecialchars($v->text3); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">Заголовок видео:</label>
                                <input type="text" name="label_video" class="form-control boxed" value="<?= htmlspecialchars($v->label_video); ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label text-xs-right">video:</label>
                                <textarea class="form-control boxed" name="video"><?= htmlspecialchars($v->video); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">Фото1</label><?php 
                                if($v->img1) { ?>
                                    <img style="max-width:1000px;" src="<?= URL::base(); ?>public/images/main/<?= $v->img1; ?>">
                                <?php } ?>
                                <input type="file" class="form-control" id="photo" name="photo1">
                            </div>
                            <div class="form-group">
                                <label for="photo">Фото2</label><?php 
                                if($v->img2) { ?>
                                    <img style="max-width:1000px;" src="<?= URL::base(); ?>public/images/main/<?= $v->img2; ?>">
                                <?php } ?>
                                <input type="file" class="form-control" id="photo" name="photo2">
                            </div>
                            <div class="form-group">
                                <label for="photo">Фото3</label><?php 
                                if($v->img3) { ?>
                                    <img style="max-width:1000px;" src="<?= URL::base(); ?>public/images/main/<?= $v->img3; ?>">
                                <?php } ?>
                                <input type="file" class="form-control" id="photo" name="photo3">
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
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
$(function () {
    CKEDITOR.replace('text');
});
</script>