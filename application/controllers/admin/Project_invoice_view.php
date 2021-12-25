<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_invoice_view extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('db_target');
    }
    
    public function fetch_invoice($id)
    {
        $data['invoice'] = $this->db_target->fetch_invoice($id);
        echo "<pre>";
        print_r($data);
        die;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_invoice_view',$data);
        $this->load->view('admin/common/footer');
    }
    public function view_invoice($name){
        $filename = "./assets/document/".$name;
        
        // Header content type
        header("Content-type: application/pdf");
        
        header("Content-Length: " . filesize($filename));
        
        // Send the file to the browser.
        readfile($filename);
    }
    public function fetch_invoice_all()
    {
        $data['project_name'] = $this->db_target->fetch_project_name();
        $data['invoice'] = $this->db_target->fetch_invoice();
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_invoices_all',$data);
        $this->load->view('admin/common/footer');
    }
}

/* End of file Project_invoice_view.php */
