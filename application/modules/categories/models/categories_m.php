<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Categories_m extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->table = 'categories';
    }

    public function get_all_main() {
        return $this->get_many_by(array('main_id' => 0), 'name');
    }

    public function get_all_main_dd() {
        $result = $this->get_all_main();
        $main_cate = array('0' => '請選擇主類別');
        foreach($result as $cate) {
            $main_cate[$cate['id']] = $cate['name'];
        }
        return $main_cate;
    }

    public function delete_cate($id = 0) {
        $main_cate = $this->get_by_id($id);
        $result = $this->db->delete($this->table, array('main_id' => $main_cate['main_id']));
        $result = $this->delete($id);
        return $result;
    }

    public function get_all_sub() {
        return $this->get_many_by(array('main_id !=' => 0), 'main_id');
    }

    public function get_all_sub_by_main($main_id = 0) {
        return $this->get_many_by(array('main_id =' => $main_id), 'name');
    }
}