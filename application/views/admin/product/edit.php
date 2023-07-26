<?php //echo "<pre>"; //print_r($rowFetch);?>

<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Product Update Form</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-5 form-main">
         <div class="card  form-card  shadow-lg mb-5">
            <div id="success_message"></div>
             <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('update-product',['id'=>'catfrmm']);?>
            <div class="form-row">
                     <div class="form-group col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Category <span class="text-danger">*</span></label>
                         <select name="cat_id" id="cat_id" class="form-control"  title="Select category" placeholder="Select category">
                             <!--<option value="">---- Choose Category  ----</option>-->
                             <?php foreach($datas as $data) {?>
                    <option value="<?= $data->id; ?>" <?php if($rowFetch->cat_id == $data->id){ echo  "selected = 'selected'";} ?> ><?= ucfirst($data->category); ?></option>
                                        
                                    
                             <?php }?>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('category','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                                        <input type="hidden" name="id" value="<?= $rowFetch->id ?>">
                                        <input type="hidden" name="old_img" value="<?= $rowFetch->product_image ?>">
                                        <input type="hidden" name="old_video" value="<?= $rowFetch->product_video ?>">
                     <div class="form-group col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">SubCategory <span class="text-danger">*</span></label>
                         <select name="subcat_id" id="subcat_id" class="form-control " title="Select subcategory" placeholder="Select subcategory">
                             <!--<option value=''>---- Choose Subcategory  ----</option>-->
                             <?php if(!empty($subcat)) {  foreach($subcat as $subCat) { ?>
                        <option value="<?= $subCat->id; ?>" <?php if($rowFetch->subcat_id == $subCat->id){ echo  "selected = 'selected'";} ?> ><?= ucfirst($subCat->subcategory); ?></option>

                             <?php } }?>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('subcategory','<span class="text-danger mt-1">','</span>');?>
                     </div>
            </div>
            
            <div class="form-row">
                
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label ">Product Name<span class="text-danger">*</span></label>
                         <input type="text" name="product_name" id="product_name" class="form-control" title="Enter product name" value="<?= set_value('product_name',$rowFetch->product_name)?>" placeholder="Enter product name">
                         <?php echo form_error('product_name','<span class="text-danger mt-1">','</span>');?>
                    </div>
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label">Product Price<span class="text-danger">*</span></label>
                         <input type="number" name="product_price" id="product_price" class="form-control" title="Enter product price" value="<?= set_value('product_price',$rowFetch->product_price)?>"  placeholder="Enter product price">
                         <?php echo form_error('product_price','<span class="text-danger mt-1">','</span>');?>    
                    </div>
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label">Product Quantity<span class="text-danger">*</span></label>
                         <input type="number" name="product_qty" id="product_qty" class="form-control " min="1" title="Enter product quantity" value="<?= set_value('product_qty',$rowFetch->product_qty)?>"  placeholder="Enter product quantity">
                         <?php echo form_error('product_qty','<span class="text-danger mt-1">','</span>');?>
                    </div>
            </div>
            
            <div class="form-row mt-3 mb-3">
                  <div class="form-group col-md-6">
                      <i class="fa fa-cloud-upload fa-2x text-info" aria-hidden="true"></i>
                     <label for="Image Alt Description" class=" col-form-label">Product Image</label>
                     <input type="file" name="product_image" id="product_image" class="form-control" title="Enter product image" placeholder="Enter product image">
                     <?php echo form_error('product_image','<span class="text-danger mt-1">','</span>');?>
                  </div>
                  
                  <div class="form-group col-md-6">
                            <div class="" style="margin: 33px 0 0 30px;">
                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('upload/assets/image/').$rowFetch->product_image?>" class="img-fluid" style="width:50px; height:50px;">     
                            </div>
                  </div>
            </div>
                        <?php $size = $rowFetch->size;  $sizeval = explode(',',$size); ?>
               <div class="form-row mt-3 mb-3">
                  <div class="form-group col-md-4">
                      <label>Product Size<span class="text-danger">*</span></label><br>
                        <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="S" <?php echo (in_array('S',$sizeval))? 'checked': '' ?> >S
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="M" <?php echo (in_array('M',$sizeval))? 'checked': '' ?> >M
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="L" <?php echo (in_array('L',$sizeval))? 'checked': '' ?> >L
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="XL" <?php echo (in_array('XL',$sizeval))? 'checked': '' ?> >XL
                           </label>
                        </div>
                          <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="XXL" <?php echo (in_array('XXL',$sizeval))? 'checked': '' ?> >XXL
                           </label>
                        </div>
                          <?php echo form_error('size','<span class="text-danger mt-1">','</span>');?>
                </div>
                   <div class="form-group col-md-4">
                        <label for="Trending Product">Trending Product</label><br>
                            <select class="form-control" name="trending_product">
                                <option value="1" <?= ($rowFetch->trending_product == 1)? "selected = 'selected' ":"" ?> >YES</option>
                                <option value="0" <?= ($rowFetch->trending_product == 0)? "selected = 'selected' ":"" ?> >NO</option>
                            </select>
                  </div>
                  
                  <div class="form-group col-md-4">
                         <i class="fa fa-cloud-upload fa-2x text-info" aria-hidden="true"></i>
                       <label for="Image Alt Description" class=" col-form-label">Product Video</label>
                       <input type="file" name="product_video" id="product_video" class="form-control "  title="Product Videos" placeholder="Product Videos">
                        <span><?= $rowFetch->product_video ?></span>
                  </div>
            </div>
            
            
            <div class="form-row form-group">
                     <label for="Status" class="form-label">Product Short Description<span class="text-danger">*</span></label>
                    <textarea class="form-control " name="product_short_desc" id="product_short_desc" title="Enter product short description" placeholder="Enter product short description" ><?= set_value('product_short_desc',$rowFetch->product_short_desc)?></textarea>
                    <?php echo form_error('product_short_desc','<span class="text-danger mt-1">','</span>');?>
            </div>
            
             <div class="form-row form-group">
                     <label for="Status" class="form-label">Product Description<span class="text-danger">*</span></label>
                    <textarea class="form-control " name="product_description" id="editor" rows="2"><?= set_value('product_description',$rowFetch->product_description)?></textarea>
                    <?php echo form_error('product_description','<span class="text-danger mt-1">','</span>');?>
                    <script>
                         CKEDITOR.replace( 'editor' );
                    </script>
            </div>
               
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control " name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($rowFetch->status == 1)? "selected = 'selected' ":"" ?>> Active</option>
                     <option value="0" <?= ($rowFetch->status == 0)? "selected = 'selected' ":"" ?> > Inactive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('product') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
