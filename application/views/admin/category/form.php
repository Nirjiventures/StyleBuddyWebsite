<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category  Form</li>
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
             <?php  if(!empty($record_detail)) { $record_detail=$record_detail;} else { $record_detail=array(); } ?>
              

            <?php echo form_open_multipart('admin/add-category',['id'=>'catfrmm']);?>
               <div class="row">
                   
                  <div class="col-md-12">
                     <label class="field_title" for="title">Main Category<span class="req">*</span></label>
                     <div class="form_input">
                        <select class="form-control" id="main_cat_id">
                           <option value="">--select--</option>
                           <option value="addnew">Addnew</option>
                           <?php  foreach($maincategory as $row) {?>
                              <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                           <?php } ?>
                        </select>
                     </div>
                  </div>
                  
                  <div id="level1_sub_cat_result" style="display:none;width: 100%;">

                     <div class="col-md-12">

                        <label class="field_title" for="title">Sub Category<span class="req">*</span></label>

                        <div class="form_input">

                           <select class="form-control" id="level1_sub_cat">

                              <option value="">--select--</option>
                           </select>

                        </div>

                     </div>

                  </div>

                  

                  <div id="level2_sub_cat_result" style="display:none;width: 100%;">

                     <div class="col-md-12">

                        <label class="field_title" for="title">Sub Category<span class="req">*</span></label>

                        <div class="form_input">

                           <select class="form-control" id="level2_sub_cat">

                           <option value="">--select--</option>

                           

                           </select>

                        </div>

                     </div>

                  </div>

                  <div id="level3_sub_cat_result" style="display:none;width: 100%;">

                     <div class="col-md-12">

                        <label class="field_title" for="title">Sub Category<span class="req">*</span></label>

                        <div class="form_input">

                           <select class="form-control" id="level3_sub_cat">

                           <option value="">--select--</option>

                           

                           </select>

                        </div>

                     </div>

                  </div>

                  <div style="display:none;width: 100%;" id="addnew">

                     <div class="col-md-12">
                        <div class="field_title"><label class="control-label">Title *</label></div>
                        <div class="form_input">
                           <input name="name" maxlength="50" type="text" value="<?php if(set_value('name')) { echo set_value('name');}else { echo (!empty($record_detail->name))?$record_detail->name:''; } ?>" required="required" class="form-control neo" placeholder="Enter Title">
                           <?php echo form_error('title') ? '<span class="error">'.form_error('title').'</span>' : ''?>
                        </div>
                     </div>
                     
                     <div class="col-md-12">
                        <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" id="status">
                        <option value="">---- Choose a Status ----</option>
                        <option value="1" selected=""> Active</option>
                        <option value="0"> Inctive</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                     <div class="col-sm-12">
                        <label class="control-label">Category UI Order</label>
                        <input name="ui_order" maxlength="2" type="text" value="<?php if(set_value('ui_order')) { echo set_value('ui_order');} ?>" class="form-control neo" placeholder="Enter Category Order">
                        <?php echo form_error('ui_order') ? '<span class="error">'.form_error('ui_order').'</span>' : ''?>
                  </div>
                   <div class="col-md-12" id="menu_typeDiv">
                        <label for="Status" class="form-label">Menu Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="menu_type" id="menu_type">
                        <option value="">---- Choose Menu ----</option>
                        <option value="1"> Mega Menu</option>
                        <option value="2"> Drop Down</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                     
                     <div class="col-sm-12">
                        <label class="control-label">Category Image *</label> 
                        <input type="file" name="cat_image" accept="image/x-png,image/gif,image/jpeg">
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
                  <div class="ln_solid"></div>
                  <br/>
                  <div class="col-md-12">
                     <br/>
                     <div class="stick">
                        <input type="hidden" name="parent_id" id="cat_id"/>
                        <button type="submit" class="btn btn-success mt-4">Submit</button>
                        <a href="<?php echo base_url('admin/category') ;?>" class="btn btn-secondary  mt-4">Go Back</a>
                     </div>
                  </div>
               </div>
                
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<script>

$(document).ready(function() {
   $("#main_cat_id").change(function() {  
         if($(this).val()=='addnew'){
            $("#addnew").css('display','block');
            $("#menu_typeDiv").css('display','block');
            $("#cat_id").val("0");
            $('#commissiondiv').css('display','none');
            $("#level2_sub_cat_result").css("display", "none");
            $("#level1_sub_cat_result").css("display", "none");
            $("#level3_sub_cat_result").css("display", "none");
         }else{
            $("#cat_id").val($(this).val());
            $('#menu_typeDiv').css('display','none');
            $('#commissiondiv').css('display','none');
            $("#addnew").css('display','none');
            $("#level1_sub_cat_result").css("display", "none");
            $("#level2_sub_cat_result").css("display", "none");
            $(this).after('<div id="loader1" style="display:none"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/loading.gif" alt="loading subcategory" /></div>');
            $("#level1_sub_cat_loading").css("display", "block");
            $.get('<?=base_url()?>admin/dashboard/fetch?main_cat_id=' + $(this).val(), function(data) {
               console.log(data);
               if(data == 'Nocat') {
                  $("#level1_sub_cat_loading").css("display", "none");
               } else {
                  $("#level1_sub_cat_loading").css("display", "none");
                  $("#level1_sub_cat_result").css("display", "block");
                  $("#level1_sub_cat").html(data);
                  $('#loader').slideUp(200, function() {
                     $(this).remove();
                  });
               }
            });   
         }
   });
   $("#level1_sub_cat").change(function() {
        if($(this).val()=='addnew'){
         $("#addnew").css('display','block');
         $('#commissiondiv').css('display','none');
         $("#level2_sub_cat_result").css("display", "none");
         $("#level3_sub_cat_result").css("display", "none");
      }else{
         $('#commissiondiv').css('display','none');
         $("#level2_sub_cat_result").css("display", "none");
         $("#addnew").css('display','none');
         $("#cat_id").val($(this).val());
         $(this).after('<div id="loader1" style="display:none"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/loading.gif" alt="loading subcategory" /></div>');
         $("#level2_sub_cat_loading").css("display", "block");
         $.get('<?=base_url()?>admin/dashboard/fetch?main_cat_id=' + $(this).val(), function(data) {
            if(data == 'Nocat') {
                  $("#level2_sub_cat_loading").css("display", "none");
               } else {
                  $("#level2_sub_cat_loading").css("display", "none");
                  $("#level2_sub_cat_result").css("display", "block");
                  $("#level2_sub_cat").html(data);
                  $('#loader').slideUp(200, function() {
                     $(this).remove();
                  });
               }
         });   
      }
    });
   $("#level2_sub_cat").change(function() {  
      if($(this).val()=='addnew'){
         $("#addnew").css('display','block');
         $('#commissiondiv').css('display','none');
         $("#level1_sub_cat_result").css("display", "none");
         $("#level3_sub_cat_result").css("display", "none");
      }else{
         $('#commissiondiv').css('display','none');
         $("#addnew").css('display','none');
         $("#cat_id").val($(this).val());
         $(this).after('<div id="loader1" style="display:none"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/loading.gif" alt="loading subcategory" /></div>');
         $("#level2_sub_cat_loading").css("display", "block");
         $.get('<?=base_url()?>admin/dashboard/fetch?main_cat_id=' + $(this).val(), function(data) {
            if(data == 'Nocat') {
                  $("#level3_sub_cat_loading").css("display", "none");
               } else {
                  $("#level3_sub_cat_loading").css("display", "none");
                  $("#level3_sub_cat_result").css("display", "block");
                  $("#level3_sub_cat").html(data);
                  $('#loader').slideUp(200, function() {
                     $(this).remove();
                  });
               }
         });   
      }
   });
   $("#level3_sub_cat").change(function() {  
         if($(this).val()=='addnew'){
            $("#addnew").css('display','block');
            $('#commissiondiv').css('display','none');
         }
   });
});

</script>
