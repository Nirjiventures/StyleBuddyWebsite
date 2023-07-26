<?php  $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item "> <a href="<?php echo base_url($url1.'/'.$url2);?>" class="text-decoration-none">Leads</a></li>
               <li class="breadcrumb-item active" aria-current="page"> View</li>
            </ol>                                              
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12 mt-5">
         <div class="card  form-card">
            <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                     <div class="row">
                        <div class="col-sm-12">
                           <h4>Add New</h4>
                        </div>
                           <div class="col-sm-12">
                              <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
                              <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>

                           </div>
                           <div class="col-md-12 mbc">
                              <label for="Image Alt Description" class="form-label">Title<span class="text-danger"></span></label>
                              <input type="text" name="title" id="title" class="form-control" required value="<?= set_value('title'); ?>" placeholder="title">
                           </div>
                           <div class="col-sm-12 mt-3">
                              <div class="form-group boot_sp">
                                 <input type="file" id="pic" title="Browse Image" name="image" accept="*" required class="form-control box_in3">
                                 <label class="form-control-placeholder2" for="Price">Upload Document</label>
                                 <div id="pic_Err"></div>
                              </div>
                           </div>
                           <div class="col-sm-6"></div>
                           <div class="col-sm-6">
                              <button type="submit" class="btn btn-primary">Submit</button>
                           </div>
                     </div>

            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>
