<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Works extends Controller_Admin_Security
{        
    public function action_index()
    {
        $controller = strtolower($this->request->controller());
        $works = Model::factory('Admin_Works')->get_all();
        $html = View::factory('admin/works/main')
                    ->set('works', $works)
                    ->set('controller', $controller);
        $this->template->content = $html;
        $name = $this->name_module($controller);
        $this->template->action = View::factory('admin/works/action');
        if($name !== FALSE)
            $this->template->name = $name['name'];
    }
    
    /**
     * Метод вызывает страницу с формой добавления новой работы
     */
    public function action_add()
    {
        if(!empty($_POST))
            $this->add();
        else
        {
            $rubrics = Model::factory('Admin_Rubrics')->get_all();
            $html = View::factory('admin/works/add')
                ->set('rubrics', $rubrics);
            $this->template->content = $html;
            $name = $this->name_module($this->request->controller());
            $this->template->action = View::factory('admin/works/action');
            if($name !== FALSE)
                $this->template->name = $name['name'];
        }
    }
    
    /**
     * Метод сохраняет новую работы
     */
    private function add()
    {
        $post = Validation::factory($this->request->post());
        $post->rule('name', 'not_empty');
        $post->rule('url', 'not_empty');
        if($post->check()) // проводим валидацию
        {
            $fields = array('name','translit','text','slide_h','slide_descr','status','slider','date_update','rubrication_id');
            $values = array($this->request->post('name'),$this->request->post('url'),
                $this->request->post('text'),$this->request->post('slide_h'),
                $this->request->post('slide_desc'), ($this->request->post('status') ? 1 : 0), 
                ($this->request->post('slider') ? 1 : 0),date('Y-m-d H:m:s'),
                ($this->request->post('rubrics')) ? $this->request->post('rubrics') : null);
            $last = Model::factory('Admin_Works')->add_works($fields, $values);
            $this->load_tur($this->request->post('url'));
            $this->load_img_tur($last);
        }
        Controller_Static_Sitemap::index();
        HTTP::redirect('/admin/works');
    }
    
    /**
     * Метод заггрузки архива с туром
     */
    private function load_tur($url)
    {
        /*if($_FILES['tur']['tmp_name'])
        {
            $allowed_exts = array("zip");
            $file_info = pathinfo($_FILES['tur']['tmp_name']);
            $allowed_types = array("application/zip");
            if (in_array($file_info['extension'], $allowed_exts) ) {
                //работаем с файлами,
                $dir = BASE_DIR."3dtur24.ru/panorama/".$url;
                if(is_dir($dir))
                    $this->removeDirectory($dir);
                mkdir($dir, 0755, true);
                $uploadfile = $dir."/".$url.".zip";
                if(move_uploaded_file($_FILES['tur']['tmp_name'], $uploadfile))
                {
                    $zip = new ZipArchive;
                    $zip->open($uploadfile);
                    $zip->extractTo($dir);
                    $zip->close();
                    unlink($uploadfile);
                } else
                    echo "Файл не загрузился. Обратитесь к криворукому разработчику!";
            } else {
                echo "Ошибка! Тип {$_FILES['tur']['type']} запрещен либо файл имеет неверное расширение ({$file_info['extension']}).";
            }
        }*/
        $dir = BASE_DIR."public_html/panorama/".$url;
        if(!is_dir($dir))
            mkdir($dir, 0755, true);
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
    
    /**
     * Метод загрузки фото тура
     */
    private function load_img_tur($last)
    {
        if($_FILES['photo']['tmp_name'])
        {
            $this->dell_old_img($last);
            $img = getimagesize($_FILES['photo']['tmp_name']);
            $ext = str_replace('image/', '', image_type_to_mime_type($img[2]));
            $img_name = date('ymdHis');
            $dir = BASE_DIR."public_html/public/works/".$last;
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if(move_uploaded_file($_FILES['photo']['tmp_name'], $dir.'/'.$img_name.".".$ext)) {
                Model::factory('Admin_Works')->save_photo($last, $img_name.".".$ext);
                HTTP::redirect(URL::base('http', TRUE)."admin/works");
            } else {
                echo "Фото не заружено!";
            }
        }
    }
    
    private function dell_old_img($id)
    {
        $old = Model::factory('Admin_Works')->get_item($id);
        if($old->count() > 0)
        {
            $photo = $old[0]->photo;
            if($photo)
            {
                $dir = BASE_DIR."public_html/public/works/".$id."/".$photo;
                if(file_exists($dir))
                    unlink($dir);
            }
        }
    }

    /**
     * Метод выводит страницу редактирования работы
     * @throws type
     */
    public function action_edit()
    {
        if(!empty($_POST))
            $this->edit();
        else
        {
            $id = $this->request->param('id');
            if($id)
            {
                $rubrics = Model::factory('Admin_Rubrics')->get_all();
                $work = Model::factory('Admin_Works')->get_item($id);
                $html = View::factory('admin/works/edit')
                        ->set('work',$work)
                        ->set('rubrics', $rubrics);
                $this->template->content = $html;
                $name = $this->name_module($this->request->controller());
                $this->template->action = View::factory('admin/works/action');
                if($name !== FALSE)
                    $this->template->name = $name['name'];
            }
            else
            {
                throw HTTP_Exception::factory(404,'Страница не найдена',array(':uri' => $this->request->uri()))->request($this->request);
                exit();
            }
        }
    }
    
    /**
     * Метод редактирования работы
     */
    private function edit()
    {
        $id = $this->request->post('id');
        $name = $this->request->post('name');
        $url = $this->request->post('url');
        $text = $this->request->post('text');
        $slide_h = $this->request->post('slide_h');
        $slide_descr = $this->request->post('slide_descr');
        $sort = $this->request->post('sort');
        $rubrication_id = ($this->request->post('rubrics')) ? $this->request->post('rubrics') : null;
        if($sort == '')
            $sort = 0;
        $status = 0;
        $slider = 0;
        if($this->request->post('status'))
            $status = 1;
        if($this->request->post('slider'))
            $slider = 1;
        
        if(Controller_Static_Translit::check($url, 'works', $id))
                $url = Controller_Static_Translit::index ($name, 'works', $id);
        Model::factory('Admin_Works')->update_work($id, $name, $url, $text, $slide_h, $slide_descr, $sort, $status, $slider, $rubrication_id);
        $this->load_tur($url);
        $this->load_img_tur($id);
        Controller_Static_Sitemap::index();
        HTTP::redirect('/admin/works');
    }
}