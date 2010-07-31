<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Controller extends MY_Controller {
    protected $data;

    public function  __construct() {
        parent::__construct();

        $logged_in = $this->session->userdata('logged_in');

        if(!$logged_in) {
            redirect('users/login');
            exit;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->template->enable_parser(FALSE);
	    $this->template->set_layout('admin/layout');

        // Build general meta data, javascript, css and other information
        $this->template->title('Vanique Enterprise LTD 管理介面');

        // set general page partial elements.
        $this->template->set_partial('header', 'admin/partials/header', FALSE);
		$this->template->set_partial('nav', 'admin/partials/nav', FALSE);
        $this->template->set_partial('footer', 'admin/partials/footer', FALSE);
    }
}