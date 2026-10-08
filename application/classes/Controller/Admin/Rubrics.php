<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Rubrics extends Controller_Admin_Security
{        
    public function action_index()
    {
        $controller = strtolower($this->request->controller());
        $rubrics = Model::factory('Admin_Rubrics')->get_all();
        $html = View::factory('admin/rubrics/all')
                    ->set('rubrics', $rubrics)
                    ->set('controller', $controller);
        $this->template->content = $html;
        $name = $this->name_module($controller);
        $this->template->action = View::factory('admin/rubrics/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
    
    public function action_add()
    {
        if($this->request->post())
            $this->add();
        $html = View::factory('admin/rubrics/add');
        $this->template->content = $html;
        $this->template->action = View::factory('admin/rubrics/action');
        $this->template->name = "Создание рубрики";
    }
    
    private function add()
    {
        $name = $this->request->post('name');
        $translation = $this->request->post('translation');
        $sort = $this->request->post('sort');
        Model::factory('Admin_Rubrics')->save($name, $translation, $sort);
        HTTP::redirect(URL::base('http', TRUE).'admin/rubrics');
    }
    
    public function action_edit()
    {
        $id = $this->request->param('id');
        if($id)
        {
            if($this->request->post())
                $this->edit($id);
            $rubrics = Model::factory('Admin_Rubrics')->get_item($id);
            $html = View::factory('admin/rubrics/edit')->set('rubrics', $rubrics);
            $this->template->content = $html;
            $this->template->action = View::factory('admin/rubrics/action');
            $this->template->name = "Редактирование рубрики";
        }
    }
    
    private function edit($id)
    {
        $name = $this->request->post('name');
        $sort = $this->request->post('sort');
        $translation = $this->request->post('translation');
        Model::factory('Admin_Rubrics')->edit($id, $name, $sort, $translation);
        HTTP::redirect(URL::base('http', TRUE).'admin/rubrics');
    }

    public function action_dell()
    {
        $id = $this->request->param('id');
        if($id) {
            Model::factory('Admin_Rubrics')->dell($id);
            HTTP::redirect(URL::base('http', TRUE).'admin/rubrics');
        }
    }
    
}