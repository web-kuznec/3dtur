<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Module extends ORM
{
    protected $_table_name = 'modules';
    protected $_table_columns = array(
        'id' => NULL,
        'tag' => NULL,
        'name' => NULL,
        'description' => NULL,
        'admin' => NULL,
        'gruppa' => NULL,
        'sort' => NULL,
    );
    /*public function get_modules()
    {
        return DB::select()
                ->from('modules')
                ->as_object()
                ->execute();
    }
    
    public function get_linkrole()
    {
        return DB::select('modules_link_role.module_id', 'modules_link_role.role_id', 'roles.name', 'roles.tag')
                ->from('modules_link_role')
                ->join('roles')
                ->on('modules_link_role.role_id', '=', 'roles.id')
                ->as_object()
                ->execute();
    }
    
    public function get_roles()
    {
        return DB::select()
                ->from('roles')
                ->where('tag', '!=', 'admin')
                ->execute()
                ->as_array();
    }
    
    public function delete_link_role($module, $role)
    {
        DB::delete('modules_link_role')
                ->where('module_id', '=', $module)
                ->and_where('role_id', '=', $role)
                ->execute();
    }
    
    public function add_link_role($module, $role)
    {
        DB::insert('modules_link_role')
                ->values(array($module, $role))
                ->execute();
    }
    
    public function create($name, $group, $tag)
    {
        $query = DB::select()
                ->from('modules')
                ->where('tag', '=', $tag)
                ->as_object()
                ->execute();
        if($query->count() == 0)
        {
            DB::insert('modules', array('tag', 'name', 'group'))
                    ->values(array($tag, $name, $group))
                    ->execute();
            $last_id = mysql_insert_id();
            DB::insert('modules_link_role')
                    ->values(array($last_id, '5'))
                    ->execute();
        }
    }*/
    
}