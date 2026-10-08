<?php defined('SYSPATH') or die('No direct script access.');
 
abstract class Controller_Common extends Controller_Template {
 
    public $template = 'main';
    public $_settings = array();
 
    public function before()
    {
        parent::before();
        $pages = Model::factory('Pages')->active_top_menu();
        $this->template->menu = View::factory("top_menu")->set('pages', $pages);
        $setting = Model::factory('Admin_Settings')->get_all();
        foreach($setting as $k => $v)
        {
            $this->_settings['title'] = $v->title;
            $this->_settings['keywords'] = $v->keywords;
            $this->_settings['description'] = $v->description;
            $this->_settings['text_top'] = $v->text_top;
            $this->_settings['text_bottom'] = $v->text_bottom;
            $this->_settings['phone'] = $v->phone;
            $this->_settings['email'] = $v->email;
        }
        $this->template->content = '';
        $this->template->title = $this->_settings['title'];
        $this->template->text_top = $this->_settings['text_top'];
        $this->template->text_bottom = $this->_settings['text_bottom'];
        $this->template->phone = $this->_settings['phone'];
        $this->template->email = $this->_settings['email'];
    }
 
} // End Common