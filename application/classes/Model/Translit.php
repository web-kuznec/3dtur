<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Translit extends Model
{
    public function set_trans($name, $table, $id)
    {
        $query = DB::update($table)
                ->set(array('translit' => $name))
                ->where('id', '=', $id)
                ->execute();
        return FALSE;
    }
    
    public function check($translit, $table, $id = NULL)
    {
        if($id === NULL) {
            $query = DB::select()
                    ->from($table)
                    ->where('translit', '=', $translit)
                    ->as_object()
                    ->execute();
        } else {
            $query = DB::select()
                    ->from($table)
                    ->where('translit', '=', $translit)
                    ->where('id', '!=', $id)
                    ->as_object()
                    ->execute();
        }
        if($query->count() > 0)
            return TRUE;
        else
            return FALSE;
            
    }
}