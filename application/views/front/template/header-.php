<!DOCTYPE html>

<html lang="en">

<head>

    <?php $meta_title = $this->site->meta_title?>

    <?php $meta_keyword = $this->site->meta_keyword?>

    <?php $meta_description = $this->site->meta_description?>

    <?php   if($this->uri->segment(1)){ ?>

        <?php $meta_title = $seoData->meta_title?>

        <?php $meta_keyword = $seoData->meta_keyword?>

        <?php $meta_description = $seoData->meta_description?>

    <?php   } ?>



    <?php 

    	$uID = $this->session->userdata('session_user_id_temp');

    	$c['user_id'] = $uID;

    	$cartRows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();

    ?>

    <?php 

		$cart_qty = 0;



		$cart_price = 0;



		foreach ($cartRows as $key => $value) {



			if($value->in_stock){



				$cart_price += $value->total;



				$cart_qty += $value->quantity;



			}



		}

	?>



    

	<?php $meta_title = ($meta_title) ? $meta_title.' | StyleBuddy' : 'StyleBuddy';?>



    <title><?=$meta_title?></title>



    <meta charset="utf-8">



    <meta name="keywords" content="<?=$meta_keyword?>">



    <meta name="description" content="<?=$meta_description?>">

    <!--<meta http-equiv="refresh" content="30">-->

    
    <meta property='og:title' content="<?=$meta_title?>" data-dynamic='true' />
    <meta property='og:site_name' content='<?=$meta_title?>' data-dynamic='true' />
    <meta property='og:url' content='<?=current_url()?>' />
    <meta property='og:description' content="<?=$meta_description?>"  data-dynamic='true' />
    <meta property='og:type' content='article'  data-dynamic='true' />
    <meta property='og:image' content='<?=base_url(); ?>assets/images/sb.png' />
    <meta property='og:image:type' content='image/png' data-dynamic='true'>
    <meta property='og:image:width' content='800'  data-dynamic='true' />
    <meta property='og:image:height' content='430'  data-dynamic='true' />
    <meta property='og:locale' content='en_US' />


   <!-- <meta property="og:url"           content="<?=current_url()?>" />



    <meta property="og:type"          content="website" />



    <meta property="og:title"         content="<?=$meta_title?>" />



    <meta property="og:description"   content="<?=$meta_description?>" />



    <?php if($this->uri->segment(1) == 'shop' && !empty($this->uri->segment(2))  && !empty($this->uri->segment(3))){  ?>



        <meta property="og:image"         content="<?=base_url('resize_image.php?new_width=400&new_height=400&image=assets/images/product/'.$productDetails->image)?>" />



    <?php   } ?>


-->
    



    



    <meta name="twitter:card" content="summary_large_image">



    <meta name="twitter:site" content="@site_username">



    <meta name="twitter:title" content="<?=$meta_title?>">



    <meta name="twitter:description" content="<?=$meta_description?>">



    <?php if($this->uri->segment(1) == 'shop' && !empty($this->uri->segment(2))  && !empty($this->uri->segment(3))){  ?>



        <meta property="twitter:image"         content="<?=base_url('resize_image.php?new_width=400&new_height=400&image=assets/images/product/'.$productDetails->image)?>" />



    <?php   } ?>



    <meta name="twitter:domain" content="<?=base_url()?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">

	

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>



	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700;800&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Khand:wght@300;500&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500&display=swap" rel="stylesheet">


	

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

	<script src="https://kit.fontawesome.com/ce0ebae40f.js" crossorigin="anonymous"></script>

    



	

  	



	 

	<link href="<?= base_url() ?>assets/css/star-rating.css?dev=<?=time();?>" rel="stylesheet">

	<link href="<?= base_url() ?>assets/css/custom.css?dev=<?=time();?>" rel="stylesheet">

	<link href="<?= base_url() ?>assets/css/menu.css?dev=<?=time();?>" rel="stylesheet">

	<link href="<?= base_url() ?>assets/css/ecommerce.css?dev=<?=time();?>" rel="stylesheet">

	<link href="<?= base_url() ?>assets/css/vijay.css?dev=<?=time();?>" rel="stylesheet">

    





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script src="<?= base_url() ?>assets/js/star-rating.js?dev=<?=time();?>" crossorigin="anonymous"></script>

  	<script src="<?= base_url() ?>assets/js/main.js?dev=<?=time();?>" crossorigin="anonymous"></script>

    




    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162411924-1"></script>

    <script>

      window.dataLayer = window.dataLayer || [];

      function gtag(){dataLayer.push(arguments);}

      gtag('js', new Date());

      gtag('config', 'UA-162411924-1');

    </script>

    <script>

    	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':



		    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],



		    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=



		    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);



		    })(window,document,'script','dataLayer','GTM-KBJ4WD2');

	</script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10902817037"></script> 



    <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-10902817037'); </script>

    <script type="text/javascript">

        (function(c,l,a,r,i,t,y){

            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};

            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;

            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);

        })(window, document, "clarity", "script", "fuxdf24vng");

    </script>

  <?php //if(!$this->uri->segment(1)){  ?> 
  <!-- Meta Pixel Code -->
    <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1238135933480696');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1238135933480696&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
 <?php //}  ?>
</head>
 

<body class="<?php if($this->uri->segment(1) == 'user' || $this->uri->segment(1) == 'postjob'){ echo 'user_section';}?>">



    <div id="fb-root"></div>



    <script>

    	(function(d, s, id) {



	    var js, fjs = d.getElementsByTagName(s)[0];



	    if (d.getElementById(id)) return;



	    js = d.createElement(s); js.id = id;



	    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";



	    fjs.parentNode.insertBefore(js, fjs);



	    }(document, 'script', 'facebook-jssdk'));

	</script>

	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBJ4WD2" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<?php 

        $this->load->model('Page_Model');

        $this->site = $this->Page_Model->allController();

    ?>

    <?php 
    	$table = 'our_services';
        $table_corporate = 'our_services_corporate_domain';
        $table_corporate_domain = 'corporate_domain';
                
        if($this->session->userdata('email') && $this->session->userdata('userType') == 6){
            $email = $this->session->userdata('email');
            $domain_name = preg_replace( '!^.+?([^@]+)$!', '$1', $email );
            $domain_nameRow = $this->db->get_where($table_corporate_domain,['domain_name'=> $domain_name])->row();
            if ($domain_nameRow) {
                $our_services = $this->db->get_where($table_corporate,['status'=> 1,'domain_id'=> $domain_nameRow->id])->result(); 
            }else{
                $our_services = $this->db->get_where($table,['status'=> 1])->result();
            }
        }else{
            $our_services = $this->db->get_where($table,['status'=> 1])->result();  
        }

    	//$our_services = $this->common_model->get_all_details('our_services',array('status'=>1),array(array('field'=>'ui_order','type'=>'ASC')))->result();

    	//echo $this->db->last_query();

    ?>


    <?php if(($this->uri->segment(1) == 'user' && $this->uri->segment(2) != 'registration') || $this->uri->segment(1) == 'postjob'){ ?>
     	<link href="<?= base_url(); ?>assets/ui/user/dashboard.css?dev=<?=time();?>" rel="stylesheet">
    <?php }?>
    <header>

	<div class="container">

		<div class="row m-0 align-items-center">

			<div class="col-sm-3 col-6 m_padd p-0">

				<div class="logo"><div class="mobile_bt"><a id="sidebar-btn"><i class="fa fa-bars" aria-hidden="true"></i></a></div> 

				<a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>

			</div>

			

			<div class="col-sm-7 p-0">



				<div class="menu_part">

	

					<div id="my_menu">

						<a id="sidebar-close"><i class="fa fa-times" aria-hidden="true"></i></a>

						<ul class="menu_bg">

							<li><a href="<?=base_url()?>">Home</a></li>

							<li class="m_main sub_child_menu">

								<a>Our services</a>

								<ul class="single_menu">

									<li class="sub_child">

										<a> Services</a>

										<ul>

											<?php foreach ($our_services as $key => $value) { ?>

												<li><a href="<?=base_url('services/'.$value->slug)?>"><?=$value->title?></a></li> 

											<?php }?>

										</ul>

									</li>
									<li class="sub_child">
										<a>Corporate</a>
										<ul>
											<li><a href="<?=base_url('Services/corporate')?>">Corporate Services</a></li>
											<?php if (!$this->session->userdata('userType')) { ?>
												<li><a href="<?=base_url('corporate-registration')?>">Corporate Registration</a></li>
												<li><a href="<?=base_url('corporate-login')?>">Corporate Login</a></li>
											<?php } ?>
										</ul>

									</li>

									<li><a href="<?=base_url('services/pricing')?>">Pricing</a></li>
									<?php
							    		$expertises_list  =  $this->common_model->get_all_details_query('area_expertise_looking','where status = 1 order by ui_order asc')->row();
							    		$list = $expertises_list;
							    	?>
							    	<li><a href="<?=base_url('connect-with-stylists/'.$list->slug)?>">Connect with a Fashion Stylist </a></li>	 

									<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>

								</ul>

							</li>

							<li class="m_main sub_child_menu">

								<a>For Stylists</a>

								<ul class="single_menu">

									<li><a href="<?=base_url('stylist-zone/registration')?>"> Register as a stylist</a></li>

									<li><a href="<?=base_url('page/browsejobs');?>"> Browse Jobs</a></li>

									<!--<li><a href="<?=base_url('post/jobs');?>"> Post jobs</a></li>-->

									<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>
									<li><a href="<?=base_url('login/stylistlogin');?>"> Login</a></li>
								</ul>

							</li>
							

							 <li><a href="<?=base_url('contact-us')?>"> Contact Us</a></li> 

							

							<!--<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>-->

							<li class="m_main sub_child_menu">
    								<a>Shop</a>
    								<ul class="<?php if(isMobile()){ echo 'single_menu';}else{echo 'mega_menu';}?>">
    									<div class="container">
    										<div class="row m-0">
    											<?php 	$parentCategory = getParentCategory();  ?>
    											<?php 	foreach ($parentCategory as $key => $value) { ?>
    								    		    <?php if ($value['menu_type'] == 1) { ?>
    								    		    	<li class="<?php if($value['child']){echo '111111';}?> col-sm-3">
    								    		    	<?php //if ($value['child']) { ?>
    	    							    	    		<b><u><?=$value['name'];?></u></b>
    	    								            	<ul>
    	    								            	    <li class="<?php if(!isMobile()){ echo 'mega_menu_item';}?>">
    	    										            	<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>">Shop all </a>
    	    													</li>
    	    											        
    	    								            		<?php $j = 0;foreach ($value['child'] as $key1 => $value1) { ?>
        	    										            <li class="<?php if(!isMobile()){ echo 'mega_menu_item';}?>">
        	    										                <?php if ($j==0) { ?>
        	    														    <!--<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>">Shop all </a>-->
        	    														<?php } ?>
        	    														<?php foreach ($value1['child'] as $key2 => $value2) { ?>
        	    											            	<a href="<?=base_url('shop/'.$value2['slug'].'?catid='.$value2['id'])?>"><?=$value2['name'];?></a> 
        	    														<?php } ?>
        	    											        </li>
    	    											        <?php $j++;} ?>
    	    								            	</ul>
    	    								            <?php //}else{ ?>
    	    								            	<!--<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>"><b><?=$value['name'];?></b> </a>-->
    	    								            <?php //} ?>
    	    								          	</li>
    									          	<?php  }else if ($value['menu_type'] == 2){ ?>
    	    								          	<li class="<?php if($value['child']){echo '22222';}?> col-sm-3">
    	    								          	<?php //if ($value['child']) { ?>
    	    							            		<b><u><?=$value['name'];?></u></b>
    	    								            	<ul>
    	    								            	    <li class="<?php if(!isMobile()){ echo 'mega_menu_item';}?>">
    	    										            	<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>">Shop all </a>
    	    													</li>
    	    								            		<?php foreach ($value['child'] as $key1 => $value1) { ?>
    	    								            		    <?php if ($value1['child']) { ?>
    	    								            		        <li><a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
    	        								            		        <ul class="sub_menu">
    	            								            		    <?php foreach ($value1['child'] as $key2 => $value2) { ?>
    	            											            	<li><a href="<?=base_url('shop/'.$value2['slug'].'?catid='.$value2['id'])?>"><?=$value2['name'];?></a><li> 
    	            														<?php } ?>
    	            														</ul> 
    	        														</li> 
    	    								            		    <?php  }else{ ?>
    	    								            		        <li><a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?> </a></li>
    	    										        		<?php  } ?>
    	    										        	<?php } ?>
    	    								            	</ul>
    	    								            <?php //}else{ ?>
    	    								            	<!--<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>"><b><?=$value['name'];?></b> </a>-->
    	    								            <?php //} ?>
    	    								          	</li>
    									          	<?php  }?>
    								    		<?php  }?>
    										</div>
    									</div>
    								</ul>
    							</li>

						</ul>





						<div class="sidebar-navigation">
							<img src="<?php echo base_url(); ?>assets/images/sb-icc.png" class="sb_icon">
							<?php if ($this->session->userdata('userType')) { ?>
								<p>Welcome, <?=$this->session->userdata('fname').' '.$this->session->userdata('lname');?></p>
							<?php } ?>	
							<ul>
								<?php if ($this->session->userdata('userType')) { ?>
									<li  class="mb-4 dash_top">
										<a class="gdc">MY ACCOUNT <em class="mdi fa fa-angle-down"></em></a>
										<ul>
											<?php  if($this->session->userdata('userType') == 2  ) {  ?>
								    			<li><a href="<?= base_url('stylist-zone/dashboard') ?>">My Dashboard</a></li>
								    			<li><a href="<?= base_url('stylist-zone/manage-profile') ?>">Edit Profile</a></li>
									        <?php } else if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 6  ){ ?>
									        	<li><a href="<?= base_url('user/user-dashboard') ?>">My Dashboard</a></li>
									        	<li><a href="<?= base_url('user/user-profile') ?>">Edit Profile</a></li>
									        <?php } else if($this->session->userdata('userType') == 4  ){ ?>
									        	<li><a href="<?= base_url('boutiques/dashboard') ?>">My Dashboard</a></li>
									        	<li><a href="<?= base_url('user/user-profile') ?>">Edit Profile</a></li>
									        <?php } else if($this->session->userdata('userType') == 5  ){ ?>
									        	<li><a href="<?= base_url('postjob/index') ?>">My Dashboard</a></li>
									        	<li><a href="<?= base_url('postjob/profile') ?>">Edit Profile</a></li>
									        <?php }  ?>
									    </ul>
								    </li>
								<?php } ?>

							   	 

							   	<li><a href="<?=base_url()?>">Home</a></li>

							    <li><a href="#">Our services <em class="mdi fa fa-angle-down"></em></a>
							          	<ul>
							              <li><a href="#">Services <em class="mdi fa fa-angle-down"></em></a>
								              <ul>
								                  <?php foreach ($our_services as $key => $value) { ?>
													<li><a href="<?=base_url('services/'.$value->slug)?>"><?=$value->title?></a></li> 
												<?php }?>
								              </ul>
							              </li>
							              <li class="sub_child">
											<a href="#">Corporate <em class="mdi fa fa-angle-down"></em></a>
											<ul>
												<li><a href="<?=base_url('Services/corporate')?>">Corporate Services</a></li>
												<?php if (!$this->session->userdata('userType')) { ?>
													<li><a href="<?=base_url('corporate-registration')?>">Corporate Registration</a></li>
													<li><a href="<?=base_url('corporate-login')?>">Corporate Login</a></li>
												<?php } ?>
											</ul>

										</li>
							            <li><a href="<?=base_url('services/pricing')?>">Pricing</a></li>
							              <?php

								    		$expertises_list  =  $this->common_model->get_all_details_query('area_expertise_looking','where status = 1 order by ui_order asc')->row();

								    		$list = $expertises_list;

								    	?>

								    	<li><a href="<?=base_url('connect-with-stylists/'.$list->slug)?>">Connect with a Fashion Stylist </a></li>	 

										<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>

							              

							        </ul>

							    </li>



							      <li>

									<a>For Stylists <em class="mdi fa fa-angle-down"></em></a>

									<ul>

										<li><a href="<?=base_url('stylist-zone/registration')?>"> Register as a stylist</a></li>

										<li><a href="<?=base_url('page/browsejobs');?>"> Browse Jobs</a></li>

										<!--<li><a href="<?=base_url('post/jobs');?>"> Post jobs</a></li>-->

										<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>

										<li><a href="<?=base_url('login/stylistlogin');?>"> Login</a></li>

									</ul>

								  </li>

								   <li><a href="<?=base_url('contact-us')?>"> Contact Us</a></li> 

								  <!--<li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>-->



							   	<li><a href="#">Shop <em class="mdi fa fa-angle-down"></em></a>
							        <ul>
							            <?php 	$parentCategory = getParentCategory();  ?>
										<?php 	foreach ($parentCategory as $key => $value) { ?>
							              	<li><a href="#"><?=$value['name'];?> <em class="mdi fa fa-angle-down"></em></a>
							              		<ul>
						              		    <li>
									            	<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>">Shop all </a>
												</li>
				              					<?php foreach ($value['child'] as $key1 => $value1) { ?>
							            		    <?php if ($value1['child']) { ?>
								            		    <?php $j=0;foreach ($value1['child'] as $key2 => $value2) { ?>
											            	<li>
											            	    <?php if ($j==0) { ?>
											            		    <a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>">Shop all </a>
											            		<?php } ?>
											            		<a href="<?=base_url('shop/'.$value2['slug'].'?catid='.$value2['id'])?>"><?=$value2['name'];?></a>
											            	<li> 
														<?php $j++;} ?>
							            		    <?php  }else{ ?>
							            		        <li><a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?> </a></li>
									        		<?php  } ?>
									        	<?php } ?>
							              		</ul>
							              	</li>
							            <?php  }?>
							        </ul>
							    </li>
							     
							      	<?php if ($this->session->userdata('userType')) { ?>
										 
									<?php }else{ ?>
									<?php } ?>
							     	

							  </ul>
							  
							  

						</div>

					</div>

				</div>

			</div>

			<div class="col-sm-2 col-6 p-0">

				<div class="rightbar">
					<?php if(isMobile()){ ?>
						<ul class="mobile_reg">

							<li>

								<a href="<?=base_url('cart');?>">

									<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/bag.png">

									<span class="min_cart"  id="cart_qty_span" data-qty="<?= ($cart_qty)?$cart_qty:'0' ?>"><?= ($cart_qty)?$cart_qty:'0' ?></span>

								</a>

							</li>

							

							<?php if ($this->session->userdata('userType')) { ?>

								<li><a  href="<?= base_url('logout') ?>" title="Logout" class="uk_register">Logout</a></li>

							<?php }else{ ?>

								<li><a href="<?= base_url('user/registration') ?>" class="uk_register action_bt_2 new_pr">Register</a></li>

							<?php } ?>

								

						</ul>

					<?php  }else{ ?>
						<ul class="desktop_login">
							<?php if ($this->session->userdata('userType')) { ?>
								<li>
									<?php  if($this->session->userdata('userType') == 2  ) {  ?>
			                    		<a class="dropdown-item" href="<?= base_url('stylist-zone/dashboard') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/user.png"></a>
			                        <?php } else if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 6  ){ ?>
			                        	<a class="dropdown-item" href="<?= base_url('user/user-dashboard') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/user.png"></a>
			                        <?php } else if($this->session->userdata('userType') == 4  ){ ?>
			                        	<a class="dropdown-item" href="<?= base_url('boutiques/dashboard') ?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/user.png"></a>
			                        <?php } else if($this->session->userdata('userType') == 5  ){ ?>
			                        	<a class="dropdown-item" href="<?= base_url('postjob/index') ?>">
			                        		<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/user.png"></a>
			                        <?php }  ?>
						        </li>
								<li><a  href="<?= base_url('logout') ?>" title="Logout"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/logout.png"></a></li>
						  	<?php }else{ ?>
						  		<li><a  href="<?= base_url('user/registration') ?>" class="action_bt_2 new_pr" title="Register">Register</a></li>
							<?php } ?>
							<li>
								<a href="<?=base_url('cart');?>">
									<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/bag.png">
									<span class="min_cart"  id="cart_qty_span" data-qty="<?= ($cart_qty)?$cart_qty:'0' ?>"><?= ($cart_qty)?$cart_qty:'0' ?></span>
								</a>
							</li>
						</ul>
					<?php  }  ?>
				</div>
			</div>
		</div>
	</div>
</header>

 