<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Admin_Users extends Model
{
    public function get_users()
    {
        return DB::select('users.id', 'users.username', 'users.email', 'users.status', 'roles.name')
                ->from('users')
                ->join('users_roles', 'LEFT')
                ->on('users.id', '=', 'users_roles.user_id')
                ->join('roles')
                ->on('users_roles.role_id', '=', 'roles.id')
                ->order_by('roles.id')
                ->as_object()
                ->execute();
    }
    
    public function get_info($id)
    {
        return DB::select('users.*', 'users_roles.role_id')
                ->from('users')
                ->join('users_roles')
                ->on('users.id', '=', 'users_roles.user_id')
                ->where('users.id', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function change_status($id, $status)
    {
        DB::update('users')
                ->set(array('status' => $status))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function change_status_groupus($id, $status)
    {
        DB::update('roles')
                ->set(array('status' => $status))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function delete($id)
    {
        DB::delete('users')
                ->where('id', '=', $id)
                ->execute();
        
        DB::delete('users_roles')
                ->where('user_id', '=', $id)
                ->execute();
    }
    
    public function delete_groupus($id)
    {
        DB::delete('roles')
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function history($action, $id, $username, $password, $salt, $email, $status, $role, $user)
    {
        DB::insert('users_history', array('action', 'user_id', 'username', 'password', 'salt', 'email', 'status', 'role_id', 'changed_by_user_id'))
                ->values(array($action, $id, $username, $password, $salt, $email, $status, $role, $user))
                ->execute();
    }
    
    public function get_groups()
    {
        return DB::select()
                ->from('roles')
                ->as_object()
                ->execute();
    }
    
    public function get_group($id)
    {
        return DB::select()
                ->from('roles')
                ->where('id', '=', $id)
                ->as_object()
                ->execute();
    }
    
    public function update_group($id, $name, $desc, $status)
    {
        DB::update('roles')
                ->set(array('name' => $name, 'description' => $desc, 'status' => $status))
                ->where('id', '=', $id)
                ->execute();
    }
    
    public function create_group($tag, $name, $desc, $status)
    {
        DB::insert('roles', array('tag', 'name', 'description', 'status'))
                ->values(array($tag, $name, $desc, $status))
                ->execute();
    }
}