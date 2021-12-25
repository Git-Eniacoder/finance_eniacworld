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
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
              <span>From</span>
              <input type="month"
                class="form-control" name="" id="from" aria-describedby="helpId" placeholder="">
            </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
          <span>To</span>
              <input type="month"
                class="form-control" name="" id="to" aria-describedby="helpId" placeholder="">
            </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <span>Company</span>
            <select class="form-control" name="" id="">
              <option slected>All</option>
              <?php foreach($project_name as $key){ ?>
              <option value="<?php echo $key['project_id']?>"><?php echo $key['project_name']?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-3">
        <div class="form-group py-4">
              <input type="submit"
                class="btn btn-primary" name="" id="search" aria-describedby="helpId" value="Go">
            </div>
        </div>
    </div>
</div>
<div class="container py-4">
   <?php foreach($invoice as $key) { ?>
   <div id="accordion" class="myaccordion">
      <div class="card">
         <div class="card-header" id="headingOne">
            <h2 class="mb-0">
               <button class="d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
               <?php 
                // echo $key['invoice_date'] ;
                $date = strtotime($key['invoice_date']);
                echo date("F",$date).' ';
                echo date("Y",$date);
                ?>
                  <span class="fa-stack fa-sm">
                  <a class="btn btn-primary text-white py-2" href="<?php echo base_url('admin/project_invoice_view/view_invoice/'.$key['invoice_name']); ?>" ><i class="fas fa-file-invoice"></i></a>
                </span>
               </button>
            </h2>
         </div>
         <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body px-5">
               <table class="table table-borderless">
                  <tbody>
                     <tr>
                        <td>Amount</td>
                        <td>
                            <?php echo $key['invoice_amount']; ?>
                        </td>
                     </tr>
                     <tr>
                        <td>Gst</td>
                        <td>
                            <?php echo $key['invoice_gst']; ?>
                        </td>
                     </tr>
                     <tr class="bg-light">
                        <td>Total</td>
                        <td>
                            <?php echo $key['invoice_amount']+$key['invoice_gst']; ?>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <?php }?>
   </div>
</main>
<script>
  $('#search').click(function(){
     var from = $('#from').val();
     var to = $('#from').val();
     if()

  });
</script>