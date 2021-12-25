<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
    <h3 class="text-center text-success my-3">Add Invoice</h3>
       <form action="<?php echo base_url('admin/project_invoice/create_invoice/'.$project_id); ?>" method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                    <input type="month" class="form-control" name="invoice_date" id="month_pick" aria-describedby="helpId" placeholder="Invoice Amount">
                    </div>
                    <!-- <div class="form-group">
                      <label for=""></label>
                      <select multiple class="custom-select" name="" id="">
                            <option selected>Select Multi Projects</option>
                            <option value="">Qureka 397</option>
                            <option value="">Qureka 1028</option>
                            <option value="">Qureka 3432</option>
                        </select>
                    </div> -->
           <div class="row">
               <div class="col-md-6">
                <div class="form-group">
                        <input type="text" class="form-control" name="invoice_amount" id="amount" aria-describedby="helpId" placeholder="Invoice Amount" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <input type="number" class="form-control" name="invoice_gst" id="" placeholder="GST amount" aria-describedby="fileHelpId" >
                    </div>
                </div>
           </div>
           <div class="form-group">
                      <input type="file" class="form-control-file" name="document_upload" id="" placeholder="" aria-describedby="fileHelpId" >
        </div>
           <input name="" id="" class="btn btn-primary text-center" type="submit" value="Add Invoice">
       </form>
   </div>
   
</main>
<script>
    $(document).ready(function() {
            $('#month_pick').change(function() {
                    $('#amount').val('fetching....');
                    var date = $(this).val();
                    console.log(date);
                $.ajax({
                    url: '<?php echo base_url('admin/project_invoice/fetch_invoice_amount/'); ?>',
                    data: {'date': date,'project_id' : <?php echo $project_id; ?>},
                    type: 'POST',
                    success: function(data) {
                        var amount = JSON.parse(data);
                    if(amount['SUM(sub_invoice_amount)']){
                       $('#amount').val(amount['SUM(sub_invoice_amount)']);
                    }else{
                        $('#amount').val('No Lean Amount');
                    }
                    }
                });
        });
    });
</script>
