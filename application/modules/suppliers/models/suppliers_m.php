<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Suppliers_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'suppliers';
    }
    
    public function get_datatable($offset = 0, $limit = 0, $sort = array(), $filter = "") {
        return $this->get_for_datatable(array('name', 'code', 'contact', 'id'), $offset, $limit, $sort, $filter);
    }
}