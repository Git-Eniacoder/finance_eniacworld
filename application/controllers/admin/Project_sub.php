<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_sub extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }

    public function show_sub_page($id){
        $data['id'] = $id;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_sub',$data);
        $this->load->view('admin/common/footer');
    }
    public function create_sub_project($id){
        $data['sub_project_name'] = $this->input->post('project_name');
        $data['sub_project_date'] = $this->input->post('project_date');
        $data['project_id'] = $id ;
        if($this->db_target->insert_data_sub($data)){
            redirect(base_url().'admin/project_sub/show_sub_page/'.$id);
        }
    }
}

/* End of file Project_sub.php */
