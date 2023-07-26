<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Subcategory Update Form</li>
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
            <?php echo form_open('update-subcategory',['id'=>'subcatfrmm']);?>
                <div class=" row">
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Category <span class="text-danger">*</span></label>
                         <select name="category" id="category" class="form-control">
                             <?php foreach($datas as $data) {?>
                                    <option value="<?= $data->id; ?>" <?php if($single->category === $data->id) {echo "selected = 'selected'";}  ?> ><?= $data->category; ?></option>
                             <?php }?>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('category','<span class="text-danger mt-1">','</span>') ;?>
                       <input type="hidden" name="id" value="<?= $single->id ?>">
                       <input type="hidden" name="old_img" value="<?= $single->sub_cat_image ?>" >
                     </div>
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">SubCategory <span class="text-danger">*</span></label>
                         <input type="text" name="subcategory" id="subcategory" class="form-control" value="<?= set_value('subcategory',$single->subcategory); ?>">
                           <span id="categoryErr"></span>
                       <?php echo form_error('subcategory','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                </div>     
                <div class="row">
                     <div class="col-md-5">
                        <label for="Image Alt Description" class="form-label">Sub Menu<span class="text-danger">*</span></label>
                         <select class="form-control" name="is_child" id="is_child">
                         <option value="">---- Choose a Sub Menu ----</option>
                         <option value="1" <?= ($single->is_child == 1)?'selected':'' ?> >Yes</option>
                         <option value="0" <?= ($single->is_child == 0)?'selected':'' ?> >No</option>
                        </select>
                          <span class="badge badge-secondary">If you want to add Sub menu,select yes, otherwise select no.</span>
                           <span id="categoryErr"></span>
                        <?php echo form_error('is_child','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                    <div class="col-md-5">
                       <i class="fa fa-cloud-upload fa-2x text-primary" aria-hidden="true"></i>
                     <label for="Image Alt Description" class=" col-form-label">Catogery Image (Upload size Max 1 MB)</label>
                     <input type="file" name="sub_cat_image" id="sub_cat_image" class="form-control" title="Enter product image" placeholder="Add Catogery image">
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                   </div>
                   <div class="col-md-2">
                       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/images/cate/').$single->sub_cat_image ?>" style="width:60px; height:60px;"class="img-thumbnail mt-3">
                   </div>
               </div> 
            
               
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($single->status == 1) ?  "selected = 'selected'" : ''; ?> > Active</option>
                     <option value="0" <?= ($single->status == 0) ?  "selected = 'selected'" : ''; ?> > Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('subcategory') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
