<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
      <h3 class="text-center text-success my-3">Raise Invoice</h3>
      <form action="<?php echo base_url('admin/project_sub_amount/create_sub_invoice/'.$parent_id.'/'.$child_id) ?>" method="post">
         <div class="form-group">
            <input type="date" class="form-control" name="sub_invoice_raise_date" id="date" aria-describedby="helpId">
         </div>
         <div class="form-group">
            <input type="number" class="form-control" name="sub_invoice_amount" id="date" aria-describedby="helpId" placeholder="Enter Amount">
         </div>
         <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                    <input type="month" class="form-control" name="sub_invoice_date" id="date" aria-describedby="helpId" placeholder="Enter Amount">
                    </div>
                </div>
           </div>
         <input name="" id="" class="btn btn-primary text-center" type="submit" value="Raise Invoice">
      </form>
   </div>
</main>