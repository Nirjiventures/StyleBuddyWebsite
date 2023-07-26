<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category  Form</li>
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
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/add-category',['id'=>'catfrmm']);?>
            
            <div class="row">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Category <span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name'); ?>">
                       <span id="categoryErr"></span>
                    <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                <!--<div class="form-group col-md-6">-->
                <!--      <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>-->
                <!--     <label for="Image Alt Description" class=" col-form-label">Catogery Image (Upload size Max 1 MB)</label>-->
                <!--     <input type="file" name="cat_image" id="cat_image" class="form-control" title="Enter product image" placeholder="Add Catogery image" required>-->
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
             
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" selected=""> Active</option>
                     <option value="0"> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/category') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
