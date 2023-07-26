<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Slider  Form</li>
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
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title'); ?>" placeholder="Add Title">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                <div class="col-md-6">
                     <label for="Image Alt Description" class="form-label">Sub Title </label>
                     <input type="text" name="sub_title" id="sub_title" class="form-control" title="Enter product image" placeholder="Add Sub Title" value="<?= set_value('sub_title'); ?>">
                      <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
            
                <div class="col-md-6 mt-2">
                     <label for="Image Alt Description" class="form-label">Slider Image(Upload size Max 2 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="slider_image" id="slider_image" class="form-control" title="Enter product image" placeholder="Add Catogery image" >
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
               </div>

               <div class="col-md-6 mt-2">
                  <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                  
                     <select class="form-control" name="status" id="status">
                        <option value="">---- Choose a Status ----</option>
                        <option value="1" selected=""> Active</option>
                        <option value="0"> Inctive</option>
                     </select>
                     <span id="statusErr"></span>
                     <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                  
               </div>

            </div>
  
            

            
            <div class="col-12 text-center">
               <label for="" class="col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/slider') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
