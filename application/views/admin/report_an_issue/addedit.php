<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
<div class="container-fluid wc mt-2 p-0">
   <div class="row">
      <div class="col-md-12 ">
            <div class="  form-card p-3">
               <div class="text-end"><a href="<?php echo base_url($url1."/".$url2);?>" class="btn btn-primary float-right "><i class="fa fa-bars" aria-hidden="true"></i> List</a></div>
               <div id="success_message"></div>
               <span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
               <span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>
               <?php $row = $record_detail;?>
                <div class="even"  data-val="<?=$row->id?>">
                    <p>First Name: <?php echo !empty($row->fname) ? $row->fname : 'N/A' ?></p>
                    <p>Last Name<?php echo !empty($row->lname) ? $row->lname : 'N/A' ?></p>
                    <p>Country Name<?php echo !empty($row->country_name) ? $row->country_name : 'N/A' ?></p>
                    <p>Email: <?php echo !empty($row->email) ? $row->email : 'N/A' ?></p>
                    <p>Mobile: <?php echo !empty($row->mobile) ? $row->mobile : 'N/A' ?></p>
                    <p>Message: <?php echo !empty($row->message) ? $row->message : 'N/A' ?></p>
                    <div>Expertise: 

                        <?php 
                        if($row->issue){
                            $issue = explode(',',$row->issue);
                            $i = 1;
                            foreach ($issue as $key => $value) {
                                echo '<p>'.$i.': '.$value.'</p>';
                            $i++;}
                        }else{
                            echo 'N?A';
                        } 
                        ?>
                            

                        </div>
                    <p>Created at: <?php echo !empty($row->created_at) ? date("m-d-Y", strtotime($row->created_at)) : '' ?></p>
                </div>
      
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
      $('.onlyInteger').on('keypress', function(e) {

         keys = ['0','1','2','3','4','5','6','7','8','9','.']

         return keys.indexOf(event.key) > -1

      })
      
</script>
<script type="text/javascript">
   function delete_image(display,id,column,path,img,table,controller) {
      let text = "Do you want to delete this";
      if (confirm(text) == true) {
         $.ajax({
            type: 'GET',
            url: '<?=base_url()?>admin/'+controller+'/deleteImages',   
            data: {'id':id,'img':img,'column':column,'path':path,'table':table},
            success: function(response){
               console.log(response);
               $('#reviewMesage').html(response);
               $('#reviewMesage').show().delay('10000').fadeOut();
               $("#"+display).hide();

            }
         });

      } else {
         text = "You canceled!";
      }
   }
</script>