<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_sub_amount extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
        //Do your magic here
    }
    
    public function view_sub($parent_id,$child_id)
    {
        $data['parent_id'] = $parent_id;
        $data['child_id'] = $child_id;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_sub_amount',$data);
        $this->load->view('admin/common/footer');
    }
    public function create_sub_invoice($paent_id,$child_id){
        $data['sub_invoice_amount'] = $this->input->post('sub_invoice_amount');
        $data['project_id'] = $paent_id;
        $data['sub_project_id'] = $child_id;
        $data['sub_invoice_date'] = $this->input->post('sub_invoice_date');
        $date = strtotime($data['sub_invoice_date']);
        $data['sub_project_year'] = date("Y",$date);
        $data['sub_invoice_raise_date'] = $this->input->post('sub_invoice_raise_date');
        if($this->db_target->insert_sub_invoice($data)){
            redirect(base_url().'admin/project_show/');
        }
    }

}

/* End of file Project_sub_amount.php */
