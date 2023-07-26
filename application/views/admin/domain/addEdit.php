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
               <li class="breadcrumb-item active" aria-current="page">Our Services Details</li>
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
            <a href="<?php echo base_url($url1.'/'.$url2.'?'.http_build_query($_GET, '', "&")) ;?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List </a>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card  form-card">
                <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                <input type="hidden" name="id" id="id" class="form-control" value="<?= set_value('id',$datas->id); ?>" >
                <div class="row ">
                    <div class="col-md-4">
                        <label for="" class="form-label">Domain Name<span class="text-danger">*</span></label>
                        <input type="text" name="domain_name" id="domain_name" class="form-control" value="<?= set_value('domain_name',$datas->domain_name); ?>" placeholder="Domain Name" required>
                        <?php echo form_error('domain_name','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                    <div class="col-sm-3">
                       <label class="control-label" for="sip_code">Company</label>
                       <select id="corporate_company_id" name="corporate_company_id"  class="form-control" required>
                            <option value=""> Select Company</option>
                            <?php foreach($corporate_company as $key=>$value){ ?>
                                    <?php if ($value->id == $datas->corporate_company_id || $value->id == $_GET['corporate_company_id'] ){$sel='selected';}else{$sel='';}?>
                                    <option value="<?=$value->id?>" <?=$sel?>> <?=$value->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-sm-3">
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
                    <div class="col-md-6">
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
                </div>
                <?php echo form_close();?>
            </div>
      </div>
   </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>

<script type="text/javascript">
   function addRow(id){
      var id  = id;
      var rowCount = $('.dynamic_row .dynamic_row_All').length;
      console.log(rowCount);

      data  = addSlotsDiv(id,rowCount);
      $(".dynamic_row").append(data);
   }
    
function addSlotsDiv(id,rowCount){
    var html = '';
    html = '<div class="col-md-12 remove_row"  id="'+rowCount+'">';
        html += '<div class="dynamic_row_All row"> ';
            html += '<div class="col-md-4">';
                html += '<div class="form-group boot_sp">';
                    html += '<label class="form-label" for="inlink">Title<span class="text-danger">*</span></label>';
                    html += '<input type="text" required name="ac_title[]" class="form-control ">';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-7">';
                html += '<div class="form-group boot_sp mb-0">';
                    html += '<label class="form-label" for="pin">Description<span class="text-danger">*</span></label>';
                    html += '<textarea required class="form-control" maxlength="180" rows="5" id="ac_description'+rowCount+'" name="ac_description[]" placeholder=""></textarea>';
                html += '</div>';
            html += '</div>';
            html += '<div class="col-md-1 text-right"><a class="btn btn-plus remove_more" onclick="deleteAttribute('+rowCount+');return false;"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove</a></div>';
        html += '</div>';
    html += '</div>';
    $(document).ready(function() {
        CKEDITOR.replace( 'ac_description'+rowCount,{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} ); 
    });

    return html; 
}
   function deleteAttribute(id){
        $("#"+id).css("display","none");
         $("#"+id).remove();
    }
</script>