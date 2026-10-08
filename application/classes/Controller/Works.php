<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Works extends Controller_Common
{

    public function action_index()
    {
        if($this->request->param('page'))
            $paginate = $this->request->param('page');
        $page = strtolower(Request::current()->controller());
        $info = Model::factory('Pages')->get_page_by_translit($page);
        $this->template->description = $info[0]->description;
        $this->template->keywords = $info[0]->keywords;

        $search = $this->request->query('search');
        if ($search !== NULL) {
            $search = trim($search);
            if ($search === '') {
                $search = NULL;
            }
        }

        $db_total = Model::factory('Works')->get_count($search);
        $total = $db_total[0]['total'];

        $pagination = Pagination::factory(array('total_items' => $total))
                ->route_params(array('controller' => Request::current()->controller(),
                    'action' => Request::current()->action()));

        $works = Model::factory('Works')->get_all_paginame($pagination->items_per_page, $pagination->offset, $search);
        $rubrics = Model::factory('Admin_Rubrics')->get_all();
        $name = Model::factory("Pages")->get_page_by_translit(strtolower($this->request->controller()));
        $this->template->name = $name[0]->name_menu;
        $title = $name[0]->name_menu." - ".$this->template->title;
        if(isset($paginate))
            $title .= " | страница ".$paginate;
        $this->template->title = $title;
        $this->template->content = View::factory('all_works')
                ->set('works', $works)
                ->set('rubrics', $rubrics)
                ->set('search', $search)
                ->bind('last', $last)
                ->bind('pagination', $pagination);
    }

    public function action_rubrication()
    {
        if($this->request->param('page'))
            $paginate = $this->request->param('page');
        $rubrication = $this->request->param('rubrication');
        $search = $this->request->query('search');
        if ($search !== NULL) {
            $search = trim($search);
            if ($search === '') {
                $search = NULL;
            }
        }
        $rubrics = Model::factory('Admin_Rubrics')->get_all();
        $page = strtolower(Request::current()->controller());
        $info = Model::factory('Pages')->get_page_by_translit($page);
        $this->template->description = $info[0]->description;
        $this->template->keywords = $info[0]->keywords;

        $db_total = Model::factory('Works')->get_count_by_rubrication($rubrication, $search);
        $total = $db_total[0]['total'];

        $pagination = Pagination::factory(array('total_items' => $total))
                ->route_params(array(
                    'controller' => Request::current()->controller(),
                    'action' => Request::current()->action(),
                    'rubrication' => $rubrication,
                ));

        $works = Model::factory('Works')->get_all_paginame_by_rubrication($rubrication, $search, $pagination->items_per_page, $pagination->offset);
        $name = Model::factory("Pages")->get_page_by_translit(strtolower($this->request->controller()));
        $this->template->name = $name[0]->name_menu;
        $title = $name[0]->name_menu." - ".$this->template->title;
        if(isset($paginate))
            $title .= " | страница ".$paginate;
        $this->template->title = $title;
        $this->template->content = View::factory('work_with_rubrication')
                ->set('works', $works)
                ->set('rubrics', $rubrics)
                ->set('search', $search)
                ->bind('last', $last)
                ->bind('rubrication', $rubrication)
                ->bind('pagination', $pagination);
    }
    
    private function page_work($name)
    {
        $works = Model::factory('Works')->get_work($name);
        if(!$works[0])
        {
            throw new HTTP_Exception_404('Страница не найдена'); // Тададам!
            exit();
        }
        else
        {
            $this->template->name = $works[0]->name;
            $this->template->title = $works[0]->name." - ".$this->template->title;
            $this->template->content = View::factory('page_work')->set('translit', $name)->set('text', $works[0]->text);
        }
    }

} // End Works