<?//= print_r($datas); ?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Update Child Subcategory Form</li>
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
            <?php echo form_open_multipart('admin/update-child-subcategory',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Sub Category <span class="text-danger">*</span></label>
                         <select name="subcategory_id" id="subcategory_id" class="form-control">
                             <option value="">---- Choose SubCategory  ----</option>
                             <?php foreach($datas as $data) { ?>
                                    <option value="<?= $data->id; ?>" <?= ($data->id == $single->subcategory_id)?'selected':''?> ><?= $data->subcategory; ?></option>
                             <?php }?>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('subcategory_id','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Child SubCategory Name<span class="text-danger">*</span></label>
                         <input type="text" name="child_sub_cat_name" id="child_sub_cat_name" class="form-control" value="<?= set_value('child_sub_cat_name',$single->child_sub_cat_name); ?>">
                           <span id="categoryErr"></span>
                       <?php echo form_error('child_sub_cat_name','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
            </div>
            <div class="row">
                 <div class="form-group col-md-6">
                       <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>
                     <label for="Image Alt Description" class=" col-form-label">Child SubCategory Image (Upload size Max 1 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="child_sub_cat_image" id="child_sub_cat_image" class="form-control" title="Enter product image" placeholder="Add Catogery image">
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                     <input type="hidden" name="id" value="<?= $single->id ?>">
                     <input type="hidden" name="old_img" value="<?= $single->child_sub_cat_image ?>">
                 </div>
                 <div class="col-md-2">
                     <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/images/cate/').$single->child_sub_cat_image ?>" style="width:60px; height:60px;"class="mt-4 img-thumbnail">
                 </div>
             </div>
               
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($single->status == 1)?'selected':'' ?> > Active</option>
                     <option value="0" <?= ($single->status == 0)?'selected':'' ?> > Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/child-subcategory') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
