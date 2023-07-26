<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;500&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <link href="<?= base_url(); ?>assets/ui/user/dashboard.css?dev=<?=time();?>" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/ui/main.js?dev=<?=time();?>"></script>

    <link href="<?= base_url() ?>assets/css/ecommerce.css?dev=<?=time();?>" rel="stylesheet">
    <script>
    	jQuery(function($) {
    	   var path = window.location.href; 
    	   // because the 'href' property of the DOM element is the absolute path
    	   $('ul li a').each(function() {
    		  if (this.href === path) {
    		      $(this).addClass('active_m');
    		  }
    	   });
    	});

    </script>
<script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
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