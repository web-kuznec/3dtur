<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Struct extends Model
{
    public function get_page($page)
    {
        return DB::select('id', 'text')
                ->from('pages')
                ->where('translit', '=', $page)
                ->as_object()
                ->execute();
    }
    
    public function get_pages()
    {
        return DB::select()
                ->from('pages')
                ->order_by('sort')
                ->as_object()
                ->execute();
    }
    
    public function create($page, $struct_name, $struct_name_menu, $struct_url, $struct_sort, $struct_title, $struct_keywoards, $struct_description, $struct_seo, $struct_status, $user, $struct_inmenu)
    {
        if($struct_status === NULL)
            $status = 0;
        else
            $status = 1;
        if($struct_inmenu === NULL)
            $inmenu = 0;
        else
            $inmenu = 1;
        
        if($page == 0)
        {
            DB::insert('pages', array('name', 'name_menu', 'translit', 'title', 'description', 'keywords', 'user_id', 'sort', 'status', 'in_menu'))
                    ->values(array($struct_name, $struct_name_menu, $struct_url, $struct_title, $struct_description, $struct_keywoards, $user, $struct_sort, $status, $inmenu))
                    ->execute();
        }
        else
        {
            DB::insert('pages', array('parent', 'name', 'name_menu', 'translit', 'title', 'description', 'keywords', 'user_id', 'sort', 'status', 'in_menu'))
                    ->values(array($page, $struct_name, $struct_name_menu, $struct_url, $struct_title, $struct_description, $struct_keywoards, $user, $struct_sort, $status, $inmenu))
                    ->execute();
        }
                
    }
    
    public function get_parent($id)
    {
        $query = DB::select('parent')
                ->from('pages')
                ->where('id', '=', $id)
                ->execute()
                ->as_array();
        if(count($query == 1))
            return $query[0];
        else
            return FALSE;
    }
    
    public function get_child($id)
    {
        return DB::select('id')
                ->from('pages')
                ->where('parent', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function get_info($page)
    {
        return DB::select()
                ->from('pages')
                ->where('id', '=', $page)
                ->as_object()
                ->execute();
    }
    
    public function change_status($id, $status)
    {
        DB::update('pages')
                ->set(array('status' => $status))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function delete($id)
    {
        DB::delete('pages')
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function history($id, $user, $action, $name, $name_menu, $translit, $title, $description, $keywords, $tizer, $text, $seo, $date, $page_user_id, $sort, $status, $in_menu)
    {
        DB::insert('page_history', array('page_id', 'changed_by_user_id', 'action', 'name', 'name_menu', 'translit', 'title', 'description', 'keywords', 'tizer', 'text', 'seo', 'date', 'page_user_id', 'sort', 'status', 'in_menu'))
                ->values(array($id, $user, $action, $name, $name_menu, $translit, $title, $description, $keywords, $tizer, $text, $seo, $date, $page_user_id, $sort, $status, $in_menu))
                ->execute();
    }
    
    public function get_history()
    {
        return DB::select()
                ->from('page_history')
                ->as_object()
                ->execute();
    }
    
    public function change_text($id, $text)
    {
        DB::update('pages')
                ->set(array('text' => $text))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function get_item($id)
    {
        return DB::select()
                ->from('pages')
                ->where('id', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function edit($id, $arr)
    {
        DB::update('pages')
                ->set($arr)
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function add($col, $val)
    {
        DB::insert('pages', $col)
                ->values($val)
                ->execute();
    }
}