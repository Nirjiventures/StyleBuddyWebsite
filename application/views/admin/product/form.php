<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Product Form</li>
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
            <?php echo form_open_multipart('add-product',['id'=>'catfrmm']);?>
            <div class="form-row">
                     <div class="form-group col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Category <span class="text-danger">*</span></label>
                         <select name="cat_id" id="cat_id" class="form-control"  title="Select category" placeholder="Select category">
                             <option value="">---- Choose Category  ----</option>
                             <?php foreach($datas as $data) {?>
                                    <option value="<?= $data->id; ?>"><?= ucfirst($data->category); ?></option>
                             <?php }?>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('category','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
      
                     <div class="form-group col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">SubCategory <span class="text-danger">*</span></label>
                         <select name="subcat_id" id="subcat_id" class="form-control " title="Select subcategory" placeholder="Select subcategory">
                             <option value=''>---- Choose Subcategory  ----</option>
                         </select>
                           <span id="categoryErr"></span>
                       <?php echo form_error('subcategory','<span class="text-danger mt-1">','</span>');?>
                     </div>
            </div>
            
            <div class="form-row">
                
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label ">Product Name<span class="text-danger">*</span></label>
                         <input type="text" name="product_name" id="product_name" class="form-control" title="Enter product name" placeholder="Enter product name">
                         <?php echo form_error('product_name','<span class="text-danger mt-1">','</span>');?>
                    </div>
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label">Product Price<span class="text-danger">*</span></label>
                         <input type="number" name="product_price" id="product_price" class="form-control" title="Enter product price" placeholder="Enter product price">
                         <?php echo form_error('product_price','<span class="text-danger mt-1">','</span>');?>    
                    </div>
                    <div class="form-group col-md-4">
                         <label for="Image Alt Description" class=" col-form-label">Product Quantity<span class="text-danger">*</span></label>
                         <input type="number" name="product_qty" id="product_qty" class="form-control " min="1" title="Enter product quantity" placeholder="Enter product quantity">
                         <?php echo form_error('product_qty','<span class="text-danger mt-1">','</span>');?>
                    </div>
            </div>
            
            <div class="form-row mt-3 mb-3">
                  <div class="form-group col-md-6">
                      <i class="fa fa-cloud-upload fa-2x text-info" aria-hidden="true"></i>
                     <label for="Image Alt Description" class=" col-form-label">Product Image (Upload size Max 1 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="product_image" id="product_qty" class="form-control" title="Enter product image" placeholder="Enter product image" required>
                     <?php echo form_error('product_image','<span class="text-danger mt-1">','</span>');?>
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                  </div>
                  
                  <div class="form-group col-md-6">
                         <i class="fa fa-cloud-upload fa-2x text-info" aria-hidden="true"></i>
                       <label for="Image Alt Description" class=" col-form-label">Product Multiple Image<span class="text-danger">*</span></label>
                       <input type="file" name="product_galary_image[]" id="product_galary_image" class="form-control " multiple="multiple" title="Upload multiple images" placeholder="Upload multiple images" required>
                    
                  </div>
            </div>
            
                <div class="form-row mt-3 mb-3">
                    
                  <div class="form-group col-md-4">
                      <label>Product Size<span class="text-danger">*</span></label><br>
                        <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="S">S
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="M">M
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="L">L
                           </label>
                        </div>
                         <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" name="size[]" value="XL">XL
                           </label>
                        </div>
                          <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input " name="size[]" value="XXL">XXL
                           </label>
                        </div>
                          <?php echo form_error('size','<span class="text-danger mt-1">','</span>');?>
                </div>
                  <div class="form-group col-md-4">
                        <label for="Trending Product">Trending Product</label>
                            <select class="form-control" name="trending_product">
                                <option value="1">YES</option>
                                <option value="0" selected>NO</option>
                            </select>
                  </div>
                  <div class="form-group col-md-4">
                       <label for="Image Alt Description" class=" col-form-label">Product Video (Upload size Max 3 MB)</label>
                       <input type="file" name="product_video" id="product_video" class="form-control"  title="Product Videos" placeholder="Product Videos">
                    
                  </div>
            </div>
            
            
            <div class="form-row form-group">
                     <label for="Status" class="form-label">Product Short Description<span class="text-danger">*</span></label>
                    <textarea class="form-control " name="product_short_desc" id="product_short_desc" title="Enter product short description" placeholder="Enter product short description" ></textarea>
                    <?php echo form_error('product_short_desc','<span class="text-danger mt-1">','</span>');?>
            </div>
            
             <div class="form-row form-group">
                     <label for="Status" class="form-label">Product Description<span class="text-danger">*</span></label>
                    <textarea class="form-control " name="product_description" id="editor" rows="2"></textarea>
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
                     <option value="1" selected=""> Active</option>
                     <option value="0"> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('product') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
