<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Articles extends Model
{
    protected $_table = 'articles';
    
    public function get_all()
    {
        return DB::select($this->_table.".*", "articles_img.photo")
                ->from($this->_table)
                ->join('articles_img')
                ->on($this->_table.'.id','=','articles_img.articles_id')
                ->where($this->_table.'.status','=',1)
                ->where($this->_table.'.date','<',date('Y-m-d H:i:s'))
                ->order_by('date', 'DESC')
                ->as_object()
                ->execute();
    }
    
    public function get_article($url)
    {
        return DB::select()
                ->from($this->_table)
                ->where('translit', '=', $url)
                ->as_object()
                ->execute();
    }
    
    public function get_img($id)
    {
        return DB::select()
                ->from('articles_img')
                ->where('articles_id', '=', $id)
                ->where('status', '=', 1)
                ->as_object()
                ->execute();
    }
}