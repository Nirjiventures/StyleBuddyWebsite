<?php
   $url1 = $this->uri->segment(1);
   $url2 = $this->uri->segment(2);
   $url3 = $this->uri->segment(3);
?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">CMS Page Update Form</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-1 form-main">
         <div class="card  form-card">
            <div class="col-md-12">
               <a href="<?php echo base_url($url1.'/page') ;?>" class="btn btn-primary float-right"><i class="fa fa-bars" aria-hidden="true"></i> LIST </a>
            </div>
            <div id="success_message"></div>
             <span class="text-center text-info mb-1" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-1" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'catfrmm']);?>
            
            <div class="mb-3 row">
               <div class="col-sm-6">
                 <label for="Image Alt Description" class=" col-form-label">Page Title<span class="text-danger">*</span></label>
                  <input type="text" name="title" value="<?= $datas->title ?>" class="form-control" placeholder="name">
                 <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>

               <div class="col-sm-6">
                 <label for="Image Alt Description" class=" col-form-label">Sub Title</label>
                  <input type="text" name="sub_title" value="<?= $datas->sub_title ?>" class="form-control" placeholder="sub title">
                 <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>

            </div>
            

            <div class="form-group row">
                 <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Page Top Content<span class="text-danger">*</span></label>
                        <textarea id="editor1" name="content" rows="2" class="form-control"><?= $datas->content ?></textarea>
                       <?php echo form_error('content','<span class="text-danger mt-1">','</span>') ;?>
                          
                          <input type="hidden" name="id" value="<?= $datas->id; ?>">
                 </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="Image Alt Description" class=" col-form-label">Page Bottom Content<span class="text-danger">*</span></label>
                    <textarea id="editor2" name="content2" rows="2" class="form-control"><?= $datas->content2 ?></textarea>
                    <?php echo form_error('content2','<span class="text-danger mt-1">','</span>') ;?>
                </div>
            </div>
             
            <div class="form-group row">
                <div class="col-sm-8">
                    <label for="Image Alt Description" class=" col-form-label">Page Image</label>
                    <input type="file" name="image" class="form-control">
                    <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                </div>
                <div class="col-sm-4">
                    <?php if(!empty($datas->image)) { ?>
                        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/').$datas->image ?>" class="-imgthumbnail" style="width:100px; height:100px;">
                        <input type="hidden" name="old_image" value="<?= $datas->image; ?>">
                    <?php  } ?>
                </div>  
            </div>
            
            
           
            
            
            <div class="mb-3 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                     <textarea id="meta_title" name="meta_title" rows="2" class="form-control"><?= $datas->meta_title ?></textarea>
               </div>
            </div>
            <div class="mb-3 row">
               <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                     <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"><?= $datas->meta_keyword ?></textarea>
               </div>
            </div>
            <div class="mb-3 row">
                  <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control"><?= $datas->meta_description ?></textarea>
                         
                  </div>
            </div>

            <div class="row">
               <div class="col-sm-4">
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

            <div class="text-center col-sm-12">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/page') ;?>" class="btn btn-secondary mt-4">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
