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
               <li class="breadcrumb-item active" aria-current="page">Slide  Form</li>
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
            <input type="hidden" name="id" value="<?= $datas->id ?>">
            <div class="row">
               
               <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Title <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title', $datas->title); ?>" placeholder="Add Title">
                    <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class=" col-md-6">
                     <label for="Image Alt Description" class="form-label">Sub Title  </label>
                     <input type="text" name="sub_title" id="sub_title" class="form-control" title="Enter product image" placeholder="Add Sub Title" value="<?= set_value('sub_title',$datas->sub_title); ?>">
                      <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>
               </div>

               <!-- <div class=" col-md-6">
                     <label for="Image Alt Description" class="form-label">Sub Title 2 </label>
                     <input type="text" name="sub_title2" id="sub_title2" class="form-control"  placeholder="Add Sub Title 2" value="<?= set_value('sub_title2',$datas->sub_title2); ?>">
                      <?php echo form_error('sub_title2','<span class="text-danger mt-1">','</span>') ;?>
               </div> -->
               <div class="col-md-6">
                     <label for="Image Alt Description" class="form-label">Slider <span class="text-danger">*</span></label>
                     <select class="form-control" name="slider_id" id="slider_id" required>
                        <option value="">---- Choose Slider ----</option>
                        <?php foreach ($slider as $key => $value): ?>
                           <?php if($value->id == $datas->slider_id){$sel='selected';}else{$sel='';} ?> 
                              <option value="<?=$value->id?>" <?=$sel?>><?=$value->title?></option>
                        <?php endforeach ?> 
                     </select>
               </div>
               <div class="col-md-6">
                     <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                     <select class="form-control" name="status" id="status">
                        <option value="">---- Choose a Status ----</option>
                        <option value="1" <?= ($datas->status ==1)? 'selected = selected' : '' ?> > Active</option>
                        <option value="0" <?= ($datas->status ==0)? 'selected = selected' : '' ?> > Inactive</option>
                     </select>
                     <span id="statusErr"></span>
                     <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="col-sm-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
               <a href="<?php echo base_url($url1.'/'.$url2) ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
