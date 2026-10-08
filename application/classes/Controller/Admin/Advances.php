<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Advances extends Controller_Admin_Security
{        
    public function action_index()
    {
        $controller = strtolower($this->request->controller());
        $advances = Model::factory('Admin_Advances')->get_all();
        $html = View::factory('admin/advances/all')
                    ->set('advances', $advances)
                    ->set('controller', $controller);
        $this->template->content = $html;
        $name = $this->name_module($controller);
        $this->template->action = View::factory('admin/advances/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
    
    public function action_add()
    {
        if($this->request->post())
            $this->add();
        $html = View::factory('admin/advances/add');
        $this->template->content = $html;
        $this->template->action = View::factory('admin/advances/action');
        $this->template->name = "Создание преимущества";
    }
    
    private function add()
    {
        $awesome = $this->request->post('awesome');
        $h = $this->request->post('h');
        $p = $this->request->post('p');
        Model::factory('Admin_Advances')->save($awesome, $h, $p);
    }
    
    public function action_edit()
    {
        $id = $this->request->param('id');
        if($id)
        {
            if($this->request->post())
                $this->edit($id);
            $advance = Model::factory('Admin_Advances')->get_item($id);
            $html = View::factory('admin/advances/edit')->set('advance', $advance);
            $this->template->content = $html;
            $this->template->action = View::factory('admin/advances/action');
            $this->template->name = "Создание преимущества";
        }
    }
    
    private function edit($id)
    {
        $awesome = $this->request->post('awesome');
        $h = $this->request->post('h');
        $p = $this->request->post('p');
        Model::factory('Admin_Advances')->edit($id,$awesome,$h,$p);
    }
}