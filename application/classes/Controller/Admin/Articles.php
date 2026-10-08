<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Articles extends Controller_Admin_Common {
    
    public $_n = 40;
    public $_paginator = FALSE;
    public $_start = 0;
    public $_limit = 40;
    
    /**
     * Перед выводом статей формируем общую информацию. например меню действий
     */
    public function before()
    {
        parent::before();
        if($this->_user === FALSE) // юзер не авторизован
        {
            $this->template->set_filename('login');
            $this->template->name = "Авторизация";
            $this->template->content = $this->noauth();
        }
        if(Kohana::$config->load('articles')->count())
            $this->_config = Kohana::$config->load('articles');
        
        $path = URL::base('http');
        if($this->request->directory())
            $path .= strtolower($this->request->directory())."/";
        $path .= strtolower($this->request->controller());
        $this->template->action = View::factory('admin/articles/action')->bind('path', $path);
    }
    
    /**
     * Метод выводит все статьи
     */
    public function action_index()
    {
        $all_articles = Model::factory('Admin_Articles')->get_articles();
        $count = $all_articles->count();
        $this->pagination($count);
        $this->template->pagination = $this->_paginator;
        $articles = Model::factory("Admin_Articles")->limit_info($this->_start, $this->_limit);
        $name = $this->name_module($this->request->controller());
        if($name !== FALSE)
            $this->template->name = $name['name'];
        $html = View::factory('admin/articles/all')
                ->set('articles', $articles);
        $this->template->content = $html;
    }
    
    /**
     * Метод выводит историю изменения статей
     */
    public function action_history()
    {
        $all_articles = Model::factory('Admin_Articles')->get_history();
        $count = $all_articles->count();
        $this->pagination($count);
        $this->template->pagination = $this->_paginator;
        $articles = Model::factory("Admin_Articles")->limit_info_history($this->_start, $this->_limit);
        $name = $this->name_module($this->request->controller());
        if($name !== FALSE)
            $this->template->name = $name['name'];
        $html = View::factory('admin/articles/history')
                ->set('articles', $articles);
        $this->template->content = $html;
    }
    
    /**
     * Постраничная навигация
     * @param integer $count количество статей
     */
    public function pagination($count)
    {
        $page = $this->request->param('page');
        if(isset($page))
        {
            $this->_start = $this->_n*$page-$this->_n;
            $this->_limit = $this->_n;
        }
        else
        {
            $this->_limit = $this->_n;
        }
        $this->_paginator = Pagination::factory(array('total_items' => $count, 'items_per_page' => $this->_n));
    }
    
    /**
     * Добавляем статью
     */
    public function action_add()
    {
        if($this->request->post())
            $this->add();

        $name = $this->name_module($this->request->controller());
        if($name !== FALSE)
            $this->template->name = $name['name'];
        $html = View::factory('admin/articles/add');
        $this->template->content = $html;
    }
    
    private function add()
    {
        $post = Validation::factory($this->request->post()); // готовимся к проведению валидации
        $post->rule('name', 'not_empty');
        $post->rule('url', 'not_empty');
        $post->rule('tizer', 'not_empty');
        $post->rule('tizer', 'min_length', array(':value', 6));
        if($post->check()) // проводим валидацию
        {
            $name = $this->request->post('name');
            $url = $this->request->post('url');
            if($this->request->post('date'))
                $date = date("Y-m-d H:i:s",strtotime($this->request->post('date')));
            else
                $date = date("Y-m-d H:i:s");
            $tizer = $this->request->post('tizer');
            $text = $this->request->post('text');
            $title = $this->request->post('title');
            $keywords = $this->request->post('keywords');
            $description = $this->request->post('description');
            $status = 0;
            if($this->request->post('status'))
                $status = 1;
            $article = Model::factory('Admin_Articles')->create($name,$url,$date,$tizer,$text,$title,$keywords,$description,$status,$this->_user);
            if(!empty($_FILES['image']['tmp_name']))
                $this->load_img($article[0]);
            Controller_Static_Sitemap::index();
            HTTP::redirect('/admin/articles');
        }
    }
    
    private function load_img($id)
    {
        $dir = PUBPATH.'articles/'.$id;
        $new_photo = $id."_".date('ymdHis_');
        if(!is_dir($dir))
            mkdir($dir, 0777);
        $img = getimagesize($_FILES['image']['tmp_name']);
        $ext = '.' . str_replace('image/', '', $img['mime']);
        $f = $dir.'/'.$new_photo.$ext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $f))
        {
            Controller_Static_Images::imageresize($f,$f,$this->_config->max_width_img,$this->_config->max_height_img,100);
            $img_type = image_type_to_mime_type($img[2]);
            if($img_type == "image/jpeg")
                shell_exec("jpegoptim --strip-all " .$f);
            elseif($img_type == "image/png")
                shell_exec("optipng " . $f);
            Model::factory('Admin_Articles')->add_photo($id, $new_photo, $ext);
        }
    }
    
    /**
     * Добавляем статью
     */
    public function action_edit()
    {
        $id = $this->request->param('id');
        if($this->request->post())
        {
            $this->edit();
            HTTP::redirect('/admin/articles');
        }
        $name = $this->name_module($this->request->controller());
        if($name !== FALSE)
            $this->template->name = $name['name'];
        $article = Model::factory('Admin_Articles')->get_info($id);
        $img = Model::factory('Admin_Articles')->get_img($id);
        $html = View::factory('admin/articles/edit')
                ->set('article',$article[0])
                ->set('img',$img);
        $this->template->content = $html;
    }
    
    private function edit()
    {
        $post = Validation::factory($this->request->post()); // готовимся к проведению валидации
        $post->rule('id', 'not_empty');
        $post->rule('name', 'not_empty');
        $post->rule('url', 'not_empty');
        $post->rule('tizer', 'not_empty');
        $post->rule('tizer', 'min_length', array(':value', 6));
        if($post->check()) // проводим валидацию
        {
            $id = $this->request->post('id');
            $name = $this->request->post('name');
            $url = $this->request->post('url');
            if($this->request->post('date'))
                $date = date("Y-m-d H:i:s",strtotime($this->request->post('date')));
            else
                $date = date("Y-m-d H:i:s");
            $tizer = $this->request->post('tizer');
            $text = $this->request->post('text');
            $title = $this->request->post('title');
            $keywords = $this->request->post('keywords');
            $description = $this->request->post('description');
            $status = 0;
            if($this->request->post('status'))
                $status = 1;
            Model::factory('Admin_Articles')->update($id,$name,$url,$date,$tizer,$text,$title,$keywords,$description,$status,$this->_user);
            if(!empty($_FILES['image']['tmp_name']))
            {
                $images = Model::factory('Admin_Articles')->get_photo_by_articles($id);
                foreach($images as $k => $v)
                {
                    Model::factory('Admin_Articles')->dell_photo($v->id);
                    $file = PUBPATH.'articles/'.$id.'/'.$v->photo;
                    if(file_exists($file))
                        unlink($file);
                }
                $this->load_img($id);
            }
            Controller_Static_Sitemap::index();
            HTTP::redirect('/admin/articles');
        }
    }
}