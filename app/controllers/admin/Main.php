<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Main
 *
 * @author tbesarab
 */
class Main extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        
        $this->tpl
                ->set('current_section', 'Панель администратора')
                ->set('menu', $this->menu)
                ->set('user', $this->user)
                ->set('group_id',  $this->group_id)
                ->set_view('output', 'admin/dashboard')
                ->build('admin/main');
        $this->firephp->log($this->group_id);
        $this->firephp->log($this->user);
        $this->firephp->log($this->session->all_userdata);        
    }
}
