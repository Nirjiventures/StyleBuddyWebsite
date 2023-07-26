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

    <meta property='og:locale' content='en_US' />

    

    <!--<meta http-equiv="refresh" content="30">-->

    <meta property='og:title' content="<?=$meta_title?>" data-dynamic='true' />

    <meta property='og:site_name' content='<?=$meta_title?>' data-dynamic='true' />

    <meta property='og:url' content='<?=current_url()?>' />

    <meta property='og:description' content="<?=$meta_description?>"  data-dynamic='true' />

    <meta property='og:type' content='article'  data-dynamic='true' />

    <?php $img =  'assets/images/sb.png';?>

    <?php if(!empty($seoData->meta_image))  {?>

        <?php 

            $img1 =  $seoData->meta_image; 

            if (file_exists($img1)) {

                $img = $img1;

            }

        ?>

    <?php } ?>

    <meta property='og:image' content='<?=base_url($img); ?>' />

    <!--<meta property='og:image:type' content='image/png' data-dynamic='true'>-->

    <meta property='og:image:width' content='800'  data-dynamic='true' />

    <meta property='og:image:height' content='430'  data-dynamic='true' />

    

    <!-- <meta property="og:url"           content="<?=current_url()?>" />

    <meta property="og:type"          content="website" />

    <meta property="og:title"         content="<?=$meta_title?>" />

    <meta property="og:description"   content="<?=$meta_description?>" />

    <?php if($this->uri->segment(1) == 'shop' && !empty($this->uri->segment(2))  && !empty($this->uri->segment(3))){  ?>

        <meta property="og:image"         content="<?=base_url('resize_image.php?new_width=400&new_height=400&image=assets/images/product/'.$productDetails->image)?>" />

    <?php   } ?>

    -->

    

    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:site" content="<?=$meta_title?>">

    <meta name="twitter:title" content="<?=$meta_title?>">

    <meta name="twitter:description" content="<?=$meta_description?>">

    <meta property="twitter:image" content="<?=base_url($img)?>" />

    <meta name="twitter:domain" content="<?=base_url()?>">



    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.png">

    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">

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



        /*(function(c,l,a,r,i,t,y){



            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};



            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;



            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);



        })(window, document, "clarity", "script", "fuxdf24vng");

*/

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

 

  

<style>

.right_social ul { list-style: none; padding: 0px; margin: 0px; }  

.right_social ul li a { color: #fff; width: 40px; height: 40px; display: block; margin-bottom: 5px; text-align: center; line-height: 40px; border-radius: 4px; }  

.right_social { position: fixed; top: 40%; z-index: 999; right: 5px; }

.right_social ul li a:hover {background: var(--color-black); color: #fff;}



.facebook { background: #3B5998; color: white; }  

.youtube { background: #bb0000; color: white; }  

.instaram { background: #d6249f;

  background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%); color: white; }  

.linkedin { background: #007bb5; color: white; }

</style>



<div class="right_social">

		<ul>

			<li><a class="facebook" target="_blank" href="<?= $this->site->facebook ?>"><i class="fab fa-facebook-f"></i></a></li>

			<li><a class="youtube" target="_blank" href="<?= $this->site->youtube ?>"><i class="fab fa-youtube"></i></a></li>

			<li><a class="instaram" target="_blank" href="<?= $this->site->instagram ?>"><i class="fab fa-instagram"></i></a></li>

			<li><a class="linkedin" target="_blank" href="<?= $this->site->linkedin ?>"><i class="fab fa-linkedin-in"></i></a></li>



		</ul>

</div>



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

                                            <li><a href="<?=base_url('personal-styling-session-gift-cards')?>">	Personal Styling Session Gift Cards</a></li>

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



							<li class="m_main sub_child_menu" style="display:none!important">

								<a>Shop</a>

								<ul class="single_menu">

									 

									<?php 	$parentCategory = getParentCategory();  ?>

									<?php 	foreach ($parentCategory as $key => $value) { ?>

					    		    	<li class="1 sub_child">

					    		    		<a><?=$value['name'];?></a>

							            	<ul>

							            	    <li class="1 ">

									            	<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>">Shop all</a>

												</li>

							            		<?php $j = 0;foreach ($value['child'] as $key1 => $value1) { ?>

								            		<?php if($value1['child']) { ?>

								            			<li class="2 ">

    								            			<a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?></a>

    								            				<ul>

    	    										                <?php foreach ($value1['child'] as $key2 => $value2) { ?>

    	    										                	<li class="3 ">

    	    											            		<a href="<?=base_url('shop/'.$value2['slug'].'?catid='.$value2['id'])?>"><?=$value2['name'];?></a> 

    	    											            	</li>

    	    														<?php } ?>

    	    											    	</ul>

    	    											</li>

	    											<?php }else{ ?>

	    												<li class="2 ">

    								            			<a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?></a>

    								            		</li>

	    											<?php } ?>

										        <?php $j++;} ?>

							            	</ul>

							          	</li>

						          	<?php  }?>

								    		 

									<li class="1 ">

						            	<a href="<?=base_url(); ?>page/giftcard">Gift Card</a>

									</li>	 

								</ul>

							</li>

							<!-- <li class="m_main sub_child_menu">

								<a>Shop</a>

								<ul class="single_menu">



									<li class="sub_child">



										<a> Women</a>



										<ul>

											<li><a href="">Party Wear</a>

												<ul>



													<li><a href="#"> Indian</a></li>

													<li><a href="#"> Indowestren</a></li>

													<li><a href="#"> Westren</a></li>

												</ul>

											</li>

										</ul>



									</li>

									<li class="sub_child">

										<a>Men</a>

										

										<ul>

											<li><a href="">Party Wear</a>

												<ul>

													<li><a href="#"> Westren</a></li>

												</ul>

											</li>

										</ul>



									</li>



									



								</ul>



							</li> -->

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

								    			<li><a href="<?= base_url('stylist-zone/setting') ?>"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>

                                              <li><a target="_blank"  href="<?= base_url('service-provider-agreement') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Service Provider Agreement</a></li>

                                              <li><a onclick="onSignout()" style="cursor:pointer"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>

									        <?php } else if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 6  ){ ?>

									        	<li><a href="<?= base_url('user/user-dashboard') ?>">My Dashboard</a></li>

									        	<li><a href="<?= base_url('user/user-profile') ?>">Edit Profile</a></li>

									        	<li><a href="<?= base_url('user/stylingreport') ?>">My Styling Reports</a></li>

                                        		<li><a href="<?= base_url('user/myserviceorder') ?>"> Styling Service Order</a></li>

                                        		<li><a href="<?= base_url('user/myshoporder') ?>"> Shop Orders</a></li>

                                        		<li><a href="<?= base_url('user/giftorder') ?>"> Purchased Gifts</a></li>

                                        		<li><a href="<?= base_url('user/user-wishlist') ?>"> My Wishlist</a></li>

                                        		<li><a href="<?= base_url('user/user-setting') ?>"> Settings</a></li>

                                        		<li><a onclick="onSignout()" style="cursor:pointer"> Logout</a></li>

									        <?php } else if($this->session->userdata('userType') == 4  ){ ?>

									        	<li><a href="<?= base_url('boutiques/dashboard') ?>">My Dashboard</a></li>

									        	<li><a href="<?= base_url('user/user-profile') ?>">Edit Profile</a></li>

									        	<li><a href="<?= base_url('boutiques/setting') ?>"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>

                                                  <li><a target="_blank"  href="<?= base_url('service-provider-agreement') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Service Provider Agreement</a></li>

                                                  <li><a onclick="onSignout()" style="cursor:pointer"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>

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

												<li><a href="<?=base_url('personal-styling-session-gift-cards')?>">	Personal Styling Session Gift Cards</a></li>

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



								 



							   	<li  style="display:none!important"><a href="#">Shop <em class="mdi fa fa-angle-down"></em></a>

							        <ul style="display:none">

							            <?php 	$parentCategory = getParentCategory();  ?>

										<?php 	foreach ($parentCategory as $key => $value) { ?>



											<li><a href="#"><?=$value['name'];?> <em class="mdi fa fa-angle-down"></em></a>

								            	<ul>

								            	    <li>

										            	<a href="<?=base_url('shop/'.$value['slug'].'?catid='.$value['id'])?>"><b>Shop all</b></a>

													</li>

								            		<?php $j = 0;foreach ($value['child'] as $key1 => $value1) { ?>

								            			<?php if ($value1['child']) { $tt = '<em class="mdi fa fa-angle-down"></em>';?>

									            			<li><a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><u><?=$value1['name'];?> <?=$tt?></u></a>

										            			<ul>

		    										                <?php foreach ($value1['child'] as $key2 => $value2) { ?>

		    										                	<li>

		    											            		<a href="<?=base_url('shop/'.$value2['slug'].'?catid='.$value2['id'])?>"><?=$value2['name'];?></a> 

		    											            	</li>

		    														<?php } ?>

			    											    </ul>

			    											</li>

		    											<?php  }else{ ?>

								            		        <li><a href="<?=base_url('shop/'.$value1['slug'].'?catid='.$value1['id'])?>"><?=$value1['name'];?> </a></li>

										        		<?php  } ?>

											        <?php $j++;} ?>

								            	</ul>

								          	</li>



							              	 

							            <?php  }?>

							            <li class="1 ">

    						            	<a href="<?=base_url(); ?>page/giftcard">Gift Card</a>

    									</li>	 

							        </ul>

							    </li>

							     

							      	<?php if ($this->session->userdata('userType')) { ?>

										 

									<?php }else{ ?>

									<?php } ?>

							     	



							  </ul>

							  

							    <a href="<?php echo base_url(); ?>login/userlogin" class="login_grednn">Login</a>

                                <a href="<?= base_url('user/registration') ?>" class="login_grednn">Register</a>

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



								<li><a onclick="onSignout()" style="cursor:pointer" title="Logout" class="uk_register">Logout</a></li>



							<?php }else{ ?>



								<!--<li><a href="<?= base_url('user/registration') ?>" class="uk_register action_bt_2 new_pr">Register</a></li>-->



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

								<li><a onclick="onSignout()" style="cursor:pointer"style="cursor:pointer" title="Logout"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/logout.png"></a></li>

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



 