<?php  $this->load->view('admin/template/header'); ?>

<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">>Personal Stylist Location Form</li>
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
            <?php echo form_open_multipart('admin/add-personal-stylist',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Stylist Location ( Page Title) <span class="text-danger">*</span></label>
                      <input type="text" name="title" id="title" class="form-control" required>
                      <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class="col-md-3">
                 <label for="Image Alt Description" class="form-label">Main Image <span class="text-danger">*</span></label>
                 <input type="file" name="image" id="image" class="form-control" title="Upload Main Image" required>
                 <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
               </div>
                <div class="col-md-3">
                 <label for="Image Alt Description" class="form-label">Detail Image  <span class="text-danger">*</span></label>
                 <input type="file" name="last_image" id="last_image" class="form-control" title="Upload Main Image" required>
                 <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
               </div>
            </div>
             <div class="row mt-4">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Top Content<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="top_content"  id="editor" required></textarea>
                     <script>CKEDITOR.replace('editor', {height:100});</script>
                    <?php echo form_error('top_content','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
             <div class="row mt-4">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">University Students<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_1_data"  id="editor1" required></textarea>
                    <?php echo form_error('col_1_data','<span class="text-danger mt-1">','</span>') ;?>
                    <script>CKEDITOR.replace('editor1', {height:130});</script>
               </div>
               <div class="col-md-6 ">
                    <label for="Image Alt Description" class="form-label">Office Professionals<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_2_data"  id="editor2" required></textarea>
                    <?php echo form_error('col_2_data','<span class="text-danger mt-1">','</span>') ;?>
                    <script>CKEDITOR.replace('editor2', {height:130});</script>
               </div>
               <div class="col-md-6 mt-4">
                    <label for="Image Alt Description" class="form-label">Entrepreneurs & Business Owners<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_3_data"  id="editor3" required></textarea>
                    <?php echo form_error('col_3_data','<span class="text-danger mt-1">','</span>') ;?>
                    <script>CKEDITOR.replace('editor3', {height:130});</script>
               </div>
               <div class="col-md-6 mt-4">
                    <label for="Image Alt Description" class="form-label">Brides and Grooms<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_4_data"  id="editor4" required></textarea>
                    <?php echo form_error('col_4_data','<span class="text-danger mt-1">','</span>') ;?>
                    <script>CKEDITOR.replace('editor4', {height:130});</script>
               </div>
               <div class="col-md-6 mt-4">
                    <label for="Image Alt Description" class="form-label">Homemakers<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_5_data"  id="editor5" required></textarea>
                    <?php echo form_error('col_5_data','<span class="text-danger mt-1">','</span>') ;?>
                    <script>CKEDITOR.replace('editor5', {height:130});</script>
               </div>
               <div class="col-md-6 mt-4">
                    <label for="Image Alt Description" class="form-label">Kids<span class="text-danger">*</span></label>
                     <textarea class="form-control border border-dark"rows="5" name="col_6_data"  id="editor6" required></textarea>
                    <script>CKEDITOR.replace('editor6', {height:130});</script>
                    <?php echo form_error('col_6_data','<span class="text-danger mt-1">','</span>') ;?>
                    
               </div>
            </div>
             <div class="row mt-4">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Last Content<span class="text-danger">*</span></label>
                     <textarea class="form-control" name="last_content"  id="last_content"></textarea>
                     <script>CKEDITOR.replace('last_content', {height:200});</script>
                    <?php echo form_error('last_content','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
  
            <div class="border-bottom border border-secondary mb-5 mt-5"></div>
             
            <div class="form-group row">
               <label for="Status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
               <div class="col-sm-10">
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" selected=""> Active</option>
                     <option value="0"> Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info mt-4">
               <a href="<?php echo base_url('admin/personal-stylist') ;?>" class="btn btn-secondary mt-4">Show</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>