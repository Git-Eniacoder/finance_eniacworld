<div id="layoutSidenav_content">
<main>
   <div class="container-fluid py-4">
    <h3 class="text-center text-success my-3">Create Project</h3>
       <form action="<?php echo base_url('admin/project_name/insert_data'); ?>" method="post">
           <div class="form-group">
             <input type="text" class="form-control" name="project_name" id="" aria-describedby="helpId" placeholder="Project Name">
           </div>
           <div class="form-group">
             <input type="date" class="form-control" name="project_date" id="" aria-describedby="helpId" placeholder="Project Start Date">
           </div>
           <input name="" id="" class="btn btn-primary text-center" type="submit" value="Add Project">
       </form>
   </div>
</main>