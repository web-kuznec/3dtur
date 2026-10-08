<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Articles extends Controller_Ajax_JSON
{
    /**
     * Метод выводит html пользователей
     */
    public function action_dell_img()
    {
        if(empty($this->_error) && $this->_role == 5)
        {
            $id = $this->request->post('id');
            $img = Model::factory('Admin_Articles')->get_photo($id);
            Model::factory('Admin_Articles')->dell_photo($id);
            $file = PUBPATH.'articles/'.$img[0]->articles_id.'/'.$img[0]->photo;
            if(file_exists($file))
                unlink($file);
        }
        else
            echo json_encode($this->_errorr);
    }
    
    public function action_dell()
    {
        if(empty($this->_error) && $this->_role == 5)
        {
            $id = $this->request->post('id');
            Model::factory('Admin_Articles')->delete($id);
            $images = Model::factory('Admin_Articles')->get_photo_by_articles($id);
            foreach($images as $k => $v)
            {
                Model::factory('Admin_Articles')->dell_photo($v->id);
                $file = PUBPATH.'articles/'.$id.'/'.$v->photo;
                if(file_exists($file))
                    unlink($file);
            }
        }
        else
            echo json_encode($this->_errorr);
    }
    
    public function action_status()
    {
        if(empty($this->_error) && $this->_role == 5)
        {
            $id = $this->request->post('id');
            $status = $this->request->post('status');
            if($status == 1)
                $status = 0;
            else
                $status = 1;
            Model::factory('Admin_Articles')->set_status($id,$status);
        }
        else
            echo json_encode($this->_errorr);
    }
}