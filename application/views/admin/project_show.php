<?php 
// echo "<pre>";
// print_r($all_data);
// die;
?>
<style>
   body {
   background: #F9F9F9;
   }
   .myaccordion {
   width : 90%;
   margin: 10px 0;
   box-shadow: 0 0 1px rgba(0,0,0,0.1);
   }
   .myaccordion .card,
   .myaccordion .card:last-child .card-header {
   border: none;
   }
   .myaccordion .card-header {
   border-bottom-color: #EDEFF0;
   background: transparent;
   }
   .myaccordion .fa-stack {
   font-size: 18px;
   }
   .myaccordion .btn {
   width: 100%;
   font-weight: bold;
   color: #004987;
   padding: 0;
   }
   table {
   border-collapse:separate; 
   border-spacing: 0 2px;
   }
   tr{
   background-color : aliceblue;
   }
   .myaccordion .btn-link:hover,
   .myaccordion .btn-link:focus {
   text-decoration: none;
   }
   .myaccordion li + li {
   margin-top: 10px;
   }
   .fa-stack a{
   /* margin : 0 2px; */
   }
</style>
<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
<?php for($i=0; $i<count($all_data); $i++){ ?>
   <div id="accordion<?php echo $i ?>" class="myaccordion">
      <div class="card">
         <div class="card-header" id="headingOne">
            <h2 class="mb-0">
               <button class="d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $i ?>" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo $all_data[$i]['project_name']; ?>
                  <span class="fa-stack fa-sm">
                     <a class="text-dark dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></a>
                     <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/project_stats/fetch_stats/<?php echo $all_data[$i]['project_id']; ?>">Project Stats</a>
                        <a class="dropdown-item" href="<?php echo base_url().'admin/project_partner/show_partner/'; ?><?php echo $all_data[$i]['project_id']; ?>">Add Partner</a>
                        <a class="dropdown-item" href="<?php echo base_url();?>admin/project_sub/show_sub_page/<?php echo $all_data[$i]['project_id']; ?>">Create Subproject</a>
                        <a class="dropdown-item" href="<?php echo base_url().'admin/project_invoice/show_invoice/'.$all_data[$i]['project_id']; ?>">Upload Invoice</a>
                        <a class="dropdown-item" href="<?php echo base_url().'admin/project_invoice_view/fetch_invoice/'.$all_data[$i]['project_id']; ?>">View Invoice</a>
                     </div>
                  </span>
               </button>
            </h2>
         </div>
         <div id="collapseOne<?php echo $i ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion<?php echo $i ?>">
            <div class="card-body px-5">
               <table class="table table-borderless">
                  <tbody>
                  <?php for($j=0; $j<count($all_data[$i]['sexy']); $j++ ){ ?>
                     <tr>
                        <td><?php echo $all_data[$i]['sexy'][$j]['sub_project_name']; ?></td>
                        <td>
                           <a class="text-dark" href="<?php echo base_url().'admin/project_sub_amount/view_sub/'.$all_data[$i]['project_id'].'/'.$all_data[$i]['sexy'][$j]['sub_project_id']; ?> " ><i class="fa fa-plus"></i></a>
                        </td>
                     </tr>
                  <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
</div>
</main>