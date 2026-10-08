<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Settings extends Controller_Admin_Security {
    
    /**
     * Метод вывода настроек
     */
    public function action_index()
    {
        if($this->request->post())
            $this->edit();
        $settings = Model::factory('Admin_Settings')->get_all();
        $html = View::factory('admin/settings/edit')
                ->set('settings', $settings);
        $this->template->action = View::factory('admin/settings/action');
        $this->template->content = $html;
    }
    
    private function edit()
    {
        $id = $this->request->post('id');
        $text_top = $this->request->post('text_top');
        $phone = $this->request->post('phone');
        $email = $this->request->post('email');
        $title = $this->request->post('title');
        $keywords = $this->request->post('keywords');
        $description = $this->request->post('description');
        $text_bottom = $this->request->post('text_bottom');
        
        Model::factory('Admin_Settings')->set_setting($id, $title, $keywords, $description, $text_top, $email, $phone, $text_bottom);
        HTTP::redirect('/admin/settings');
    }
}