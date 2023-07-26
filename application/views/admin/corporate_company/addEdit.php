<?php $this->load->view('admin/template/header'); ?>
<?php $url1  = $this->uri->segment(1);?>
<?php $url2  = $this->uri->segment(2);?>
<?php $url3  = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin/Dashboard/");?>" class="text-decoration-none">Home</a></li>
               
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div id="message" class="text-primary text-center"></div>
            <div id="success_message"></div>
            <a href="<?php echo base_url($url1.'/'.$url2) ;?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List </a>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card  form-card">
                <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                <input type="hidden" name="id" id="id" class="form-control" value="<?= set_value('id',$datas->id); ?>" >
                <div class="row ">
                    <div class="col-md-6">
                        <label for="" class="form-label">Company Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name',$datas->name); ?>" placeholder="Company Name">
                        <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                    <div class="col-sm-6">
                        <label for="Status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" id="status">
                            <option value="">---- Choose a Status ----</option>
                            <option value="1" <?= ($datas->status == 1)?'selected':'' ?> > Active</option>
                            <option value="0" <?= ($datas->status == 0)?'selected':'' ?> > InActive</option>
                        </select>
                        <span id="statusErr"></span>
                        <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                   </div>
                </div>
                <div class="row ">
                    <div class="col-md-9">
                        <label for="Image Alt Description" class=" col-form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control" title="Enter product image" placeholder="Add Catogery image" >
                        <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                     </div>
                </div>
                <input type="hidden" name="id" value="<?= $datas->id ?>">
                <input type="hidden" name="old_img" value="<?= $datas->image ?>">
                <?php if($datas->image ){?>
                    <div class="col-md-3 mt-4">
                       <?php $img =  'assets/images/no-image.jpg';?>
                       <?php if(!empty($datas->image))  {?>
                          <?php 
                             $img1 =  'assets/images/corporate_domain/'.$datas->image; 
                             if (file_exists($img1)) {
                                  $img = $img1;
                             }
                          ?>
                       <?php } ?>
                       <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img)?>" class="img-thumbnail"class="img-thumbnail" style="width:100px; height:60px;"> 
                    </div>
                 <?php } ?>

                <div class="col-12 text-center">
                   <label for="" class="form-label"></label>
                   <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
                   <a href="<?php echo base_url($url1.'/'.$url2) ;?>" class="btn btn-secondary mt-2">Go Back</a>
                </div>
                <?php echo form_close();?>
            </div>
      </div>
   </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>
 