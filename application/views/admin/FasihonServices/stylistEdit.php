<?php  $this->load->view('admin/template/header'); ?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"> Stylist Expertise / Interests Update Form</li>
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
             <?php echo form_open_multipart('admin/update-stylist-expertise-interests',['id'=>'sliderfrmm']);?>
            
            <div class="row">
               <div class="col-md-4">
                    <label for="Image Alt Description" class="form-label">Expertise / Interests Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name',$datas->name ); ?>" placeholder="Expertise / Interests Service Name">
                    <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
                    <input type="hidden" name="id" value="<?= $datas->id; ?>">
               </div>
               


               <div class="col-md-4">
                  <div class="row m-0">
                     <div class="form-group boot_sp">
                              <label class="form-label" for="Price">Main Pic(<span class="extenstion">Image extensions supported jpeg, jpg, png</span>)</label>
                             <input type="file" id="Pic" title="Browse Image" name="image" accept=".jpg,.jpeg,.gif" class="form-control">
                     </div>

                     
                    <div>
                        <?= $this->session->flashdata('imgerror'); ?>
                        

                        <?php if(!empty($datas->image)) { ?>
                           <?php  $img = image_exist($datas->image,'assets/images/stylist/'); ?>
                           <img alt="Personal Styling | StyleBuddy" style="width:80px"   alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
                        <?php } ?>
                     </div>
                  </div>

               </div>
               <div class="col-md-4">
                  <div class="row m-0">
                     <div class="form-group boot_sp">
                           <label class="form-label" for="Price">icon Pic(<span class="extenstion">Image extensions supported jpeg, jpg, png</span>)</label>
                          <input type="file" id="icon_image" title="Browse Image" name="icon_image" accept=".jpg,.jpeg,.gif" class="form-control">
                     </div>
                     <div>
                        <?php if(!empty($datas->icon_image)) { ?>
                        <?php  $img = image_exist($datas->icon_image,'assets/images/stylist/'); ?>
                        <img alt="Personal Styling | StyleBuddy" style="width:80px"   alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">

                        <?php } ?> 
                     </div>
                  </div>

               </div>

               

                
            </div>
            

            <div class="row">
                <div class="col-sm-4">
                  <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
              
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status == 1)?'selected':'' ?> > Active</option>
                     <option value="0" <?= ($datas->status == 0)?'selected':'' ?> > InActive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>

               <div class="col-8 mt-4">
                  <label for="" class="form-label"></label>
                  <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
                  <a href="<?php echo base_url('admin/stylist-expertise-interests') ;?>" class="btn btn-secondary mt-2">Go Back</a>
                </div>

            </div>

            
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>