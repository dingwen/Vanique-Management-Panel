<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Products_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'products';
    }
    
    public function get_datatable($offset = 0, $limit = 0, $sort = array(), $filter = "") {
        log_message('info', print_r($sort, TRUE));
        return $this->get_for_datatable(array('sku', 'name', 'supplier_id', 'main_category_id', 'sub_category_id', 'id'), $offset, $limit, $sort, $filter);
    }
}