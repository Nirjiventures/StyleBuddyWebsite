<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Policy Update Form</li>
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
            <?php echo form_open('admin/update-policy',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Page<span class="text-danger">*</span></label>
                         <select name="page_name"  class="form-control">
                             <option value="">---- Choose Page  ----</option>
                             <option value="Privacy-Policy" <?= ($datas->page_name == 'Privacy-Policy')? 'selected = selected':''  ?> >Privacy Policy</option>
                             <option value="Terms-Conditions" <?= ($datas->page_name == 'Terms-Conditions')? 'selected = selected':''  ?> >Terms & Conditions</option>
                         </select>
                           <input type="hidden" name="id" value="<?= $datas->id ?>">
                       <?php echo form_error('page_name','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
            
            </div>
            <div class="form-group row">
                 <div class="col-sm-12">
                       <label for="Image Alt Description" class=" col-form-label">Page Content<span class="text-danger">*</span></label>
                        <textarea id="editor" name="policy_content" rows="2" class="form-control"><?= $datas->policy_content ?></textarea>
                       <?php echo form_error('policy_content','<span class="text-danger mt-1">','</span>') ;?>
                        <script>
                         CKEDITOR.replace( 'editor' );
                        </script>
                 </div>
            </div>   
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
            <!--  <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Title</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <input type="text" class="form-control" placeholder="Enter Title" name="metaTitle" value="<?= $datas->metaTitle ?>">                    -->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Tag</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <input type="text" class="form-control" placeholder="Enter Meta Tag" name="metaTag" value="<?= $datas->metaTag ?>">                    -->
            <!--    </div>-->
            <!--</div>-->
            
            <!-- <div class="form-group row">-->
            <!--   <label for="" class="col-sm-2 col-form-label">Meta Description</label>-->
            <!--   <div class="col-sm-10">-->
            <!--        <textarea class="form-control" name="metaDescription" rows="2" placeholder="Enter Meta Description"><?= $datas->metaDescription ?></textarea>-->
            <!--    </div>-->
            <!--</div>-->
            
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
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/policy') ;?>" class="btn btn-primary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
