<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Department
 *
 * @author tbesarab
 */
class Department extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->current_section = 'Отдел/Служба';
        $this->table_db = 'department';
        
        $this->crud
                ->columns('name', 'short_name','description')
                ->display_as('short_name', 'Сокращение');
        $this->_example_output();
    }
}
