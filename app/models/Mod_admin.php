<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Mod_admin
 *
 * @author tbesarab
 */
class Mod_admin extends MY_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function add_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
        
    
}
