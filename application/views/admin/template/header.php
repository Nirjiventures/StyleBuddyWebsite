<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>ADMIN DASHBOARD</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="robots" content="all,follow">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/vendor/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome CSS-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/vendor/font-awesome/css/font-awesome.min.css">
      <!-- Fontastic Custom icon font-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/fontastic.css">
      <!-- Google fonts - Poppins -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
      <!-- theme stylesheet-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/style.pink.css" id="theme-stylesheet">
      <!-- Custom stylesheet - for your changes-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/custom.css">
      <!-- Favicon-->
     <!-- <link rel="shortcut icon" href="<?php //echo base_url();?>assets/admin/img/favicon.ico">-->
      <link rel="icon" type="image/x-icon" href="https://www.stylebuddy.in/assets/images/favicon.png">
      
      <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/admin.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
      <!--<script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>-->
      <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
      <style type="text/css">
           .cross_img {

               width: 76px;

               height: 76px;

               margin-top: 8px;

           }

   .cross_image {

       margin-top: 8px;

       position: absolute;

       border: 1px solid #FFF;

       width: 25px;

       text-align: center;

       border-radius: 100px;

       height: 25px;

       line-height: 25px;

       font-weight: bold;

       background: #333333bf;

       color: #FFFF;

   }

   .chosen-container-multi .chosen-choices{

      background: none!important;

   }
      </style>

      <?php 
        $rrr = getUserPermission();
        //echo $this->db->last_query();
        $permission = unserialize($rrr['permission']);
        //var_dump($permission);
      ?>
   </head>
   <body>
      <div class="page">
       
      <header class="header">
         <nav class="navbar">
            <!-- Search Box-->
            <div class="search-box">
               <button class="dismiss"><i class="icon-close"></i></button>
               <form id="searchForm" action="#" role="search">
                  <input type="search" placeholder="What are you looking for..." class="form-control">
               </form>
            </div>
            <div class="container-fluid">
               <div class="navbar-holder d-flex align-items-center justify-content-between">
                  <!-- Navbar Header--> 
                  <div class="navbar-header">
                     <!-- Navbar Brand -->
                     <a href="<?php base_url('admin-dashboard');?>" class="navbar-brand d-none d-sm-inline-block">
                        <div class="brand-text d-none d-lg-inline-block"><strong>StyleBuddy</strong></div>
                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                     </a>
                     <!-- Toggle Button-->
                     <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                  </div>
                  <!-- Navbar Menu -->
                  <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                     <!-- Search-->
                     <li>&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" target="_blank"  href="<?=base_url()?>">View Site </a>&nbsp;&nbsp;&nbsp;</li>
                     <!--<li>Welcome <span class='text-primary'> <?php echo $this->session->userdata('adminEmail'); ?></span> </li>-->
                     <?php $site_setting = $this->common_model->get_all_details_query('site_setting',array())->row();?>
                     <li>Welcome <span class='text-primary'> To <?php echo $site_setting->site_name; ?> Admin</span> </li> 
                     <li class="nav-item"><a href="<?php echo base_url('admin/Login/logout');?>" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <?php $segment = $this->uri->segment(2); $segment = "admin/$segment"; ?>
      <div class="container-fluid p-0">
      <div class="row">
      <div class="col-md-2">
         <div class="page-content d-flex align-items-stretch">
            <!-- Side Navbar -->
            <nav class="side-navbar">
               <ul class="list-unstyled">
                        <li class="active"><a href="<?php echo base_url('admin-dashboard') ;?>"> <i class="icon-home"></i>Main dashboard</a></li>
                        
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/slider',$permission) || in_array('admin/slides',$permission)  || in_array('admin/zoomtext',$permission) || in_array('admin/cms-page',$permission) || in_array('admin/StyleStories',$permission) || in_array('admin/blog-category',$permission) || in_array('admin/admin/story-blog-comment',$permission) || in_array('admin/contact-us',$permission)|| in_array('admin/ourteam',$permission) || in_array('admin/faqs_category',$permission) || in_array('admin/faqs',$permission) || in_array('admin/site-setting',$permission) || in_array('admin/review',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#footerDropdown1" aria-expanded="false" data-toggle="collapse">Manage All CMS Pages</a>
                                <ul id="footerDropdown1" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/slider',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/slider')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/slider');?>">Manage Slider </a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/slides',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/slides')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/slides');?>">Add Slide </a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/zoomtext',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/zoomtext')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/zoomtext');?>">Add Zoom Text </a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/cms-page',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/cms-page')?'active':'' ?>">
                                    <a href="<?php echo base_url('admin/cms-page');?>">CMS Pages</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/StyleStories',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/StyleStories')?'active':'' ?>">
                                    <a href="<?php echo base_url('admin/StyleStories');?>">All Style Stories</a>
                                    </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/blog-category',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/blog-category')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/blog-category');?>">Manage Blog Category</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/admin/story-blog-comment',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/story-blog-comment')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/story-blog-comment');?>">Blog Comments</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/contact-us',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/contact-us')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/contact-us');?>">Contact Us</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/ourteam',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/ourteam')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/ourteam');?>">Our team</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/faqs_category',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/faqs_category')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/faqs_category');?>">Faqs Category</a>
                                    </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/faqs',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/faqs')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/faqs');?>">FAQS</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/site-setting',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/site-setting')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/site-setting');?>">Website Setting</a>
                                    </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/review',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/review')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/review');?>">Review</a>
                                    </li>
                                    <li class="<?= ($segment == 'admin/report_an_issue_question')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/report_an_issue_question');?>">Report Issue Question</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/occasionStylistCategories',$permission) || in_array('admin/our-services',$permission) || in_array('admin/homepageservices',$permission) || in_array('admin/stylist-expertise-interests',$permission) || in_array('admin/looking-stylist',$permission)  || in_array('admin/services',$permission)  || in_array('admin/subscription',$permission) || in_array('admin/consult_question',$permission) || in_array('admin/consultPlan',$permission)  || in_array('admin/consultOrder',$permission) || in_array('admin/fashion-consulting-services',$permission) || in_array('admin/gift',$permission)|| in_array('admin/gift_booking',$permission) || in_array('admin/allvideos',$permission) || in_array('admin/videos',$permission)  || in_array('admin/packagePurchasedUsers',$permission) || in_array('admin/serviceorder',$permission) || in_array('admin/webuser',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#footerDropdown" aria-expanded="false" data-toggle="collapse">Styling services</a>
                                <ul id="footerDropdown" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/occasionStylistCategories',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/occasionStylistCategories')?'active':'' ?>">
                                             <a href="<?php echo base_url('admin/occasionStylistCategories');?>">Occasion Stylist Category</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/our-services',$permission)){ ?>
                                     
                                        <li class="<?= ($segment == 'admin/our-services')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/our-services');?>">Our services</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/our-services',$permission)){ ?>
                                     
                                        <li class="<?= ($segment == 'admin/homepageservices')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/homepageservices');?>">Home Page services</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/stylist-expertise-interests',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/stylist-expertise-interests')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/stylist-expertise-interests');?>">Stylist Expertis</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/looking-stylist',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/looking-stylist')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/looking-stylist');?>">Stylist Expertise</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/services',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/services')?'active':'' ?>">
                                             <a href="<?php echo base_url('admin/services');?>">Styling Packages</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/subscription',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/subscription')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/subscription');?>">Subscription</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/consult_question',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/consult_question')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/consult_question');?>">Plans Question</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/consultPlan',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/consultPlan')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/consultPlan');?>">Yearly Plans</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/consultOrder',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/consultOrder')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/consultOrder');?>">Yearly Plan Subscriptions</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/fashion-consulting-services',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/fashion-consulting-services')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/fashion-consulting-services');?>">Fashion Consulting</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/gift',$permission)|| in_array('admin/gift_booking',$permission)){ ?>
                                        <li class="menu-item-has-children"><a href="#giftCardDropdown" aria-expanded="false" data-toggle="collapse">Gift Card Managment</a>
                                            <ul id="giftCardDropdown" class="collapse list-unstyled">

                                                <li class="<?= ($segment == 'admin/gift')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/gift');?>">Create new gift card</a>
                                                </li>
                                                 <li class="<?= ($segment == 'admin/gift_booking')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/gift_booking');?>">Purchased gift cards </a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    
                                    <li class="<?= ($segment == 'admin/coupon')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/coupon');?>">Coupon Code</a>
                                    </li>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/allvideos',$permission) || in_array('admin/videos',$permission)){ ?>
                                        <li class="menu-item-has-children"><a href="#videAppDropdown" aria-expanded="false" data-toggle="collapse">All videos</a>
                                            <ul id="videAppDropdown" class="collapse list-unstyled">

                                                <li class="<?= ($segment == 'admin/allvideos')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/allvideos');?>">All Stylist Video </a>
                                                </li> 

                                                <li class="<?= ($segment == 'admin/videos')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/videos');?>">Youtube Video</a>
                                                </li> 
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/packagePurchasedUsers',$permission)){ ?>
                                         <li class="<?= ($segment == 'admin/packagePurchasedUsers')?'active':'' ?>">
                                             <a href="<?php echo base_url('admin/packagePurchasedUsers');?>">Styling Services - Purchased</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/serviceorder',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/serviceorder')?'active':'' ?>">
                                             <a href="<?php echo base_url('admin/serviceorder');?>">Package orders</a>
                                    </li>  
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/webuser',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/webuser')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/webuser');?>">Registered User</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/register-vendors',$permission) || in_array('admin/jobs',$permission)|| in_array('admin/register-boutique',$permission) || in_array('admin/register-postJobUser',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#user_managment" aria-expanded="false" data-toggle="collapse">Stylist zone</a>
                                <ul id="user_managment" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/register-vendors',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/register-vendors')?'active':'' ?>">
                                             <a href="<?php echo base_url('admin/register-vendors');?>">Registered stylists</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/jobs',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/jobs')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/jobs');?>">Jobs</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/register-boutique',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/register-boutique')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/register-boutique');?>">Boutiquer User</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/register-postJobUser',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/register-postJobUser')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/register-postJobUser');?>">Post Job  User</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/shopslider',$permission) || in_array('admin/category',$permission)|| in_array('admin/sizes',$permission) || in_array('admin/sizes',$permission) || in_array('admin/colors',$permission) || in_array('admin/allproducts',$permission) || in_array('admin/offers',$permission)|| in_array('admin/brand',$permission) || in_array('admin/abandon_cart',$permission) || in_array('admin/user-order',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#product_managment" aria-expanded="false" data-toggle="collapse">Shop</a>
                                <ul id="product_managment" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/shopslider',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/shopslider')?'active':'' ?>">
                                          <a href="<?php echo base_url('admin/shopslider');?>">Shop Slider</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/category',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/category')?'active':'' ?>">
                                          <a href="<?php echo base_url('admin/category');?>">Shop Category</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/sizes',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/sizes')?'active':'' ?>">
                                          <a href="<?php echo base_url('admin/sizes');?>">Size</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/colors',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/colors')?'active':'' ?>">
                                          <a href="<?php echo base_url('admin/colors');?>">Color</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/allproducts',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/allproducts')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/allproducts');?>">All  Products</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/offers',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/offers')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/offers');?>">All  Offers</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/brand',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/brand')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/brand');?>">Brands</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/abandon_cart',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/abandon_cart')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/abandon_cart');?>">Abandon Cart</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/user-order',$permission)){ ?>
                                    
                                    <li class="<?= ($segment == 'admin/user-order')?'active':'' ?>">
                                         <a href="<?php echo base_url('admin/user-order');?>">Shop Orders</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/ask-quote-form',$permission)){ ?>
                            <li class="<?= ($segment == 'admin/ask-quote-form' || $segment == 'admin/collaborate' || $segment == 'admin/RakhiLeads' || $segment == 'admin/fashionExpertConsultation' || $segment == 'admin/survey_log' || $segment == 'admin/ask_for_quote_log' || $segment == 'admin/get_started' || $segment == 'admin/report_an_issue' || $segment == 'admin/check_availability' || $segment == 'admin/freesession' || $segment == 'admin/DiwaliLeads')?'active':'' ?>">
                                <a href="<?php echo base_url('admin/ask-quote-form');?>">All Forms Leads</a>
                            </li>
                        <?php } ?>
                        <?php /*if($this->session->userdata('admin_id') == 1  || in_array('admin/collaborate',$permission)  || in_array('admin/RakhiLeads',$permission) || in_array('admin/DiwaliLeads',$permission) || in_array('admin/fashionExpertConsultation',$permission)  || in_array('admin/survey_log',$permission) || in_array('admin/ask_for_quote_log',$permission) || in_array('admin/get_started',$permission)  || in_array('admin/report_an_issue_question',$permission) || in_array('admin/report_an_issue',$permission) ||  in_array('admin/check_availability',$permission) ||  in_array('admin/freesession',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#allFormsDropdown" aria-expanded="false" data-toggle="collapse">All forms</a>
                                 <ul id="allFormsDropdown" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/collaborate',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/ask-quote-form')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/ask-quote-form');?>">Ask a fashion stylist</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/collaborate',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/collaborate')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/collaborate');?>">Collaborate with Us</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/RakhiLeads',$permission) || in_array('admin/DiwaliLeads',$permission)){ ?>
                                    <li class="menu-item-has-children"><a href="#leadDropdown" aria-expanded="false" data-toggle="collapse">Lead Management</a>
                                        <ul id="leadDropdown" class="collapse list-unstyled">
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/RakhiLeads',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/RakhiLeads')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/RakhiLeads');?>">Rakhi Leads</a>
                                                </li> 
                                            <?php } ?>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/DiwaliLeads',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/DiwaliLeads')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/DiwaliLeads');?>">Diwali Leads</a>
                                                </li> 
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/fashionExpertConsultation',$permission)){ ?>
                                    <li class="<?= ($segment == 'admin/fashionExpertConsultation')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/fashionExpertConsultation');?>">Fashion Expert Consultation</a>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/survey_log',$permission) || in_array('admin/ask_for_quote_log',$permission) || in_array('admin/get_started',$permission)){ ?>
                                    <li class="menu-item-has-children"><a href="#logDropdown" aria-expanded="false" data-toggle="collapse">Log Managment</a>
                                        <ul id="logDropdown" class="collapse list-unstyled">
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/survey_log',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/survey_log')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/survey_log');?>">Survey Log</a>
                                                </li>
                                            <?php } ?>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/ask_for_quote_log',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/ask_for_quote_log')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/ask_for_quote_log');?>">Ask for quote log</a>
                                                </li>
                                            <?php } ?>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/get_started',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/get_started')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/get_started');?>">Get Started Log</a>
                                                </li>
                                            <?php } ?>
                                            
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/report_an_issue_question',$permission) || in_array('admin/report_an_issue',$permission)){ ?>
                                    <li class="menu-item-has-children"><a href="#report_an_issueDropdown" aria-expanded="false" data-toggle="collapse">User reported issues</a>
                                         <ul id="report_an_issueDropdown" class="collapse list-unstyled">
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/report_an_issue_question',$permission)){ ?>
                                                <li class="<?= ($segment == 'admin/report_an_issue_question')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/report_an_issue_question');?>">Report Issue Question</a>
                                                </li>
                                            <?php } ?>
                                            <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/report_an_issue',$permission)){ ?> 
                                                <li class="<?= ($segment == 'admin/report_an_issue')?'active':'' ?>">
                                                    <a href="<?php echo base_url('admin/report_an_issue');?>">Report Issue</a>
                                                </li> 
                                            <?php } ?>
                                            
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/check_availability',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/check_availability')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/check_availability');?>">Check Availability Leads</a>
                                        </li>
                                    <?php } ?> 
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/freesession',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/freesession')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/freesession');?>">Book Free Session</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }*/ ?> 
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/appdashboard',$permission) || in_array('admin/slidesapp',$permission) || in_array('admin/posts_category',$permission) || in_array('admin/posts_type',$permission) || in_array('admin/posts',$permission) || in_array('admin/activity_log',$permission) || in_array('admin/push_notification',$permission) || in_array('admin/push_notification_log',$permission)){ ?>
                            <li class="menu-item-has-children"><a href="#mobileAppDropdown" aria-expanded="false" data-toggle="collapse">SB APP</a>
                                <ul id="mobileAppDropdown" class="collapse list-unstyled">
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/appdashboard',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/appdashboard')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/appdashboard');?>">Home Screen Content</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/slidesapp',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/slidesapp')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/slidesapp');?>">App Home Slider </a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/page',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/page')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/page');?>">App Pages</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/appuser',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/appuser')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/appuser');?>">App User</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/appvendor',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/appvendor')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/appvendor');?>">App Stylist</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/posts_category',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/posts_category')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/posts_category');?>">Post Category</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/posts_type',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/posts_type')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/posts_type');?>">Post Type</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/posts',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/posts')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/posts');?>">All App Posts</a>
                                        </li>                        
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/activity_log',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/activity_log')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/activity_log');?>">Activity log</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/push_notification',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/push_notification')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/push_notification');?>">Push Notification</a>
                                        </li>
                                    <?php } ?> 
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/push_notification_log',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/push_notification_log')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/push_notification_log');?>">User Activity Notification</a>
                                        </li> 
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/posts_report',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/posts_report')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/posts_report');?>">Posts Report</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/users_report',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/users_report')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/users_report');?>">Users Report</a>
                                        </li>
                                    <?php } ?> 
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/corporate_leads',$permission) || in_array('admin/corporate_company',$permission) || in_array('admin/corporate_user',$permission) || in_array('admin/ourcorporateservices',$permission)){ ?> 
                                    <li class="<?= ($segment == 'admin/corporate_leads')?'active':'' ?>">

                        <li class="menu-item-has-children"><a href="#corporateAppDropdown" aria-expanded="false" data-toggle="collapse">Corporate zone</a>
                            <ul id="corporateAppDropdown" class="collapse list-unstyled"> 
                                <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/corporate_leads',$permission)){ ?> 
                                    <li class="<?= ($segment == 'admin/corporate_leads')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/corporate_leads');?>">Corporate Leads</a>
                                    </li>
                                <?php } ?>
                                <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/corporate_company',$permission)){ ?> 
                                    <li class="<?= ($segment == 'admin/corporate_company')?'active':'' ?>">
                                        <a href="<?php echo base_url('admin/corporate_company');?>">Company Name</a>
                                    </li>
                                <?php } ?> 
                                    <?php  $corporate_domain = $this->common_model->get_all_details('corporate_domain',array('status'=>1))->result();
                                        $rows = $this->common_model->get_all_details_query('corporate_company',' ORDER BY ID DESC')->row();
                                        $corporate_domain = $rows;
                                    ?>  
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/corporate_user',$permission)){ ?>
                                        <li class="<?= ($segment == 'admin/corporate_user')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/corporate_user?corporate_company_id='.$corporate_domain->id);?>">All Corporate Users</a>
                                        </li>
                                    <?php } ?>
                                    <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/ourcorporateservices',$permission)){ ?> 
                                        <li class="<?= ($segment == 'admin/ourcorporateservices')?'active':'' ?>">
                                            <a href="<?php echo base_url('admin/ourcorporateservices?corporate_company_id='.$corporate_domain->id);?>">Corporate Services</a>
                                        </li>
                                    <?php } ?>              
                                
                            </ul>
                        </li>
                        <?php } ?>     
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/referral',$permission)){ ?>
                            <li class="<?= ($segment == 'admin/referral')?'active':'' ?>">
                                <a href="<?php echo base_url('admin/referral');?>">Referral</a>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/leads',$permission)){ ?>
                            <li class="<?= ($segment == 'admin/leads')?'active':'' ?>">
                                <a href="<?php echo base_url('admin/leads');?>">Lead Management </a>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1 || in_array('admin/adminguide',$permission)){ ?>
                            <li class="<?= ($segment == 'admin/adminguide')?'active':'' ?>">
                                <a href="<?php echo base_url('admin/adminguide');?>">Admin Guide </a>
                            </li>
                        <?php } ?>
                        <?php if($this->session->userdata('admin_id') == 1){ ?>
                            <li class="<?= ($segment == 'admin/adminusers')?'active':'' ?>">
                                <a href="<?php echo base_url('admin/adminusers');?>"> Admin users access.  </a>
                            </li>
                        <?php } ?>

                         
                        <li class="bg-primary text-white">
                            <a href="<?php echo base_url('admin/Login/logout');?>">Logout</a>
                        </li>
                </ul>
               
            </nav>
         </div> 
      </div> 
      <div class="col-md-10 p-0"> 
      <div class="col-md-12 pl-5"> 
        <script>
            $('.menu-item-has-children > a').click(function () {
            if ($(this).next('ul').hasClass("show")) {
                $('.sub-menu').removeClass('show');
            } else {
                $('.sub-menu').removeClass('show');
                //$(this).next('ul').toggleClass('show');
            }
            });
        </script>      
        <?php
            $segment1 = $this->uri->segment(1);
            $segment2 = $this->uri->segment(2);
            $segment3 = $this->uri->segment(3);
            $tab2 = 'Dashboard';
            $tab2_link ='';
            $tab3 = '';
            if ($segment2) {
                $tab2 = ucwords(str_replace('-', ' ', $segment2));
            }
            if ($segment3) {
                $tab2_link = $segment2;
                $tab3 = ucwords(str_replace('-', ' ', $segment3));
            }





            function from_camel_case($input) {
              preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
              $ret = $matches[0];
              foreach ($ret as &$match) {
                $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
              }
              return implode(' ', $ret);
            }
            $tab2 = ucwords(from_camel_case($tab2));
        ?>      
              




        <div class="container-fluid p-0 wc">
           <div class="row ">
              <div class="col-md-6">
                 <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb pl-3 mr-3">
                       <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
                       <li class="breadcrumb-item active" aria-current="page"> <?=$tab2?></li>
                    </ol>                                              
                 </nav>
              </div>
              <div class="col-md-6 text-right">
                 <div class="lead_mm"><a href="<?php echo base_url('admin/leads');?>">Lead Management</a></div>
              </div>
           </div>
        </div>
        <style type="text/css">
            .row .col-md-12 .breadcrumb{
                display: none;
            }
        </style>



        <?php $a  = array('slider','slider','zoomtext','cms-page','StyleStories','story-blog-comment','blog-category','contact-us','ourteam','faqs_category','faqs','site-setting','review'); ?>
        <?php $b  = array('webuser','coupon','occasionStylistCategories','packagePurchasedUsers','serviceorder','homepageservices','our-services','services','subscription','consult_question','consultPlan','consultOrder','fashion-consulting-services','stylist-expertise-interests','looking-stylist','gift','gift_booking','allvideos','videos'); ?>
        <?php $c  = array('register-vendors','jobs','register-boutique','register-postJobUser'); ?>
    
        <?php $d  = array('shopslider','category','sizes','colors','allproducts','offers','brand','abandon_cart','user-order'); ?>
        <?php $e  = array('ask-quote-form','collaborate','fashionExpertConsultation','check_availability','freesession','report_an_issue_question','report_an_issue','RakhiLeads','DiwaliLeads','survey_log','ask_for_quote_log','get_started'); ?>

        <?php $f  = array('page','appvendor','appuser','users_report','posts_report','slidesapp','appdashboard','posts_category','posts_type','posts','activity_log','push_notification','push_notification_log','posts_report'); ?>
        <?php $g  = array('ourcorporateservices','corporate_user','corporate_company','domain','corporate_leads'); ?>
        
        <?php if(in_array($this->uri->segment(2), $a)){ ?>
            <script type="text/javascript">
                $('#footerDropdown1').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $b)){ ?>
            <script type="text/javascript">
                $('#footerDropdown').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $c)){ ?>
            <script type="text/javascript">
                $('#user_managment').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $d)){ ?>
            <script type="text/javascript">
                $('#product_managment').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $e)){ ?>
            <script type="text/javascript">
                $('#allFormsDropdown').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $f)){ ?>
            <script type="text/javascript">
                $('#mobileAppDropdown').addClass('show');
            </script>
        <?php } else if(in_array($this->uri->segment(2), $g)){ ?>
            <script type="text/javascript">
                $('#corporateAppDropdown').addClass('show');
            </script>
        <?php }else{ ?>
        <?php } ?>