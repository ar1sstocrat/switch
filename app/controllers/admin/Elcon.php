<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Elcon
 *
 * @author tbesarab
 */
class Elcon extends Admin_Controller
{
     public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $all = $this->session->all_userdata();
        
        
        $this->current_section = 'Коммутаторы ОК';
        $this->table_db = 'switch';
        $this->crud
                ->columns('name', 'ip_address', 'parent_id')
                ->fields('name', 'ip_address', 'parent_id', 'parent_port')
                ->display_as('parent_id', 'Родительский коммутатор')
                ->display_as('parent_port', 'Родительский порт')
                ->display_as('ip_address', 'IP адрес')
                ->set_relation('parent_port', 'switch_ports', 'port_id')
                ->set_relation('parent_id', 'switch', 'name')
                ->unset_delete();
        $this->_example_output();
    }
}
