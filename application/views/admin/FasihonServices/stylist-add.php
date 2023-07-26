<?php  $this->load->view('admin/template/header'); ?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> Stylist Expertise / Interests Form</li>
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
                  
               <div class="col-md-4">
                     <label for="Image Alt Description" class="form-label">Title<span class="text-danger"></span></label>
                     <input type="text" name="title" id="title" class="form-control" value="" placeholder=" Title">
               </div>
               <div class="col-md-4">
                    <label for="Image Alt Description" class="form-label">Title Develop<span class="text-danger"></span></label>
                      <input type="text" name="title_develop" id="title_develop" class="form-control" value="<?= set_value('title_develop',$datas->title_develop ); ?>" placeholder="Title">
               </div>
               <div class="col-md-4">
                     <label for="Image Alt Description" class="form-label">Sub Title<span class="text-danger"></span></label>
                     <input type="text" name="sub_title" id="sub_title" class="form-control" value="" placeholder="Sub Title">
               </div>
               
               <div class="col-md-12 mt-3">
                  <div class="form-group boot_sp">
                     <label class="form-label" for="Price">Main Pic(<span class="extenstion">Image extensions supported JPEG, JPG, PNG, WEBP </span>)</label>
                     <input type="file" id="Pic" title="Browse Image" name="image" accept=".jpg,.jpeg,.gif" class="form-control ">
                      <?= $this->session->flashdata('imgerror'); ?>
                      
                  </div>
               </div>
               
               <div class="col-md-12">
                  <label for="Image Alt Description" class="form-label">Area Of Expertise / Interests<span class="text-danger"></span></label>
                  <div class="form-group row">
                     <?php if(!empty($style)) {  ?>
                           <?php foreach($style as $list) {  ?>
                              <div class="col-sm-4">
                                 <div class="form-check checkbox-group"> 
                                   <input class="form-check-input checkarray" type="checkbox" name="expertise[]" value="<?= $list->id ?>" id="flexCheckDefault-<?= $list->id ?>">
                                   <label class="form-check-label" for="flexCheckDefault-<?= $list->id ?>">
                                    <?= $list->name ?>
                                   </label>
                                 </div>
                              </div>
                        <?php  } ?>
                     <?php } ?>
                  </div>
               </div>

               <div class="form-group row">
                     <div class="col-sm-12">
                          <label for="Image Alt Description" class=" col-form-label">Page Content<span class="text-danger">*</span></label>
                           <textarea id="editor" name="description" rows="2" class="form-control"></textarea>
                           <?php echo form_error('description','<span class="text-danger mt-1">','</span>') ;?>
                           <script> CKEDITOR.replace( 'editor',{'height':150} ); </script>
                     </div>
               </div>

            </div>
             
         
            <div class="mb-2 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                     <textarea id="meta_title" name="meta_title" rows="2" class="form-control"></textarea>
               </div>
            </div>
            <div class="mb-2 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                     <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"></textarea>
               </div>
            </div>
            <div class="mb-2 row">
                  <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                        <textarea id="meta_description" name="meta_description" rows="2" class="form-control"></textarea>
                  </div>
            </div>

             <div class="row justify-content-center">
                 <div class="col-sm-4">
                   <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
             
                   <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" selected> Active</option>
                     <option value="0"> InActive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>

            <div class="com-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/stylist-expertise-interests') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>