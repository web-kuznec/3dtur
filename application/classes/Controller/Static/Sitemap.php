<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Static_Sitemap extends Controller {
    
    public static $_date = NULL;
    public static $_fp = NULL;
    public static $_header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    public static function index()
    {
        self::$_date = date('Y-m-d');
        self::$_fp = fopen("sitemap.xml", "w+");
        fwrite(self::$_fp, self::$_header);
        self::generate();
        fwrite(self::$_fp, "
</urlset>");
        fclose(self::$_fp);
    }
    
    private static function generate()
    {
        self::main_page();
        self::works();
        self::articles();
    }
    
    /**
     * Метод записывает в sitemap статичные страницы в основном с главной страницы
     */
    private static function main_page()
    {
        self::write_file(self::$_fp, URL::base('https'), self::$_date, "1");
        $pages = Model::factory('Admin_Sitemap')->pages();
        foreach($pages as $k => $v)
        {
            $url = URL::base('https').self::url($v->translit);
            self::write_file(self::$_fp, $url, $v->date_update, "0.8");
        }
    }
    
    /**
     * Метод записывает в sitemap статичные портфолио
     */
    private static function works()
    {
        self::write_file(self::$_fp, URL::base('https').'works', self::$_date, "1");
        $pages = Model::factory('Admin_Sitemap')->works();
        foreach($pages as $k => $v)
        {
            $url = URL::base('https')."panorama/".self::url($v->translit)."/index.html";
            self::write_file(self::$_fp, $url, ($v->date_update) ? $v->date_update : self::$_date, "0.8");
        }
    }
    
    /**
     * Метод записывает в sitemap статичные портфолио
     */
    private static function articles()
    {
        self::write_file(self::$_fp, URL::base('https').'articles', self::$_date, "1");
        $pages = Model::factory('Admin_Sitemap')->articles();
        foreach($pages as $k => $v)
        {
            $url = URL::base('https')."articles/item/".self::url($v->translit).".html";
            self::write_file(self::$_fp, $url, ($v->date_update) ? $v->date_update : self::$_date, "0.8");
        }
    }
    
    /**
     * Обрабатываем url -заменяем кавычки и прочую хуйню символами
     * @param string $url - url изначально
     * @return string
     */
    private static function url($url)
    {
        $url = str_replace("&", "&amp;", $url);
        $url = str_replace("&&amp;", "&amp;", $url);
        $url = str_replace("'", "&apos;", $url);
        $url = str_replace('"', "&quot;", $url);
        $url = str_replace(">", "&gt;", $url);
        $url = str_replace("<", "&lt;", $url);
        return $url;
    }
    
    /**
     * Метод записывает в файл $fp данные
     * @param type $fp - файл
     * @param type $url - адрес страницы
     * @param type $date - дата обновления страницы
     * @param type $priority - приоритет
     */
    private static function write_file($fp, $url, $date, $priority)
    {
        fwrite($fp, "
<url>
    <loc>".$url."</loc>
    <lastmod>".date('Y-m-d',strtotime($date))."</lastmod>
    <priority>".$priority."</priority>
</url>");
    }
}