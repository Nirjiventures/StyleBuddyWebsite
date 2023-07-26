<style type="text/css">
   .cross_img {
       width: 76px;
       height: 76px;
       margin-top: 8px;
   }
   .cross_image {
       margin-top: 8px;
       position: absolute;
       border: 1px solid #FFF;
       width: 25px;
       text-align: center;
       border-radius: 100px;
       height: 25px;
       line-height: 25px;
       font-weight: bold;
       background: #333333bf;
       color: #FFFF;
   }
   .chosen-container-multi .chosen-choices{
      background: none!important;
   }

   .ser_ans{color: #f62ac1;}
   .q_black{color: #000000;}
   table, .table {
    font-size: 0.9em;
    color: #38499a;
}
.ser_ans_final{color: #000000!important;}
table p {margin-bottom: 10px;}
table tr td {
    padding: 10px!important;
}
.top_info_ser {background: #eaecd0;padding: 20px 3px; width: 100%;}
.top_info_ser p { margin-bottom: 0px; border: 2px solid #f62ac1; padding: 15px; border-radius: 4px;font-size: 15px; }
.hed_q{background: #f0f0f0; padding: 15px; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;}
.top_info_ser p span { position: absolute; top: 3px; font-size: 11px; color: #333; }
</style>
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
               <?php 

                  $email = $record_detail['email'];
                  $mobile = $record_detail['mobile'];
                  $name = $record_detail['name'];
                  $answer = $record_detail['answer'];

                  $answer = (array)(json_decode($answer));
                  $option = '';
                  $option = '<div class="top_info_ser row m-0">';
                  $option .= '<div class="col-sm-3 pr-0"><p><span>Name</span><b><i class="fa fa-user"></i>  </b>'.$name.'</p></div>';
                  $option .= '<div class="col-sm-4 pr-0"><p><span>Email ID</span><b><i class="fa fa-envelope"></i> </b>'.$email.'</p></div>';
                  $option .= '<div class="col-sm-3 pr-0"><p><span>Mobile</span><b><i class="fa fa-phone"></i> </b>'.$mobile.'</p></div>'; 
                 $option .= '</div>';

                  $abQuestion = array(
                      array(
                          'title'=>'Welcome to Your Style Assessment. Lets start with Basics. How often do you see yourself in the mirror?',
                          'sub_title'=>'Mirrors help us regulate our emotions and sync up with ourselves and others',
                          'question'=>array('2 to 5 times a Day','More than 5 times a Day','Less then Twice a Day')
                      ),
                      array(
                          'title'=>'“How do I Look?” – how often you ask this question to others?',
                          'sub_title'=>'We usually want to know other\'s opinions to help make decisions or to ensure we are doing the right thing',
                          'question'=>array('Never or Rarely','Almost always','When I am dressing up for special occassion')
                      ),
                      array(
                          'title'=>'Is Looking Good and Stylish important for you?',
                          'sub_title'=>'Looking good will not only increase your self-confidence but it also impresses and attracts other people',
                          'question'=>array('Yes, Always','Yes, but only on special occasions','This is not important for me')
                      ),
                      array(
                          'title'=>'How often do you get praised for your style and what you wear?',
                          'sub_title'=>'It demonstrates their admiration for your fashion sense',
                          'question'=>array('Almost Always :-)','Only when I dress up for special occasions','Never or very Rarely :-(')
                      ),
                      array(
                          'title'=>'Do you think that dressing well and carrying your unique style helps boost confidence at workplace?',
                          'sub_title'=>'Studies show that people who dress right for interviews or business meetings are 80% more likely to succeed',
                          'question'=>array('Yes, I Strongly Agree','I am not sure about it','No, I don\'t think it is important')
                      ),
                      array(
                          'title'=>'What are your Style Goals for 2023?',
                          'sub_title'=>'Did you know that Indians are adopting fashion and style like never before?',
                          'question'=>array('Try Something New','Look Simple but Stylish','I have no personal style goals')
                      ),
                      array(
                          'title'=>'Do you comment on what other people wear and their style?',
                          'sub_title'=>'It means you are good at observing and appreciate fashion and style',
                          'question'=>array('Almost Always','Sometimes','Never')
                      ),

                  );
                  $option .= '<div class="hed_q"><h5>Questions: </h5></div>';
                  $option .= '<table class="table table-striped table-bordered">'; 
                      $ib=0;  foreach ($abQuestion as $key => $value) { $ib++; 
                          $option .= '<tr>';
                              $option .= '<td><p><b class="q_black">Question '.$ib.'.</b> '.$value['title'].'<br/><span>'.$value['sub_title'].'</span></p>
                                          <p><b class="ser_ans">Ans. </b><span class="ser_ans_final">'.$answer['radio-group'.$ib].'</span></p>
                                          </td>';
                          $option .= '</tr>';
                          
                      }
                  echo $option .= '</table>';
             

               ?>  
                 
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