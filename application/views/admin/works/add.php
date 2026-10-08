<div class="tab_container">
    <h1>Новая работа</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Заголовок *</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите название работы" required="required">
            <p class="help-block">Название будет видно на странице портфолио</p>
        </div>
        <div class="form-group">
            <label for="url">url *</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Введите url" required="required">
            <p class="help-block">Url - путь в адресной строке браузера. Его можно <a onclick="translit('name', 'works', 'url');" >сгенирировать автоматически</a></p>
        </div>
        <div class="form-group">
            <label for="text">Описание работы *</label>
            <textarea class="form-control" id="text" name="text" required="required" rows="7"></textarea>
            <p class="help-block">Опишите подробно создаваемую работу</p>
        </div>
        <div class="form-group">
            <label for="text">Рубрика</label>
            <select name="rubrics" class="form-control">
                <option value="">Не выбрано</option><?php
                foreach($rubrics as $r) { ?>
                    <option value="<?= $r->id ;?>"><?= $r->name ?></option><?php
                } ?>
            </select>
            <p class="help-block">Поле не обязательно для заполнения</p>
        </div>
        <div class="form-group">
            <label for="photo">Фото работы *</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <p class="help-block">Загрузите фото для preview и слайдера</p>
        </div>
        <div class="form-group">
            <label for="photo">Архив с панорамой</label>
            <input type="file" class="form-control" id="tur" name="tur">
            <p class="help-block">Загрузите zip архив с панорамой </p>
        </div>
        <div class="form-group">
            <label for="photo">Показывать работы в слайдере </label>
            <input style="width:15px;" type="checkbox" class="form-control" id="slider" name="slider" title="Показывать/не показывать работу в слайдере">
        </div>
        <div class="form-group">
            <label for="name">Заголовок слайда </label>
            <input type="text" class="form-control" name="slide_h" placeholder="Заголовок слайда">
        </div>
        <div class="form-group">
            <label for="text">Описание слайда </label>
            <textarea class="form-control" name="slide_desc" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="photo">Статус</label>
            <input style="width:15px;" type="checkbox" class="form-control" id="status" name="status" title="Включить/выключить работу">
        </div>
        <button type="submit" class="btn btn-success">Создать работу</button>
    </form>
</div>