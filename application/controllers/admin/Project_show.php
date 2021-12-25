<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_show extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }
    
    public function index()
    {
        $data = $this->db_target->fetch_project_name();
        for($i=0; $i<count($data); $i++){
            $data[$i]['sexy'] = $this->db_target->sub_project_fetch($data[$i]['project_id']);
        }
        $data['all_data'] = $data;
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_show',$data);
        $this->load->view('admin/common/footer');
    }

}

/* End of file Project_show.php */
