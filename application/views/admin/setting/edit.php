<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Website setting Update Form</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid1">
   <div class="row">
      <div class="col-md-12 mt-5 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-site-setting',['id'=>'sliderfrmm']);?>
            
             <input type="hidden" name="id" value="<?= $datas->id ?>"> <input type="hidden" name="old_img" value="<?= $datas->logo ?>">
            <div class="row">
                <div class="mb-2 col-md-4">
                    <label for="Image Alt Description" class="form-label">Linkedin Link</label>
                      <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?= set_value('linkedin',$datas->linkedin); ?>" >
                       <?php echo form_error('linkedin','<span class="text-danger mt-1">','</span>') ;?>
                </div>
             
                 <div class="mb-2 col-md-4">
                     <label for="Image Alt Description" class="form-label">Facebook Link</label>
                     <input type="text" name="facebook" id="facebook" class="form-control" value="<?= set_value('facebook',$datas->facebook); ?>" >
                      <?php echo form_error('linkedin','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                  <div class="mb-2 col-md-4">
                     <label for="Image Alt Description" class="form-label">Instagram Link</label>
                     <input type="text" name="instagram" id="instagram" class="form-control" value="<?= set_value('instagram',$datas->instagram); ?>" >
                      <?php echo form_error('linkedin','<span class="text-danger mt-1">','</span>') ;?>
                 </div>
                
            </div>
            <div class="row">
             <div class="mb-2 col-md-4">
                <label for="Image Alt Description" class=" col-form-label">Twitter Link</label>
                 <input type="text" name="twitter" id="twitter" class="form-control" value="<?= set_value('twitter',$datas->twitter); ?>" >
                  <?php echo form_error('twitter','<span class="text-danger mt-1">','</span>') ;?>
             </div>
             <div class="mb-2 col-md-4">
                <label for="Image Alt Description" class=" col-form-label">Youtube Link</label>
                 <input type="text" name="youtube" id="youtube" class="form-control" value="<?= set_value('youtube',$datas->youtube); ?>" >
                  <?php echo form_error('youtube','<span class="text-danger mt-1">','</span>') ;?>
             </div>
             <div class="mb-2 col-md-4">
                 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/').$datas->logo ?>" style="width:30px; height:30px;"> 
                 <label for="Image Alt Description" class=" col-form-label">Logo(Upload size Max 2 MB)</label>
                 <input type="file" name="logo" id="logo" class="form-control" >
                 <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
             </div>
            </div>
            <div class="row">
             <div class="mb-2 col-md-6">
                <label for="Image Alt Description" class=" col-form-label">Email</label>
                 <input type="text" name="email" id="email" class="form-control" value="<?= set_value('email',$datas->email); ?>" >
                  <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>
             </div>
             <div class="mb-2 col-md-6">
                 <label for="Image Alt Description" class=" col-form-label">Mobile No</label>
                 <input type="text" name="mobile" id="mobile" class="form-control" value="<?= set_value('mobile',$datas->mobile); ?>">
                 <?php echo form_error('instagram','<span class="text-danger mt-1">','</span>') ;?>
             </div>
            </div>
              <div class="row">
               <div class="mb-2 col-md-12">
                   <label for="Image Alt Description" class=" col-form-label">Website short description</label>
                   <textarea  name="short_details" class="form-control"  rows="3"><?= $datas->short_details ?></textarea>
                   <?php echo form_error('short_details','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class="mb-2 col-md-12">
                   <label for="Image Alt Description" class=" col-form-label">Address</label>
                   <textarea id="editor" name="address" class="form-control"  rows="1"><?= $datas->address ?></textarea>
                   <?php echo form_error('address','<span class="text-danger mt-1">','</span>') ;?>
                   <script type="text/javascript">
                      /* CKEDITOR.replace( 'editor',{
                       height: 100
                       });*/
                   </script>
               </div>
               <div class="mb-2 col-md-12">
                    <label for="Image Alt Description" class=" col-form-label">GSTIN</label>
                    <input type="text" maxlength="gstin" name="gstin" id="gstin" class="form-control" value="<?= set_value('gstin',$datas->gstin); ?>">
                    <?php echo form_error('gstin','<span class="text-danger mt-1">','</span>') ;?>
                </div>
             </div>
            
            
            <div class="mb-2 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                     <textarea id="meta_title" name="meta_title" rows="2" class="form-control"><?= $datas->meta_title ?></textarea>
               </div>
            </div>
            <div class="mb-2 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                     <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"><?= $datas->meta_keyword ?></textarea>
               </div>
            </div>
            <div class="mb-2 row">
                  <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                        <textarea id="meta_description" name="meta_description" rows="2" class="form-control"><?= $datas->meta_description ?></textarea>
                         
                  </div>
            </div>
         
            <div class="col-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="Update" value="Update" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/site-setting') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
