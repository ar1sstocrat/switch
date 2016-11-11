<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Login
 *
 * @author tbesarab
 */
class Auth extends MY_Controller
{
    public $group_id = null;
    
    protected $rules_auth = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|htmlspecialchars|encode_php_tags|strtolower'
        ),
        array(
            'field' => 'password',
            'label' => 'Пароль',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags'
        )
    );
    protected $check_email = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|htmlspecialchars|encode_php_tags|strtolower'
        )
    );
    protected $reset_pass = array(
        array(
            'field' => 'new_pass',
            'label' => 'Пароль',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags'
        ),
        array(
            'field' => 'new_pass_confirm',
            'label' => 'Пароль',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags|matches[new_pass]'
        )
    );


    public function __construct() 
    {
        parent::__construct();
    }
    
    public function login()
    {
        $this->form_validation->set_rules($this->rules_auth);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        if($this->form_validation->run())
        {
            $remember = (bool) $this->input->post('remember');
            $login = $this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember);
            $this->firephp->log($this->user);
            if($login)
            {
                redirect($this->path_admin);
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url("{$this->path_admin}/login"));
            }
        }
        
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set_view('auth_error', $this->path_admin.'message')
                ->set_view('auth_form', $this->path_admin.'auth_form')
                ->set_view('output', $this->path_admin.'auth_select')
                ->build('admin/no_auth');
    }   
    
    public function logout()
    {
        $this->ion_auth->logout();
        redirect($this->path_admin);
    }
    
    public function restore()
    {
        $this->form_validation->set_rules($this->check_email);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        $validation = $this->form_validation->run();
        if($validation)
        {
            $forgoten = $this->ion_auth->forgotten_password($this->input->post('email'));
            $this->firephp->log($forgoten);
            if($forgoten)
            {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                //$this->reset_password($forgoten['forgotten_password_code']);
                //header('refresh:3;url=/admin/');
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect($this->path_admin.'auth/restore');
                
            }
        }    
        
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set_view('mail_not_sent', $this->path_admin.'mail_not_sent')
                ->set_view('mail_sent', $this->path_admin.'message')
                ->set_view('output', $this->path_admin.'restore_pass')
                ->build('admin/no_auth');
    }
    
    public function reset_password($code = NULL)
    {
        if(!$code) show_404 ();
        
        $user = $this->ion_auth->forgotten_password_check($code);
        $this->firephp->log($user);
        if($user)
        {
            $this->form_validation->set_rules($this->reset_pass);
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
            $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        }
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set_view('mail_not_sent', $this->path_admin.'mail_not_sent')
                ->set_view('mail_sent', $this->path_admin.'message')
                ->set_view('output', $this->path_admin.'restore_pass')
                ->build('admin/no_auth');
    }
    
    public function test()
    {
        $this->load->library('mail');
        $send = $this->mail->send_mail('Taras Besarab', 'taras88lav@mail.ru', 'TEST', 'test message');
        if($send) echo 'DO!!!';
        else echo 'FUCK!!!';
    }
}
