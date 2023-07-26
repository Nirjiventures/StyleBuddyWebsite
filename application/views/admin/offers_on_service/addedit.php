<?php  $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-1 form-main">
          <div class="card  form-card">
            <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                 
                <div class="row">
                     <input type="hidden" name="id" value="<?= $record_detail['id']; ?>">
                     <div class="col-sm-6">
                        <label for="name" class="col-form-label">Offer Title</label>
                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control" placeholder="Offer Title">
                     </div>
                     <div class="col-sm-6">
                        <label for="name" class="col-form-label">Offer Sub Title</label>
                        <input type="text" id="sub_title" name="sub_title" value="<?= $record_detail['sub_title'] ?>" class="form-control" placeholder="Offer Sub Title">
                     </div>
                     <div class="col-sm-6">
                        <label class="control-label">Buy</label> 
                        <input type="text" class="form-control onlyInteger" name="buy" value ="<?php if(set_value('buy')) { echo set_value('buy');} else { echo (!empty($record_detail['buy']))?$record_detail['buy']:'';  } ?>" placeholder="Number of services to buy">
                        <?php echo form_error('buy') ? '<span class="error">'.form_error('buy').'</span>':''?>
                     </div>
                    
                     <div class="col-sm-6">
                           <label class="control-label">Discount(%)</label>
                           <input type="text" class="form-control onlyInteger" name="discount" value ="<?php if(set_value('discount')) { echo set_value('discount');} else { echo (!empty($record_detail['discount']))?$record_detail['discount']:'';  } ?>" placeholder="Discount">
                           <?php echo form_error('discount') ? '<span class="error">'.form_error('discount').'</span>' : ''?>
                     </div> 

                     <!-- <div class="col-sm-6">
                        <label for="name" class="col-form-label">Min Price</label>
                        <input type="text" id="min_price" name="min_price" value="<?= $record_detail['min_price'] ?>" class="form-control onlyInteger">
                     </div>
                       -->
                      
                     <br/>
                     
                     <div class="col-sm-8">
                        <label for="Image Alt Description" class=" col-form-label">Description<span class="text-danger">*</span></label>
                        <textarea id="package_description_1" name="description" rows="2" class="form-control"><?= $record_detail['description'] ?></textarea>
                        <script> 
                           CKEDITOR.replace( 'package_description_1',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
                                },]} ); 
                        </script>

                        <?php echo form_error('content','<span class="text-danger mt-1">','</span>') ;?>
                                
                     </div>
                     <div class="col-sm-4">
                           <label class="col-form-label" for="Price">Media</label>
                           <input type="file" id="Gallery_Pic" title="Browse Images" accept=".jpg,.jpeg,.gif" name="media[]" multiple class="form-control box_in3">
                           <input type="hidden" name="id" value="<?= $record_detail['id'] ?>">

                           <?php $media = $record_detail['media']; ?>   
                           <div class="">
                              <?php   if(!empty($media)){  ?> 
                                 <?php   $galleryes = explode(",", $media);  ?> 
                                 <?php   $k = 0;foreach($galleryes as $gallery){ $k++; ?>
                                    <?php   if(!empty($gallery)){  ?> 
                                       <span class="" id="<?=$k.'__gal_image_s'?>">
                                          <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  style="width: 100%;"  class="img-responsive" src="<?=trim(base_url().$gallery);?>" alt="">
                                       </span>  
                                    <?php   }   ?>
                                 <?php   }   ?>
                              <?php   }   ?>
                               
                           </div>
                     </div>

                     
                     <div class="col-sm-12 text-center submitDiv" >
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
                     </div>
                  </div>
               </div>
               
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>
<script type="text/javascript">
      $('.onlyInteger').on('keypress', function(e) {

         keys = ['0','1','2','3','4','5','6','7','8','9','.']

         return keys.indexOf(event.key) > -1

      })
      
</script>
<script type="text/javascript">
   function delete_image(display,id,column,path,img,table,controller) {
      let text = "Do you want to delete this";
      if (confirm(text) == true) {
         $.ajax({
            type: 'GET',
            url: '<?=base_url()?>admin/'+controller+'/deleteImages',   
            data: {'id':id,'img':img,'column':column,'path':path,'table':table},
            success: function(response){
               console.log(response);
               $('#reviewMesage').html(response);
               $('#reviewMesage').show().delay('10000').fadeOut();
               $("#"+display).hide();

            }
         });

      } else {
         text = "You canceled!";
      }
   }
   $(document).on("blur","#gift_code",function() {
         var checkEmail = $(this).val();
         
         $.ajax({
             type: 'POST',
             url: '<?php echo base_url(); ?>admin/gift/giftcodecheck',
             data: 'checkEmail='+checkEmail,
             success: function(data) {
               if(data == 1) {
                  $('#gift_code_err').html('<span class="text-primary">your gift code is exist</span>');
                  $('#gift_code').focus();
                  $('.submitDiv').css('display','none');

                  return false; 
               } else {
                  $('#gift_code_err').html(' '); 
                  $('.submitDiv').css('display','block');
               }
            }
         });    
        
    });

</script>