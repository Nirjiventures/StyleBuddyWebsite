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

             
            <?= form_open_multipart('',['id'=>'sliderfrmm','name'=>'sliderfrmm','method'=>'post']) ?>
                 

                <div class="row">

                     <input type="hidden" name="id" value="<?= $record_detail['id']; ?>">

                     <div class="col-sm-6">

                        <label for="name" class="col-form-label">Referral Name</label>

                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control" required>

                     </div>

                     <div class="col-sm-6">


                        <label for="name" class="col-form-label">Referral Code</label>

                        <?php if($this->uri->segment(3) == 'add'){ ?>

                           <input type="text" id="referral_code" name="referral_code" value="<?= $record_detail['referral_code'] ?>" class="form-control" required>

                        <?php }else{ ?>

                           <p value="<?= $record_detail['referral_code'] ?>" class="form-control"><?= $record_detail['referral_code'] ?></p>

                        <?php } ?>

                        <div id="referral_code_err"></div>

                     </div>

                       

                      
                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Description<span class="text-danger">*</span></label>

                        <textarea id="package_description_1" name="description" rows="2" class="form-control"><?= $record_detail['description'] ?></textarea>

                        <script> 

                           CKEDITOR.replace( 'package_description_1',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]

                                },]} ); 

                        </script>



                        <?php echo form_error('content','<span class="text-danger mt-1">','</span>') ;?>

                                

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

   $(document).on("blur","#referral_code",function() {
      var checkEmail = $(this).val();
      $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>admin/referral/referralCodeCheck',
          data: 'checkEmail='+checkEmail,
          success: function(data) {
            if(data == 1) {
               $('#referral_code_err').html('<span class="text-primary">your referall code is exist</span>');
               $('#referral_code').focus();
               $('.submitDiv').css('display','none');
               return false; 
            } else {
               $('#referral_code_err').html(' '); 
               $('.submitDiv').css('display','block');
            }
         }
      });    
   }); 
   /*
   function checkExistCode(checkEmail){
      $.ajax({
         type: 'POST',
         url: '<?php echo base_url(); ?>admin/referral/referralCodeCheck',
         data: 'checkEmail='+checkEmail,
         success: function(data) {
            console.log(data);
            if(data == 1) {
               return true; 
            }else{
               return false; 
            }
         }
      });
      
   }
   $('#sliderfrmm').on('submit',function(e) {
         e.preventDefault();
         $('#name_err').html('');
         $('#referral_code_err').html('');
         
         if($('#name').val() == '') {
             $('#name_err').html('<span class="text-red">Please enter your First Name</span>');
             $('#name').focus();
             return false;
         } else if($('#referral_code').val() == '') {
             $('#referral_code_err').html('<span class="text-red">Please enter Referral</span>');
             $('#referral_code').focus();
             return false;
         } else if(checkExistCode($('#referral_code').val())) {
             $('#referral_code_err').html('<span class="text-primary">your referall code is exist</span>');
             $('#referral_code').focus();
             return false; 
         } else{
            $('#sliderfrmm').submit();
            return true;
         }
   });
   */
</script>