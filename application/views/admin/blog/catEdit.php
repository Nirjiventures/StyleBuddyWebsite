<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Blog Category Update Form</li>
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
            <?php echo form_open_multipart('admin/update-blog-category',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-sm-6">
                        <label for="Image Alt Description" class="form-label">Blog Category Name<span class="text-danger">*</span></label>
                        <input type="text" name="blogCategoryName" id="blogCategoryName" placeholder="Enter Blog Category Name" class="form-control" value="<?= set_value('blogCategoryName',$datas->blogCategoryName); ?>">
                        <span id="categoryErr"></span>
                        <input type="hidden" name="id" value="<?= $datas->id?>">
                        <input type="hidden" name="old_img" value="<?= $datas->blogCategoryImage ?>">
                        <?php echo form_error('category','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                   <!-- <div class="col-md-4">-->
                   <!--   <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>-->
                   <!--  <label for="Image Alt Description" class=" col-form-label">Blog Catogery Image</label>-->
                   <!--  <input type="file" name="blogCategoryImage" id="blogCategoryImage" class="form-control" title="Enter product image" placeholder="Add Catogery image">-->
                   <!--</div>-->
                   <!--<div class="col-md-2 mt-4">-->
                   <!--    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/images/').$datas->blogCategoryImage ?>" style="width:50px; height:50px;" class="img-fluid" >-->
                   <!--</div>-->
            

                  <div class="col-sm-6">
                     <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" id="status">
                           <option value="">---- Choose a Status ----</option>
                           <option value="1" <?= ($datas->status == 1) ?  "selected = 'selected'" : ''; ?> > Active</option>
                           <option value="0" <?= ($datas->status == 0) ?  "selected = 'selected'" : ''; ?> > Inctive</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                  </div>

            </div>
  
           

            <div class="col-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/blog-category') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
