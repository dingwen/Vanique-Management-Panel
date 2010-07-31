<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Public_Controller extends MY_Controller {
    protected $data;

    public function  __construct() {
        parent::__construct();

        $this->template->set_theme('default');
        $this->template->set_layout('layout');

        // Build general meta data, javascript, css and other information
        $this->template->title('Vanique Enterprise LTD 管理介面');

        // set general page partial elements.
        $this->template->set_partial('header', '../themes/default/views/header', FALSE);
        $this->template->set_partial('footer', '../themes/default/views/footer', FALSE);
        $this->template->append_metadata(css('admin.css'))->append_metadata(css('admin_form.css'));
    }
}