<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Admin_Controller {

    protected $form_rules;
    protected $supplier_id;

    public function __construct() {
        parent::__construct();

        $this->load->model('products_m');

        $this->data->module_name = "products";
        $supplier_id = 0;
        $this->set_form_rules();

        $this->data->js = array($this->load->view('fragments/jquery_cdn.php', array(), TRUE));
        $this->data->css = array(css('admin.css'));
        
        $this->template->set_partial('side_menu', 'admin/side_menu');
    }

    public function index() {
        $this->data->js[] = js('jquery.dataTables.min.js');
        $this->data->js[] = js('datatable.fnSetFilteringDelay.js');
        $this->data->js[] = js('admin.js');
        $this->data->js[] = js('admin_product.js', 'products');

        $this->data->css[] = css('jquery-ui-1.8.2.custom.css');
        $this->data->css[] = css('dataTable.css');

        $this->template->build('admin/index', $this->data);
    }

    public function create() {
        $this->form_validation->set_rules($this->form_rules);

        if ($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->prodcuts_m->insert($temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/prodcuts');
        }

        foreach ($this->form_rules as $rule) {
            $supplier->{$rule['field']} = set_value($rule['field']);
        }

        $this->data->product = & $product;
        
        $this->data->css[] = css('admin_form.css');
        $this->data->js[] = js('admin_form.js');
        
        $this->template->build('admin/form', $this->data);
    }

    public function edit($id = 0) {
        if($id < 1) { redirect('admin/products'); }
        $this->supplier_id = $id;

        $this->form_validation->set_rules($this->form_rules);

        if ($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->prodcuts_m->update($this->supplier_id, $temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/prodcuts');
        }

        $supplier_data = $this->prodcuts_m->get_by_id($this->supplier_id);

        foreach ($supplier_data as $field => $value) {
            $supplier->{$field} = $value;
        }
            
        $this->data->product = & $product;

        $this->data->css[] = css('admin_form.css');
        $this->data->js[] = js('admin_form.js');
        
        $this->template->build('admin/form', $this->data);
    }

    public function delete($id = 0) {
        if($id < 1) { redirect('admin/prodcuts'); }

        $result = $this->prodcuts_m->delete($this->supplier_id);

        if ($result) {
            $this->session->set_flashdata('success', TRUE);
        } else {
            $this->session->set_flashdata('error', TRUE);
        }

        redirect('admin/prodcuts');
    }

    public function datatable() {
        $limit = $this->input->get_post('iDisplayLength');
        $offset = $this->input->get_post('iDisplayStart');
        $filter = $this->input->get_post('sSearch');
        $sort_cols = intval($this->input->get_post('iSortingCols'));
        $sort = array();
        if ($sort_cols > 0) {
            for ($i = 0; $i < $sort_cols; $i++) {
                $sort[] = array(
                    $this->input->get_post('iSortCol_' . $i),
                    $this->input->get_post('sSortDir_' . $i)
                );
            }
        }

        $datatable['sEcho'] = intval($this->input->get_post('sEcho'));
        $datatable['iTotalRecords'] = $this->prodcuts_m->count_all();

        $result = $this->prodcuts_m->get_datatable($offset, $limit, $sort, $filter);
        
        if ($result) {
            $datatable['iTotalDisplayRecords'] = $result[0];
            $datatable['aaData'] = $this->process_result($result[1]);
        } else {
            $datatable['iTotalDisplayRecords'] = 0;
            $datatable['aaData'] = array();
        }
        
        echo json_encode($datatable);
    }

    private function process_result($result) {
        $processed = array();

        foreach ($result as $row) {
            $id = $row[3];
            $row[3] = anchor(site_url('admin/prodcuts/edit/' . $id), 'edit') . ' ' . anchor(site_url('admin/prodcuts/delete/' . $id), 'delete', 'class="confirm"');
            $processed[] = $row;
        }
        return $processed;
    }

    private function set_form_rules() {
        $this->form_rules = array(
            array(
                'field' => "name", 'label' => "名稱",
                'rules' => "trim|required|max_length[250]"
            ),
            array(
                'field' => "code", 'label' => "產品號碼",
                'rules' => "trim|required|max_length[5]"
            )
        );
    }

}