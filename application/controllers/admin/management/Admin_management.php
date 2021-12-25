<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_management extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_login');
  
    }

    public function index()
    {
        $id = $this->session->userdata("id");
        $data['admin'] = $this->db_login->fetch($id);
        $this->load->view('admin/common/header',$data);
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/management/admin_management',$data);
        $this->load->view('admin/common/footer');
    }
   
    public function insert_update(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if($this->form_validation->run()){
            
           $data['user_name'] = $this->input->post('name');
           $data['user_uname'] = $this->input->post('username');
           $data['user_email'] = $this->input->post('email');
        //    $data['user_pass'] = $this->input->post('new_password');

        if(is_null($this->input->post('new_password'))){
            $pass = $this->input->post('new_password');
            $data['user_pass'] = md5($pass);
            }
        
           if($this->db_login->insert_update($this->session->userdata("id"),$data)){
            $this->session->set_flashdata('success','Update successfully');
             redirect(base_url().'admin/Management/admin_management');
           }
           else{
            $this->session->set_flashdata('error','Error in update');
            redirect(base_url().'admin/Management/admin_management');
           } 
        }
       else
       {
        $this->session->set_flashdata('error','Please Fill All Fields');
        redirect(base_url().'admin/Management/admin_management');
       }
    } 
    
    

}

/* End of Admin_management.php */