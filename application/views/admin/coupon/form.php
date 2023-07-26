<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Coupon  Form</li>
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
            <?php echo form_open('admin/add-coupon',['id'=>'catfrmm']);?>
            <div class=" row">
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Coupon Code<span class="text-danger">*</span></label>
                         <input type="text" class="form-control" name="coupon_code" value="<?= set_value('coupon_code'); ?>"> 
                       <?php echo form_error('coupon_code','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                     
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Coupon Value(%)<span class="text-danger">*</span></label>
                         <input type="text" name="coupon_value" id="coupon_value" class="form-control" value="<?= set_value('coupon_value'); ?>">
                           <span id="categoryErr"></span>
                       <?php echo form_error('coupon_value','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
            </div>
              <div class=" row">
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">Start Date<span class="text-danger">*</span></label>
                         <input type="date" class="form-control" name="start_date" value="<?= set_value('start_date'); ?>"> 
                       <?php echo form_error('start_date','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
                     
                     <div class="col-sm-6">
                       <label for="Image Alt Description" class=" col-form-label">End  Date<span class="text-danger">*</span></label>
                         <input type="date" name="end_date" id="end_date" class="form-control" value="<?= set_value('end_date'); ?>">
                       <?php echo form_error('end_date','<span class="text-danger mt-1">','</span>') ;?>
                     </div>
            </div>
               
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
            
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
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/coupon') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
