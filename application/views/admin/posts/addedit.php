<?php  $this->load->view('admin/template/header'); ?>

<style type="text/css">

   .cross_img {

       width: 76px;

       height: 76px;

       margin-top: 8px;

   }

   .cross_image {

       margin-top: 8px;

       position: absolute;

       border: 1px solid #FFF;

       width: 25px;

       text-align: center;

       border-radius: 100px;

       height: 25px;

       line-height: 25px;

       font-weight: bold;

       background: #333333bf;

       color: #FFFF;

   }

   .chosen-container-multi .chosen-choices{

      background: none!important;

   }

</style>

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

                    

                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Post Title</label>

                        <input type="text" id="title" name="title" value="<?= $record_detail['title'] ?>" class="form-control ">

                     </div>

                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Post Type</label>

                        <select name="post_type" class="form-control ">

                           <option value="">Select</option>

                           <?php foreach ($posts_type as $key => $value): ?>

                           <?php if ($value['slug'] == $record_detail['post_type']){$sel="selected";}else{$sel='';} ?>

                              <option value="<?=$value['slug']?>" <?=$sel?>><?=$value['name']?></option>

                           <?php endforeach ?>

                        </select>

                     </div>

                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Post Category</label>

                        <select name="post_category" class="form-control ">

                           <option value="">Select</option>

                           <?php foreach ($posts_category as $key => $value): ?>

                           <?php if ($value['slug'] == $record_detail['post_category']){$sel="selected";}else{$sel='';} ?>

                              <option value="<?=$value['slug']?>" <?=$sel?>><?=$value['name']?></option>

                           <?php endforeach ?>

                        </select>

                     </div>

                      

                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Post Description</label>

                        <textarea required id="description" name="description" rows="2" class="form-control"><?= $record_detail['description'] ?></textarea>

                        <?php echo form_error('description','<span class="text-danger mt-1">','</span>') ;?>

                        <script> 

                           CKEDITOR.replace( 'description',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]

                                },]} ); 

                        </script>

                     </div>



                     <div class="col-sm-12">
                        <div class="form-group boot_sp mt-3">
                               <input type="file" id="Gallery_Pic" title="Browse Images" accept=".jpg,.jpeg,.gif" name="media[]" multiple class="form-control box_in3">
    
                               <label class="form-control-placeholder2" for="Price">Media</label>
    
                               <input type="hidden" name="id" value="<?= $record_detail['id'] ?>">
    
                             </div>
                     </div>

                     <?php $media = $record_detail['media']; ?>   

                     <div class="col-sm-12">

                        <?php   if(!empty($media)){  ?> 

                           <?php   if(!empty($record_detail['media_type'])){  ?> 
                                <div class="col-sm-4">
                               <!-- <video class="video-col-1 hiddenControls">-->
                                <video class="video-col-1" style="width:100%" controls>
                                  <source src="<?=trim(base_url().'assets/images/posts/'.$media);?>" type="video/mp4">
                                </div>
                              </video>

                           <?php   }else{   ?>

                              <?php   $galleryes = explode(",", $media);  ?> 

                              <?php   $k = 0;foreach($galleryes as $gallery){ $k++; ?>

                                 <?php   if(!empty($gallery)){  ?> 

                                    <span class="" id="<?=$k.'__gal_image_s'?>">

                                       <a class="cross_image" onclick="delete_image('<?=$k.'__gal_image_s'?>',<?= $record_detail['id'] ?>,'media','assets/images/posts/','<?=$gallery?>','posts','posts')">X</a>

                                       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"   class="cross_img" src="<?=trim(base_url().'assets/images/posts/'.$gallery);?>" alt="">

                                    </span>  

                                 <?php   }   ?>

                              <?php   }   ?>

                           <?php   }   ?>

                        <?php   }   ?>

                        

                     </div>





                     <div class="col-sm-12 text-center">

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

</script>