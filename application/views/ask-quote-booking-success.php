<?php  $this->load->view('Page/template/header'); ?>

<style type="text/css">

	.ab-banner_inner {

    padding: 40px 0px!important;

    display: inline-grid;

    width: 100%;

}

</style>

<div class="banner_inner ab-banner_inner">

	<div class="container">

		<div class="text-center">

			<h3><?=$title?></h3>

		</div>
		<div class="text-center">
			<a href="<?=base_url()?>" class="action_bt_2">Back To Home</a>
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

	</div>

</div>

<?php $this->load->view('Page/template/footer'); ?>