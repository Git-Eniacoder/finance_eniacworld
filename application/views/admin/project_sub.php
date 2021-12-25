<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
    <h3 class="text-center text-success my-3">Create Sub Project</h3>
       <form action="<?php echo base_url('admin/project_sub/create_sub_project/'.$id); ?>" method="post">
           <div class="form-group">
             <input type="text" class="form-control" name="project_name" id="" aria-describedby="helpId" placeholder="Sub Project Name">
           </div>
           <div class="form-group">
             <input type="date" class="form-control" name="project_date" id="" aria-describedby="helpId">
           </div>
           <input name="" id="" class="btn btn-primary text-center" type="submit" value="Add Project">
       </form>
   </div>
</main>