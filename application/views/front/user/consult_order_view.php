<?php $this->load->view('front/template/header'); ?>

<div class="container-fluid p-0">

	<div>

		<div class="row m-0 justify-content-end">

			<div class="col-sm-3 p-0 black_bg">

				<div class="sidebar">

				<?php $this->load->view('Page/user/siderbar'); ?>

				</div>

			</div>

			<div class="col-sm-9">

    			<div class="rightbar1">

    			    

                    <?php 

                        $url1 = $this->uri->segment(1);

                        $url2 = $this->uri->segment(2);

                        $url3 = $this->uri->segment(3);

                    ?>

                    

                    <div class="container">

    					<div class="row">

    						<div class="col-sm-9">

    							<h3>Order Summary</h3>

    						</div>

    						<div class="col-sm-3 text-end">

    							<a href="<?=base_url('user/user-dashboard')?>" class="btn btn-primary add_pro"><i class="fa fa-home" aria-hidden="true"></i> Home</a>

    							&nbsp; - &nbsp; 

    							<a href="<?=base_url('user/consultorder')?>" class="btn btn-success add_pro"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>

    						</div>

    					</div>

    					<hr>

    				</div>

    				 

                    <div class="container">

                        <div class="summery_order">
				 
							<?=$result;?>
						</div>

    				</div>

        	             

                </div>

            </div>

		</div>

	</div>

</div>
<?php $this->load->view('front/template/footer'); ?>