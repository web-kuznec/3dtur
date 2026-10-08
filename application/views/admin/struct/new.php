<div id="window_admin_middle">
    <form id="struct_new" method="POST" onSubmit="struct_check('struct_new'); return false;">
        <div class="fleft">
            <h3>Создание страницы</h3>
        </div>
        <div class="fright">
            <a title="Закрыть" onclick="close_div('div_fix', 'div_abs');"><div id="window_close"></div></a>
        </div>
        <div class="clear"></div>
        <div class="otstp10"></div>
        <div>Название</div>
        <div>
            <input type="text" id="struct_name" name="struct_name" class="inptext494" value="" />
        </div>
        <div class="otstp10"></div>
        <div>Название в меню</div>
        <div>
            <input type="text" id="struct_name_menu" name="struct_name_menu" class="inptext494" value="" />
        </div>
        <div class="otstp10"></div>
        <div>URL <a onclick="translit('struct_name', 'pages', 'struct_url');">Выполнить транслитерацию</a></div>
        <div>
            <input type="text" id="struct_url" name="struct_url" class="inptext494" value="" />
        </div>
        <div class="otstp10"></div>
        <div>Сортировка</div>
        <div>
            <input type="text" id="struct_sort" name="struct_sort" class="inptext494" value="" />
        </div>
        <div class="otstp10"></div>
        <div>Title</div>
        <div>
            <textarea id="struct_title" name="struct_title" class="inptext494"></textarea>
        </div>
        <div class="otstp10"></div>
        <div>Keywoards</div>
        <div>
            <textarea id="struct_keywoards" name="struct_keywoards" class="inptext494"></textarea>
        </div>
        <div class="otstp10"></div>
        <div>Description</div>
        <div>
            <textarea id="struct_description" name="struct_description" class="inptext494"></textarea>
        </div>
        <div class="otstp10"></div>
        <div>SEO текст</div>
        <div>
            <textarea id="struct_seo" name="struct_seo" class="inptext494"></textarea>
        </div>
        <div class="otstp10"></div>
        <div class="fleft">Статус:&nbsp;</div>
        <div style="padding-top:2px;" class="fleft">
            <input type="checkbox" id="struct_status" name="struct_status">
        </div>
        <div class="clear"></div>
        <div class="otstp10"></div>
        <div class="fleft">Отображать в меню:&nbsp;</div>
        <div style="padding-top:2px;" class="fleft">
            <input type="checkbox" id="struct_inmenu" name="struct_inmenu" checked>
        </div>
        <div class="fright">
            <input type="hidden" name="page" value="<?= $page; ?>">
            <input type="submit" class="button" value="Создать" />
        </div>
        <div class="clear"></div>
    </form>
</div>