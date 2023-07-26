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

                     <div class="col-sm-4">

                        <label for="name" class="col-form-label">Name</label>

                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control">

                     </div>

                       

                     <div class="col-sm-4">

                        <label for="name" class="col-form-label">On Page</label>

                        <select class="form-control" id="on_page" name="on_page">

                            <option value="Home" <?php echo (strtolower($record_detail['on_page']) == 'home')?'selected':'' ?>>Home Page</option>

                            <option value="other" <?php echo (strtolower($record_detail['on_page']) == 'other')?'selected':'' ?>>Other Page</option>

                        </select>

                         

                    </div>

                     

                    <div class="col-sm-4" >

                        <label for="name" class="col-form-label">Video Type</label>

                        <select class="form-control" id="video_type" name="video_type" onchange="videoT(this.value)">

                            <option value="youtube" <?php echo (strtolower($record_detail['video_type']) == 'youtube')?'selected':'' ?>>YouTube</option>

                            <!-- <option value="other" <?php echo (strtolower($record_detail['video_type']) == 'other')?'selected':'' ?>>Local</option> -->

                        </select>

                    </div>

                    

                     <div class="col-sm-4" id="localMedia" style="display:none">

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

                                      <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  style="width: 100%;"  class="img-responsive" src="<?=trim(base_url().''.$gallery);?>" alt="">

                                   </span>  

                                <?php   }   ?>

                             <?php   }   ?>

                          <?php   }   ?>

                           

                       </div>

                    </div> 

                

                    <div class="col-sm-6"  id="youtubeMedia">

                       <label class="col-form-label" for="Price">Youtube  Video ID</label>

                       <input type="text" id="youtube_url" name="youtube_url" value="<?= $record_detail['youtube_url'] ?>" placeholder="youtube video ID" class="form-control">

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



<?php //if(strtolower($record_detail['video_type']) != 'youtube'){ ?>

    <script>

        /*$('#localMedia').css('display','block');

        $('#youtubeMedia').css('display','none'); */

    </script>

<?php  // } else{  ?>

    <script>

       /* $('#localMedia').css('display','none');

        $('#youtubeMedia').css('display','block');*/

    </script>

<?php   //}   ?>

<?php  $this->load->view('admin/template/footer'); ?>

<script type="text/javascript">

      $('.onlyInteger').on('keypress', function(e) {



         keys = ['0','1','2','3','4','5','6','7','8','9','.']



         return keys.indexOf(event.key) > -1



      })

      

</script>

<script type="text/javascript">

    function videoT(val){

        /*if(val == 'youtube'){

           $('#localMedia').css('display','none');

           $('#youtubeMedia').css('display','block');

        }else{

           $('#localMedia').css('display','block');

           $('#youtubeMedia').css('display','none'); 

        } */

    }

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

    



</script>