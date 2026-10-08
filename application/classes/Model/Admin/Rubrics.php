<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Rubrics extends Model
{
    protected $_table = "rubricator";
    
    public function get_all()
    {
        return DB::select()
                ->from($this->_table)
                ->as_object()
                ->execute();
    }
    
    public function save($name, $translation, $sort)
    {
        DB::insert($this->_table, array('name', 'translation', 'sort'))
                ->values(array($name, $translation, $sort))
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
    
    public function edit($id, $name, $sort, $translation)
    {
        DB::update($this->_table)
                ->set(array('name' => $name, 'sort' => $sort, 'translation' => $translation))
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