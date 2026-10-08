<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Works extends Model
{
    public $_table = "works";

    protected function apply_search($query, $search)
    {
        if ($search) {
            $query->and_where_open()
                ->or_where($this->_table.'.name', 'LIKE', '%'.$search.'%')
                ->or_where($this->_table.'.slide_descr', 'LIKE', '%'.$search.'%')
                ->or_where($this->_table.'.text', 'LIKE', '%'.$search.'%')
                ->and_where_close();
        }
        return $query;
    }

    public function get_count($search = NULL)
    {
        $query = DB::select(array(DB::expr('COUNT(`id`)'), 'total'))
                ->from($this->_table)
                ->where('status', '=', 1);
        $this->apply_search($query, $search);
        return $query->execute();
    }

    public function get_count_by_rubrication($rubrication, $search = NULL)
    {
        $query = DB::select(array(DB::expr('COUNT("works.id")'), 'total'))
                ->from($this->_table)
                ->join('rubricator')
                ->on($this->_table.'.rubrication_id', '=', 'rubricator.id')
                ->where($this->_table.'.status', '=', 1)
                ->where('rubricator.translation', '=', $rubrication);
        $this->apply_search($query, $search);
        return $query->execute();
    }

    public function get_all_paginame($limit, $offset, $search = NULL)
    {
        $query = DB::select()
                ->from($this->_table)
                ->where('status', '=', 1);
        $this->apply_search($query, $search);
        return $query->order_by('sort')
                ->order_by('id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->as_object()
                ->execute();
    }

    public function get_all_paginame_by_rubrication($rubrication, $search, $limit, $offset)
    {
        $query = DB::select($this->_table.'.*')
                ->from($this->_table)
                ->join('rubricator')
                ->on($this->_table.'.rubrication_id', '=', 'rubricator.id')
                ->where($this->_table.'.status', '=', 1)
                ->where('rubricator.translation', '=', $rubrication);
        $this->apply_search($query, $search);
        return $query->order_by($this->_table.'.sort')
                ->order_by($this->_table.'.id', 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->as_object()
                ->execute();
    }
    
    public function get_all()
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('status', '=', 1)
                    ->order_by('sort')
                    ->order_by('id', 'DESC')
                    ->as_object()
                    ->execute();
    }
    
    public function get_last()
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('status', '=', 1)
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->as_object()
                    ->execute();
    }
    
    public function get_work($name)
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('translit', '=', $name)
                    ->as_object()
                    ->execute();
    }
}