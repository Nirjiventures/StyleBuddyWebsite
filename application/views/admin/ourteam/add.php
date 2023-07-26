<?php $segment1  = $this->uri->segment(1);?>
<?php $segment2  = $this->uri->segment(2);?>
<?php $segment3  = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item "><a href="<?php echo base_url($segment1."/".$segment2);?>" class="text-decoration-none">Team</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Team</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="mt-5 form-main">
         <div class="card  form-card">
               <div id="success_message"></div>
               <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
               <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
               <?php echo form_open_multipart('',['id'=>'catfrmm']);?>
               <div class="row">
                     <div class="col-sm-8">
                        <div class="row">
                           <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">First Name <span class="text-danger">*</span></label>
                              <input type="text" name="fname" id="fname" class="form-control" value="">
                              <span id="fnameErr"></span>
                              
                              <?php echo form_error('fname','<span class="text-danger mt-1">','</span>') ;?>
                          </div>
                          <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">Last Name </label>
                              <input type="text" name="lname" id="lname" class="form-control" value="">
                              <span id="lnameErr"></span>
                              <?php echo form_error('lname','<span class="text-danger mt-1">','</span>') ;?>
                           </div>
                           <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">Email </label>
                              <input type="email" name="email" id="email" class="form-control" value="">
                              <span id="emailErr"></span>
                              <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
                           </div>
                           <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">Mobile </label>
                              <input type="text" name="mobile" id="mobile" class="form-control" value="">
                              <span id="mobileErr"></span>
                              <?php echo form_error('mobile','<span class="text-danger mt-1">','</span>') ;?>
                           </div>
                           <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">Designation </label>
                              <input type="text" name="designation" id="designation" class="form-control" value="">
                              <span id="designationErr"></span>
                              <?php echo form_error('designation','<span class="text-danger mt-1">','</span>') ;?>
                           </div>
                           <div class="col-sm-6">
                              <label for="Image Alt Description" class="form-label">Experience </label>
                              <input type="text" name="experience" id="experience" class="form-control" value="">
                              <span id="designationErr"></span>
                              <?php echo form_error('designation','<span class="text-danger mt-1">','</span>') ;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                          
                           <div class="form-group boot_sp">
                              <input type="file" id="Pic" title="Browse Image" name="image" accept=".jpg,.jpeg,.gif" class="form-control box_in3">
                              <label class="form-control-placeholder2" for="Price">Image</label>
                               
                              <?= $this->session->flashdata('imgerror'); ?>
                              <?php if(!empty($datas->image)) { ?><div style="margin-top: 20px;"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  style="width:200px" src='<?php echo base_url().'assets/images/'.$datas->image;?>'></div><?php } ?>
                           </div>
                         
                     </div>
                  </div>
                  <div class="row">
                     

                     
                     <div class="col-sm-12">
                        <label for="Image Alt Description" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="">
                        <span id="addressErr"></span>
                        <?php echo form_error('address','<span class="text-danger mt-1">','</span>') ;?>
                     </div>

                     <div class="col-sm-12">
                           <label class="form-label" for="Price">About</label>
                           <textarea type="text" id="editor1" name="about" value="" class="form-control box_in2"></textarea>
                           <?php echo form_error('about','<span class="text-danger mt-1">','</span>');?>
                           <script type="text/javascript"> CKEDITOR.replace("editor1",{'height':150}); </script>
                     </div>
                     <div class="col-sm-12">
                           <label class="form-label" for="Price">More About</label>
                           <textarea type="text" id="editor2" name="more_about" value="" class="form-control box_in2"></textarea>
                           <?php echo form_error('more_about','<span class="text-danger mt-1">','</span>');?>
                           <script type="text/javascript"> CKEDITOR.replace("editor2",{'height':150}); </script>
                     </div>
               </div>
  
               <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
               <div class="form-group row">
                  <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                  <div class="col-sm-10">
                     <select class="form-control" name="status" id="status">
                        <option value="">---- Choose a Status ----</option>
                        <option value="1"> Active</option>
                        <option value="0"> Inctive</option>
                     </select>
                     <span id="statusErr"></span>
                     <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                  </div>
               </div>
               <div class="form-group">
                  <label for="" class="col-sm-2 col-form-label"></label>
                  <input type="submit" name="submit" id="submit" value="Add" class="btn btn-primary mt-4">
               </div>
               <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>