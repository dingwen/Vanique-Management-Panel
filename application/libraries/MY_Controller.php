<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends Controller {
    public function  __construct() {
        parent::Controller();
        $global['base_url']			= BASE_URL;
        $global['base_uri'] 		= BASE_URI;
        $global['application_uri'] 	= APPPATH_URI;
        $this->load->vars('global', $global);
    }
}