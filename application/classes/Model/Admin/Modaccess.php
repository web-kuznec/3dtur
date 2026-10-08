<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Modaccess extends Model
{
    public function get_role($unic)
    {
        return DB::select('role_id')
            ->from('users_roles')
            ->where('user_id', '=', $unic)
            ->limit(1)
            ->as_object()
            ->execute();
    }
    
    public function get_access($module, $role)
    {
        return DB::select('modules_roles.*')
            ->from('modules_roles')
            ->join('modules', 'LEFT')
            ->on('modules_roles.module_id', '=', 'modules.id')
            ->where('modules.tag', '=', $module)
            ->and_where('modules_roles.role_id', '=', $role)
            ->limit(1)
            ->as_object()
            ->execute();
    }
    
    public function get_name($module)
    {
        $query = DB::select()
                ->from('modules')
                ->where('tag', '=', $module)
                ->limit(1)
                ->execute()
                ->as_array();
        if(!empty($query))
            return $query[0];
        else
            return false;
    }

}