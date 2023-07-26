<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Blog Category Form</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-5 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/add-blog-category',['id'=>'catfrmm']);?>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Blog Category Name<span class="text-danger">*</span></label>
                      <input type="text" name="blogCategoryName" id="blogCategoryName" placeholder="Enter Blog Category Name" class="form-control" value="<?= set_value('blogCategoryName'); ?>">
                       <span id="categoryErr"></span>
                    <?php echo form_error('blogCategoryName','<span class="text-danger mt-1">','</span>') ;?>
               </div>


                <div class="col-md-6">
                  <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                    
                        <select class="form-control" name="status" id="status">
                           <option value="">---- Choose a Status ----</option>
                           <option value="1" selected=""> Active</option>
                           <option value="0"> Inctive</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                     
                </div>
                <!--<div class="form-group col-md-6">-->
                <!--      <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>-->
                <!--     <label for="Image Alt Description" class=" col-form-label">Blog Catogery Image (Upload size Max 1 MB)</label>-->
                <!--     <input type="file" name="blogCategoryImage" id="blogCategoryImage" class="form-control" title="Enter product image" placeholder="Add Catogery image" required>-->
                <!--     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>-->
                <!-- </div> -->
            </div>
            
             <!--<div class="row">-->
             <!--    <div class="col-md-12">-->
             <!--       <label for="Image Alt Description" class="form-label">is Sub Menu<span class="text-danger">*</span></label>-->
             <!--        <select class="form-control" name="is_sub_menu" id="is_sub_menu">-->
             <!--        <option value="">---- Choose a Sub Menu ----</option>-->
             <!--        <option value="1">Yes</option>-->
             <!--        <option value="0" selected>No</option>-->
             <!--       </select>-->
             <!--         <span class="badge badge-secondary">If you want to add Sub menu,select yes, otherwise select no.</span>-->
             <!--          <span id="categoryErr"></span>-->
             <!--       <?php echo form_error('is_sub_menu','<span class="text-danger mt-1">','</span>') ;?>-->
             <!--  </div>-->
             <!--</div>-->
             
            

            <div class="col-sm-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/blog-category') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>

            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
