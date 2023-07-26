<?php $this->load->view('front/template/header'); ?>
<div class="container-fluid p-0">
	<div class="">
		<div class="row m-0 row-flex justify-content-end">
			<div class="col-sm-3 p-0 black_bg">
				<?php $this->load->view('front/postjobs/siderbar'); ?>
			</div>
			<div class="col-sm-9 p-0">
				<div class="rightbar1 ">
					 
						<h2>Subscriptions</h2>
						<h3><?=$title?></h3>
						<p></p>
						<hr>
 
		 
						<?php 
				            if ($order) {
				                echo $result;
				            }else{
				                echo $message;
				            }
						?>
					
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function submitForm(id){
		document.getElementById(id).submit();
	}
</script>
</body>
</html>