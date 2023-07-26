<?php $this->load->view('admin/template/header'); ?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Fashion Consulting services Form</li>
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
             <span class="text-center text-info mb-1" id="susid"> <?php echo $this->session->flashdata('success');?></span>
             <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('admin/add-fashion-consulting-services',['id'=>'sliderfrmm']);?>
            
            <div class="row">
                <div class="col-md-6">
                    <label for="Image Alt Description" class="form-label">Fashion Service Name<span class="text-danger">*</span></label>
                      <select name="service_id" class="form-control" id="form-control" required>
                          <option>Select Fashion Service</option>
                          <?php if($datas) { foreach($datas as $data) { ?>
                            <option value="<?= $data->id ?>"><?= $data->title ?></option>
                          <?php }} ?>    
                      </select>
                    <?php echo form_error('service_id','<span class="text-danger mt-1">','</span>') ;?>
               </div>
               <div class="col-md-6">
                 <label for="Image Alt Description" class="form-label">Image (Upload size Max 2 MB) <span class="text-danger">*</span></label>
                 <input type="file" name="image" id="image" class="form-control" title="Upload Main Image" >
                 <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
               </div>
            </div>

           
             <div class="row mt-1">
                <div class="col-md-12">
                    <label for="Image Alt Description" class="form-label">Services Content<span class="text-danger">*</span></label>
                     <textarea class="form-control" name="content"  id="editor"></textarea>
                    <?php echo form_error('content','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>

             <div class="row mt-3">
               <div class="col-md-4">
                 <label for="Image Alt Description" class="form-label">Service Price<span class="text-danger">*</span></label>
                 <input type="text" name="price" id="price" class="form-control" title="Service Price" placeholder="Price varies OR 1,000">
               </div>
               <div class="col-md-4">
                 <label for="Image Alt Description" class="form-label">Service Time (in Hour) <span class="text-danger">*</span></label>
                  <input type="number" name="time" id="time" class="form-control" title="Service Time" placeholder="Service Time">
               </div>

               <div class="col-md-4">
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

            <div class="col-12 text-center">
               <label for="" class="col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/fashion-consulting-services') ;?>" class="btn btn-secondary mt-4">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>