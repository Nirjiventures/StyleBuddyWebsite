<?php  $this->load->view('Page/template/header'); ?>

<!--========Banner Area ========-->

<div class="banner_inner">
	<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/contact_bg.jpg" class="img-fluid">
	<div class="top_title">
		<div class="container"><h3>Contact us</h3></div>
	</div>
</div>

<!--========End Banner Area ========-->	


<div class="middle_part">
	<div class="container">		
		<div class="row m-0">
			<div class="col-sm-6">
				<h2>Contact Info</h2>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
				<div class="cont-details mt-5">
					<p><i class="fas fa-map-marker-alt"></i><?= $this->site->address ?></p>
					<p><i class="fa-solid fa-phone"></i><a href="tel:<?= $this->site->mobile ?>"><?= $this->site->mobile ?></a></p>
					<p><i class="fas fa-envelope-open-text"></i><a href="mailto:<?= $this->site->email ?>" class="mail"><?= $this->site->email ?></a></p>
				</div>
				<h4 class="mt-5">Follow Us</h4>
				<ul class="social-icons-contact">
					<li>
						<a href="<?= $this->site->twitter ?>">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<li>
						<a href="<?= $this->site->facebook ?>">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
					<li>
						<a href="<?= $this->site->linkedin ?>">
							<i class="fa fa-linkedin"></i>
						</a>
					</li>
					<li>
						<a href="<?= $this->site->instagram ?>">
							<i class="fa fa-instagram"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-sm-6">
			    <?= form_open('',['id'=>'contact-form']) ?>
					<div class="form-group">
						<label>Your Name<span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" required>
						<div id="name_err"></div>
					</div>
					<div class="form-group">
						<label>Your Email<span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" required>
						<div id="email_err"></div>
					</div>
					<div class="form-group">
						<label>Subject</label>
						<input type="text" name="subject" class="form-control">
					</div>
					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control" name="message" rows="4"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" class="btn btn-primary">
						<div id="success_msg"></div>
					</div>
				<?= form_close(); ?>
			</div>	
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="map-iframe mt-5">
	                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224409.95626650137!2d77.01216398742831!3d28.497443242431952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d23844277659d%3A0xd26134df41971636!2sSpaze%20Platinum%20Tower!5e0!3m2!1sen!2sin!4v1654766157427!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	            </div>
			</div>
		</div>
	</div>
</div>



<?php $this->load->view('Page/template/footer'); ?>