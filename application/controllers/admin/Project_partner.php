<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_partner extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }
    
    public function show_partner($partner_id)
    {
        $data['partners'] = $this->db_target->show_partner();
        $data['partner_id'] = $partner_id;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_partner',$data);
        $this->load->view('admin/common/footer');
    }
    public function create_partner($id){
        $data['project_partnership_name'] = $this->input->post('project_partnership_name');
        $data['project_partnership_percent'] = $this->input->post('project_partnership_percent');
        $data['project_id'] = $id;
        if($this->db_target->create_partner($data)){
            redirect(base_url().'admin/project_partner/show_partner/'.$id);
        }
    }
    

}

/* End of file Project_partner.php */
