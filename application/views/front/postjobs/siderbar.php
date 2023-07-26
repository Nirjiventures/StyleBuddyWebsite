
<div class="sidebar " id="mySidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	
	<div  class="uskk_new" >
		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url()?><?= ($datas->image)?"/assets/images/vandor/$datas->image":"assets/images/no-image.jpg" ?> " class="img-fluid">	
		<h4><?= $datas->fname.' '.$datas->lname ?></h4>
		<p><?= $datas->email ?></p>
	</div>


	<ul>
		<li><a href="<?= base_url('postjob/index') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard </a></li>
		<li><a href="<?= base_url('postjob/profile') ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
		<li><a href="<?= base_url('postjob/addjob') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Post Jobs</a></li>
		<li><a href="<?= base_url('postjob/managejobs') ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Manage Jobs</a></li>
		<li><a href="<?= base_url('postjob/subscriptions') ?>"><i class="fa fa-server" aria-hidden="true"></i> Subscriptions</a></li>
		<li><a href="<?= base_url('postjob/managesubscriptions') ?>"><i class="fa fa fa-server" aria-hidden="true"></i>Manage Subscriptions</a></li>
		<li><a href="<?= base_url('postjob/consultationorder') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Consultation order</a></li>
		<li><a href="<?= base_url('postjob/setting') ?>"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
		<li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>
	</ul>

</div>


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