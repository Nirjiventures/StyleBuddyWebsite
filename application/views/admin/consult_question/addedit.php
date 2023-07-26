<?php  $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 mt-1 form-main">
          <div class="card  form-card">
            <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
            <div id="success_message"></div>
            <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
            <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
            <?php echo form_open_multipart('',['id'=>'sliderfrmm']);?>
                 
                <div class="row">
                  <input type="hidden" name="id" value="<?= $record_detail['id']; ?>">
                    
                     <div class="col-sm-12">
                        <label for="Image Alt Description" class=" col-form-label">Question Name</label>
                        <input type="text" id="name" name="name" value="<?= $record_detail['name'] ?>" class="form-control  pack_name">
                     </div>
                     <div class="col-sm-12 text-center">
                        <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary mt-2">
                     </div>
                  </div>
               </div>
               
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