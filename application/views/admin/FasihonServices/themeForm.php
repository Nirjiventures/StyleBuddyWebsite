<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Theme Form</li>
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
            <?php echo form_open_multipart('admin/add-theme',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-9">
                    <label for="Image Alt Description" class="form-label">Question<span class="text-danger">*</span></label>
                      <input type="text" name="question" id="question" class="form-control" value="<?= set_value('question'); ?>" placeholder="Enter Your Question">
                    <?php echo form_error('question','<span class="text-danger mt-1">','</span>') ;?>
               </div>

                <div class="col-sm-3">
                   <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                     <select class="form-control" name="status" id="status">
                        <option value="">---- Choose a Status ----</option>
                        <option value="1" selected=""> Active</option>
                        <option value="0"> Inctive</option>
                     </select>
                     <span id="statusErr"></span>
                     <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>

            </div>
             <div class="row mt-3">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Answer<span class="text-danger">*</span></label>
                     <textarea class="form-control" name="answer"  id="editor"></textarea>
                     <script>CKEDITOR.replace('editor', {height:100});</script>
                    <?php echo form_error('answer','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
  
            <div class="col-sm-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/manage-theme') ;?>" class="btn btn-secondary mt-4">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
