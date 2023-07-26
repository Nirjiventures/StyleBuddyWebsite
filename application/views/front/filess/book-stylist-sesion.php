<?php $this->load->view('Page/template/header'); ?>
<!-- <link href='<?=base_url()?>assets/calender/main.css' rel='stylesheet' />
<script src='<?=base_url()?>assets/calender/main.js'></script> -->
<style type="text/css">
  .quote_form{
    padding: 20px 40px 40px 40px;
    box-shadow: none;
    position: relative;
    margin: -90px 40px 75px 40px;
    box-shadow: -2px 18px 16px -14px #ccc;
  }
  /*.quote_form1:before {
    content: '';
    position: absolute;
    background: rgb(116 46 160 / 25%);
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
  }*/
  .quote_form {
    border-radius: 9px;
  }
  .quote_form .form-control {
    border-radius: 0px;
  }
  .quote_form .note{
    color: #f62ac1;
    text-align: center;
    font-size: 16px;
  }
  .quote_form .note p{
    position: relative;
    display: inline-block;
    margin-bottom: 0px;
  }
  .quote_form .note p:before{
    content: '';
    position: absolute;
    top: 11px;
    left: -28px;
    width: 20px;
    height: 1px;
    background: #d5d5d5;
  }
  .quote_form .note p:after{
    content: '';
    position: absolute;
    top: 11px;
    right: -28px;
    width: 20px;
    height: 1px;
    background: #d5d5d5;
  }
  .con-sec{
    background:#fff8f0;
    padding-top: 60px;
  }
  .text-ap{
    padding: 60px;
  }
  .text-ap h3 span{
    font-size:30px!important;
    color: #f62ac1;
  }
  .text-ap p{
    font-size: 16px;
    margin-top: 20px;
  }
  @media (max-width:767px){
    .text-ap{
        padding: 0px;
    }
    .con-sec{
        padding-top: 40px;
      }
  }
</style>
<?php
  $tax = 0;
  $tax_total = 0;
  
  $description        = "Ask Quote";
  $txnid              = date("YmdHis");     
  $key_id             = ROZARPAY_KEY;
  $currency_code      = $currency_code;            
  $totalCart              = ($package_price * 100) + ($tax * 100); 
  $amountCart             = $package_price + $tax;
  $merchant_order_id  = "STYLE-".date("YmdHis");
?>
<?php
    $table = 'consult_plan';
    $condition = " WHERE id != '0' AND status = 1 ";
    $condition .= " order by id ASC";
    $consult_plan = $this->common_model->get_all_details_query($table,$condition)->result_array();

    $table = 'consult_question';
    $condition = " WHERE status = '1' order by id ASC";
    $list = $this->common_model->get_all_details_query($table,$condition)->result_array();
    $consult_plan_question = $list;

?>
<script>
  var dates = new Array();
</script>
<?php foreach($stylist_availability as $k=>$v){ ?>
  <script>
    dates.push('<?=$v['availability_date']?>');
  </script>
<?php }?>
<script type="text/javascript">
    /*document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('slots');
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      

      if(d<10){
        d = '0'+d
      } 
      if(m<10){
        m = '0'+(m+1)
      } 
    

      today = y+'-'+m+'-'+d;
      var calendar = new FullCalendar.Calendar(calendarEl, {
         
        eventClick: function(arg) {
          console.log(arg.event.title);
          console.log(arg.event.extendedProps);
          var date_id = arg.event.extendedProps.date_id;
          var dd = arg.event.extendedProps.availability_date;
          var tt = arg.event.extendedProps.availability_time; 
          if (dates.includes(dd)){
              $('#datepicker').val(date_id);
              $('#date_Err').html('<h2 class="text-danger">Your selected date : '+dd + ' '+tt+'</h2>');
              $('#date_Err1').html('<h2 class="text-danger">Your selected date : '+dd + ' '+tt+'</h2>');
          }else{
            $('#datepicker').val('');
            $('#date_Err').html('<h2 class="text-danger">Please select available date</h2>');
            $('#date_Err1').html('<h2 class="text-danger">Please select available date</h2>');
          }

           
        },
        select: function(start, end, allDay) {
          if (start.startStr < today) {
            $('#datepicker').val('');
            $('#date_Err').html('<h2 class="text-danger">Please select future date</h2>');
            $('#date_Err1').html('<h2 class="text-danger">Please select future date</h2>');
          }else{
            if (dates.includes(start.startStr)){
                $('#datepicker').val(start.startStr);
                $('#date_Err').html('<h2 class="text-danger">Your selected date : '+start.startStr+'</h2>');
                $('#date_Err1').html('<h2 class="text-danger">Your selected date : '+start.startStr+'</h2>');
            }else{
              $('#datepicker').val('');
              $('#date_Err').html('<h2 class="text-danger">Please select available date</h2>');
              $('#date_Err1').html('<h2 class="text-danger">Please select available date</h2>');
            }
          }
        },
        eventColor: '#378006',
        events: <?=json_encode($stylist_dates_availability)?>,
        editable: true,
        //weekNumbers: true,
        selectable: true,
        //businessHours: true,
        dayMaxEvents: true,
      });
      calendar.render();
    });*/

</script>
<!-- <div class="ab-banner_inner">
    <div class="container text-center"><h1>Connect with us for a customized styling support</h1></div>
</div> -->
<div class="con-sec">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <div class="text-ap">
            <h3>Buy our <span>styling packages</span> today!</h3>
            <p>Subscribe to our annual styling packages to get the best out of the stylebuddy platform.</p>
        </div>
      </div>
      <div class="col-sm-6 text-center">
        <div class="video_part">
            <?php
                $table = 'videos';
                $condition = " WHERE UPPER(on_page) = 'OTHER' AND  status = '1' order by id ASC";
                $videos = $this->common_model->get_all_details_query($table,$condition)->row_array();
                //echo $this->db->last_query();
                
            ?>
            <?php if($videos){ ?>
                <iframe src="https://www.youtube.com/embed?listType=playlist&list=<?=$videos['youtube_url']?>&autoplay=1" width="100%" height="320" frameborder="0"></iframe>
                
            <?php } ?>
	       <!-- <video playsinline="playsinline" loop="loop" controls>
        		<source src="<?php echo base_url(); ?>assets/images/video/stylebuddy-session.mp4#t=0.003" type="video/mp4">
        	  </video>-->
        	  
        	  <!--<div class="con_fee">Consultation <br> <span>Fee <i class="fa fa-inr"></i> 499</span></div>-->
        </div>
        
      </div>
    </div>
  </div>
</div>
<div class="middle_part pt-0">
    <?php 
        function isMobileDevice() {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
        |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
        , $_SERVER["HTTP_USER_AGENT"]);
        }

    ?>
  
    <div class="container mt-5">
        <?php   if(isMobileDevice()){ ?>
            <?php $ij=0;foreach ($consult_plan as $key => $value) { $ij++;?>
                <div class="mobile_package mobile">
                      <?php
                          $package_price_1 =$value['package_price'];
                          $tax_1 = 0;
                          $tax_total_1 = 0;
                          $description_1        = $value['package_name'];
                          $txnid_1              = date("YmdHis");     
                          $key_id_1             = ROZARPAY_KEY;
                          $currency_code_1      = $currency_code;            

                          $totalCart_1              = ($package_price_1 * 100) + ($tax * 100); 
                          $amountCart_1             = ($package_price_1 + $tax);
                          $merchant_order_id_1  = "STYLE-".date("YmdHis");

                          $surl_1 = $consult_surl;
                          $furl_1 = $consult_furl;

                      ?>
                      <div class="hed_pp y_color">
                          <div class="row">
                              <div class="col-sm-12 padd">
                                  <h3><?=$description_1?> <span><i class="fa fa-inr"></i> <?=$package_price_1?></span></h3>
                              </div>
                          </div>
                      </div>
                      <?php $package_description =  json_decode($value['package_description']);?>
                      <?php foreach($package_description as $row) { ?>
                            <div class="hed_pp">
                                <div class="row align-items-center">
                                  <div class="col-sm-8 padd main_color">
                                    <p><?=$row->question_name?></p>
                                    <a data-toggle="tooltip" title="<?=$row->question_name?>" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                  </div>
                                <div class="col-sm-4 padd">
                                  <p><?=$row->question_value?></p>
                                </div>
                              </div>
                            </div> 
                      <?php    } ?>


                      <div class="hed_pp">
                            <div class="row align-items-center">
                                <div class="col-sm-2 padd">
                                    <?php //echo form_open_multipart($consult_callback_url,['id'=>'ask-quote_'.$ij,'name'=>'ask-quote_'.$ij,'method'=>'post']) ?>
                                    <?= form_open_multipart(base_url('page/buypackage/'.base64_encode($value['id'])),['method'=>'post']) ?>
                                      <input type="hidden" name="fname" class="form-control box_in3" value="<?=$loggedRow['fname']?>">
                                      <input type="hidden" name="lname" class="form-control box_in3" value="<?=$loggedRow['fname']?>">
                                      <input type="hidden" name="email" class="form-control box_in3"  value="<?=$loggedRow['email']?>">
                                      <input type="hidden" name="mobile" class="form-control box_in3 onlyInteger" value="<?=$loggedRow['mobile']?>">

                                      <input type="hidden" name="consult_package_id"  value="<?=$value['id']?>"/>
                                      <input type="hidden" name="key_id"  value="<?=$key_id_1?>"/>
                                      <input type="hidden" name="currency" value="<?=$currency_code_1?>"/>
                                      <input type="hidden" name="pay_type"   value="RAZORPAY"/>
                                      <input type="hidden" name="payment_tax" value="<?php echo $tax_1; ?>"/>
                                      <input type="hidden" name="payment_tax_total"  value="<?php echo $tax_total_1; ?>"/>
                                      <input type="hidden" name="grand_total" value="<?php echo $amountCart_1; ?>"/>
                                      <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_<?=$ij?>" />
                                      <input type="hidden" name="merchant_order_id" value="<?php echo $merchant_order_id_1; ?>"/>
                                      <input type="hidden" name="merchant_trans_id" value="<?php echo $txnid_1; ?>"/>
                                      <input type="hidden" name="merchant_product_info_id" value="<?php echo $description_1; ?>"/>
                                      <input type="hidden" name="merchant_surl_id" value="<?php echo $surl_1; ?>"/>
                                      <input type="hidden" name="merchant_furl_id" value="<?php echo $furl_1; ?>"/>
                                      <input type="hidden" name="merchant_total" value="<?php echo $totalCart_1; ?>"/>
                                      <input type="hidden" name="merchant_amount" value="<?php echo $amountCart_1; ?>"/>
                                      <!--<?php if($this->session->userdata('loginUser')){ ?>
                                        <input type="submit" value="Buy Now" class="sub">
                                      <?php }else{ ?> 
                                        <a href="<?= base_url('login') ?>" class="sub">Buy Now</a>
                                      <?php } ?>-->
                                      <input type="submit" value="Buy Now" class="sub">
                                  <?= form_close();?>
                                </div>
                            </div>
                      </div>
                  
                </div>
            <?php }?>
        <?php   }  else { ?>

            <div class="package">
                <div class="hed_pp">
                  <div class="row">
                    <div class="col-sm-6 padd"></div>
                    <?php 
                        $cc = count($consult_plan); 
                        $column = 2;
                        if($cc == 1){
                            $column = 6;
                        }elseif($cc == 2){
                            $column = 3;
                        }
                        
                    ?>
                        
                    <?php foreach ($consult_plan as $key => $value) { ?>
                      <div class="col-sm-<?=$column?> padd">
                          <h3><?=$value['package_name']?> <span><i class="fa fa-inr"></i> <?=$value['package_price']?></span></h3>
                      </div>
                    <?php }?>
                  </div>
                </div>
                <?php foreach ($consult_plan_question as $key => $value) { ?>
                    <div class="hed_pp">
                      <div class="row align-items-center">
                        <div class="col-sm-6 padd main_color">
                          <p><?=$value['name']?></p>
                          <a  data-toggle="tooltip" title="<?=$value['name']?>" ><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        </div>
                        <?php 
                        $cc = count($consult_plan); 
                        $column = 2;
                        if($cc == 1){
                            $column = 6;
                        }elseif($cc == 2){
                            $column = 3;
                        }
                        
                        ?>
                        <?php foreach ($consult_plan as $key1 => $value1) { ?>
                            <div class="col-sm-<?=$column?> padd">
                                <?php $package_description =  json_decode($value1['package_description']);?>
                                <?php
                                   $val = '';
                                   foreach($package_description as $row) {
                                      if ($value['id']  == $row->question_id) {
                                         $val =  $row->question_value;
                                      }
                                   }
                                ?>
                                <p><?= $val ?></p>
                            </div>
                        <?php }?>
                      </div>
                    </div>
                <?php }?>
                <div class="hed_pp">
                  <div class="row align-items-center">
                    <div class="col-sm-6 padd main_color">
                    
                    </div>
                    <?php $ij=0;foreach ($consult_plan as $key => $value) { $ij++;?>
                      <div class="col-sm-2 padd">
                        <?php
                            $package_price_1 =$value['package_price'];
                            $tax_1 = 0;
                            $tax_total_1 = 0;
                            $description_1        = $value['package_name'];
                            $txnid_1              = date("YmdHis");     
                            $key_id_1             = ROZARPAY_KEY;
                            $currency_code_1      = $currency_code;            

                            $totalCart_1              = ($package_price_1 * 100) + ($tax * 100); 
                            $amountCart_1             = ($package_price_1 + $tax);
                            $merchant_order_id_1  = "STYLE-".date("YmdHis");

                            $surl_1 = $consult_surl;
                            $furl_1 = $consult_furl;

                        ?>
                        <?php //echo form_open_multipart($consult_callback_url,['id'=>'ask-quote_'.$ij,'name'=>'ask-quote_'.$ij,'method'=>'post']) ?>
                        <?= form_open_multipart(base_url('page/buypackage/'.base64_encode($value['id'])),['method'=>'post']) ?>
                            <input type="hidden" name="fname" class="form-control box_in3" value="<?=$loggedRow['fname']?>">
                            <input type="hidden" name="lname" class="form-control box_in3" value="<?=$loggedRow['fname']?>">
                            <input type="hidden" name="email" class="form-control box_in3"  value="<?=$loggedRow['email']?>">
                            <input type="hidden" name="mobile" class="form-control box_in3 onlyInteger" value="<?=$loggedRow['mobile']?>">

                            <input type="hidden" name="consult_package_id"  value="<?=$value['id']?>"/>
                            <input type="hidden" name="key_id"  value="<?=$key_id_1?>"/>
                            <input type="hidden" name="currency" value="<?=$currency_code_1?>"/>
                            <input type="hidden" name="pay_type"   value="RAZORPAY"/>
                            <input type="hidden" name="payment_tax" value="<?php echo $tax_1; ?>"/>
                            <input type="hidden" name="payment_tax_total"  value="<?php echo $tax_total_1; ?>"/>
                            <input type="hidden" name="grand_total" value="<?php echo $amountCart_1; ?>"/>
                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id_<?=$ij?>" />
                            <input type="hidden" name="merchant_order_id" value="<?php echo $merchant_order_id_1; ?>"/>
                            <input type="hidden" name="merchant_trans_id" value="<?php echo $txnid_1; ?>"/>
                            <input type="hidden" name="merchant_product_info_id" value="<?php echo $description_1; ?>"/>
                            <input type="hidden" name="merchant_surl_id" value="<?php echo $surl_1; ?>"/>
                            <input type="hidden" name="merchant_furl_id" value="<?php echo $furl_1; ?>"/>
                            <input type="hidden" name="merchant_total" value="<?php echo $totalCart_1; ?>"/>
                            <input type="hidden" name="merchant_amount" value="<?php echo $amountCart_1; ?>"/>
                            <!--<?php if($this->session->userdata('loginUser')){ ?>
                              <input type="submit" value="Buy Now" class="sub">
                            <?php }else{ ?> 
                              <a href="<?= base_url('login') ?>" class="sub">Buy Now</a>
                            <?php } ?>-->
                            <input type="submit" value="Buy Now" class="sub">
                        <?= form_close();?>
                      </div>
                    <?php }?>
                  </div>
                </div>
            </div>
        <?php   } ?>
    </div>
    <div class="container">
         <div class="row justify-content-center">
           
            <div class="col-sm-8 p-0">
                 <div class="why_book">
                     <h1>Why book a styling session with us?</h1>
                     <ul>
                         <li>To finally solve the problem of shopping yourself. Instead of you spending hours on shopping, we will shop for you personally. </li>
                         <li>To give you a easy, simple and effective insight about which style suits you the most from thousands of combinations. </li>
                         <li>To boost your overall appearance, confidence and personality, no matter how young or old you are. </li>
                         <li>With each stylist having 10+ yrs. of experience, expect quality and value for money insight. </li>
                     </ul>
                 </div>
            </div>
        </div>
    </div>
    
    <div class="container" style="display:none">
        <?= form_open_multipart($callback_url,['id'=>'ask-quote','name'=>'ask-quote','method'=>'post']) ?>
         
        <div class="row justify-content-center">
           
          <div class="col-sm-8 p-0">

            <div class="quote_form">
              <div class="input-group mb-3">
                <div id="myRadioGroup" class="text-center">
                    <div id="success_msg"></div>
                    <?php   
                        if($this->session->flashdata('success')){
                            echo $this->session->flashdata('success');
                            header('Refresh: 5; URL='.$this->session->flashdata('lastUrl'));
                            header('Refresh: 5; URL='.base_url('select-service'));
                        }
                    ?>
                </div>
              </div>
              
              <div id="Quote22" class="desc">
                  <input type="hidden" id="lastPage" name="lastPage" value="<?=$lastPage?>">
                  <input type="hidden" id="stylist_id" name="stylist_id" value="<?=$this->uri->segment(2)?>">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group boot_sp">
                          <label class="form-control-placeholder2">First Name</label>
                          <input type="text" id="fname" name="fname" class="form-control box_in3" value="<?=$loggedRow['fname']?>">
                          
                          <div id='fname_err'></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group boot_sp">
                          <label class="form-control-placeholder2">Last Name</label>
                          <input type="text" id="lname" name="lname" class="form-control box_in3"  value="<?=$loggedRow['lname']?>">
                          
                          <div id='lname_err'></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group boot_sp">
                          <label class="form-control-placeholder2">Email</label>
                          <input type="text" id="email" name="email" class="form-control box_in3"  value="<?=$loggedRow['email']?>">
                          
                          <div id='email_err'></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group boot_sp">
                          <label class="form-control-placeholder2">Mobile</label>
                          <input type="tel" id="mobile" name="mobile" class="form-control box_in3 onlyInteger" value="<?=$loggedRow['mobile']?>">
                          
                          <div id='mobile_err'></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group boot_sp">
                        <label class="form-control-placeholder2">City</label>
                          <input type="text" id="city" name="city" class="form-control box_in3"  value="<?=$loggedRow['city_name']?>">
                          
                          <div id='city_err'></div>
                        </div>
                    </div>

                     
                    <div class="col-sm-4">
                       <div class="form-group boot_sp">
                          <label class="form-control-placeholder2">Consultation Topic</label>
                          <select id="area_expertise" name="area_expertise" class="form-control box_in3">
                            <option value="Styling for wedding">Styling For Wedding</option>
                            <option value="Styling for parties">Styling For Parties</option>
                            <option value="Styling for business meetings">Styling For Business Meetings</option>
                            <option value="Styling for photoshoot and modelling">Styling For Photoshoot and Modelling</option>
                            <option value="Styling for festivals">Styling For Festivals</option>
                            <option value="Styling for birthday parties">Styling For Birthday Parties</option>
                            <option value="Styling for date">Styling For Date</option>
                            <option value="Need help with Shopping">Need Help With Shopping</option>
                            <option value="Need help with wardrobe refresh">Need Help With Wardrobe Refresh</option>
                            <option value="Complete image-makeover">Complete image-makeover</option>
                            <option value="Looking for designer outfits">Looking for designer outfits</option>
                            <option value="others">Others</option>
                            <!-- <?php foreach ($area_expertise as $key => $value) { ?>
                                <option value="<?=$value['name']?>"><?=$value['name']?></option>
                            <?php }?> -->
                          </select>
                          
                          <div id='area_err'></div>
                        </div>
                    </div>

                  </div>
                  <!-- <div id="date_Err1" class="mb-3"></div>   -->    
                  <div class="form-group boot_sp">
                            <label class="form-control-placeholder2">Message</label>
                            <textarea class="form-control box_in3" id="message" name="message" rows="5" style="height:100px!important;"></textarea>
                            
                            <div id='message_err'></div>
                  </div>
                  <div class="col-sm-12">
                    <div class="note">
                      <p><b>Consultation Fee INR &#8377;499</b></p>
                    </div>
                  </div>


                  <input type="hidden" name="currency" id="currency" value="<?=$currency_code?>"/>
                  <input type="hidden" name="pay_type" id="pay_type" value="RAZORPAY"/>
                  <input type="hidden" name="payment_tax" id="payment_tax" value="<?php echo $tax; ?>"/>
                  <input type="hidden" name="payment_tax_total" id="payment_tax_total" value="<?php echo $tax_total; ?>"/>
                  <input type="hidden" name="grand_total" id="grand_total" value="<?php echo $amountCart; ?>"/>
                  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
                  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
                  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $totalCart; ?>"/>
                  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amountCart; ?>"/>
                      
                  

                  <?php $venderId = base64_decode(str_replace('uOiEa', '', $this->uri->segment(2))); ?>
                  <?php if($this->session->userdata('loginUser')){ ?>
                    <?php if($this->session->userdata('userId') != $venderId ){ ?>
                      <input type="submit" value="BUY NOW" class="sub">
                    <?php }else{ ?> 
                      <a href="#" class="sub"> OWN Profile</a>
                    <?php } ?>
                  <?php }else{ ?> 
                    <input type="submit" value="Book now" class="sub">
                  <?php } ?>
                  
                  
              </div>
               
            </div>
          </div>
        </div>
        <?= form_close(); ?>  
    </div>
</div>

<?php $this->load->view('Page/template/footer'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    
    $(function() {
      $( "#city" ).autocomplete({
        minLength: 2,
        source: "<?=base_url('page/cities')?>",
        select: function( event, ui ) {
          event.preventDefault();
          console.log(ui.item);
          $("#city").val((ui.item.value));
          //$('#FormStylist').attr('action','<?=base_url('stylist-and-expert/'.$this->uri->segment(2).'/')?>'+ui.item.id);
        }
      });
    });

</script>
<script type="text/javascript">
  $(document).ready(function() {
  var razorpay_pay_btn, instance;
  $('#ask-quote').on('submit',function(e){
      e.preventDefault();

      $('#fname_err').html('');
      $('#lname_err').html('');
      $('#mobile_err').html('');
      $('#email_err').html('');
      $('#city_err').html('');
      $('#message_err').html('');
      

      if($('#fname').val() == '' || $('#fname').val().trim().length == '') {
          $('#fname_err').html('<span class="text-danger">Please enter your first name</span>');
          $('#fname').focus();
          return false;
      } else if($('#lname').val() == '' || $('#lname').val().trim().length == '') {
          $('#lname_err').html('<span class="text-danger">Please enter your last name</span>');
          $('#lname').focus();
          return false;
      } else if($('#email').val() == '') {
          $('#email_err').html('<span class="text-danger">Please enter email</span>');
          $('#email').focus();
          return false; 
      } else if(!IsEmail($('#email').val())) {
          $('#email_err').html('<span class="text-danger">Please enter correct email</span>');
          $('#email').focus();
          return false; 
      }else if ($('#mobile').val() == '' || $('#mobile').val().trim().length == '') { 
        $('#mobile_err').html('<span class="text-danger">Please enter mobile number</span>') 
        $('#mobile').focus();
        return false; 
      }else if ($('#city').val() == '' || $('#city').val().trim().length == '') { 
        $('#city_err').html('<span class="text-danger">Please enter select city</span>') 
        $('#city').focus();
        return false; 
      }else if ($('#area_expertise').val() == '' || $('#area_expertise').val().trim().length == '') { 
        $('#area_err').html('<span class="text-danger">Please Select Consultation Topic</span>') 
        $('#area_expertise').focus();
        return false; 
      }else if ($('#message').val() == '' || $('#message').val().trim().length == '') { 
        $('#message_err').html('<span class="text-danger">Please enter message</span>') 
        $('#message').focus();
        return false; 
      }else{
        /*$('#ask-quote').get(0).submit();
        return true;*/
        var name = document.getElementById('fname').value + ' ' +document.getElementById('lname').value;

          var email = document.getElementById('email').value;

          var mobile = document.getElementById('mobile').value;



          var options = {

                key:            "<?php echo $key_id; ?>",

                amount:         "<?php echo $totalCart; ?>",

                name:           name,

                description:    "Order # <?php echo $merchant_order_id; ?>",

                netbanking:     true,

                currency:       "<?php echo $currency_code; ?>", // INR

                prefill: {

                    name:       name,

                    email:      email,

                    contact:    mobile

                },

                notes: {

                    soolegal_order_id: "<?php echo $merchant_order_id; ?>",

                },

                handler: function (transaction) {

                    document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;

                    document.getElementById('ask-quote').submit();

                },

                "modal": {

                    "ondismiss": function(){

                        location.reload()

                    }

                }

            };





            if(typeof Razorpay == 'undefined') {

                setTimeout(razorpaySubmit, 200);

                if(!razorpay_pay_btn && el) {

                    razorpay_pay_btn    = el;

                    el.disabled         = true;

                    el.value            = 'Please wait...';  

                }

            } else {

                if(!instance) {

                    instance = new Razorpay(options);

                    if(razorpay_pay_btn) {

                    razorpay_pay_btn.disabled   = false;

                    razorpay_pay_btn.value      = "Pay Now";

                    }

                }

                instance.open();

            }
      }
  });    
  $("input[name$='quote']").click(function() {
      var test = $(this).val();
      $("div.desc").hide();
      $("#Quote" + test).show();
  });
});

  $('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    })
    function validateAlphabet(value) {         
        var regexp = /^[a-zA-Z ]*$/;         
        return regexp.test(value);    
    }
  function checkWord(id,count){
    var words= $('#'+id).val().length;
      if (words > count) {
        $('#'+id+'_err').html('');
      }else{
        $('#'+id+'_err').html('<span class="text-danger">' + (words + 1) + ' character. Please enter minimum '+count + ' character.</span>');
         
      }
      
    }
  function IsEmail(email) {     
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       
        return regex.test(email);   
    }
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
	$(document).ready(function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]',placement: 'right' });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      var razorpay_pay_btn, instance;
      $('#ask-quote_1').on('submit',function(e){
          e.preventDefault();
          var name = this.fname.value +' '+this.lname.value;
          var email = this.email.value;
          var mobile = this.mobile.value;


          var options = {
                 
                key:            this.key_id.value,
                amount:         this.merchant_total.value,
                name:           name,
                description:    "Order # "+this.merchant_order_id.value,
                netbanking:     true,
                currency:       this.currency.value,
                prefill: {
                    name:       name,
                    email:      email,
                    contact:    mobile
                },
                notes: {
                    soolegal_order_id: this.merchant_order_id.value,
                },
                handler: function (transaction) {
                    document.getElementById('razorpay_payment_id_1').value = transaction.razorpay_payment_id;
                    document.getElementById('ask-quote_1').submit();
                },
                "modal": {
                    "ondismiss": function(){
                        location.reload()
                    }
                }
            };
            if(typeof Razorpay == 'undefined') {
                setTimeout(razorpaySubmit, 200);
                if(!razorpay_pay_btn && el) {
                    razorpay_pay_btn    = el;
                    el.disabled         = true;
                    el.value            = 'Please wait...';  
                }
            } else {
                if(!instance) {
                    instance = new Razorpay(options);
                    if(razorpay_pay_btn) {
                      razorpay_pay_btn.disabled   = false;
                      razorpay_pay_btn.value      = "Pay Now";
                    }
                }
                instance.open();
            }
           

      }); 
      $('#ask-quote_2').on('submit',function(e){
          e.preventDefault();
          var name = this.fname.value +' '+this.lname.value;
          var email = this.email.value;
          var mobile = this.mobile.value;
          var options = {
                key:            this.key_id.value,
                amount:         this.merchant_total.value,
                name:           name,
                description:    "Order # "+this.merchant_order_id.value,
                netbanking:     true,
                currency:       this.currency.value,
                prefill: {
                    name:       name,
                    email:      email,
                    contact:    mobile
                },
                notes: {
                    soolegal_order_id: this.merchant_order_id.value,
                },
                handler: function (transaction) {
                    document.getElementById('razorpay_payment_id_2').value = transaction.razorpay_payment_id;
                    document.getElementById('ask-quote_2').submit();
                },
                "modal": {
                    "ondismiss": function(){
                        location.reload()
                    }
                }
            };
          if(typeof Razorpay == 'undefined') {
              setTimeout(razorpaySubmit, 200);
              if(!razorpay_pay_btn && el) {
                  razorpay_pay_btn    = el;
                  el.disabled         = true;
                  el.value            = 'Please wait...';  
              }
          } else {
              if(!instance) {
                  instance = new Razorpay(options);
                  if(razorpay_pay_btn) {
                    razorpay_pay_btn.disabled   = false;
                    razorpay_pay_btn.value      = "Pay Now";
                  }
              }
              instance.open();
          }
          

      }); 
      $('#ask-quote_3').on('submit',function(e){
          e.preventDefault();
          var name = this.fname.value +' '+this.lname.value;
          var email = this.email.value;
          var mobile = this.mobile.value;
          var options = {
                key:            this.key_id.value,
                amount:         this.merchant_total.value,
                name:           name,
                description:    "Order # "+this.merchant_order_id.value,
                netbanking:     true,
                currency:       this.currency.value,
                prefill: {
                    name:       name,
                    email:      email,
                    contact:    mobile
                },
                notes: {
                    soolegal_order_id: this.merchant_order_id.value,
                },
                handler: function (transaction) {
                    document.getElementById('razorpay_payment_id_3').value = transaction.razorpay_payment_id;
                    document.getElementById('ask-quote_3').submit();
                },
                "modal": {
                    "ondismiss": function(){
                        location.reload()
                    }
                }
            };
          if(typeof Razorpay == 'undefined') {
              setTimeout(razorpaySubmit, 200);
              if(!razorpay_pay_btn && el) {
                  razorpay_pay_btn    = el;
                  el.disabled         = true;
                  el.value            = 'Please wait...';  
              }
          } else {
              if(!instance) {
                  instance = new Razorpay(options);
                  if(razorpay_pay_btn) {
                    razorpay_pay_btn.disabled   = false;
                    razorpay_pay_btn.value      = "Pay Now";
                  }
              }
              instance.open();
          }
      }); 
    });
</script>

