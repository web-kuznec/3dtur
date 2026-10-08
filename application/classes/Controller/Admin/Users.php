<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Users extends Controller_Admin_Common {
    
    public function action_index()
    {
        $users = Model::factory('Admin_Users')->get_users();
        $html = View::factory('admin/users/all')
                ->set('users', $users);
        $this->template->content = $html;
        $name = $this->name_module($this->request->controller());
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
}