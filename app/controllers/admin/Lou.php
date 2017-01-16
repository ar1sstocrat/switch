<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Lou
 *
 * @author tbesarab
 */
class Lou extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->language('lou');
    }
    
    public function index()
    {
        $this->current_section = lang('lou_id');
        $this->table_db = 'lou';
        $this->crud
                ->columns('number', 'address', 'pgs_id', 'coating', 'year', 'month', 'switch_id')
                ->fields('number', 'address', 'pgs_id', 'coating', 'year', 'month', 'switch_id')
                ->display_as('number', lang('number'))
                ->display_as('address', lang('address'))
                ->display_as('pgs_id', lang('pgs_id'))
                ->display_as('coating', lang('coating'))
                ->display_as('year', lang('year'))
                ->display_as('month', lang('month'))
                ->display_as('switch_id', lang('switch_id'))
                ->set_relation('switch_id', 'switch', 'name');
        $this->_example_output();
    }
}
