<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Pages extends Model
{
    public $_table = "pages";
    
    public function active_pages()
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('status', '=', 1)
                    ->where('in_route', '=', 1)
                    ->as_object()
                    ->execute();
    }
    
    public function active_top_menu()
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('status', '=', 1)
                    ->where('in_menu', '=', 1)
                    ->as_object()
                    ->execute();
    }
    
    public function get_page_by_translit($id)
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('translit', '=', $id)
                    ->as_object()
                    ->execute();
    }
}