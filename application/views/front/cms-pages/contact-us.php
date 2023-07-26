<div class="banner_inner">
	<div class="container">
		<h1><?= ucwords($cmsData->title) ?></h1>
        <?php 
			$this->breadcrumb = new Breadcrumbcomponent();
			$this->breadcrumb->add('Home', base_url());
			$this->breadcrumb->add('Conatct Us', base_url('contact-us'));
		?>
		<?php echo $this->breadcrumb->output(); ?>
	</div>
</div>
<div class="middle_part">
	<div class="container">	
		
			<div class="col-12 text-center if_you ">
				
					<p>If you need help with Styling or wish to join our fast-growing team of fashion industry professionals, <br>
					<b>pls drop us a message on <a href="tel:<?= $this->site->mobile ?>"> <?= $this->site->mobile ?></a> or write to us at <a href="mailto:<?= $this->site->email ?>"><?= $this->site->email ?></a></b></p>

					
			</div>

			
			<div class="row  contact justify-content-center">
			 

			<div class="col-sm-3">
				<div class="ct-box">
		            <div class="info">
		              <p><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?= $this->site->address ?></p>
		            </div>
		        </div>
		        <div class="ct-box">
		            <div class="info">
		              <p><i class="fa-solid fa-phone"></i> <a href="tel:<?= $this->site->mobile ?>"><?= $this->site->mobile ?></a></p>
		            </div>
		        </div>
		        <div class="ct-box">
		            <div class="info">
		              <p><i class="fas fa-envelope-open-text" aria-hidden="true"></i> <a href="mailto:<?= $this->site->email ?>" class="mail"><?= $this->site->email ?></a></p>
		            </div>
		        </div>
		        <h6>Follow Us</h6>
		        <div class="soical_m_contact">
			        <ul>
			        	<li><a target="_blank" href="<?= $this->site->facebook ?>"><i class="fab fa-facebook-f"></i></a></li>
			        	<li><a target="_blank" href="<?= $this->site->youtube ?>"><i class="fab fa-youtube"></i></a></li>
			        	<li><a target="_blank" href="<?= $this->site->instagram ?>"><i class="fab fa-instagram"></i></a></li>
			        	<li><a target="_blank" href="<?= $this->site->linkedin ?>"><i class="fab fa-linkedin-in"></i></a></li>
			    	</ul>
			    </div>
			</div>
			<div class="col-sm-8">
				<div class="fq-form">
					<h4>GET IN TOUCH</h4>
					<?php echo $this->session->flashdata('message');?>
				    <?= form_open('',['id'=>'223233232']) ?>
					    <div class="row">
					    	<div class="col-sm-6">
					    		<div class="form-group fg_gp">
									<input type="text" name="name" value="<?php if(set_value('name')) { echo set_value('name');}?>" placeholder="Your Name" class="box_new" required  onkeypress="return IsAlphaNumeric(event,'name_err');">
									<i class="fa fa-user"></i>
									<div id="name_err"></div>
								</div>
					    	</div>
					    	<div class="col-sm-6">
					    		<div class="form-group fg_gp">
									<input type="email" name="email" value="<?php if(set_value('email')) { echo set_value('email');}?>" placeholder="Your Email" class="box_new" required>
									<i class="fa fa-envelope"></i>
									<div id="email_err"></div>
								</div>
					    	</div>
					    	<div class="col-sm-6">
					    		<div class="form-group fg_gp">
									<input type="text" name="subject" value="<?php if(set_value('subject')) { echo set_value('subject');}?>" placeholder="Subject" class="box_new">
									<i class="fa fa-book"></i>
								</div>
					    	</div>
					    	<div class="col-sm-6">
					    		<div class="form-group fg_gp">
									<input type="url" name="url" value="<?php if(set_value('url')) { echo set_value('url');}?>" placeholder="Portfolio URL" class="box_new">
									<i class="fa fa-globe"></i>
								</div>
					    	</div>
					    	<div class="col-sm-12">
					    		<div class="form-group fg_gp">
									<textarea class="box_text3" value="<?php if(set_value('message')) { echo set_value('message');}?>" placeholder="Message" name="message" rows="4"><?php if(set_value('message')) { echo set_value('message');}?></textarea>
									<i class="fa fa-edit"></i>
								</div>
					    	</div>
					    	<div class="col-sm-5">
                				<div class="form-group boot_sp fg_gp">
                					<input  type="text" name="captcha" style="padding: 12px;" maxlength="10" placeholder="Enter captcha Code" class="box_new" required>
                				</div>
                			</div>
                
                			<div class="col-sm-5">
                					<span id="captImg"><?php echo $captchaImg; ?></span> <a href="javascript:void(0);" class="refreshCaptcha"><i class="fa fa-refresh" aria-hidden="true" style="margin-left: 20px;"></i></a>
                			</div>
                			
					    	<div class="col-sm-12 text-center mt-2">
					    		<div class="form-group">
									<input type="submit" value="Submit" class="subscribe_bt">
									<div id="success_msg"></div>
								</div>
					    	</div>
					    </div>
					<?= form_close(); ?>
				</div>
			</div>
				
		</div>
		<div class="">
			<div class="">
				
			</div>
		</div>
	</div>
</div>

<div class="map-iframe mt-5">
	                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224409.95626650137!2d77.01216398742831!3d28.497443242431952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d23844277659d%3A0xd26134df41971636!2sSpaze%20Platinum%20Tower!5e0!3m2!1sen!2sin!4v1654766157427!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	            </div>
<script type="text/javascript">
	$(document).ready(function(){
        $('.refreshCaptcha').on('click', function(){
            pageLoad();
        });
    });
    function pageLoad(){
        $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
            result = $.parseJSON(data);
            $('#captImg').html(result.image);
            //console.log(result);
        });
    }
    window.onload = pageLoad;

</script>