<!DOCTYPE html>
<html lang="en">
<head>
  <title>Stylist Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  
  <link href="<?= base_url(); ?>assets/ui/vendor/dashboard.css?dev=<?=time();?>" rel="stylesheet">
   <script src="<?= base_url(); ?>assets/ui/main.js?dev=<?=time();?>"></script>

  <script>
    jQuery(function($) {
      var path = window.location.href; 
      $('ul li a').each(function() {
      if (this.href === path) {
        $(this).addClass('active_m');
      }
      });
    });
  </script>
   <script type="text/javascript">

        (function(c,l,a,r,i,t,y){
    
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
    
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
    
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    
        })(window, document, "clarity", "script", "fuxdf24vng");
    
    </script> 
     <script src="<?=base_url('assets/js/main.js')?>"></script>
  </head>
  <body>
  <span class="mobile-nav" onclick="openNav()">&#9776; Menu</span>
  <div class="sidebar" id="mySidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div class="uskk "> 
        <?php if($profile->image) { ?>
          <a target="_blank"  href="<?=base_url('stylists/'.base64_encode($profile->id).'/'.strtolower($profile->fname.'-'.$profile->lname))?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/vandor/').$profile->image ?>" class="img-fluid"></a>
        <?php } else { ?>
          <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/no-image.jpg" class="img-fluid">
        <?php } ?>
          
        <h4><?= strtoupper($profile->fname.' '.$profile->lname) ?></h4>
        <p>Email id : <?= $profile->email ?></p>
        <a href="<?= base_url() ?>"class="btn btn-info ">Go to Website</a>

      </div>
      <ul>
          <li><a href="<?= base_url('boutiques/setting') ?>"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
          <li><a target="_blank"  href="<?= base_url('service-provider-agreement') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Service Provider Agreement</a></li>
          <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>
      </ul>
  </div>



<style type="text/css">
  .nav-link:focus, .nav-link:hover {
    color: #f7f3da!important;
  }
  ul#submenu3 {
      padding-left: 50px;
  }
</style>