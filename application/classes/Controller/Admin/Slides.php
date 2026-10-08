<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Slides extends Controller_Admin_Security
{        
    public function action_index()
    {
        $controller = strtolower($this->request->controller());
        $slides = Model::factory('Admin_Slides')->get_all();
        $html = View::factory('admin/slides/all')
                    ->set('slides', $slides)
                    ->set('controller', $controller);
        $this->template->content = $html;
        $name = $this->name_module($controller);
        $this->template->action = View::factory('admin/slides/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
    
    public function action_edit()
    {
        $id = $this->request->param('id');
        if($id)
        {
            if($this->request->post())
                $this->edit($id);
            $slide = Model::factory('Admin_Slides')->get_slide($id);
            $html = View::factory('admin/slides/edit')->set('slide', $slide);
            $this->template->content = $html;
            $this->template->action = View::factory('admin/slides/action');
            $this->template->name = "Редактирование слайда";
        }
    }
    
    private function edit($id)
    {
        $h1 = $this->request->post('h1');
        $text1 = $this->request->post('text1');
        $h2 = $this->request->post('h2');
        $text2 = $this->request->post('text2');
        $h3 = $this->request->post('h3');
        $text3 = $this->request->post('text3');
        $label_video = $this->request->post('label_video');
        $video = $this->request->post('video');
        Model::factory('Admin_Slides')->set_slide($id,$h1,$text1,$h2,$text2,$h3,$text3,$label_video,$video);
        $this->load_imgs($id);
    }
    
    private function load_imgs($id)
    {
        if($_FILES['photo1']['tmp_name'])
        {
            $img = getimagesize($_FILES['photo1']['tmp_name']);
            $ext = str_replace('image/', '', image_type_to_mime_type($img[2]));
            $img_name = date('ymdHis');
            $dir = BASE_DIR."public_html/public/images/main/";
            //$dir = BASE_DIR."public_html/public/images/main/";
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if(move_uploaded_file($_FILES['photo1']['tmp_name'], $dir.'/'.$img_name.".".$ext)) {
                Model::factory('Admin_Slides')->update_img($id, 'img1', $img_name.".".$ext);
            }
        }
        if($_FILES['photo2']['tmp_name'])
        {
            $img = getimagesize($_FILES['photo2']['tmp_name']);
            $ext = str_replace('image/', '', image_type_to_mime_type($img[2]));
            $img_name = date('ymdHis');
            $dir = BASE_DIR."public_html/public/images/main/";
            //$dir = BASE_DIR."public_html/public/images/main/";
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if(move_uploaded_file($_FILES['photo2']['tmp_name'], $dir.'/'.$img_name.".".$ext)) {
                Model::factory('Admin_Slides')->update_img($id, 'img2', $img_name.".".$ext);
            }
        }
        if($_FILES['photo3']['tmp_name'])
        {
            $img = getimagesize($_FILES['photo3']['tmp_name']);
            $ext = str_replace('image/', '', image_type_to_mime_type($img[2]));
            $img_name = date('ymdHis');
            $dir = BASE_DIR."public_html/public/images/main/";
            //$dir = BASE_DIR."public_html/public/images/main/";
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if(move_uploaded_file($_FILES['photo3']['tmp_name'], $dir.'/'.$img_name.".".$ext)) {
                Model::factory('Admin_Slides')->update_img($id, 'img3', $img_name.".".$ext);
            }
        }
    }
}