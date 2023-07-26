<!DOCTYPE html>
<html>
   <head>
       <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">
      <title>Admin Login</title>
      <?php echo link_tag('assets/admin/vendor/bootstrap/css/bootstrap.min.css');?>
      <?php echo link_tag('assets/admin/css/admin.css');?>
        <style type="text/css">
           .toggle-password {
               float: right;
               cursor: pointer;
               margin-right: 14px;
               margin-top: -30px;
               position: relative;
           }
        </style>
   </head>
   <body class="body_bg">
      <div class="container">
         <div class="row">
            
               <div class="log_in shadow mt-50">
                  <div class="col-sm-12 text-center"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" style="width: 160px; margin-bottom: 0px;"></div>
                  <div class="clearfix"></div>


                  <?php if( $this->session->flashdata('message') ) {?>
                  <span class="text-center text-danger mb-3"> <?php  echo $this->session->flashdata('message') ; ?></span>
                  <?php }?>
                  <?php echo form_open('stylebuddy-admin',['id'=>'myform'])?>
                  
                  <div class="form-group">
                      <label>Email Id</label>
                     <input type="text" name="email" id="email"  class="form-control box_in3" autocomplete="off" placeholder="">
                     <?php echo form_error('email','<span class="text-danger mt-1">','</span>') ;?>  
                     
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                     <input type="Password" name="password" id="password"  class="form-control box_in3" autocomplete="off" placeholder="">
                     <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                     <?php echo form_error('password','<span class="text-danger mt-1">','</span>') ;?>
                     
                  </div>
                  <div class="form-group">
                     <input type=submit name="submit" class="btn  sub">
                   </div>
                   <div class="col-sm-12 text-center link"><a href="<?= base_url(); ?>" target="_blank" class="text-decoration-none font-weight-bolder">Go To Home</a></div>
                  <?php echo form_close()?>
               </div>
            
         </div>
      </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- <script src="<?php echo base_url('assets/admin/vendor/jquery.min.js')?>"></script> -->
      <script src="<?php echo base_url('assets/admin/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
   </body>
</html>

<script type="text/javascript">
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type").toUpperCase() == "PASSWORD") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>