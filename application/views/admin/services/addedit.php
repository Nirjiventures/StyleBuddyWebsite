<?php  $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<style type="text/css">
   .pack_name {
       background: #333!important;
       color: yellow!important;
   }
   .cke_combo_text {
       line-height: 26px;
       padding-left: 4px!important;
       width: 40px!important;
   }
</style>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item "> <a href="<?php echo base_url($url1.'/'.$url2);?>" class="text-decoration-none">Services</a></li>
               <li class="breadcrumb-item active" aria-current="page"> View</li>
            </ol>                                              
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   <div class="row">

      <div class="col-md-12 mt-1 form-main">
          <div class="card  form-card">
            <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>

         
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            
            
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                <?php if($area_expertise){ ?>
                <div class="row">
                  <input type="hidden" name="id" value="<?= $record_detail['id']; ?>">
                  
                  <div class="col-md-12">
                     <label for="Image Alt Description" class="form-label">Service Name<span class="text-danger"></span></label>
                     <select id="area_expertise_id" name="area_expertise_id" class="form-control" >
                        <?php foreach ($area_expertise as $key => $value) {  ?>

                           <?php    if($record_detail['area_expertise_id']){ ?>
                              <?php    if($value['id'] == $record_detail['area_expertise_id']){ ?>
                                 <option 11 value="<?=$value['id'].'===='.$value['name']?>" <?=$sel?>><?=$value['name']?></option>
                              <?php    } ?>
                           <?php    }else{ ?>
                              <option value="<?=$value['id'].'===='.$value['name']?>" <?=$sel?>><?=$value['name']?></option>
                           <?php    }?>
                        <?php }?>
                     </select>
                  </div>
                    

                  
                  <div class="col-sm-12">
                     <table>
                        <tr>
                           
                           <td>
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
                                 <textarea required id="package_description_1" name="package_description_1" rows="2" class="form-control"><?= $record_detail['package_description_1'] ?></textarea>
                                 <?php echo form_error('package_description_1','<span class="text-danger mt-1">','</span>') ;?>
                                 <script> 
                                    CKEDITOR.replace( 'package_description_1',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
                                         },]} ); 
                                 </script>
                              </div>
                           </td>
                           <td style="vertical-align: text-bottom; width: 15%;">
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
                                 <input type="text" id="package_name_1" name="package_name_1" value="Classic" class="form-control box_in3 pack_name" readonly>
                              </div>
                              <div class="form-group boot_sp mt-5">
                                 <label class="form-label" for="package_price_1">Package Price</label>
                                 <input required type="text" id="package_price_1" name="package_price_1" value="<?= $record_detail['package_price_1'] ?>" class="form-control box_in3 onlyInteger">
                                 
                              </div>
                           </td>
                        </tr>
                        <tr>
                           
                           <td>
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
                                 <textarea required id="package_description_2" name="package_description_2" rows="2" class="form-control"><?= $record_detail['package_description_2'] ?></textarea>
                                 <?php echo form_error('package_description_2','<span class="text-danger mt-1">','</span>') ;?>
                                 <script> 
                                    CKEDITOR.replace( 'package_description_2',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
                                         },]} ); 
                                 </script>
                              </div>
                           </td>
                           <td style="vertical-align: text-bottom;">
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
                                 <input required type="text" id="package_name_2" name="package_name_2" value="Premium" class="form-control box_in3 pack_name" readonly>
                              </div>
                              <div class="form-group boot_sp mt-5">
                                 <label class="form-label" for="package_price_2">Package Price</label>
                                 <input required type="text" id="package_price_2" name="package_price_2" value="<?= $record_detail['package_price_2'] ?>" class="form-control box_in3 onlyInteger">
                                 
                              </div>
                           </td>
                        </tr>
                        <tr>
                            
                           <td>
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Description</label>
                                 <textarea required id="package_description_3" name="package_description_3" rows="2" class="form-control"><?= $record_detail['package_description_3'] ?></textarea>
                                 <?php echo form_error('package_description_3','<span class="text-danger mt-1">','</span>') ;?>
                                 <script> 
                                    CKEDITOR.replace( 'package_description_3',{'height':150,toolbarGroups: [{"groups": ["mode"]},{"name": "paragraph","groups": ["list"]},{"name": "styles","groups": ["styles"]
                                         },]} ); 
                                 </script>
                              </div>
                           </td>
                           <td style="vertical-align: text-bottom;">
                              <div class="">
                                 <label for="Image Alt Description" class=" col-form-label">Package Name</label>
                                 <input required type="text" id="package_name_3" name="package_name_3" value="Luxury" class="form-control box_in3 pack_name" readonly>

                              </div>
                              <div class="form-group boot_sp mt-5">
                                 <label class="form-label" for="package_price_3">Package Price</label>
                                 <input required type="text" id="package_price_3" name="package_price_3" value="<?= $record_detail['package_price_3'] ?>" class="form-control box_in3 onlyInteger">
                                 
                              </div>
                           </td>
                        </tr>
                        
                     </table>
                  </div>

                   
               </div>
               

                <div class="col-sm-12 text-center">
                  <label for="" class="form-label"></label>
                  <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary mt-2">
                  <a href="<?php echo base_url($url1.'/'.$url2) ;?>" class="btn btn-secondary mt-2">Go Back</a>
                </div>

                <?php }else{ ?>
                    <p>Services not Available. Please create service. <a href="<?=base_url('admin/stylist-expertise-interests')?>"> Services</a></p>
                <?php } ?>
            <?php echo form_close();?>
         </div>
      </div>
   </div>
</div>
<?php  $this->load->view('admin/template/footer'); ?>
<script type="text/javascript">
      $('.onlyInteger').on('keypress', function(e) {

         keys = ['0','1','2','3','4','5','6','7','8','9','.']

         return keys.indexOf(event.key) > -1

      })
      function addRow(id=0){
         var id  = id;
           var rowCount = $('#list tr').length;
           console.log(id);
           console.log(rowCount);
           data  = addSlots(id,rowCount);
           $("#list").append(data);
      }
      function addSlots(id,rowCount){
         html = '';
            html += '<tr id="'+rowCount+'">';
               html += '<td>';
                  html += '<input type="text" id="length" name="first_col[]" value="" required class="form-control table_td length">';
               html += '</td>';
               html += '<td>';
                  html += '<input type="text" id="width" name="second_col[]" value="" required class="form-control table_td width">';
               html += '</td>';
               html += '<td>';
                  html += '<input type="text" id="height" name="third_col[]" value="" required class="form-control table_td height">';
               html += '</td>';
               html += '<td>';
                  html += '<input type="text" id="pices" name="fourth_col[]" value="" required class="form-control table_td pices">';
               html += '</td>';
               html  += '<td class="action"><span class="del"><a class="btn btn-danger" onclick="deleteAttribute('+rowCount+');return false;"><i class="fa fa-times red"></i></a></span></td>';
            html += '</tr>';
         return html;
      }
      function deleteAttribute(id){
           $("#"+id).css("display","none");
            $("#"+id).remove();
      }
</script>