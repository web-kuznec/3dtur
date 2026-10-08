<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Struct extends Controller_Admin_Security
{    
    /**
     * Метод вывода всех страниц
     */
    public function action_index()
    {
        $pages = Model::factory('Admin_Struct')->get_pages();
        $html = View::factory('admin/struct/struct')
                    ->set('pages', $pages);
        $this->template->content = $html;
        $name = $this->name_module($this->request->controller());
        $this->template->action = View::factory('admin/struct/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
    
    public function action_history()
    {
        $pages = Model::factory('Admin_Struct')->get_history();
        $name = $this->name_module($this->request->controller());
        $this->template->action = View::factory('admin/struct/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
        $html = View::factory('admin/struct/history')
                ->set('pages', $pages);
        $this->template->content = $html;
    }
    
    /**
     * Метод вывода страницы создания
     */
    public function action_add()
    {
        if($this->request->post())
            $this->add();
        $html = View::factory('admin/struct/add');
        $this->template->content = $html;
        $this->template->name = "Новая страница";
        $this->template->action = View::factory('admin/struct/action');
    }
    
    public function add()
    {
        $id = NULL;
        if($this->request->param('id'))
            $id = $this->request->param('id');
        $name = $this->request->post('name');
        $url = $this->request->post('url');
        $name_menu = $this->request->post('name_menu');
        $title = $this->request->post('title');
        $keywords = $this->request->post('keywords');
        $description = $this->request->post('description');
        $text = $this->request->post('text');
        $seo = $this->request->post('seo');
        $status = 0;
        if($this->request->post('status'))
            $status = 1;
        $in_menu = 0;
        if($this->request->post('in_menu'))
            $in_menu = 1;
        $in_route = 0;
        if($this->request->post('in_route'))
            $in_route = 1;
        
        $col = array('parent','name','translit','name_menu','title',
            'keywords','description','text','seo','status','in_menu','in_route','date_update');
        $val = array($id,$name,$url,$name_menu,$title,$keywords,$description,
            $text,$seo,$status,$in_menu,$in_route,date('Y-m-d H:m:s'));
            
        Model::factory('Admin_Struct')->add($col,$val);
        Controller_Static_Sitemap::index();
        HTTP::redirect('/admin/struct');
    }
    
    /**
     * Метод вывода страницы редактирования
     */
    public function action_edit()
    {
        $id = $this->request->param('id');
        if($id)
        {
            if($this->request->post())
                $this->edit();
            $page = Model::factory('Admin_Struct')->get_item($id);
            $html = View::factory('admin/struct/edit')
                    ->set('page', $page);
            $this->template->content = $html;
            $this->template->name = "Структура сайта -> ".$page[0]->name;
            $this->template->action = View::factory('admin/struct/action');
        }
    }
    
    /**
     * Метод принимает POST данные и сохраняет в БД
     */
    private function edit()
    {
        $id = intval($this->request->post('id'));
        $name = $this->request->post('name');
        $name_menu = $this->request->post('name_menu');
        $title = $this->request->post('title');
        $keywords = $this->request->post('keywords');
        $description = $this->request->post('description');
        $text = $this->request->post('text');
        $seo = $this->request->post('seo');
        $status = 0;
        if($this->request->post('status'))
            $status = 1;
        $in_menu = 0;
        if($this->request->post('in_menu'))
            $in_menu = 1;
        $in_route = 0;
        if($this->request->post('in_route'))
            $in_route = 1;
        
        $arr = array('name'=>$name,'name_menu'=>$name_menu, 
            'title'=>$title,'keywords'=>$keywords,'date_update'=>date('Y-m-d H:m:s'), 
            'description'=>$description,'text'=>$text,'seo'=>$seo,
            'status'=>$status,'in_menu'=>$in_menu, 'in_route'=>$in_route);
            
        Model::factory('Admin_Struct')->edit($id,$arr);
        Controller_Static_Sitemap::index();
        HTTP::redirect('/admin/struct');
    }
}