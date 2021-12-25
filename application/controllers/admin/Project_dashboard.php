<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_dashboard extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_dashboard');
        $this->load->view('admin/common/footer');
    }

}

/* End of file Project_dashboard.php */
