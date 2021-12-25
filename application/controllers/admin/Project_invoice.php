<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_invoice extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }
    
    public function show_invoice($id)
    {
        $data['project_id'] = $id ;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_invoice',$data);
        $this->load->view('admin/common/footer');
    }
    public function fetch_invoice_amount(){
        $date = $this->input->post('date');
        $project_id= $this->input->post('project_id');
        $amount = $this->db_target->fetch_invoice_amount($date,$project_id);
        echo json_encode($amount);
    }
    public function create_invoice($id){
        $config['upload_path']          = './assets/document';
        $config['file_name']            = 'document'.rand().'.pdf';
        $config['allowed_types']        = 'pdf';
        $data['invoice_date'] = $this->input->post('invoice_date');
        $date = strtotime($data['invoice_date']);
        $data['invoice_year'] = date("Y",$date);
        $data['invoice_amount'] = $this->input->post('invoice_amount');
        $data['invoice_gst'] = $this->input->post('invoice_gst');
        $data['invoice_name'] = $config['file_name'];
        $data['project_id'] = $id;

        $this->load->library('upload', $config);
        if($this->upload->do_upload('document_upload')){
            if($this->db_target->create_invoice($data)){
                redirect(base_url().'admin/project_invoice/show_invoice/'.$id);
            }
        }
    }
}

/* End of file Project_invoice.php */
