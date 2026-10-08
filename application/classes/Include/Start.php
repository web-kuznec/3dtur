<?php defined('SYSPATH') or die('No direct script access.');

class Start {

    /**
     * Метод возвращает транслиты страниц, которые активны на сайте, через разделитель "|"
     * @return string
     */
    public function initpage() {
        $html = "|";
        $info = Model::factory('Pages')->active_pages();
        $i = 0;
        foreach ($info as $k) {
            $i++;
            $translit = $k->translit;
            if ($i == $info->count())
                $html .= $translit;
            else
                $html .= $translit . "|";
        }
        return $html;
    }

}

// End Start