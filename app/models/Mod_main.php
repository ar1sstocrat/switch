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
    public function user_info($id = NULL)
    {
        return $this->db
                ->where('u.id', $id)
                ->select('u.username, u.email, u.first_name, u.last_name, u.company, u.phone, u.patronimyc, u.img, '
                        . 'd.name AS department_name, d.short_name, d.description, p.name AS post_name')
                ->from('users u')
                ->join('department d', 'd.id=u.department_id')
                ->join('post p', 'p.id=u.post_id')
                ->get()
                ->row();
    }
}
