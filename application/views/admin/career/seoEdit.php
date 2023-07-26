<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">career  SEO Update Form</li>
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
            <?php echo form_open('admin/update-career-seo',['id'=>'dd']);?>
                    
              <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Title<span class="text-danger">*</span></label>
               <div class="col-sm-10">
                <input type="text" name="title" value="<?= $datas->title ?>" placeholder="Enter Title" class="form-control">
               </div>
              </div>
              <input type="hidden" name="id" value="<?= $datas->id ?>">
              <div class="form-group row">
                <label for="Status" class="col-sm-2 col-form-label">Meta Tag<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                <input type="text" name="metaTag" value="<?= $datas->metaTag ?>" placeholder="Enter Meta Tag" class="form-control">
                </div>
              </div>
              <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Meta Description<span class="text-danger">*</span></label>
               <div class="col-sm-10">
                <textarea name="metaDescription" value="" class="form-control" placeholder="Enter Meta Description"><?= $datas->metaDescription ?></textarea>
               </div>
              </div>
      
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
    
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/career-seo') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
