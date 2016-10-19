<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Pages
 *
 * @author tbesarab
 */
class Pages extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $all = $this->session->all_userdata();
        $this->firephp->log($all);
        
        $this->current_section = 'Страницы';
        $this->table_db = 'pages';
        $this->crud
                ->columns('name', 'uri', 'active')
                ->fields('name', 'uri', 'active')
                ->unset_delete();
        $this->_example_output();
    }
}
