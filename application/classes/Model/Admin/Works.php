<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Works extends Model
{
    protected $_table = "works";
    
    public function get_all()
    {
        return DB::select()
                ->from($this->_table)
                ->as_object()
                ->execute();
    }
    
    public function add_works( array $fields, array $values)
    {
        $result = DB::insert($this->_table, $fields)
                ->values($values)
                ->execute();
        return $result[0];
    }
    
    public function get_item($id)
    {
        return DB::select()
                ->from($this->_table)
                ->where('id','=',$id)
                ->as_object()
                ->execute();
    }
    
    public function save_photo($id, $name)
    {
        DB::update($this->_table)
                ->set(array('photo' => $name))
                ->where('id','=',$id)
                ->execute();
    }
    
    public function update_work($id, $name, $url, $text, $slide_h, $slide_descr, $sort, $status, $slider, $rubrication)
    {
        DB::update($this->_table)
                ->set(array('name' => $name,'translit' => $url, 'text' => $text, 
                    'slide_h' => $slide_h, 'slide_descr' => $slide_descr, 
                    'sort' => $sort, 'status' => $status, 'slider' => $slider,
                    'date_update' => date('Y-m-d H:i:s'), 'rubrication_id' => $rubrication))
                ->where('id','=',$id)
                ->execute();
    }
    
    public function dell($id)
    {
        DB::delete($this->_table)
                ->where('id','=',$id)
                ->execute();
    }
    
    public function set_status($id,$status)
    {
        DB::update($this->_table)
                ->set(array('status' => $status))
                ->where('id','=',$id)
                ->execute();
    }
    
    public function get_slider()
    {
        return DB::select()
                ->from($this->_table)
                ->where('slider','=',1)
                ->order_by('id', 'DESC')
                ->as_object()
                ->execute();
    }
}