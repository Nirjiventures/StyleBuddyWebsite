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
               <li class="breadcrumb-item active" aria-current="page"> Stylist Expertise / Interests Update Form</li>
            </ol>                                              
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-2 form-main">
         <div class="card  form-card">
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
            <div class="row">
                <input type="hidden" name="id" value="<?= $datas->id; ?>">
                <div class="col-md-4">
                    <label for="Image Alt Description" class="form-label">Title<span class="text-danger"></span></label>
                    <?php 
                        if($this->uri->segment(3) == 'add'){
                            $title = $experiseRow->title_develop;
                        }else{
                            $title = $datas->title;
                        }
                    ?>
                    
                    <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title',$title ); ?>" placeholder="Title">
                </div>
                <div class="col-sm-4">
                    <label for="Status" class="col-form-label">City <span class="text-danger">*</span></label>
                    <select class="form-control" name="city_id" id="city_id">
                        <option value="" disabled>---- Choose city ----</option>
                        <?php foreach($cities as $k=>$v){?>
                            <?php if($v->id == $datas->city_id){$sel='selected';}else{$sel='';}?>
                            <option value="<?=$v->id ?>"  <?=$sel ?>> <?=$v->city ?></option>
                        <?php }?>
                        
                    </select>
                    <span id="city_idErr"></span>
                    <?php echo form_error('city_id','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-sm-4">
                    <label for="Status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="status" id="status">
                        <?php if($this->uri->segment(3) == 'add'){ ?>
                            <option value="1" <?= ($datas->status == 1)?'selected':'' ?> > Active</option>
                            <option value="0"> InActive</option>
                        <?php }else{ ?>
                            <option value="1" <?= ($datas->status == 1)?'selected':'' ?> > Active</option>
                            <option value="0" <?= ($datas->status == 0)?'selected':'' ?> > InActive</option>
                        <?php     } ?>
                        
                        
                    </select>
                    <span id="statusErr"></span>
                    <?php echo form_error('status','<span class="text-danger mt-1">','</span>') ;?>
                </div>
                <div class="col-sm-12">
                      <label for="Image Alt Description" class=" col-form-label">Page Content<span class="text-danger">*</span></label>
                       <textarea id="editor" name="description" rows="2" class="form-control"><?= $datas->description ?></textarea>
                      <?php echo form_error('description','<span class="text-danger mt-1">','</span>') ;?>
                        <script> CKEDITOR.replace( 'editor',{'height':200} ); </script>
                         <input type="hidden" name="id" value="<?= $datas->id; ?>">
                </div>
                
            </div>

            <div class="col-12 text-center">
               <label for="" class="form-label"></label>
               <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
               <a href="<?php echo base_url('admin/looking-stylist-city') ;?>" class="btn btn-secondary mt-2">Go Back</a>
            </div>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>