<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller_Common
{
    public function action_index()
    {
        $page = strtolower(Request::current()->controller());
        $info = Model::factory('Pages')->get_page_by_translit($page);
        $name = 'Статьи';
        $title = "Статьи - ".$this->template->title;
        $description = $keywords = FALSE;
        if($info->count() == 1)
        {
            if(!empty($info[0]->name))
                $name = $info[0]->name;
            if(!empty($info[0]->title))
                $title = $info[0]->title;
            if(!empty($info[0]->description))
                $description = $info[0]->description;
            if(!empty($info[0]->keywords))
                $keywords = $info[0]->keywords;   
        }
        
        $page = Request::current()->param('page');
        $articles = Model::factory('Articles')->get_all();
        $this->template->name = $name;
        $this->template->title = $title;
        $this->template->description = $description;
        $this->template->keywords = $keywords;
        $this->template->content = View::factory("articles/all")->set('articles',$articles);
    }
    
    public function action_item()
    {
        $url = Request::current()->param('page');
        $article = Model::factory('Articles')->get_article($url);
        if($article->count() == 0)
        {
            throw new HTTP_Exception_404('Страница не найдена'); // Тададам!
            exit();
        }
        $this->template->name = $article[0]->name;
        $this->template->title = $article[0]->name;
        $imgs = Model::factory('Articles')->get_img($article[0]->id);
        $this->template->content = View::factory("articles/item")
                ->set('img', $imgs)
                ->set('id', $article[0]->id)
                ->set('name', $article[0]->name)
                ->set('text', $article[0]->text)
                ->set('date', $article[0]->date);
        if(!empty($article[0]->description))
            $this->template->description = $article[0]->description;
        if(!empty($article[0]->keywords))
            $this->template->keywords = $article[0]->keywords;
    }
}

// End Articles