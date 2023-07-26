<div class="about_new">
	<div class="container">
		<div class="row m-0">
			<div class="col-sm-6">
				<div class="about_texta">
					<h1><?= ucwords($cmsData->title) ?></h1>
					<p><?= ($cmsData->sub_title) ?></p>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="about_video">
				    <?php
                        $table = 'videos';
                        $condition = " WHERE UPPER(on_page) = 'HOME' AND  status = '1' order by id ASC";
                        $videos = $this->common_model->get_all_details_query($table,$condition)->row_array();
                        //echo $this->db->last_query();
                        
                    ?>
                    <?php if($videos){ ?>
                        <iframe src="https://www.youtube.com/embed?listType=playlist&list=<?=$videos['youtube_url']?>&autoplay=1" width="100%" height="380" frameborder="0"></iframe>
                    
                    
                    <?php } ?>
                    
					<!--<iframe width="100%" height="380" src="https://www.youtube.com/embed/l9fNxA4kt2w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
				</div>
			</div>
		</div>
	</div>
</div>
<div class="we_are">
	<div class="container">
		
		<div class="row m-0 align-items-center justify-content-between">
			<div class="col-sm-5">
				<div class="are_photo">
				    <?php $img =  'assets/images/banner-reg2.png';?>
					<?php if(!empty($cmsData->image))  { ?>
						<?php 
				   			$img1 =  'assets/images/'.$cmsData->image; 
				   			if (file_exists($img1)) {
				   				$img = $img1;
				   			}
				   		?>
				   	<?php } ?>    
			        <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
					
				</div>
			</div>

			<div class="col-sm-6">
				<div class="we_only">
					<p class="getting">We are only just getting started..</p>
					<div class="row m-0">
						<div class="col-sm-6 col-6">
							<div class="num_p">
								<p>100+</p>
								<span>Projects Delivered</span>
							</div>
						</div>

						<div class="col-sm-6 col-6">
							<div class="num_p">
								<p>1500+</p>
								<span>Stylists</span>
							</div>
						</div>

						<div class="col-sm-6 col-6">
							<div class="num_p">
								<p>4 Star</p>
								<span>Service Rating</span>
							</div>
						</div>

						<div class="col-sm-6 col-6">
							<div class="num_p">
								<p>10+</p>
								<span>Yrs of Fashion Styling Experience in our Team</span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

</div>


<div class="the_goal">
	<div class="container">
		<div class="row m-0">
			
			<div class="col-sm-6">
				<div class="goal_data">
				    <?= $cmsData->content?>
					<!--<p class="main_hed">Our Goal</p>
					<p>We combine the art of creativity and technical skills to create visually stunning outfits that make a statement.</p>

					 <p>Our goal is to make people look and feel their best, and to tell a story through clothing. Fashion is a powerful tool that can change the way we feel, the way we interact with others, and the way we are perceived by the world.</p>-->
				</div>
			</div>
			<div class="col-sm-6">
				<div class="goal_vision">
				    <?= $cmsData->content2?>
					<!--<p class="main_hed">Our Vision</p>

					<p>With a experienced team and great motive, our vision is to become one of the largest platforms which supports Individuals, Businesses & other Stakeholders with their Fashion needs. </p>

					<p>We want to become the GO-TO platform for Fashion Stylists of every kind & help thousands of such talent stylists to showcase their potential in front of the real world by doing what they are good at. </p>-->
				</div>
			</div>

		</div>
	</div>
</div>



<?php $ourteam=$this->common_model->get_all_details_query('stylebuddy_works','where status = 1 order by ui_order asc')->result(); ?>
<?php if($ourteam){   ?>
	<div class="lgt-bg">
		<div class="ab-sec container">
			<div class="row align-items-center vi-listing">
				<div class="col-sm-12 ">
					<h2>How we work at Stylebuddy</h2>
				</div>
		     	<div class="col-sm-12">
		     		
		     		<div class="row">
		     			<?php  foreach($ourteam as $key=>$value){   ?>
							<div class="col-sm-3">
								<div class="box_about">
								    <?php $img = image_exist($value->image,'assets/images/stylebuddy_works/'); ?>
								    <div class="icon"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid"></div>
									<div class="content">
									    <h3><?=$value->name;?></h3>
										<?=$value->description;?>
									</div>
								</div>
							</div>
					    <?php  }  ?>
		     		</div>
		     	</div>
		     </div>
		</div>
	</div>
<?php } ?>


<div class="style_team">
	<div class="container">
		<h3>Our Experienced Team</h3>

		<div class="row m-0">
			<?php $ourteam  =  $this->common_model->get_all_details_query('ourteam','where status = 1 order by ui_order asc')->result(); ?>
			<?php  foreach($ourteam as $key=>$value){   ?>
    			<div class="col-sm-3 col-6">
    				<div class="my_team">
    				    <?php $img = image_exist($value->image,'assets/images/'); ?>
    				    <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img) ?>" class="img-fluid">
    					<p><?=$value->fname;?></p>
    					<span><?=$value->designation;?></span>
    				</div>
    			</div>
            <?php  }  ?>
			 
		</div>

	</div>
</div>



<?php if (!$this->session->userdata('userType')) { ?>	
<section class="register_yellow" style="background: #FAFF00 url('<?=base_url('assets/images/skd.png')?>');">
	<div class="container">
		<div class="col-sm-9">
			<div class="yellow_title">
				<h3 class="font50 mb80">Register for attractive Styling deals</h3>
				
				<div class="row m-0 justify-content-between">
					
					<div class="col-sm-5">
						<div class="log_bottom">
							<h4 class="mb80">Login</h4>
							<div id="response_msg"></div>
							<div class="fm_group">
								<p>Email Id</p>
								<input name="userEmail" id="userEmail" type="text" class="sub_box">
								<div id="email_err"></div>
							</div>
							
							<div class="fm_group">
								<p>Password: </p>
								<div class="fg_gp" style="margin-bottom:0px">
    								<input name="userPassword" id="userPassword" type="password" class="sub_box" style="margin-bottom: 16px;">
    								<i class="toggle-password fa fa-fw fa-eye-slash"></i>
    								<div id="password_err"></div>
    							</div>
							</div>
							<div class="fg_gp" style="margin-top:0px;float: right;">
							    <a href="<?= base_url('forgot-password') ?>">Forgot password?</a>
							</div>
							<div class="clearfix"></div>
							<div class="fm_group text-center">
								<a type="submit" value="Login" class="action_bt4" onclick="login()">Login</a>
							</div>
							
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="new_red">
							<h4>New to Stylebuddy?</h4>
							<a href="<?=base_url('user/registration')?>">Register Now!</a>
							<br/><br/>
							<a href="<?=base_url('login/stylistlogin')?>">Login as Stylist!</a>
						</div>
						
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</section> 
<?php } ?>
<script type="text/javascript">
	function login(){
			var userEmail = $('#userEmail').val();
			var userPassword = $('#userPassword').val();
            $.ajax({
                type: 'POST',
                dataType:"json",
                url: '<?php echo base_url(); ?>login/loginAjax',
                data: {userEmail:userEmail,userPassword:userPassword},
                success: function(data) {
                	$('#response_msg').html('<span class="text-danger">'+ data.response +'</span>');
                	if(data.status == 'success'){
                		window.location.reload();
                	}else{

                	}
	           	}
            });    
        
	}
</script>
 