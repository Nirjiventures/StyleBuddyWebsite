<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Careers Update Form</li>
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
            <?php echo form_open_multipart('admin/update-career',['id'=>'dd']);?>
            
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="Image Alt Description" class="form-label">Job Title <span class="text-danger">*</span></label>
                      <input type="text" name="jobTitle" id="jobTitle" class="form-control" value="<?= set_value('jobTitle',$data->jobTitle); ?>" placeholder="Page Title">
                    <?php echo form_error('jobTitle','<span class="text-danger mt-1">','</span>') ;?>
               </div>
                <div class="form-group col-md-3">
                    <label for="Image Alt Description" class="form-label">Department<span class="text-danger">*</span></label>
                      <select  name="department" id="department" class="form-control">
                          <option value"Operations" <?= ($data->department == 'Operations')?'selected':'' ?> >Operations</option>
                          <option value"IT" <?= ($data->department == 'IT')?'selected':'' ?>>IT</option>
                          <option value"Hr" <?= ($data->department == 'Hr')?'selected':'' ?> >Hr</option>
                          <option value"Admin" <?= ($data->department == 'Admin')?'selected':'' ?> >Admin</option>
                      </select>
                    <?php echo form_error('department','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class="form-group col-md-4">
                    <label for="Image Alt Description" class="form-label">Job Location <span class="text-danger">*</span></label>
                      <input type="text" name="location" id="location" class="form-control" value="<?= set_value('location',$data->location); ?>" placeholder="Noida, Delhi, Mumbai, Gurugram">
                    <?php echo form_error('location','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="row form-group">
              <label for="Image Alt Description" class="form-label">Short Description <span class="text-danger">*</span></label>
                 <textarea class="form-control" id="editor1" name="shortDesc"><?= $data->shortDesc ?></textarea>
                  <script type="text/javascript">
                        CKEDITOR.replace("editor1",{height:100});
                  </script>
                 <?php echo form_error('shortDesc','<span class="text-danger mt-1">','</span>') ;?>
            </div>
            <div class="row">
                 <label for="Image Alt Description" class="form-label">Long Description <span class="text-danger">*</span></label>
                  <textarea class="form-control" id="editor" name="longDesc"><?= $data->longDesc ?></textarea>
                  <script type="text/javascript">
                        CKEDITOR.replace("editor",{height:150});
                  </script>
                  <input type="hidden" name="id" value="<?= $data->id ?>" >
                   <?php echo form_error('longDesc','<span class="text-danger mt-1">','</span>') ;?>
            </div>
      
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
              
            <!--<div class="form-group row">-->
            <!--    <label for="Status" class="col-sm-2 col-form-label">Meta Tag </label>-->
            <!--    <div class="col-sm-10">-->
            <!--    <input type="text" name="metaTag" value="<?= set_value('metaTag',$data->metaTag ) ?>" placeholder="Enter Meta Tag" class="form-control">-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="form-group row">-->
            <!--   <label for="Status" class="col-sm-2 col-form-label">Meta Description</label>-->
            <!--   <div class="col-sm-10">-->
            <!--    <textarea name="metaDescription" class="form-control" placeholder="Enter Meta Description" ><?= set_value('metaDescription',$data->metaDescription ) ?></textarea>-->
            <!--   </div>-->
            <!--</div>-->
                
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($data->status == 1)?'selected':'' ?> > Active</option>
                     <option value="0" <?= ($data->status == 0)?'selected':'' ?> > Inactive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/career') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
