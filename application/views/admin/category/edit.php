<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category Update Form</li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-1 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
             <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/update-category',['id'=>'catfrmm']);?>
            <div class=" row">

                     <div class="col-sm-12">
                        <label for="Image Alt Description" class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name',$datas->name); ?>">
                        <span id="categoryErr"></span>
                        <input type="hidden" name="id" value="<?= $datas->id?>">
                        
                        <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                  

                  
                     
                   
                  <div class="col-sm-12">
                     <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                    
                        <select class="form-control" name="status" id="status">
                           <option value="">---- Choose a Status ----</option>
                           <option value="1" <?= ($datas->status == 1) ?  "selected = 'selected'" : ''; ?> > Active</option>
                           <option value="0" <?= ($datas->status == 0) ?  "selected = 'selected'" : ''; ?> > Inctive</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                     
                  </div>

                  <div class="col-sm-12">
                  
                        <label class="control-label">Category UI Order</label>
                        <input name="ui_order" maxlength="2" type="text" value="<?php if(set_value('ui_order')) { echo set_value('ui_order');}else { echo (!empty($datas->ui_order))?$datas->ui_order:''; } ?>" class="form-control neo" placeholder="Enter Category Order">
                        <?php echo form_error('ui_order') ? '<span class="error">'.form_error('ui_order').'</span>' : ''?>
                  </div>
                  <div class="col-sm-12">
                     <label class="control-label">Parent Category </label>
                   
                     <select class="form-control"  id="parent_id" name="parent_id">
                        <option value="">--Select Category--</option>
                        <?php  foreach($catAll as $k=>$v){  if($v['id']==$datas->parent_id){$sel = 'selected';}else{$sel = '';}?>

                           <?php  if($v['id']!=$datas->id){ ?>
                              <option value="<?=$v['id']?>" <?= $sel?>> <?=$v['name']?> </option>
                              <?php foreach($v['child'] as $v1){ ?><?php if($v1['id']==$datas->parent_id){$sel = 'selected';}else{$sel = '';}?>
                           <?php  if($v1['id']!=$datas->id){ ?>
                                 <option value="<?=$v1['id']?>" <?= $sel?>>- <?=$v1['name']?> </option>
                                 <?php foreach($v1['child'] as $v2){ ?><?php if($v2['id']==$datas->parent_id){$sel = 'selected';}else{$sel = '';}?>
                                 <?php  if($v2['id']!=$datas->id){ ?>
                                       <option value="<?=$v2['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;-- <?=$v2['name']?> </option>
                                          <?php foreach($v2['child'] as $v3){ ?><?php if($v3['id']==$datas->parent_id){$sel = 'selected';}else{$sel = '';}?>
                                       <?php  if($v3['id']!=$datas->id){ ?>
                                          <option value="<?=$v3['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v3['name']?> </option>
                                             <?php foreach($v3['child'] as $v4){ ?><?php if($v4['id']==$datas->parent_id){$sel = 'selected';}else{$sel = '';}?>
                                             <option value="<?=$v4['id']?>" <?= $sel?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-- <?=$v4['name']?> </option>
                                          <?php } ?>
                                       <?php } ?>
                                    <?php } ?>
                                 <?php } ?>
                              <?php } ?>
                              <?php } ?>
                              <?php } ?>
                           <?php } ?>
                        <?php } ?>
                     </select>
                     <?php echo form_error('category') ? '<span class="error">'.form_error('category').'</span>' : ''?>
                  </div>
                   

                  <div class="col-sm-12">
                        <label class="control-label">Category Image *</label> 
                        <input type="file" name="cat_image" accept="image/x-png,image/gif,image/jpeg">
                        <?php if(!empty($datas->cat_image)) { ?><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  style="width: 220px;" class="image" src='<?php echo base_url().''.$datas->cat_image;?>'><?php } ?> 
                        <?php echo form_error('cat_image') ? '<span class="error">'.form_error('cat_image').'</span>' : ''?>
                  </div>
                  
                  <div class="col-md-12">
                        <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                        <textarea id="meta_title" name="meta_title" rows="2" class="form-control" placeholder="Meta Title"><?= $datas->meta_title ?></textarea>
                  </div>
                
                  <div class="col-md-12">
                        <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                        <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control" placeholder="Meta Keyword"><?= $datas->meta_keyword ?></textarea>
                  </div>
                
                  <div class="col-sm-12">
                     <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                     <textarea id="meta_description" name="meta_description" rows="3" class="form-control" placeholder="Meta Description"><?= $datas->meta_description ?></textarea>
                         
                  </div>
            </div>
  
            

            
            <div class="col-sm-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/category') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
