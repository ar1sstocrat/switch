<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Switches
 *
 * @author tbesarab
 */
class Switches extends Admin_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->language('switches');
    }
    
    public function index()
    {
        $this->current_section = lang('core_switch');
        $this->table_db = 'core_switch';
        $this->crud
                ->columns('name', 'host_name', 'ip', 'ports', 'parent_id', 'img')
                ->fields('name', 'host_name', 'ip', 'ports', 'parent_id', 'img')
                ->display_as('name', lang('name'))
                ->display_as('ip', lang('ip'))
                ->display_as('host_name', lang('host_name'))
                ->display_as('house_id', lang('house_id'))
                ->display_as('ports', lang('ports'))
                ->display_as('parent_id', lang('parent_id'))
                ->display_as('img', lang('img'))
                ->set_relation('parent_id', 'core_switch', 'host_name')
                ->callback_column('ip', array($this, '_decode_ip'))
                ->callback_after_insert(array($this, '_insert_ports'))
                ->callback_after_delete(array($this, '_after_delete'))
                ->unset_print();
        $this->_example_output();
    }
    
    public function connection()
    {
        $this->current_section = lang('core_connection');
        $this->table_db = 'core_connection';
        $this->crud
                ->columns('switch_id', 'port_id', 'port_type_id', 'tag_vlan_id', 'untag_vlan_id', 'connection', 'description')
                ->fields('switch_id', 'port_id', 'port_type_id', 'tag_vlan_id', 'untag_vlan_id', 'connection', 'description')
                ->display_as('switch_id', lang('switch_id'))
                ->display_as('port_id', lang('port_id'))
                ->display_as('port_type_id', lang('port_type_id'))
                ->display_as('tag_vlan_id', lang('tag_vlan_id'))
                ->display_as('untag_vlan_id', lang('untag_vlan_id'))
                ->display_as('connection', lang('connection'))
                ->display_as('description', lang('description'))
                ->set_relation('port_type_id', 'core_ports_type', 'port_type')
                ->set_relation('switch_id', 'core_switch', 'name')
                ->field_type('tag_vlan_id', 'multiselect', $this->_get_vlan())
                ->field_type('untag_vlan_id', 'multiselect', $this->_get_vlan())
                ->callback_after_insert(array($this, '_insert_ports'))
                ->unset_print();
        $this->_example_output();
    }
    
    public function vlan()
    {
        $this->current_section = lang('vlan');
        $this->table_db = 'vlan';
        $this->crud
                ->columns('vlan_id', 'description')
                ->fields('vlan_id', 'description')
                ->display_as('vlan_id', lang('vlan_id'))
                ->display_as('description', lang('description'))
                ->unset_print();
        $this->_example_output();
    }

    public function _insert_ports($post_array, $primary_key)
    {
        
        for($i=1; $i<=$post_array['ports']; $i++)
        {
            $insert_data = array(
                'switch_id' => $primary_key,
                'port_id' => $i,
            );
            $this->mod_admin->add_data($insert_data, 'core_connection');
        }
        $this->mod_admin->update_record($this->table_db, array('id' => $primary_key), array('ip' => inet_pton($this->input->post('ip'))));
        return TRUE;  
    }
    
    public function _after_delete($primary_key)
    {
        return $this->mod_admin->delete_record('core_connection', array('switch_id'=>$primary_key));
    }
    
    public function _get_vlan()
    {
        $data = $this->mod_admin->get_all_records('vlan');
        $result = array();
        foreach($data as $value)
        {
            $result[$value->vlan_id] = $value->vlan_id;
        }
        if(!empty($result))
            return $result;
        else
            return array(1=>'');
    }
    
    public function _decode_ip($value, $row)
    {
        $this->firephp->log($row);
        return inet_ntop($value);
    }
}
