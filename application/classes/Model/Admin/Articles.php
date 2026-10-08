<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Articles extends Model
{
    public function get_articles()
    {
        return DB::select()
                ->from('articles')
                ->as_object()
                ->execute();
    }
    
    public function create($art_name, $art_url, $art_date, $art_tizer, $art_text, $art_title, $art_keywords, $art_description, $art_status, $user)
    {
        return DB::insert('articles', array('name', 'translit', 'date', 'caption', 'text', 'title', 'keywords', 'description', 'status', 'user_id', 'date_update'))
                ->values(array($art_name, $art_url, $art_date, $art_tizer, $art_text, $art_title, $art_keywords, $art_description, $art_status, $user, date('Y-m-d H:i:s')))
                ->execute();
    }
    
    public function update($id,$name,$url,$date,$tizer,$text,$title,$keywords,$description,$status,$user)
    {
        DB::update('articles')
                ->set(array('name' => $name,
                            'translit' => $url,
                            'date' => $date,
                            'caption' => $tizer,
                            'text' => $text,
                            'title' => $title,
                            'keywords' => $keywords,
                            'description' => $description,
                            'status' => $status,
                            'user_id' => $user,
                            'date_update' => date('Y-m-d H:i:s')))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function limit_info($start, $limit)
    {
        return DB::select('articles.id', 'articles.text', 'articles.name', 'articles.status', 'articles.dir', 'articles.translit', 'articles.caption', 'articles.date')
                ->from('articles')
                ->order_by('articles.id', 'DESC')
                ->limit($limit)
                ->offset($start)
                ->as_object()
                ->execute();
    }
    
    public function limit_info_history($start, $limit)
    {
        return DB::select()
                ->from('articles_history')
                ->order_by('date', 'DESC')
                ->order_by('date_history', 'DESC')
                ->limit($limit)
                ->offset($start)
                ->as_object()
                ->execute();
    }
    
    public function get_info($id)
    {
        return DB::select()
                ->from('articles')
                ->where('id', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function get_history()
    {
        return DB::select()
                ->from('articles_history')
                ->as_object()
                ->execute();
    }
    
    public function history($action, $id, $title, $keywords, $description, $dir, $group, $name, $translit, $caption, $text, $date, $user_id, $sort, $status)
    {
        DB::insert('articles_history', array('action', 'article_id', 'title', 'keywords', 'description', 'dir', 'group_id', 'name', 'translit', 'caption', 'text', 'date', 'user_id', 'sort', 'status'))
                ->values(array($action, $id, $title, $keywords, $description, $dir, $group, $name, $translit, $caption, $text, $date, $user_id, $sort, $status))
                ->execute();
    }
    
    public function delete($id)
    {
        DB::delete('articles')
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function recovery_insert($article_id, $action, $title, $keywords, $description, $dir, $group_id, $name, $translit, $caption, $text, $date, $user_id, $sort, $status)
    {
        DB::insert('articles', array('id', 'title', 'keywords', 'description', 'dir', 'name', 'translit', 'caption', 'text', 'date', 'user_id', 'sort', 'status'))
                ->values(array($article_id, $title, $keywords, $description, $dir, $name, $translit, $caption, $text, $date, $user_id, $sort, $status))
                ->execute();
    }
    
    public function recovery_update($article_id, $action, $title, $keywords, $description, $dir, $group_id, $name, $translit, $caption, $text, $date, $user_id, $sort, $status)
    {
        DB::update('articles')
                ->set(array('id' => $article_id, 'title' => $title, 'keywords' => $keywords, 'description' => $description, 'dir' => $dir, 'name' => $name, 'translit' => $translit, 'caption' => $caption, 'text' => $text, 'date' => $date, 'user_id' => $user_id, 'sort' => $sort, 'status' => $status))
                ->execute();
    }
    
    public function set_status($id, $status)
    {
        DB::update('articles')
                ->set(array('status' => $status))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function get_img($id)
    {
        return DB::select()
                ->from('articles')
                ->join('articles_img')
                ->on('articles.id','=','articles_img.articles_id')
                ->where('articles.id','=',$id)
                ->as_object()
                ->execute();
    }
    
    public function add_photo($id, $photo, $ext)
    {
        DB::insert('articles_img', array('photo','articles_id','status'))
                ->values(array($photo.$ext, $id,'1'))
                ->execute();
    }
    
    public function get_photo($id)
    {
        return DB::select()
                ->from('articles_img')
                ->where('id','=',$id)
                ->as_object()
                ->execute();
    }
    
    public function dell_photo($id)
    {
        DB::delete('articles_img')
                ->where('id','=',$id)
                ->execute();
    }
    
    public function get_photo_by_articles($id)
    {
        return DB::select()
                ->from('articles_img')
                ->where('articles_id','=',$id)
                ->as_object()
                ->execute();
    }
}