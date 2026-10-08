<?php defined('SYSPATH') or die('No direct script access.');
 
abstract class Controller_Admin_Common extends Controller_Template
{ 
    public $template = 'admin/main';
    
    public function before()
    {
        parent::before();
        $this->security();
        $this->template->styles = View::factory('admin/styles/styles');
        if($this->_user !== FALSE)
        {
            View::set_global('title', 'Панель управления');
            $this->template->menu = $this->menu();
            $this->template->scripts = View::factory('admin/scripts/auth');
        }
        else
            $this->template->scripts = View::factory('admin/scripts/not_auth');
    }
    
    /**
     * Метод выводит окно авторизации
     * @return type
     */
    public function noauth()
    {
        $html = View::factory('auth/auth');
        return View::factory('auth/oblojka')->set('html', $html);
    }
    
    public function info()
    {
        return View::factory('admin/info');
    }
    
    public function admin()
    {
        //$modules = $this->action_getmodules();
    }
    
    public function menu()
    {
        if(count($this->_modules) > 0)
        {
            $html = View::factory('admin/menu')
                    ->set('menu', $this->_modules);
            return $html;
        }
        else
            return FALSE;
    }
    
    public function name_module($controller)
    {
        return Model::factory('Admin_Modaccess')->get_name(strtolower($controller));
    }
    
} //End Controller_Admin_Common