<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
    <h3 class="text-center text-success my-3">Add Partner</h3>
       <form action="<?php echo base_url('admin/project_partner/create_partner/'.$partner_id); ?>" method="post">
           <div class="form-group">
             <input type="text" class="form-control" name="project_partnership_name" id="" aria-describedby="helpId" placeholder="Partner Name">
           </div>
           <div class="row">
               <div class="col-md-6">
                <div class="form-group">
                        <input type="range" class="form-control" name="project_partnership_percent" id="percentage" min="1" max="100" aria-describedby="helpId">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                        <h6 class="text-secondary py-2">Project Partnership: <span id="per_no">0 %</span></h6>
                    </div>
                </div>
           </div>
           <input name="" id="" class="btn btn-primary text-center" type="submit" value="Add Partner">
       </form>
   </div>
   <div class="container-fluid py-4">
    <table class="table">
    <thead class="table-primary">
        <tr>
        <th scope="col">Partner Name</th>
        <th scope="col">Percentage</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($partners as $key) { ?>
        <tr>
            <td><?php echo $key['project_partnership_name']; ?></td>
            <td><?php echo $key['project_partnership_percent']; ?> %</td>
            <td><i class="fas fa-cog"></i></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    
   </div>
</main>
<script>
    $("#percentage").on("input change", function() { 
        var per = $("#percentage").val(); 
        $('#per_no').html(per+" %");
        $('#percentage').attr('max', <?php $count=0; foreach($partners as $key){ $count += $key['project_partnership_percent'];} echo 100 - $count ;?>);
    });
</script>