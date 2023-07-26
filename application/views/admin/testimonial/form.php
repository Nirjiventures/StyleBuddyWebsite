<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Testimonial Form</li>
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
            <?php echo form_open_multipart('admin/add-testimonial',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="testimonial_name" id="testimonial_name" class="form-control" value="<?= set_value('title'); ?>" placeholder="Add  name">
                    <?php echo form_error('testimonial_name','<span class="text-danger mt-1">','</span>') ;?>
                </div>
             
                 <div class="form-group col-md-6">
                     <label for="Image Alt Description" class=" col-form-label">Client Image(Upload size Max 2 MB)<span class="text-danger">*</span></label>
                     <input type="file" name="image" id="image" class="form-control" title="Enter product image" placeholder="Add testimonial image" >
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                 </div>
            </div>
            <div class="form-group row">
                <label for="Image Alt Description" class=" col-form-label">Testimonial data<span class="text-danger">*</span></label>
                <textarea id="editor" name="testimonial_data" class="form-control"  rows="1"></textarea>
                <?php echo form_error('testimonial_data','<span class="text-danger mt-1">','</span>') ;?>
                <script type="text/javascript">
                    CKEDITOR.replace("editor");
                </script>
            </div>
  
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
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/testimonial') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
