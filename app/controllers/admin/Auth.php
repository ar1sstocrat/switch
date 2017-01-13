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
            'label' => 'Новый пароль',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags'
        ),
        array(
            'field' => 'new_pass_confirm',
            'label' => 'Подтверждение пароля',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags|matches[new_pass]'
        )
    );


    public function __construct() 
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->language('ion_auth');
    }
    
    public function login()
    {
        $this->form_validation->set_rules($this->rules_auth);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<div class="alert bg-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
        $this->ion_auth_model->set_message_delimiters('<div class="alert bg-success" role="alert"><span class="glyphicon glyphicon-check"></span>', '</div>');
        if($this->form_validation->run())
        {
            $remember = (bool) $this->input->post('remember');
            $login = $this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember);
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
                ->set_view('output', $this->path_admin.'auth_form')
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
        $this->ion_auth_model->set_error_delimiters('<div class="alert bg-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
        $this->ion_auth_model->set_message_delimiters('<div class="alert bg-success" role="alert"><span class="glyphicon glyphicon-check"></span>', '</div>');
        $validation = $this->form_validation->run();
        if($validation)
        {
            $forgoten = $this->ion_auth->forgotten_password($this->input->post('email'));
            if($forgoten)
            {
                $forgoten['path'] = '/admin/auth/reset_password/';
                if($this->_send_forgotten_code($forgoten))
                {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    header('refresh:3;url=/admin/');
                }
                else
                {
                    $this->session->set_flashdata('message', lang('email_forgot_password_error'));
                    header('refresh:5;url=/admin/auth/restore/');
                }
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect($this->path_admin.'auth/restore');
                
            }
        }    
        
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set_view('mail_sent', $this->path_admin.'message')
                ->set_view('output', $this->path_admin.'mail_not_sent')
                ->build('admin/no_auth');
    }
    
    public function reset_password($code = NULL)
    {
        $user = $this->ion_auth->forgotten_password_check($code);
        if(!$user || !$code)
        {
            show_404();            
        }
        else
        {
           $this->tpl
                ->set('email', $user->email)
                ->set_view('output', $this->path_admin.'reset_pass_form')
                ->build('admin/no_auth');
        }
    }
    
    public function change_password()
    {
        if(empty($this->input->post())) show_404 ();
        $this->form_validation->set_rules($this->reset_pass);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<div class="alert bg-warning" role="alert"><span class="glyphicon glyphicon-warning-sign"></span>', '</div>');
        $this->ion_auth_model->set_message_delimiters('<div class="alert bg-success" role="alert"><span class="glyphicon glyphicon-check"></span>', '</div>');
        $validation = $this->form_validation->run();
        if($validation)
        {
            
            $reset = $this->ion_auth_model->reset_password($this->input->post('email'), $this->input->post('new_pass'));
            if($reset)
            {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                header('refresh:3;url=/admin/');
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                header('refresh:3;url=/admin/restore/');
            }
        }
        $this->tpl
                ->set('email', $this->input->post('email'))
                ->set('message', $this->session->flashdata('message'))
                ->set_view('reset_pass_fail', $this->path_admin.'message')
                ->set_view('output', $this->path_admin.'reset_pass_form')
                ->build('admin/no_auth');
        
    }

    public function _send_forgotten_code($data = NULL)
    {
        if(!$data)
        {
            $this->session->set_flashdata('message', 'Нет данных для сброса пароля');
            return FALSE;
        }
        else
        {
            $message = $this->load->view('auth/email', $data, TRUE);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email'), $this->config->item('admin_name'));
            $this->email->to($data['identity']);
            $this->email->subject($this->config->item('site_title') .'-'. lang('email_forgotten_password_subject'));
            $this->email->message($message);
            if($this->email->send())
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        
    }
}
