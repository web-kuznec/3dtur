<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Sitemap extends Model
{
    public function pages()
    {
        return DB::select()
                    ->from('pages')
                    ->where('status','=',1)
                    ->where('in_route','=',1)
                    ->as_object()
                    ->execute();
    }
    
    public function works()
    {
        return DB::select()
                    ->from('works')
                    ->where('status','=',1)
                    ->as_object()
                    ->execute();
    }
    
    public function articles()
    {
        return DB::select()
                    ->from('articles')
                    ->where('status','=',1)
                    ->as_object()
                    ->execute();
    }
}