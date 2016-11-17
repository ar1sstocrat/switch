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
    protected $registration = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|htmlspecialchars|encode_php_tags|strtolower',
        ),
        array(
            'field' => 'password',
            'label' => 'Пароль',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|encode_php_tags',
        ),
        array(
            'field' => 'password_confirm',
            'label' => 'Подтверждение пароля',
            'rules' => 'trim|required|min_length[3]|htmlspecialchars|matches[password]|encode_php_tags',
        ),
        array(
            'field' => 'first_name',
            'label' => 'Имя',
            'rules' => 'trim|required|htmlspecialchars|encode_php_tags',
        ),
        array(
            'field' => 'last_name',
            'label' => '',
            'rules' => 'trim|required|htmlspecialchars|encode_php_tags',
        ),
        array(
            'field' => 'patronimyc',
            'label' => '',
            'rules' => 'trim|htmlspecialchars|encode_php_tags',
        ),
        array(
            'field' => 'phone',
            'label' => 'Телефон',
            'rules' => 'trim|required|htmlspecialchars|encode_php_tags'
        ),
        array(
            'field' => 'department',
            'label' => 'Отдел',
            'rules' => 'required'
        ),
        array(
            'field' => 'post',
            'label' => 'Должность',
            'rules' => 'required'
        ),
    );
    
    protected $upload_errors;


    public function __construct() 
    {
        parent::__construct();
        $this->load->language('ion_auth');
        $this->load->library('email');
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
                $this->session->set_flashdata('css_class', 'alert alert-danger');
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url("login"));
            }
        }
        
        $this->tpl
                ->set('message', $this->session->flashdata('message'))
                ->set('css_class', $this->session->flashdata('css_class'))
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
                $forgoten['path'] = '/auth/reset_password/';
                if($this->_send_forgotten_code($forgoten))
                {
                    $this->session->set_flashdata('css_class', 'alert alert-info');
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    header('refresh:3;url=/');
                }
                else
                {
                    $this->session->set_flashdata('css_class', 'alert alert-danger');
                    $this->session->set_flashdata('message', lang('email_forgot_password_error'));
                    header('refresh:5;url=/auth/restore/');
                }
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('/auth/restore');
                
            }
        }    
        
        $this->tpl
                ->set('css_class', $this->session->flashdata('css_class'))
                ->set('message', $this->session->flashdata('message'))
                ->set_view('info', 'info')
                ->set_view('output', 'restore_pass')
                ->build('login');
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
                ->set_view('output', 'reset_pass')
                ->build('login');
        }
    }
    
    public function change_password()
    {
        if(empty($this->input->post())) show_404 ();
        $this->form_validation->set_rules($this->reset_pass);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        $validation = $this->form_validation->run();
        if($validation)
        {
            $reset = $this->ion_auth_model->reset_password($this->input->post('email'), $this->input->post('new_pass'));
            $this->firephp->log($reset);
            if($reset)
            {
                $this->session->set_flashdata('css_class', 'alert alert-info');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                header('refresh:3;url=/');
            }
            else
            {
                $this->session->set_flashdata('css_class', 'alert alert-danger');
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                //header('refresh:3;url=/auth/restore/');
            }
        }
        $this->tpl
                ->set('email', $this->input->post('email'))
                ->set('css_class', $this->session->flashdata('css_class'))
                ->set('message', $this->session->flashdata('message'))
                ->set_view('info', 'info')
                ->set_view('output', 'reset_pass')
                ->build('login');
        
    }
    
    public function registration()
    {
        $data = array();
        $data['department'] = $this->mod_main->get_all_records('department');
        $data['post'] = $this->mod_main->get_all_records('post');
        $this->form_validation->set_rules($this->registration);
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_error_delimiters('<p class="error">', '</p>');
        $this->ion_auth_model->set_message_delimiters('<p class="successful">', '</p>');
        $img = $this->_upload_img();
        $img_path = $img ? '/assets/uploads/img/users/'.$img['file_name'] : '';
        $validation = $this->form_validation->run();
        if($validation)
        {
            $username = $this->_get_username($this->input->post('first_name'), $this->input->post('last_name'));
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $additional_data = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'patronimyc'    => $this->input->post('patronimyc'),
                'phone'         => $this->input->post('phone'),
                'department_id'    => $this->input->post('department'),
                'post_id'          => $this->input->post('post'),
                'img'           => $img_path,
                'ip_adddress'   => $this->input->ip_address(),
                'group_id'         => 2,
            );
            $group = 2;
            $user = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
            if($user)
            {
                redirect(site_url());
            }
            else
            {
                $this->session->set_flashdata('css_class', 'alert alert-danger');
                $this->session->set_flashdata('message', $this->ion_auth->errors());
            }
        }
        
        
        $this->tpl
            ->set('data', $data)
            ->set('css_class', $this->session->flashdata('css_class'))
            ->set('message', $this->session->flashdata('message'))
            ->set_view('output', 'registration')
            ->build('login');
    }
    
    public function _upload_img()
    {
        $this->load->library('upload');
        if($this->upload->do_upload('img'))
        {
            $img = $this->upload->data();
            return $img;
        }
        else
        {
            //$this->session->set_flashdata('img_error', $this->upload->display_errors());
            $this->upload_errors = $this->upload->display_errors();
            return FALSE;
        }
    }
    
    public function _get_username($name = '', $second_name = '')
    {
        if(!$name || !$second_name)
        {
            return FALSE;
        }
        $name = convert_accented_characters($name);
        $second_name = convert_accented_characters($second_name);
        $username = strtolower($name{0} . $second_name);
        return $username;
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
