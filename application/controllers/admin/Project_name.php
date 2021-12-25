<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_name extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }
    
    public function index()
    {
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_name');
        $this->load->view('admin/common/footer');
    }
    public function insert_data(){
        $data['project_name'] = $this->input->post('project_name');
        $data['project_date'] = $this->input->post('project_date');
        if($this->db_target->insert_data($data)){
            redirect(base_url().'admin/project_name');
        }
    }

}

/* End of file Project_name.php */
