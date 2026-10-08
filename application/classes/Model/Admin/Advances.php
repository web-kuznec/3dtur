<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Advances extends Model
{
    protected $_table = "advances";
    
    public function get_all()
    {
        return DB::select()
                ->from($this->_table)
                ->as_object()
                ->execute();
    }
    
    public function save($awesome, $h, $p)
    {
        DB::insert($this->_table, array('awesome', 'h', 'p'))
                ->values(array($awesome, $h, $p))
                ->execute();
    }
    
    public function get_item($id)
    {
        return DB::select()
                ->from($this->_table)
                ->where('id', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function edit($id,$awesome,$h,$p)
    {
        DB::update($this->_table)
                ->set(array('awesome' => $awesome, 'h' => $h, 'p' => $p))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function dell($id)
    {
        DB::delete($this->_table)
                ->where('id', '=', $id)
                ->execute();
    }
}