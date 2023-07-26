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

                        <label for="name" class="col-form-label">Gift Name</label>

                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control">

                     </div>

                     <!-- <div class="col-sm-6">

                        <label for="name" class="col-form-label">Gift Code</label>

                        <?php if($this->uri->segment(3) == 'add'){ ?>

                           <input type="text" id="gift_code" name="gift_code" value="<?= $record_detail['gift_code'] ?>" class="form-control">

                        <?php }else{ ?>

                           <p value="<?= $record_detail['gift_code'] ?>" class="form-control"><?= $record_detail['gift_code'] ?></p>

                        <?php } ?>

                        <div id="gift_code_err"></div>

                     </div>

                     <div class="col-sm-6">

                        <?php if(!$record_detail['gift_code_limit']){ ?>

                              <label for="name" class="col-form-label">Gift Code Limit</label>

                              <input type="text" id="gift_code_limit" name="gift_code_limit" value="<?= $record_detail['gift_code_limit'] ?>" class="form-control onlyInteger">

                        <?php }else{ ?>

                              <label for="name" class="col-form-label">Gift Code Limit</label>

                              <p class="form-control onlyInteger"><?= $record_detail['gift_code_limit'] ?></p>

                        <?php } ?>

                     </div> -->

                     <div class="col-sm-6">

                        <label for="name" class="col-form-label">Gift Code Price</label>

                        <input type="text" id="gift_code_price" name="gift_code_price" value="<?= $record_detail['gift_code_price'] ?>" class="form-control onlyInteger">

                     </div>

                     <!-- <div class="col-sm-6">

                        <label for="name" class="col-form-label">Min Price</label>

                        <input type="text" id="min_price" name="min_price" value="<?= $record_detail['min_price'] ?>" class="form-control onlyInteger">

                     </div>

                     <div class="col-sm-6">

                        <label for="name" class="col-form-label">Max Price</label>

                        <input type="text" id="max_price" name="max_price" value="<?= $record_detail['max_price'] ?>" class="form-control onlyInteger">

                     </div> -->

                     <div class="col-sm-6">

                        <label for="name" class="col-form-label">Start Date</label>

                        <input type="date" id="start_date" name="start_date" value="<?= $record_detail['start_date'] ?>" class="form-control">

                     </div>

                     <div class="col-sm-6">

                        <label for="name" class="col-form-label">End Date</label>

                        <input type="date" id="end_date" name="end_date" value="<?= $record_detail['end_date'] ?>" class="form-control">

                     </div>

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
                     
                    <div class="col-md-12">
                         <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                         <textarea id="meta_title" name="meta_title" rows="2" class="form-control" placeholder="Meta Title"><?= $record_detail['meta_title'] ?></textarea>
                    </div>
                 
                    <div class="col-md-12">
                         <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                         <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control" placeholder="Meta Keyword"><?= $record_detail['meta_keyword'] ?></textarea>
                    </div>
                
                    <div class="col-sm-12">
                      <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                      <textarea id="meta_description" name="meta_description" rows="3" class="form-control" placeholder="Meta Description"><?= $record_detail['meta_description'] ?></textarea>
                          
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