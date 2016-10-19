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
        $this->group_id = $this->user['group_id'];
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
        $this->crud->set_language('russian');
        $this->menu = array(
            '' => 'На сайт',
            'admin' => 'Панель администратора',
            'admin/users' => 'Пользователи',
            'admin/pages' => 'Страницы',
            'admin/department' => 'Отдел', 
            'admin/post' => 'Должность',
            'admin/switch' => 'Коммутаторы ОК',
            'admin/ip' => 'Реальные ІР-адреса',
            'lou' => 'ЛОУ',
            'address_base' => 'Адрессная база',
            'admin/wiki' => 'WIKI'
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