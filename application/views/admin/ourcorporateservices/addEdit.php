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
            <a href="<?php echo base_url($url1.'/'.$url2.'?' . http_build_query($_GET, '', "&")) ;?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> Service </a>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-danger mb-2" id="errid"> <?php echo $this->session->flashdata('error');?></span>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card  form-card">
                <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                <input type="hidden" name="id" id="id" class="form-control" value="<?= set_value('id',$datas->id); ?>" >
                <div class="row ">
                    <div class="col-md-4">
                        <label for="Image Alt Description" class="form-label">Service Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="<?= set_value('title',$datas->title); ?>" placeholder="Service Title">
                        <?php echo form_error('title','<span class="text-danger mt-1">','</span>') ;?>
                    </div>
                    <div class="col-md-4">
                        <label for="Image Alt Description" class="form-label">Service Sub Title </label>
                        <input type="text" name="sub_title" id="sub_title" class="form-control" value="<?= ($datas->sub_title)?$datas->sub_title:'Get ready to look your best, Online'; ?>" placeholder="Service Sub Title">

                        <?php echo form_error('sub_title','<span class="text-danger mt-1">','</span>') ;?>

                    </div>
                    <div class="col-md-2">
                     <label for="Image Alt Description" class="form-label">Image (Upload size Max 2 MB) <span class="text-danger">*</span></label>
                     <input type="file" name="image" id="image" class="form-control" title="Upload Main Image"  onchange="loadFile(event)">
                     <span class="text-center text-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('imgerror');?></span>
                   </div>
                   <div class="col-md-2">
                      <?php  $img = image_exist($datas->image,'assets/images/services/'); ?>
                      <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  id="profilephoto_img" src="<?= base_url($img) ?>" class="img-fluid">
                   </div>
                </div>

                <div class="mb-2 row">
                     
                    <div class="col-sm-6">
                        <label for="Image Alt Description" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <select class="form-control" name="corporate_company_id" id="corporate_company_id">
                           <option value="">---- Select Company ----</option>
                           <?php foreach ($corporate_company as $key => $value): ?>
                                <?php $sel='';if($value->id == $_GET['corporate_company_id']){$sel='selected';} ?>
                                <?php if($value->id == $datas->corporate_company_id){$sel='selected';} ?> 
                                <option value="<?=$value->id?>" <?=$sel?>><?=$value->name?></option>
                           <?php endforeach ?> 
                       </select>
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
                <div class="mb-2 row">
                   <div class="col-md-6">
                         <label for="Image Alt Description" class="form-label">Main price</label>
                         <input id="mrp_price" name="mrp_price" required class="form-control onlyInteger" value="<?= $datas->mrp_price ?>"> 
                   </div>
                 
                   <div class="col-md-6">
                         <label for="Image Alt Description" class="form-label">Discount(%)</label>
                         <input id="discount" name="discount" class="form-control onlyInteger" value="<?= $datas->discount ?>"> 
                   </div>
                </div>
                <div class="row mt-4 mb-2">
                    <div class="col-md-6">
                        <label for="Image Alt Description" class="form-label">Left Section</label>
                         <textarea class="form-control" name="left_section1"  id="left_section1"><?= $datas->left_section1 ?></textarea>
                        <?php echo form_error('left_section1','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'left_section1',{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} ); 

                         </script>
                    </div>
                    <div class="col-md-6">
                        <label for="Image Alt Description" class="form-label">Right Section</label>
                         <textarea class="form-control" name="right_section1"  id="right_section1"><?= $datas->right_section1 ?></textarea>
                        <?php echo form_error('right_section1','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'right_section1',{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} );
                         </script>
                    </div>
                    <div class="col-md-12  mt-4">

                        <label for="Image Alt Description" class="form-label">Section 1</label>

                          <input type="text" name="section1" id="section1" class="form-control" value="<?= ($datas->section1)?$datas->section1:'About'; ?>" placeholder="section 1 Title">

                        <?php echo form_error('section1','<span class="text-danger mt-1">','</span>') ;?>

                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="Image Alt Description" class="form-label">Top Content<span class="text-danger">*</span></label>
                         <textarea class="form-control" name="description_top"  id="package_title_top"><?= $datas->description_top ?></textarea>
                        <?php echo form_error('description_top','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'package_title_top',{'height':120} ); 
                         </script>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="Image Alt Description" class="form-label">Section 2</label>
                          <input type="text" name="section2" id="section2" class="form-control" value="<?= set_value('section2',$datas->section2); ?>" placeholder="section2 Title">
                        <?php echo form_error('section2','<span class="text-danger mt-1">','</span>') ;?>
                   </div>
                    <div class="col-md-6 mt-4">
                        <label for="Image Alt Description" class="form-label">Left Box</label>
                         <textarea class="form-control" name="left_section2"  id="left_section2"><?= $datas->left_section2 ?></textarea>
                        <?php echo form_error('left_section2','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'left_section2',{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} ); 

                         </script>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="Image Alt Description" class="form-label">Right Box</label>
                         <textarea class="form-control" name="right_section2"  id="right_section2"><?= $datas->right_section2 ?></textarea>
                        <?php echo form_error('right_section2','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'right_section2',{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} );
                         </script>
                    </div>
                    <div class="col-md-12  mt-4">

                        <label for="Image Alt Description" class="form-label">Section 3</label>

                          <input type="text" name="section3" id="section3" class="form-control" value="<?= ($datas->section1)?$datas->section3:'More About the Service'; ?>" placeholder="section 3 Title">

                        <?php echo form_error('section3','<span class="text-danger mt-1">','</span>') ;?>

                    </div>
                    <div class="col-md-12 mt-4">
                       <div class="dynamic_row">    
                          <div class="row mt-3">
                             <div class="col-md-12 mb-3"><h4>Add Accordion</h4></div>
                          </div>    
                          <div class="dynamic_row_All row" id="0">
                            <?php 
                                if($datas->description_middle){
                                    $description_middle = (json_decode($datas->description_middle));
                                    $rowCount = 0;
                                    $i = 0;
                                    $html = '';
                                    if($description_middle->ac_title){
                                        $ac_title = $description_middle->ac_title;
                                        $ac_description = $description_middle->ac_description;
                                        for ($i=0; $i < count($ac_title); $i++) { 
                                            $rowCount++;
                                            $html .= '<div class="col-md-12 remove_row"  id="'.$rowCount.'">';
                                                $html .= '<div class="dynamic_row_All row"> ';
                                                    $html .= '<div class="col-md-4">';
                                                        $html .= '<div class="form-group boot_sp">';
                                                            $html .= '<label class="form-label" for="inlink">Title<span class="text-danger">*</span></label>';
                                                            $html .= '<input type="text" required name="ac_title[]" class="form-control" value="'.$ac_title[$i].'">';
                                                        $html .= '</div>';
                                                    $html .= '</div>';
                                                    $html .= '<div class="col-md-7">';
                                                        $html .= '<div class="form-group boot_sp mb-0">';
                                                            $html .= '<label class="form-label" for="pin">Description<span class="text-danger">*</span></label>';
                                                            $html .= '<textarea required class="form-control" maxlength="180" rows="5" id="ac_description'.$rowCount.'" name="ac_description[]" placeholder="">'.$ac_description[$i].'</textarea>';
                                                        $html .= '</div>';
                                                    $html .= '</div>';
                                                    $html .= '<div class="col-md-1 text-right"><a class="btn btn-plus remove_more" onclick="deleteAttribute('.$rowCount.');return false;"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove</a></div>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                            ?>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    CKEDITOR.replace( 'ac_description<?=$rowCount?>',{'height':100,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]},]} ); 
                                                 });
                                            </script>
                                            <?php 
                                                    
                                        }
                                        echo $html;    
                                    }
                                }
                                
                            ?>
                              
                          </div>
                       </div>
                       <div class="">
                            <a class="btn btn-danger" onclick="addRow(1)"> <i class="fa fa-plus"></i> Add</a>
                            <span id="err"></span>
                            <br/>
                       </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <label for="Image Alt Description" class="form-label">Service box content</label>
                        <textarea class="form-control" name="description_bottom"  id="package_title_1"><?= $datas->description_bottom ?></textarea>
                        <?php echo form_error('description_bottom','<span class="text-danger mt-1">','</span>') ;?>
                        <input type="hidden" name="id" value="<?= $datas->id ?>">
                        <input type="hidden" name="old_image" value="<?= $datas->image ?>">
                        <script> 
                            CKEDITOR.replace( 'package_title_1',{'height':120} ); 
                        </script>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label for="Image Alt Description" class="form-label">Plan Page Content<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="short_description"  id="short_description"><?= $datas->short_description ?></textarea>
                        <?php echo form_error('short_description','<span class="text-danger mt-1">','</span>') ;?>
                        <script> 
                            CKEDITOR.replace( 'short_description',{'height':120} ); 
                        </script>
                    </div>
                </div>
                
                
                <div class="row mt-4">
                   <div class="col-md-12">
                         <label for="Image Alt Description" class="form-label">Meta Title<span class="text-danger"></span></label>
                         <textarea id="meta_title" name="meta_title" rows="2" class="form-control"><?= $datas->meta_title ?></textarea>
                   </div>
                </div>
                <div class="mt-4 row">
                   <div class="col-md-12">
                         <label for="Image Alt Description" class="form-label">Meta Keyword<span class="text-danger"></span></label>
                         <textarea id="meta_keyword" name="meta_keyword" rows="2" class="form-control"><?= $datas->meta_keyword ?></textarea>
                   </div>
                </div>
                <div class="mt-4 mb-2 row">
                      <div class="col-sm-12">
                           <label for="Image Alt Description" class=" col-form-label">Meta Description<span class="text-danger">*</span></label>
                            <textarea id="meta_description" name="meta_description" rows="2" class="form-control"><?= $datas->meta_description ?></textarea>
                             
                      </div>
                 
                     
                </div>

                <div class="col-12 text-center">
                   <label for="" class="form-label"></label>
                   <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
                   <a href="<?php echo base_url($url1.'/'.$url2.'?' . http_build_query($_GET, '', "&")) ;?>" class="btn btn-secondary mt-2">Go Back</a>
                </div>
                <?php echo form_close();?>
            </div>
      </div>
   </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>

<script type="text/javascript">

var loadFile = function(event) {
    var output = document.getElementById('profilephoto_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    console.log(output.src);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
  };


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