<?php  $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item "> <a href="<?php echo base_url($url1.'/'.$url2);?>" class="text-decoration-none">Leads</a></li>
               <li class="breadcrumb-item active" aria-current="page"> View</li>
            </ol>                                              
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid p-0">
   <div class="row justify-content-center">
      <div class="col-md-11 mt-1 form-main">
         <div class="card  form-card">
             <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
               <div class="row">
                  <input type="hidden" name="id" value="<?= $record_detail->id; ?>">
                  <input type="hidden" name="date_id" value="<?= $record_detail->date_id; ?>">
                  <input type="hidden" name="stylist_id" value="<?= $record_detail->stylist_id; ?>">
                  
                  <div class="col-md-4 mbc">
                       <label for="Image Alt Description" class="form-label">First Name<span class="text-danger"></span></label>
                         <input type="text" name="fname" id="fname" class="form-control" value="<?= set_value('fname',$record_detail->fname ); ?>" placeholder="First Name">
                  </div>
                  <div class="col-md-4 mbc">
                       <label for="Image Alt Description" class="form-label">Last Name<span class="text-danger"></span></label>
                         <input type="text" name="lname" id="lname" class="form-control" value="<?= set_value('lname',$record_detail->lname ); ?>" placeholder="Last Name">
                  </div>
                  <div class="col-md-4 mbc">
                       <label for="Image Alt Description" class="form-label">Email<span class="text-danger"></span></label>
                         <input type="text" name="email" id="email" class="form-control" value="<?= set_value('email',$record_detail->email ); ?>" placeholder="Email">
                  </div>
                  <div class="col-md-4 mbc">
                       <label for="Image Alt Description" class="form-label">Mobile<span class="text-danger"></span></label>
                         <input type="text" name="mobile" id="mobile" class="form-control" value="<?= set_value('mobile',$record_detail->mobile ); ?>" placeholder="Mobile">
                  </div>
                  <div class="col-md-4 mbc">
                       <label for="Image Alt Description" class="form-label">City<span class="text-danger"></span></label>
                         <input type="text" name="city" id="city" class="form-control" value="<?= set_value('city',$record_detail->city ); ?>" placeholder="City">
                  </div>
                  <div class="col-md-4 mbc">
                     <label for="Image Alt Description" class="form-label">Service  <span class="text-danger"></span></label>
                     <select id="area_expertise" name="area_expertise" class="form-control" >
                        <?php foreach ($area_expertise as $key => $value) {  if($value['name'] == $record_detail->area_expertise){$sel='selected';}else{$sel='';}?>
                            <option value="<?=$value['name']?>" <?=$sel?>><?=$value['name']?></option>
                        <?php }?>
                     </select>
                  </div>

                  <div class="col-md-4 mbc">
                     <label for="Image Alt Description" class="form-label">lead source <span class="text-danger"></span></label>
                     <select id="source_from" name="source_from" class="form-control" >
                        <?php $source_from = array('Website','Whatsapp','Google','Social media','Referral','Others');?>
                        <?php foreach ($source_from as $key => $value) {  if($value == $record_detail->source_from){$sel='selected';}else{$sel='';}?>
                            <option value="<?=$value?>" <?=$sel?>><?=$value?></option>
                        <?php }?>
                     </select>
                  </div>

                  

                  <div class="col-md-4 mbc">
                        <label for="Image Alt Description" class="form-label">Stylist Name<span class="text-danger"></span></label>
                        <input type="text" name="stylist_name" id="stylist_name" class="form-control" value="<?= set_value('stylist_name',$record_detail->stylist_name ); ?>" placeholder="City">
                        <input type="hidden" name="stylist_id"  id="stylist_id" value="<?=$record_detail->stylist_id; ?>">
                  </div>
                  <div class="col-md-4 mbc">
                     <label for="Image Alt Description" class="form-label">Allocate To<span class="text-danger"></span></label>
                     <select id="allocated" name="allocated" class="form-control" >
                        <?php foreach ($venderList as $key => $value) {  ?>
                           <?php 
                              $allocated_id = $record_detail->allocated_id;
                              if(!$record_detail->allocated_id){$allocated_id=$record_detail->stylist_id;}
                           ?>
                           <?php if($value['id'] == $allocated_id){$sel='selected';}else{$sel='';}?>
                           <option value="<?=$value['id'].'===='.$value['fname'].' '.$value['lname']?>" <?=$sel?>><?=$value['fname'].' '.$value['lname']?></option>
                        <?php }?>
                     </select>
                  </div>

                  <div class="col-md-4 mbc">
                        <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                       
                           <select class="form-control" name="status" id="status">
                              <option value="">---- Choose a Status ----</option>

                              <?php $source_from = array('0'=>'Not Contacted','1'=>'Contacted lead','2'=>'Lead Interested','3'=>'Lead Converted','4'=>'Junk Lead','5'=>'Lead not Interested','6'=>'Cancelled');?>
                              <?php foreach ($source_from as $key => $value) {  if($key == $record_detail->status){$sel='selected';}else{$sel='';}?>
                                  <option value="<?=$key?>" <?=$sel?>><?=$value?></option>
                              <?php }?>
                           </select>
                           <span id="statusErr"></span>
                           <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                        
                  </div>

                  <div class="col-sm-12">
                     <label for="Image Alt Description" class=" col-form-label">Booked details </label>
                     <textarea id="editor" name="message" rows="2" class="form-control"><?= $record_detail->message ?></textarea>
                     <?php echo form_error('message','<span class="text-danger mt-1">','</span>') ;?>
                     <script> CKEDITOR.replace( 'editor',{'height':150} ); </script>
                  </div>


                  <div class="col-md-12"> <br/> </div>
               </div>
               
               <div class="col-md-12 text-center">
                  <div class="form-group">
                     <label for="" class="col-form-label"></label>
                     <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
                     <a href="<?php echo base_url($url1.'/'.$url2) ;?>" class="btn btn-secondary mt-4">Go Back</a>
                  </div>
               </div>

            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    
   $(function() {
      $( "#city" ).autocomplete({
         minLength: 2,
         source: "<?=base_url('page/cities')?>",
         select: function( event, ui ) {
            event.preventDefault();
            console.log(ui.item);
            $("#city").val((ui.item.value));
            //$('#FormStylist').attr('action','<?=base_url('stylist-and-expert/'.$this->uri->segment(2).'/')?>'+ui.item.id);
         }
      });
    });

     $(function() {
      $( "#stylist_name" ).autocomplete({
         minLength: 2,
         source: "<?=base_url('admin/leads/venders')?>",
         select: function( event, ui ) {
            event.preventDefault();
            console.log(ui.item);
            $("#stylist_name").val((ui.item.value));
            $("#stylist_id").val((ui.item.id));
         }
      });
    });

</script>