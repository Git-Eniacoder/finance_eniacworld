<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Project_stats extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('db_target');
    }
    
    public function fetch_stats($id)
    {
        $data['id'] = $id;
        $data['year'] = $this->db_target->fetch_year($id);
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/sidebar');
        $this->load->view('admin/project_stats',$data);
        $this->load->view('admin/common/footer');
    }
    public function fetch_all_stats_data(){
        $year = $this->input->post('year');
        $id = $this->input->post('id');
        $data = $this->db_target->fetch_graph_year($year,$id);
        $invoice_month = array();
        $invoice_amount = array();
        for($i=0; $i<count($data); $i++){
            $date = strtotime($data[$i]['invoice_date']);
            $invoice_month[$i] = date("F",$date);
            $invoice_amount[$i] = (int)$data[$i]['invoice_amount'];
        }
        
//Month wise sub project fetch
        $sub_project_data = $this->fetch_sub_project_data($year,$id);

        $array = array(
            'month'   => $invoice_month,
            'amount'     => $invoice_amount,
            'sub_project_data' => $sub_project_data['one_by_domain'],
            'total_all' => $sub_project_data['total_all']
           );
        echo json_encode($array);
    }
    public function fetch_sub_project_data($year,$id){
        $bg_line = array('#00ffff','#ffff00','#f2ffe6','#bb33ff','#47d1d1','#e6ecff');
        $bg = array('#e6ffff','#e6ecff','#bb33ff','#bb33ff','#ebfafa','#e6ecff');

        $sub_project = $this->db_target->sub_project_fetch($id);
        $sub_invoice_data =  [];
        for($i=0; $i<count($sub_project); $i++){
            $sub_invoice_data[$i]['sub_project_name'] = $sub_project[$i]['sub_project_name'];
            $fetched_data = $this->db_target->sub_invoice_month($sub_project[$i]['sub_project_id'],$year);
                for($j=0; $j<count($fetched_data); $j++){
                    $date_temp = strtotime($fetched_data[$j]['sub_invoice_date']); 
                    $sub_invoice_data[$i]['sub_month'][$j] = date("m",$date_temp);
                    $sub_invoice_data[$i]['sub_amount'][$j] = $fetched_data[$j]['sub_invoice_amount'];
                }
        }

        for($i=0; $i<count($sub_invoice_data); $i++){
            $count_month = array(0,0,0,0,0,0,0,0,0,0,0,0);
            $data[$i]['label'] = $sub_invoice_data[$i]['sub_project_name'];
            $total_name['sub_name'][$i] = $sub_invoice_data[$i]['sub_project_name'];
            $count = 0;
            if(count($sub_invoice_data[$i]) > 1 ){
                for($j=0; $j<count($sub_invoice_data[$i]['sub_month']); $j++){
                    $count += (int)$sub_invoice_data[$i]['sub_amount'][$j] ;
                    $count_month[intval($sub_invoice_data[$i]['sub_month'][$j])-1] = (int)$sub_invoice_data[$i]['sub_amount'][$j];
                }
            }
                $total_name['sub_total'][$i] = $count;
                $data[$i]['data'] = $count_month;
                $data[$i]['backgroundColor'] = $bg[$i];
                $data[$i]['borderColor'] =  $bg_line[$i];
                $data[$i]['borderWidth'] = 2;
            // break;
        }
        $data_all['one_by_domain'] =  $data;
        $data_all['total_all'] = $total_name;
        return $data_all;
    }
    public function fetch_all_total(){
       
    }

}

/* End of file Project_stats.php */
