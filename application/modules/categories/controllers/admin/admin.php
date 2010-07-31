<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Admin_Controller {

    protected $form_rules;
    protected $category_id;

    public function __construct() {
        parent::__construct();

        $this->load->model('categories_m');
        
        $this->data->module_name = "categories";
        $this->category_id = 0;
        
        $this->data->css = array(css('admin.css'));
        $this->data->js = array($this->load->view('fragments/jquery_cdn.php', array(), TRUE));

        $this->template->set_partial('side_menu', 'admin/side_menu');
    }

    public function index() {
        $this->data->js[] = js('jquery.dataTables.min.js');
        $this->data->js[] = js('datatable.fnSetFilteringDelay.js');
        $this->data->js[] = js('admin.js');
        $this->data->js[] = js('admin_categories.js', 'categories');
        
        $this->data->css[] = css('jquery-ui-1.8.2.custom.css');
        $this->data->css[] = css('dataTable.css');


        $this->data->main_categories = $this->categories_m->get_all_main();
        $this->data->sub_categories = $this->categories_m->get_all_sub_by_main($this->data->main_categories[0]['id']);
        $this->template->build('admin/index', $this->data);
    }

    public function create_main() {
        $this->set_main_form_rules();
        $this->form_validation->set_rules($this->form_rules);

        if($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->categories_m->insert($temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/categories');
        }

        foreach($this->form_rules as $rule) {
            $category->{$rule['field']} = set_value($rule['field']);
        }

        $this->data->category = & $category;

        $this->data->js[] = js('admin.js');

        $this->data->css[] = css('admin_form.css');
        
        $this->template->build('admin/main_form', $this->data);
    }

    public function create_sub() {
        $this->set_sub_form_rules();
        $this->form_validation->set_rules($this->form_rules);

        if($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->categories_m->insert($temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/categories');
        }

        foreach($this->form_rules as $rule) {
            $category->{$rule['field']} = set_value($rule['field']);
        }

        $category->main_categories = $this->categories_m->get_all_main_dd();
        $this->data->category = & $category;

        $this->data->js[] = js('admin.js');

        $this->data->css[] = css('admin_form.css');
        
        $this->template->build('admin/sub_form', $this->data);
    }

    public function edit_main($id = 0) {
        if($id < 1) { redirect('admin/categories'); }

        $this->category_id = $id;

        $this->set_main_form_rules();
        $this->form_validation->set_rules($this->form_rules);

        if($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->categories_m->update($this->category_id, $temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/categories');
        }

        $category_data = $this->categories_m->get_by_id($id);
        foreach ($category_data as $field => $value) {
            $category->{$field} = $value;
        }

        $this->data->category = & $category;

        $this->data->js[] = js('admin.js');

        $this->data->css[] = css('admin_form.css');
        
        $this->template->build('admin/main_form', $this->data);
    }

    public function edit_sub($id = 0) {
        if($id < 1) { redirect('admin/categories'); }

        $this->category_id = $id;

        $this->set_sub_form_rules();
        $this->form_validation->set_rules($this->form_rules);

        if($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->categories_m->update($id, $temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/categories');
        }

        $category_data = $this->categories_m->get_by_id($id);
        foreach ($category_data as $field => $value) {
            $category->{$field} = $value;
        }

        $category->main_categories = $this->categories_m->get_all_main_dd();
        $this->data->category = & $category;
        
        $this->data->js[] = js('admin.js');

        $this->data->css[] = css('admin_form.css');
        
        $this->template->build('admin/sub_form', $this->data);
    }

    public function delete($id = 0) {
        if($id < 1) { redirect('admin/categories'); }

        $result = $this->categories_m->delete_cate($id);
        if ($result) {
            $this->session->set_flashdata('success', TRUE);
        } else {
            $this->session->set_flashdata('error', TRUE);
        }

        redirect('admin/categories');
    }

    public function get_sub() {
        $main_id = $this->input->post('id');
        $sub_categories = $this->categories_m->get_all_sub_by_main($main_id);
        $processed = array();

        if($sub_categories) {
            foreach ($sub_categories as $row) {
                $action_str = anchor(site_url('admin/categories/edit_sub/'.$row['id']), 'edit') . ' ' . anchor(site_url('admin/categories/delete/'.$row['id']), 'delete', 'class="confirm"');
                $processed[] = array(
                    $row['name'],
                    $row['code'],
                    $action_str
                );
            }
        }

        echo json_encode($processed);
    }

    private function set_main_form_rules() {
        $this->form_rules = array(
            array(
                'field' => "name", 'label' => "名稱",
                'rules' => "trim|required|max_length[250]|callback_check_main_name"
            ),
            array(
                'field' => "code", 'label' => "代碼",
                'rules' => "trim|required|max_length[20]"
            )
        );
    }

    private function set_sub_form_rules() {
        $this->form_rules = array(
            array(
                'field' => "main_id", 'label' => "主類別",
                'rules' => "trim|max_length[250]|callback_check_main_category"
            ),
            array(
                'field' => "name", 'label' => "子類別名稱",
                'rules' => "trim|required|max_length[250]|callback_check_sub_name"
            ),
            array(
                'field' => "code", 'label' => "代碼",
                'rules' => "trim|required|max_length[20]"
            )
        );
    }

    public function check_main_category($str) {
        if(intval($str) < 1) {
			$this->form_validation->set_message('check_main_category', '請選擇一個主類別');
			return FALSE;
		}
		else {
			return TRUE;
		}
    }

    public function check_main_name($str) {
        $result = $this->categories_m->get_many_by(array('name =' => $str, 'id !=' => $this->category_id));
        if($result) {
			$this->form_validation->set_message('check_main_name', '類別名稱重複');
			return FALSE;
		} else {
			return TRUE;
		}
    }

    public function check_sub_name($str) {
        $result = $this->categories_m->get_many_by(array('name =' => $str, 'main_id !=' => '0', 'id !=' => $this->category_id));
        if($result) {
			$this->form_validation->set_message('check_sub_name', '類別名稱重複');
			return FALSE;
		} else {
			return TRUE;
		}
    }
}