<?php $this->load->view('admin/template/header'); ?>
<?php $url1  =$this->uri->segment(1);?>
<?php $url2  =$this->uri->segment(2);?>
<?php $url3  =$this->uri->segment(3);?>
  <?php 

$url1 = $this->uri->segment(1);

$url2 = $this->uri->segment(2);

$url3 = $this->uri->segment(3);





?>

  <main class="main-content">
    <section class="user-area">
      <div class="container-fluid">
        <div class="">
          <div class="summery_order">
							<div class="row">
								<div class="col-sm-9">
								</div>
								<div class="col-sm-3 text-center">
									<p><a href="<?= base_url($url1.'/'.$url2) ?>" class="btn btn-secondary"><i class="fa fa-long-arrow-left" ></i> Back to Order List</a></p>

								</div>

							</div>

							<hr>

							<div class="row">		

								<div class="col-md-10 jk">	

								<span class="text-center mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>

									<?=$result;?>

								</div>

							</div>

							
					

				  </div>

					

					

        </div>

	    </div>

	  </section>

    <!--== End Contact Area ==-->



  

  

  </main>



  <!--== Start Footer Area Wrapper ==-->


<?php $this->load->view('admin/template/footer'); ?>