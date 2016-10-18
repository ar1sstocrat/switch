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
        
        //$this->group_id = $this->session->userdata('group_id');
    }
    
    public function index()
    {
        
        if($this->ion_auth->logged_in())
        {
            redirect(site_url());
        }
        else
        {
            redirect(site_url("auth/login"));            
        }
    }
    
    public function login()
    {
        $this->form_validation->set_rules($this->rules_auth);
        $this->form_validation->set_error_delimiters('<p class="alert-danger">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        if($this->form_validation->run())
        {
            $remember = (bool) $this->input->post('remember');
            $login = $this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember);
            if($login)
            {
                redirect('/');
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url("auth/login"));
            }
        }
        
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set_view('info', 'info')
                ->set_view('output', 'auth_form')
                ->build('login');
    }   
    
    public function logout()
    {
        $this->ion_auth->logout();
        redirect('/');
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
                $this->reset_password($forgoten['forgotten_password_code']);
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
                ->set_view('no_mail_out', $this->path_admin.'no_mail_out')
                ->set_view('mail_out', $this->path_admin.'mail_out')
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
                ->set_view('no_mail_out', $this->path_admin.'no_mail_out')
                ->set_view('mail_out', $this->path_admin.'mail_out')
                ->set_view('output', $this->path_admin.'restore_pass')
                ->build('admin/no_auth');
    }
    
    public function test()
    {
        $this->load->library('mail');
        $send = $this->mail->send_mail('Taras Besarab', 'tarasbesarab@gmail.com', 'TEST', 'test message');
        if($send) echo 'DO!!!';
        else echo 'FUCK!!!';
    }
}
