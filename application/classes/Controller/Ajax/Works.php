<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Ajax_Works extends Controller_Ajax_HTML {

    public function action_dell()
    {
        if($this->_access === TRUE)
        {
            $id = $this->request->post('id');
            $old = Model::factory('Admin_Works')->get_item($id);
            $photo = $old[0]->photo;
            $url = $old[0]->translit;
            
            $dir = BASE_DIR."public_html/panorama/".$url."/";
            if(is_dir($dir))
                $this->removeDirectory($dir);
            if($photo)
            {
                $dir = BASE_DIR."public_html/public/works/".$id."/";
                if(file_exists($dir.$photo))
                    $this->removeDirectory($dir);
            }
            Model::factory('Admin_Works')->dell($id);
        }
    }
    
    public function removeDirectory($dir)
    {
        if ($objs = glob($dir."/*")) {
            foreach($objs as $obj) {
                is_dir($obj) ? $this->removeDirectory($obj) : unlink($obj);
            }
        }
        rmdir($dir);
    }
    
    public function action_status()
    {
        $id = $this->request->post('id');
        $status = $this->request->post('status');
        Model::factory('Admin_Works')->set_status($id,$status);
    }
}