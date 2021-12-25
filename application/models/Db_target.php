<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Db_target extends CI_Model {
    public function insert_data($data){
        $this->db->insert('project_create', $data);
        if($this->db->insert_id()){
            return true;
        }else{
            return false;
        }
        
    }
    public function insert_data_sub($data){
        $this->db->insert('sub_project_create', $data);
        if($this->db->insert_id()){
            return true;
        }else{
            return false;
        }
        
    }
    public function insert_sub_invoice($data){
        $this->db->insert('sub_project_invoice', $data);
        if($this->db->insert_id()){
            return true;
        }else{
            return false;
        }
        
    }
    public function create_partner($data){
        $this->db->insert('project_partnership', $data);
        if($this->db->insert_id()){
            return true;
        }else{
            return false;
        }
        
    }
    public function create_invoice($data){
        $this->db->trans_start();
        $this->db->insert('project_invoice', $data);
        $this->db->where('project_id', $data['project_id'])->where('sub_invoice_date', $data['invoice_date'])->update('sub_project_invoice',array('invoice_status' => 1));
        $this->db->trans_complete();
        if($this->db->trans_status()){
            return true;
        }else{
            return false;
        }
        
        
    }
    public function fetch_project_name(){
        return $this->db->get('project_create')->result_array();
    }
    public function show_partner(){
        return $this->db->get('project_partnership')->result_array();
    }
    public function sub_project_fetch($id){
       
        return $this->db->where('project_id',$id)->get('sub_project_create')->result_array();
       
    }
    public function fetch_invoice_amount($date,$project_id){
        return $this->db->query('SELECT SUM(sub_invoice_amount) FROM sub_project_invoice where sub_invoice_date ="'.$date.'" && project_id ='.$project_id)->row_array();
    }
    public function fetch_year($id){
        return $this->db->query('SELECT DISTINCT invoice_year FROM project_invoice where project_id = '.$id.' ORDER BY invoice_year')->result_array();
    }
    public function fetch_graph_year($year,$id){
       return $this->db->query('SELECT invoice_date,invoice_amount FROM `project_invoice` WHERE invoice_year = '.$year.' && project_id ='.$id)->result_array();
    }
    public function fetch_invoice($id=null){
        if($id){
            return $this->db->where('project_id',$id)->get('project_invoice')->result_array();
        }else{
            return $this->db->get('project_invoice')->result_array();
        }
        }
    public function sub_invoice_month($id,$year){
        return $this->db->query('SELECT * FROM `sub_project_invoice` WHERE invoice_status=1 && sub_project_year = '.$year.' && sub_project_id ='.$id.' ORDER BY sub_invoice_date')->result_array();
    }


    
}

/* End of file Db_target.php */
