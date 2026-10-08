<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_User extends Model
{
    protected $_table = "users";
    
    public function get_user($id)
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('id', '=', $id)
                    ->as_object()
                    ->execute();
    }
    
    public function get_user_by_name($id)
    {
        return DB::select()
                    ->from($this->_table)
                    ->where('nick', '=', $id)
                    ->as_object()
                    ->execute();
    }
    
    public function unique_nick($nick)
    {
        return ! DB::select(array(DB::expr('COUNT(nick)'), 'total'))
                    ->from('users')
                    ->where('nick', '=', $nick)
                    ->execute()
                    ->get('total');
    }
    
    public function unique_email($email)
    {
        return ! DB::select(array(DB::expr('COUNT(nick)'), 'total'))
                    ->from('users')
                    ->where('email', '=', $email)
                    ->execute()
                    ->get('total');
    }
    
    public function add_user($nick, $email, $pass, $salt, $confirm)
    {
        DB::insert($this->_table, array('nick', 'password', 'salt', 'confirm', 'email', 'type', 'status'))
                    ->values(array($nick, $pass, $salt, $confirm, $email, '1', '0'))
                    ->execute();
    }
    
    public function confirm($confirm)
    {
        $query = DB::select('id')
            ->from($this->_table)
            ->where('confirm', '=', $confirm)
            ->where('status', '=', 0)
            ->limit('1')
            ->execute()
            ->as_array();
        if(isset($query[0]['id']))
        {
            DB::update($this->_table)
                ->set(array('status' => 1))
                ->where('id', '=', $query[0]['id'])
                ->execute();
            return $query[0];
        }
        else
            return FALSE;
    }
    
    public function user_role($id)
    {
        $query = DB::select()
                    ->from('users_roles')
                    ->where('user_id', '=', $id)
                    ->where('role_id', '=', 1)
                    ->execute()
                    ->as_array();
        if(!isset($query[0]))
            DB::insert('users_roles', array('user_id', 'role_id'))
                ->values(array($id, 1))
                ->execute();
    }
    
    public function set_reset($email, $reset, $date)
    {
        DB::update($this->_table)
                ->set(array('reset' => $reset, 'reset_data' => $date))
                ->where('email', '=', $email)
                ->execute();
    }
    
    public function reset($reset)
    {
        $query = DB::select()
                    ->from($this->_table)
                    ->where('reset', '=', $reset)
                    ->where('reset_data', '<', DB::expr('NOW()'))
                    ->where(DB::expr('reset_data + INTERVAL 30 MINUTE' ), '>', DB::expr('NOW()'))
                    ->limit(1)
                    ->execute()
                    ->as_array();
        
        if(isset($query[0]))
        {
            DB::update($this->_table)
                    ->set(array('reset' => NULL, 'reset_data' => NULL))
                    ->where('id', '=', $query[0]['id'])
                    ->execute();
            return $query[0];
        }
        else
            return FALSE;
    }
    
    public function newpass($user, $newpass, $salt, $confirm)
    {
        DB::update($this->_table)
            ->set(array('password' => $newpass, 'salt' => $salt, 'confirm' => $confirm))
            ->where('id', '=', $user)
            ->execute();
    }
}