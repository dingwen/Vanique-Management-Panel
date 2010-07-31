<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends Admin_Controller {

    protected $form_rules;
    protected $supplier_id;

    public function __construct() {
        parent::__construct();

        $this->load->model('suppliers_m');

        $this->data->module_name = "suppliers";
        $supplier_id = 0;
        $this->set_form_rules();

        $this->data->css = array(css('admin.css'));
        $this->data->js = array($this->load->view('fragments/jquery_cdn.php', array(), TRUE));
        
        $this->template->set_partial('side_menu', 'admin/side_menu');
    }

    public function index() {
        $this->data->js[] = js('jquery.dataTables.min.js');
        $this->data->js[] = js('datatable.fnSetFilteringDelay.js');
        $this->data->js[] = js('admin.js');
        $this->data->js[] = js('admin_supplier.js', 'suppliers');

        $this->data->css[] = css('jquery-ui-1.8.2.custom.css');
        $this->data->css[] = css('dataTable.css');

        $this->template->build('admin/index', $this->data);
    }

    public function create() {
        $this->form_validation->set_rules($this->form_rules);

        if ($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->suppliers_m->insert($temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/suppliers');
        }

        foreach ($this->form_rules as $rule) {
            $supplier->{$rule['field']} = set_value($rule['field']);
        }

        $this->data->supplier = & $supplier;
        
        $this->data->css[] = css('admin_form.css');
        $this->data->js[] = js('admin_form.js');
        $this->template->build('admin/form', $this->data);
    }

    public function edit($id = 0) {
        if($id < 1) { redirect('admin/suppliers'); }
        $this->supplier_id = $id;

        $this->form_validation->set_rules($this->form_rules);

        if ($this->form_validation->run()) {
            $temp_data = $_POST;
            unset($temp_data['submit']);

            $result = $this->suppliers_m->update($this->supplier_id, $temp_data);

            if ($result) {
                $this->session->set_flashdata('success', TRUE);
            } else {
                $this->session->set_flashdata('error', TRUE);
            }

            redirect('admin/suppliers');
        }

        $supplier_data = $this->suppliers_m->get_by_id($this->supplier_id);

        foreach ($supplier_data as $field => $value) {
            $supplier->{$field} = $value;
        }
            
        $this->data->supplier = & $supplier;

        $this->data->css[] = css('admin_form.css');
        $this->data->js[] = js('admin_form.js');
        $this->template->build('admin/form', $this->data);
    }

    public function delete($id = 0) {
        if($id < 1) { redirect('admin/suppliers'); }

        $result = $this->suppliers_m->delete($this->supplier_id);

        if ($result) {
            $this->session->set_flashdata('success', TRUE);
        } else {
            $this->session->set_flashdata('error', TRUE);
        }

        redirect('admin/suppliers');
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
        $datatable['iTotalRecords'] = $this->suppliers_m->count_all();

        $result = $this->suppliers_m->get_datatable($offset, $limit, $sort, $filter);
        
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
            $row[3] = anchor(site_url('admin/suppliers/edit/' . $id), 'edit') . ' ' . anchor(site_url('admin/suppliers/delete/' . $id), 'delete', 'class="confirm"');
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
                'field' => "code", 'label' => "代碼",
                'rules' => "trim|required|max_length[5]"
            ),
            array(
                'field' => "contact", 'label' => "聯絡人",
                'rules' => "trim|required|max_length[250]"
            ),
            array(
                'field' => "phone", 'label' => "電話",
                'rules' => "trim|required|max_length[20]"
            ),
            array(
                'field' => "fax", 'label' => "傳真",
                'rules' => "trim|max_length[20]"
            ),
            array(
                'field' => "email", 'label' => "Email",
                'rules' => "trim|max_length[250]|valid_email"
            ),
            array(
                'field' => "qq_account", 'label' => "QQ帳號",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "ali_wangwang", 'label' => "阿里旺旺帳號",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "taobao", 'label' => "淘寶",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "msn_account", 'label' => "MSN帳號",
                'rules' => "trim||max_length[250]|valid_email"
            ),
            array(
                'field' => "address", 'label' => "地址",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "village", 'label' => "村",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "district", 'label' => "區",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "township", 'label' => "鄉/鎮",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "city", 'label' => "縣/市",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "region", 'label' => "省",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "country", 'label' => "國家",
                'rules' => "trim|max_length[250]"
            ),
            array(
                'field' => "postcode", 'label' => "郵遞區號",
                'rules' => "trim|max_length[20]"
            ),
            array(
                'field' => "note", 'label' => "備註/Note",
                'rules' => "trim"
            ),
            array(
                'field' => "fill_date", 'label' => "填表日期",
                'rules' => "trim|required"
            ),
            array(
                'field' => "cell", 'label' => "手機",
                'rules' => "trim"
            ),
            array(
                'field' => "website", 'label' => "公司/廠商網址",
                'rules' => "trim"
            )
        );
    }

}