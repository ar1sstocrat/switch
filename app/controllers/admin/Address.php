<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Address_base
 *
 * @author tbesarab
 */
class Address extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->language('lou');
    }
    
    public function index()
    {
        $this->current_section = lang('address_base');
        $this->table_db = 'address_base';
        $this->crud
                ->columns('id', 'street', 'house', 'house_id', 'district_id', 'lou_id', 'numders_department', 'locality_id', 'net_type', 'house_type', 'cascades', 'comment')
                ->fields('street', 'house', 'house_id', 'district_id', 'lou_id', 'numders_department', 'locality_id', 'net_type', 'house_type', 'cascades', 'comment')
                ->display_as('street', lang('street'))
                ->display_as('id', lang('id'))
                ->display_as('huose', lang('house'))
                ->display_as('house_id', lang('house_id'))
                ->display_as('numders_department', lang('numders_department'))
                ->display_as('district_id', lang('district_id'))
                ->display_as('net_type', lang('net_type'))
                ->display_as('house_type', lang('house_type'))
                ->display_as('cascades', lang('cascades'))
                ->display_as('comment', lang('comment'))
                ->display_as('locality_id', lang('locality_id'))
                ->display_as('lou_id', lang('lou_id'))
                ->set_relation('district_id', 'districts', 'name')
                ->set_relation('house_type', 'house_type', 'name')
                ->set_relation('lou_id', 'lou', 'number')
                ->set_relation('net_type', 'net_type', 'name')
                ->set_relation('locality_id', 'locality', 'name');
        $this->_example_output();
    }
    
    public function districts()
    {
        $this->current_section = lang('district_id');
        $this->table_db = 'districts';
        $this->crud
                ->columns('name')
                ->display_as('name', lang('name'));
        $this->_example_output();
    }
    
    public function locality()
    {
        $this->current_section = lang('locality_id');
        $this->table_db = 'locality';
        $this->crud
                ->columns('name')
                ->display_as('name', lang('name'));
        $this->_example_output();
    }
    
    public function house()
    {
        $this->current_section = lang('house_type');
        $this->table_db = 'house_type';
        $this->crud
                ->columns('name')
                ->display_as('name', lang('name'));
        $this->_example_output();
    }
    
    public function net_type()
    {
        $this->current_section = lang('net_type');
        $this->table_db = 'net_type';
        $this->crud
                ->columns('name')
                ->display_as('name', lang('name'));
        $this->_example_output();
    }
}
