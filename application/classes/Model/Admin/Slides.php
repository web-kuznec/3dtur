<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Slides extends Model
{
    protected $_table = "slides";
    
    public function get_slide($id)
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('id','=',$id)
                    ->as_object()
                    ->execute();
    }
    
    public function set_slide($id, $h1, $text1, $h2, $text2, $h3, $text3,$label_video,$video)
    {
        DB::update($this->_table)
                ->set(array('h1' => $h1, 'text1' => $text1, 'h2' => $h2, 'text2' => $text2, 'h3' => $h3, 'text3' => $text3, 'label_video' => $label_video, 'video' => $video))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function get_all()
    {
        return DB::select()
                ->from($this->_table)
                ->where('status', '=', 1)
                ->order_by('sort')
                ->as_object()
                ->execute();
    }
    
    public function update_img($id, $label, $name)
    {
        DB::update($this->_table)
                ->set(array($label => $name))
                ->where('id', '=', $id)
                ->execute();
    }
}