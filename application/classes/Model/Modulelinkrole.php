<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Modulelinkrole extends ORM
{
    protected $_table_name = 'modules_roles';
    protected $_table_columns = array(
        'id' => NULL,
        'module_id' => NULL,
        'role_id' => NULL,
    );
    protected $_belongs_to = array(
        'module'    => array(
            'model'         => 'Module',
            'foreign_key' => 'module_id',
        )
    );
}