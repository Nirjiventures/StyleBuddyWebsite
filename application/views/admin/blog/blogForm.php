<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Blog Form</li>
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
             <span class="text-center text-primary mb-2" id="susid"> <?=  $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/add-blog',['id'=>'catfrmm']);?>
            
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="Image Alt Description" class="form-label">Choose Blog Category<span class="text-danger">*</span></label>
                     <select class="form-control" name="category_id" id="category_id">
                     <option value="" selected>---- Choose Blog Category ----</option>
                     <?php foreach($val as $value) {?>
                     <option value="<?= $value->id ?>" > <?= $value->blogCategoryName ?></option>
                     <?php }?>
                    </select>
                    <?php echo form_error('category_id','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                <div class="col-md-8">
                    <label for="Image Alt Description" class="form-label">Blog Title<span class="text-danger">*</span></label>
                      <input type="text" name="blogTitle" id="blogTitle" placeholder="Enter Blog Title" class="form-control" value="<?= set_value('blogTitle'); ?>">
                       <span id="categoryErr"></span>
                    <?php echo form_error('blogTitle','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="row mt-3">
                 <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Short Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="editor" name="shortData" rows="5"></textarea>
                      <script>CKEDITOR.replace('editor', {height:100});</script>
                    <?php echo form_error('shortData','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="row mt-3">
                 <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Long Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="editor1" name="longData" rows="5"></textarea>
                    <script>CKEDITOR.replace('editor1', {height: 150});</script>
                    <?php echo form_error('longData','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="row mt-3">
                 <div class="form-group col-md-4">
                     <label for="Image Alt Description" class=" col-form-label">Blog Image <span class="text-danger">*</span></label>
                     <input type="file" name="blogImage" id="blogImage" class="form-control"  placeholder="Add Catogery image">
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
               </div> 
                <div class="form-group col-md-4">
                     <label for="Image Alt Description" class=" col-form-label">Author Name<span class="text-danger">*</span></label>
                     <input type="text" name="author" id="author" class="form-control" placeholder="Enter Author Name">
                      <?php echo form_error('author','<span class="text-danger mt-1">','</span>') ;?>
               </div> 
               <div class="form-group col-md-4">
                     <label for="Image Alt Description" class=" col-form-label">Publish Date<span class="text-danger">*</span></label>
                     <input type="date" min="<?php echo date("Y-m-d"); ?>" name="publishDate" id="publishDate" class="form-control" placeholder="Enter Publish Date">
                     <?php echo form_error('publishDate','<span class="text-danger mt-1">','</span>') ;?>
               </div> 
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
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/blog') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
