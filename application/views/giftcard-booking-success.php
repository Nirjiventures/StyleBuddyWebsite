<?php  $this->load->view('front/template/header'); ?>


<div class="banner_inner ab-banner_inner">



	<div class="container">



		<div class="text-center">



			<h3><?=$title?></h3>



		</div>



	</div>



</div>







<div class="middle_part">



	<div class="container">



		 



		<?php 



            if ($order) {



                echo $result;



            }else{



                echo $message;



            }



		?>
		<div class="text-center">
			<a href="<?=base_url()?>" class="action_bt_2">Back To Home</a>
		</div>


	</div>



</div>



<?php $this->load->view('front/template/footer'); ?>