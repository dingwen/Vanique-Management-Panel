<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends Public_Controller {
    protected $form_rules;
    protected $form_change_password_rules;

    public function  __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('users_m');

        $this->set_form_rules();

        $this->data->js = array(
            $this->load->view('fragments/jquery_cdn.php', array(), TRUE),
            js('general.js')
        );
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            redirect('admin/suppliers');
            exit;
        }
        $this->login();
    }

    public function login() {
        $this->form_validation->set_rules($this->form_rules);

        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
            $result = $this->users_m->user_login($username, $password);

            if($result) {
                $auth_data = array(
                    'user_id' => $result['id'],
                    'username' => $username,
                    'full_name' => $result['last_name'].$result['first_name'],
                    'role' => $result['role'],
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($auth_data);

                redirect('admin/suppliers');
                exit;
            } else {
                $this->session->flashdata('login_error', TRUE);
            }
        }
        $this->template->build('login');
    }

    public function logout() {
        $auth_data = array(
            'user_id' => '',
            'username' => '',
            'full_name' => '',
            'role' => '',
            'logged_in' => FALSE
        );

        $this->session->unset_userdata($auth_data);
        redirect('users');
        exit;
    }

    public function change_password() {
        $this->form_validation->set_rules($this->form_change_password_rules);

        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));

            $result = $this->users_m->change_password($username, $password);
            
            if($result) {
                $this->session->flashdata('success', TRUE);
                redirect('users/login');
                exit;
            } else {
                $this->session->flashdata('error', TRUE);
            }
        }
        $this->template->build('change_password');
    }

    private function set_form_rules() {
        $this->form_rules = array(
            array(
                'field' => 'username',
                'label' => '使用者帳號',
                'rules' => 'trim|required|max_length(20)'
            ),
            array(
                'field' => 'password',
                'label' => '使用者密碼',
                'rules' => 'trim|required|max_length(15)'
            )
        );
        
        $this->form_change_password_rules = array(
            array(
                'field' => 'username',
                'label' => '帳號',
                'rules' => 'trim|required|max_length(20)'
            ),
            array(
                'field' => 'password',
                'label' => '新密碼',
                'rules' => 'trim|required|max_length(15)'
            ),
            array(
                'field' => 'confirm_password',
                'label' => '確認密碼',
                'rules' => 'trim|required|max_length(15)|matches[password]'
            )
        );
    }
}