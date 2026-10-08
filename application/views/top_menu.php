<?php if(!empty($pages)) 
{
    $request = Request::current();
    foreach($pages as $k => $v)
    {
        $active = "";
        if($v->translit == '') {
            if($request && $request->controller() == 'Static' && !$request->param('page'))
                $active = "navactive";
        }
        else {
            if($request && strtolower($request->controller()) == $v->translit)
                $active = "navactive";
            elseif($request && $request->param('page') == $v->translit)
                $active = "navactive";
        } ?>
        <li><a class="<?= $active; ?> color_animation" href="<?= URL::base().$v->translit; ?>"><?= $v->name_menu; ?></a></li><?php
    }
} ?>