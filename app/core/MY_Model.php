<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Model
 *
 * @author tbesarab
 */
class MY_Model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function get_all_records($table)
    {
        return $this->db->get($table)
                ->result();
    }
    
    public function get_one_record($table, $id)
    {
        return $this->db
                ->where('id', $id)
                ->get($table)
                ->row();
    }
    
    public function delete_record($table, $condition)
    {
        $this->db->delete($table, $condition);
    }
    
    public function update_record($table, $id = array(), $data)
    {
        $this->db->update($table, $data, $id);
    }
}
