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

                    

                     <div class="col-sm-12">

                        <label for="Image Alt Description" class=" col-form-label">Name</label>

                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control ">

                        <br/>

                     </div>

                      



                    
                     <div class="col-sm-12">
                        <label for="Image Alt Description" class=" col-form-label">Sub Title</label>
                        <input type="text" name="sub_title" value="<?= $record_detail['sub_title'] ?>" class="form-control" placeholder="sub title">
                        <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>
                     </div>

                  

                      
                          
                      <div class="col-sm-12 mt-5">

                           <input type="file" id="Gallery_Pic" title="Browse Images" accept=".jpg,.jpeg,.gif" name="image[]" multiple class="form-control box_in3">

                           <label class="form-control-placeholder2" for="Price">Media</label>

                           <input type="hidden" name="id" value="<?= $record_detail['id'] ?>">

                     </div>
                     <?php $media = $record_detail['image']; ?>   

                     <div class="col-sm-12">

                        <?php   if(!empty($media)){  ?> 

                            

                           <?php   $galleryes = explode(",", $media);  ?> 

                           <?php   $k = 0;foreach($galleryes as $gallery){ $k++; ?>

                              <?php   if(!empty($gallery)){  ?> 

                                 <span class="" id="<?=$k.'__gal_image_s'?>">

                                    <a class="cross_image" onclick="delete_image('<?=$k.'__gal_image_s'?>',<?= $record_detail['id'] ?>,'image','assets/images/stylist-category/','<?=$gallery?>','','<?=$url2?>')">X</a>

                                    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"   class="cross_img" src="<?=trim(base_url().'assets/images/stylist-category/'.$gallery);?>" alt="">

                                 </span>  

                              <?php   }   ?>

                           <?php   }   ?>

                        <?php   }   ?>

                         

                     </div>

                     <div class="col-sm-12">
                        <label for="Image Alt Description" class=" col-form-label">Description<span class="text-danger">*</span></label>
                        <textarea id="editor1" name="description" rows="2" class="form-control"><?= $record_detail['description'] ?></textarea>
                          <?php echo form_error('description','<span class="text-danger mt-1">','</span>') ;?>
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