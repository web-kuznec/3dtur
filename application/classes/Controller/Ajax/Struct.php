<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Ajax_Struct extends Controller_Ajax_HTML {

    /**
     * Метод выводит окно добавления страницы
     */
    public function action_new()
    {
        if($this->_access === TRUE)
        {
            $page = $this->request->post('page');
            echo View::factory('admin/struct/new')
                    ->bind('page', $page);
        }
    }
    
    /**
     * Метод возвращает транслитом наназвание страницы
     */
    public function action_translit()
    {
        if($this->_access === TRUE)
        {
            $translit = array();
            $name = $this->request->post('name');
            $table = $this->request->post('table');
            $id = $this->request->post('id');
            $post = Validation::factory($_POST); // готовимся к проведению валидации
            $post -> rule(TRUE, 'not_empty');
            if($post -> check()) // проводим валидацию
                $translit['code'] = Controller_Static_Translit::index($name, $table, $id);
            else
                $translit['code'] = "ERROR_VATIDATION";

            echo json_encode($translit);
        }
    }
    
    /**
     * Метод проверяет наличие совпадений url
     * Если есть совпадение по возвращет код ошибки в формате json
     * Иначе код успешного выполнения в формате json
     */
    public function action_check_dubl()
    {
        if($this->_access === TRUE)
        {
            $ansver = array();
            $dont = NULL;
            $struct_name = $this->request->post('struct_name');
            $struct_url = $this->request->post('struct_url');
            $table = $this->request->post('table');
            if(($this->request->post('dont')))
                $dont = $this->request->post('dont');
            if(Controller_Static_Translit::check($struct_url, $table, $dont))
            {
                $ansver['code'] = "ERROR_DUBL";
            } else {
                $ansver['code'] = "OK";
            }
            echo json_encode($ansver);
        }
    }
    
    /**
     * Метод меняет статус страницы
     */
    public function action_status()
    {
        if($this->_access === TRUE)
        {
            $ansver = array();
            $id = $this->request->post('id');
            $status = $this->request->post('status');
            if($status == 0)
                $status = 1;
            else
                $status = 0;
            //Controller_Static_History::page($id, $this->_user, "change_status");
            Model::factory('Admin_Struct')->change_status($id, $status);
            $ansver['code'] = "OK";
            echo json_encode($ansver);
        }
    }
    
    public function action_dell()
    {
        if($this->_access === TRUE)
        {
            $id = $this->request->post('id');
            Model::factory('Admin_Struct')->delete($id);
        }
    }
    
    public function action_delete()
    {
        if($this->_access === TRUE)
        {
            $id = $this->request->post('id');
            Controller_Static_History::page($id, $this->_user, "delete");
            Model::factory('Admin_Struct')->delete($id);
        }
    }
    
    /**
     * Метод создает новую страницу
     */
    public function action_create()
    {
        if($this->_access === TRUE)
        {
            $struct_name = $this->request->post('struct_name');
            $struct_name_menu = $this->request->post('struct_name_menu');
            $struct_url = $this->request->post('struct_url');
            $struct_sort = $this->request->post('struct_sort');
            $struct_title = $this->request->post('struct_title');
            $struct_keywoards = $this->request->post('struct_keywoards');
            $struct_description = $this->request->post('struct_description');
            $struct_seo = $this->request->post('struct_seo');
            $page = $this->request->post('page');
            if($this->request->post('struct_inmenu'))
                $struct_inmenu = 1;
            else
                $struct_inmenu = NULL;
            if($this->request->post('struct_status'))
                $struct_status = 1;
            else
                $struct_status = NULL;
            $user = $this->_user;
            
            Model::factory('Admin_Struct')->create($page, $struct_name, $struct_name_menu, $struct_url, $struct_sort, $struct_title, $struct_keywoards, $struct_description, $struct_seo, $struct_status, $user, $struct_inmenu);
            
        }
    }
    
    public function action_update()
    {
        if($this->_access === TRUE)
        {
            $struct_name = $this->request->post('struct_name');
            $struct_name_menu = $this->request->post('struct_name_menu');
            $struct_url = $this->request->post('struct_url');
            $struct_sort = $this->request->post('struct_sort');
            $struct_title = $this->request->post('struct_title');
            $struct_keywoards = $this->request->post('struct_keywoards');
            $struct_description = $this->request->post('struct_description');
            $struct_seo = $this->request->post('struct_seo');
            $page = $this->request->post('page');
            if($this->request->post('struct_inmenu'))
                $struct_inmenu = 1;
            else
                $struct_inmenu = NULL;
            if($this->request->post('struct_status'))
                $struct_status = 1;
            else
                $struct_status = NULL;
            $user = $this->_user;
            
            if($struct_status === NULL)
                $status = 0;
            else
                $status = 1;
            if($struct_inmenu === NULL)
                $inmenu = 0;
            else
                $inmenu = 1;
            
            $upd = array('name'=>$struct_name, 'name_menu'=>$struct_name_menu, 'translit'=>$struct_url, 'sort'=>$struct_sort, 'title'=>$struct_title, 'keywords'=>$struct_keywoards, 'description'=>$struct_description, 'seo'=>$struct_seo, 'status'=>$struct_status, 'in_menu'=>$struct_inmenu);
            Model::factory('Admin_Struct')->update($page, $upd);
            
        }
    }
    
    /**
     * Метод разворачивает дерево
     */
    public function action_open()
    {
        $current = $this->request->post('id');
        $pages = Model::factory('Admin_Struct')->get_pages();
        $struct = array();
        foreach($pages as $key)
        {
            $str_id = $key->id;
            $str_parent = $key->parent;
            $str_name = $key->name;
            $str_status = $key->status;
            $struct[$str_id]['id'] = $str_id;
            $struct[$str_id]['parent'] = $str_parent;
            $struct[$str_id]['name'] = $str_name;
            $struct[$str_id]['status'] = $str_status;
            
        }
        $array_parent = array();
        $parent = $this->detect_parent($current, $array_parent);
        $child = $this->detect_child($current);
        $path = $this->generate_path($parent, $current, $child);
        $html = $this->build($struct, $path, 0, "");
        echo $html;
    }
    
    /**
     * Метод сворачивает дерево
     */
    public function action_close()
    {
        $current = $this->request->post('id');
        $pages = Model::factory('Admin_Struct')->get_pages();
        $struct = array();
        foreach($pages as $key)
        {
            $str_id = $key->id;
            $str_parent = $key->parent;
            $str_name = $key->name;
            $str_status = $key->status;
            $struct[$str_id]['id'] = $str_id;
            $struct[$str_id]['parent'] = $str_parent;
            $struct[$str_id]['name'] = $str_name;
            $struct[$str_id]['status'] = $str_status;

        }
        $array_parent = array();
        $parent = $this->detect_parent($current, $array_parent);
        $child = $this->detect_child($current);
        $path = $this->generate_path($parent);
        $html = $this->build($struct, $path, 0, "");
        echo $html;
    }
    
    /**
     * Метод строит родительскую структуру страниц
     * @param array $struct - Структура страниц
     * @param array $path - Путь
     * @param int $level - Уровень вложенности
     * @param string $html
     * @return string
     */
    public function build($struct, $path, $level, $html)
    {
        foreach($struct as $key => $val)
        {
            $cur = 0;
            $id = $val['id'];
            $parent = $val['parent'];
            $name = $val['name'];
            $status = $val['status'];
            if($parent === NULL)
            {
                foreach($path as $k => $v)
                {
                    if(!is_array($v))
                    {
                        if($id == $v)
                            $cur = 1;
                    }
                }
                $html .= View::factory('admin/struct/open')
                        ->set('id', $id)
                        ->set('parent', $parent)
                        ->set('name', $name)
                        ->set('status', $status)
                        ->set('level', '0')
                        ->set('cur', $cur);
                if($cur == 1)
                {
                    $level++;
                    $html = $this->build_child($id, $struct, $path, $level, $html);
                }
            }
        }
        return $html;
    }
    
    /**
     * Метод строит дочернюю структуру страниц
     * @param int $par - Идентификатор родительского узла
     * @param array $struct - Структура страниц
     * @param array $path - Путь
     * @param int $level - Уровень вложенности
     * @param string $html - html
     * @return string
     */
    public function build_child($par, $struct, $path, $level, $html)
    {
        foreach($struct as $key => $val)
        {
            $cur = 0;
            $id = $val['id'];
            $parent = $val['parent'];
            $name = $val['name'];
            $status = $val['status'];
            if($parent == $par)
            {
                foreach($path as $k => $v)
                {
                    if(!is_array($v))
                    {
                        if($id == $v)
                            $cur = 1;
                    }
                }
                $html .= View::factory('admin/struct/open')
                        ->set('id', $id)
                        ->set('parent', $parent)
                        ->set('name', $name)
                        ->set('status', $status)
                        ->set('level', $level)
                        ->set('cur', $cur);
                if($cur == 1)
                {
                    $level++;
                    $html = $this->build_child($id, $struct, $path, $level, $html);
                    $level--;
                }
            }
        }
        return $html;
    }
    
    /**
     * Метод возвращает массив родительских узлов
     * @param int $id
     * @param array $array_parent
     * @return array
     */
    public function detect_parent($id, array $array_parent)
    {
        $parent = Model::factory('Admin_Struct')->get_parent($id);
        if(isset($parent['parent']))
        {
            $parent = $parent['parent'];
            $array_parent[] = $parent;
            return $this->detect_parent($parent, $array_parent);
        }
        else
            return $array_parent;
    }
    
    /**
     * Метод возвращает массив дочерних узлов
     * @param int $id
     * @return array
     */
    public function detect_child($id)
    {
        $array_child = array();
        $child = Model::factory('Admin_Struct')->get_child($id);
        if($child->count() > 0)
        {
            foreach($child as $key => $val)
            {
                $array_child[] = $val->id;
            }
        }
        return $array_child;
    }
    
    /**
     * Метод возвращает путь вложенности узлов(массив)
     * @param array $parent
     * @param int $current
     * @param array $child
     * @return array
     */
    public function generate_path($parent, $current=NULL, $child=NULL)
    {
        $str = array();
        if(!empty($parent))
        {
            foreach($parent as $key => $val)
            {
                $str[] = $val;
            }
        }
        if(isset($current))
            $str[] = $current;
        if(!empty($child))
            $str[] = $child;
        return $str;
    }
    
} // End Ajax_Struct