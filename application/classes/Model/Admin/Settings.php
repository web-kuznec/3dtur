<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Settings extends Model
{
    protected $_table = "settings";
    
    public function get_all()
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('id','=',1)
                    ->as_object()
                    ->execute();
    }
    
    public function set_setting($id, $title, $keywords, $description, $name, $email, $phone, $text_foot)
    {
        DB::update($this->_table)
                ->set(array('title' => $title, 'keywords' => $keywords, 'description' => $description, 'text_top' => $name, 'email' => $email, 'phone' => $phone, 'text_bottom' => $text_foot))
                ->where('id', '=', $id)
                ->execute();
    }
}