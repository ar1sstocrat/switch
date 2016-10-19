<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Post
 *
 * @author tbesarab
 */
class Post extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->current_section = 'Должность';
        $this->table_db = 'post';
        
        $this->crud
                ->columns('name');
        $this->_example_output();
    }
}
