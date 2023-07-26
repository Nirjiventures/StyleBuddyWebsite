<?php $segment1  = $this->uri->segment(1);?>
<?php $segment2  = $this->uri->segment(2);?>
<?php $segment3  = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item "><a href="<?php echo base_url($segment1."/".$segment2);?>" class="text-decoration-none">Team</a></li>
               <li class="breadcrumb-item active" aria-current="page">Team Detail</li>
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
            <span class="text-center text-primary mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <div class=" row">
               <div class="col-sm-12">
                  <label for="Image Alt Description" class="form-label">Name <span class="text-danger"></span></label>
                  <input type="text" class="form-control" value="<?= set_value('name',$datas->name); ?>">
                  <input type="hidden" name="id" value="<?= $datas->id?>">
                  <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
              </div>
            </div>
            <div class=" row">
               <div class="col-sm-12">
                  <label for="Image Alt Description" class="form-label">Email <span class="text-danger"></span></label>
                  <input type="text" class="form-control"  value="<?= set_value('name',$datas->email); ?>">
                  <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
              </div>
            </div>
            <div class=" row">
               <div class="col-sm-12">
                  <label for="Image Alt Description" class="form-label">Message <span class="text-danger"></span></label>
                  <textarea class="form-control" ><?= set_value('name',$datas->comment); ?></textarea>
                  <?php echo form_error('name','<span class="text-danger mt-1">','</span>') ;?>
              </div>
            </div>
            <div class="row">
               <div class="col-sm-12">
                  <label for="Status" class="form-label">Status <span class="text-danger"></span></label>
                  <select class="form-control" name="status" id="status">
                     <option value="">---- Choose a Status ----</option>
                     <option value="1" <?= ($datas->status == 1) ?  "selected = 'selected'" : ''; ?> > Active</option>
                     <option value="0" <?= ($datas->status == 0) ?  "selected = 'selected'" : ''; ?> > Inctive</option>
                  </select>
                  <span id="statusErr"></span>
                  <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
               </div>
            </div>
            <!-- <div class="form-group">
               <label for="" class="col-sm-2 col-form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-4">
               <a href="<?php echo base_url('admin/review') ;?>" class="btn btn-primary mt-4">Show</a>
            </div> -->
            <?php //echo form_close();?>
         </div>
      </div>
   </div>
</div>
