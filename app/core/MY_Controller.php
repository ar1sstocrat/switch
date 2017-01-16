<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of MY_Controller
 *
 * @author tbesarab
 */
class MY_Controller extends CI_Controller
{
    public $group_id = null;
    public $user = null;
    public $menu;
    public $path_admin = 'admin/';

    public function __construct() 
    {
        parent::__construct();
        $this->user = $this->ion_auth->user()->row_array();
        $this->session->set_userdata($this->user);
        //$this->group_id = $this->user['group_id'];
        $this->menu = array();
        $this->tpl->set('messages', $this->session->flashdata('messages'));
    }
}

class Admin_Controller extends MY_Controller
{
    
    public $data; // views data
    public $current_section; // current page
    public $js_files = array();
    public $css_files = array();
    public $table_db;
    public $field_name_generation = 'name';
    public $unset_field = array();

    public function __construct() 
    {
        parent::__construct();
        
        if($this->ion_auth->logged_in())
        {
            if($this->ion_auth->is_admin())
            {
                header('url:/admin');
            }
            else
            {
                redirect(site_url());
            }
        }
        else
        {
            redirect('/admin/login');
        }
        
        $this->load->model('mod_admin');
        $this->data = new stdClass();
        $this->load->library('grocery_CRUD');
        $this->crud = new Grocery_CRUD();
        $this->crud->set_theme('flexigrid');
        $this->crud->display_as('name', 'Имя');
        $this->crud->display_as('active', 'Статус');
        $this->crud->field_type('active', 'true_false');
        $this->crud->display_as('date', 'Дата');
        $this->crud->display_as('text', 'Текст');
        $this->crud->display_as('uri', 'Ссылка');
        $this->crud->display_as('description', 'Описание');
        $this->crud->set_language('russian');
        $this->menu = array(
            '' => '<span class="glyphicon glyphicon-home"></span>На сайт',
            'admin' => '<span class="glyphicon glyphicon-dashboard"></span>Панель администратора',
            'admin/pages' => '<span class="glyphicon glyphicon-list"></span>Страницы',
            'user_info' => array(
                '<span class="glyphicon glyphicon-user"></span>Информация о пользователях' => array(
                    'admin/users' => 'Пользователи',
                    'admin/department' => 'Отдел/Служба',
                    'admin/post' => 'Должность',
                ),
            ),
            'net_info' => array(
                '<span class="glyphicon glyphicon-fire"></span>Услуга интернет' => array(
                    'admin/ip' => 'Реальные ІР',
                    'admin/switches' => 'Коммутаторы',
                    'admin/switches/connection' => 'Коммутация',
                    'admin/switches/vlan' => 'VLAN',
                ),
            ),
            'elcon' => array(
                '<span class="glyphicon glyphicon-hdd"></span>Информация для ТО/ВОЛС' => array(
                    'admin/elcon' => 'Коммутаторы ОК',
                    'admin/lou' => 'ЛОУ',
                    'admin/address' => 'Адрессная база',
                    'admin/address/districts' => 'Районы',
                    'admin/address/locality' => 'Участок ТО',
                    'admin/address/house' => 'Тип здания',
                    'admin/address/net_type' => 'Тип сети',
                ),
            ),
            'admin/wiki' => '<span class="glyphicon glyphicon-book"></span>WIKI',
        );
    } 
    
    public function _example_output()
    {
        $this->crud->set_table($this->table_db);
        $this->data = $this->crud->render();
        $this->data->group_id = $this->group_id;
        $this->data->user = $this->user;
        $this->data->menu = $this->menu;
        $this->data->js_files = $this->data->js_files + $this->js_files;
        $this->data->css_files = $this->data->css_files + $this->css_files;
        $this->data->current_section = $this->current_section;
        $this->load->view('admin/main', $this->data);
    }
    
    public function _get_datetime($value, $row)
    {
        return date('d-m-Y H:i', $value);
    }
    
    public function _change_priviliges($post_array, $primary_key)
    {
        $this->ion_auth->remove_from_group(NULL, $primary_key);
        if(isset($post_array['group_id']))
        {
            $this->ion_auth->add_to_group($post_array['group_id'],$primary_key);
        }
        return TRUE;
    }
    
    public function _group_array()
    {
        $groups = $this->ion_auth->groups()->result_array();
        $result = array();
        foreach($groups as $group)
        {
            $result[$group['id']] = $group['description'];
        }
        return $result;
    }
}


class Public_Controller extends MY_Controller
{
    public $data;
    public $menu = array();
    public $current_section;

    public function __construct() 
    {
        parent::__construct();
        if($this->ion_auth->logged_in() == false)
        {
            redirect('/login');
        }
    }
}