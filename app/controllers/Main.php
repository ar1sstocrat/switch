<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Main
 *
 * @author tbesarab
 */
class Main extends Public_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('mod_main');
    }
    
    public function index()
    {
        $this->menu = $this->mod_main->get_menu();
        $user = $this->mod_main->user_info($this->user['id']);
        $this->tpl
                ->set('current_section', 'Главная')
                ->set('user', $user)
                ->set('menu', $this->menu)
                ->set('group_id',  $this->group_id)
                ->set_view('output','out_data')
                ->build();
    }
}
