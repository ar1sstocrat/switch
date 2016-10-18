<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mod_main
 *
 * @author tbesarab
 */
class Mod_main extends MY_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function get_menu()
    {
        $this->db->where('active!=', 1)
                ->from('pages');
        $menu = $this->db->get();
        return $menu->result();       
    }
}
