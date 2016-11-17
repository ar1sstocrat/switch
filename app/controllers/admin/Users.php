<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Users
 *
 * @author tbesarab
 */
class Users extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->current_section = 'Пользователи';
        $this->table_db = 'users';
        $this->unset_field = array('company', 'password', 'ip_address', 'img','salt', 'last_login', 'activation_code', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on');
        $this->crud
                ->columns('first_name','last_name','post_id','department_id','group_id', 'created_on', 'last_login','active')
                ->display_as('first_name', 'Имя')
                ->display_as('last_name', 'Фамилия')
                ->display_as('patronimyc','Отчество')
                ->display_as('email', 'Почтовый адрес')
                ->display_as('username', 'Имя пользователя')
                ->display_as('phone', 'Телефон')
                ->display_as('img', 'Изображение')
                ->display_as('post_id', 'Должность')
                ->display_as('group_id', 'Группа')
                ->display_as('department_id', 'Отдел')
                ->display_as('created_on', 'Зарегистрирован')
                ->display_as('last_login', 'Последний вход')
                ->field_type('group_id', 'multiselect', $this->_group_array())
                ->callback_before_update(array($this, '_change_priviliges'))
                ->edit_fields('first_name','last_name','patronimyc', 'phone', 'group_id', 'department_id', 'post_id', 'active')
                ->callback_column('created_on', array($this,'_get_datetime'))
                ->callback_column('last_login', array($this,'_get_datetime'))
                ->set_relation('post_id','post','name')
                //->set_relation_n_n('group_id', 'users_groups','groups','group_id','user_id', 'description')
                ->set_relation('department_id','department','short_name')
                ->unset_add()
                ->where('username!=', 'root')
                ->unset_fields($this->unset_field);
        $this->_example_output();
    }
}
