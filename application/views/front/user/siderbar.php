<style type="text/css">
	.fg_gp span {
	     float: left; 
	}
	body{zoom: 100%;}
</style>
<div class="sidebar" id="mySidenav">

	<div  class="uskk_new">
    <?php 
      if($datas->social_id){
        $fImage = $datas->image;
      } else{
          if($datas->image){
            $img = "assets/images/vandor/".$datas->image;
          }else{
            $img = "assets/images/no-image.jpg";
          }
          $fImage = base_url($img);
      }
    ?>


		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= $fImage?>" class="img-fluid">	
		<p><?= $datas->fname.' '.$datas->lname ?><br><?= $datas->email ?></p>
		
		
	</div>

	<ul>
		<li><a href="<?= base_url('user/user-dashboard') ?>">My Dashboard </a></li>
		<li><a href="<?= base_url('user/user-profile') ?>">Edit Profile</a></li>
		<li><a href="<?= base_url('user/stylingreport') ?>">My Styling Reports</a></li>
		<li><a href="<?= base_url('user/myserviceorder') ?>"> Styling Service Order</a></li>
		<li><a href="<?= base_url('user/myshoporder') ?>"> Shop Orders</a></li>
		<li><a href="<?= base_url('user/giftorder') ?>"> Purchased Gifts</a></li>
		<li><a href="<?= base_url('user/user-wishlist') ?>"> My Wishlist</a></li>
		
		<!--<li><a href="<?= base_url('user/consultorder') ?>"> Consultation order</a></li>-->
		
		<li><a href="<?= base_url('user/user-setting') ?>"> Settings</a></li>
		<li><a href="<?= base_url('logout') ?>"> Logout</a></li>
	</ul>
</div>

<?php $this->load->view('front/template/pop-up'); ?>



<script>

		$(document).ready(function() {

		  	$('#sidebar-btn').on('click', function() {

			$('#my_menu').toggleClass('visible');

		  	});

		  	$('#sidebar-close').on('click', function() {

				$('#my_menu').removeClass('visible');

		  	});

		});

	</script>



	<script>

	$(function(){

  var $ul   =   $('.sidebar-navigation > ul');

  

  $ul.find('li a').click(function(e){

    var $li = $(this).parent();

    

    if($li.find('ul').length > 0){

      e.preventDefault();

      

      if($li.hasClass('selected')){

        $li.removeClass('selected').find('li').removeClass('selected');

        $li.find('ul').slideUp(400);

        $li.find('a em').removeClass('mdi-flip-v');

      }else{

        

        if($li.parents('li.selected').length == 0){

          $ul.find('li').removeClass('selected');

          $ul.find('ul').slideUp(400);

          $ul.find('li a em').removeClass('mdi-flip-v');

        }else{

          $li.parent().find('li').removeClass('selected');

          $li.parent().find('> li ul').slideUp(400);

          $li.parent().find('> li a em').removeClass('mdi-flip-v');

        }

        

        $li.addClass('selected');

        $li.find('>ul').slideDown(400);

        $li.find('>a>em').addClass('mdi-flip-v');

      }

    }

  });

  

  

  $('.sidebar-navigation > ul ul').each(function(i){

    if($(this).find('>li>ul').length > 0){

      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');

      var pIntPLeft   = parseInt(paddingLeft);

      var result      = pIntPLeft + 20;

      

      $(this).find('>li>a').css('padding-left',result);

    }else{

      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');

      var pIntPLeft   = parseInt(paddingLeft);

      var result      = pIntPLeft + 20;

      

      $(this).find('>li>a').css('padding-left',result).parent().addClass('selected--last');

    }

  });

  

  var t = ' li > ul ';

  for(var i=1;i<=10;i++){

    $('.sidebar-navigation > ul > ' + t.repeat(i)).addClass('subMenuColor' + i);

  }

  

  var activeLi = $('li.selected');

  if(activeLi.length){

    opener(activeLi);

  }

  

  function opener(li){

    var ul = li.closest('ul');

    if(ul.length){

      

        li.addClass('selected');

        ul.addClass('open');

        li.find('>a>em').addClass('mdi-flip-v');

      

      if(ul.closest('li').length){

        opener(ul.closest('li'));

      }else{

        return false;

      }

      

    }

  }

  

});

</script>