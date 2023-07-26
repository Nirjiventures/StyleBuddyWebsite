<?php $this->load->view('admin/template/header'); ?>
<?php $segment1 = $this->uri->segment(1);?>
<?php $segment2 = $this->uri->segment(2);?>
<?php $segment3 = $this->uri->segment(3);?>
<div class="container-fluid p-0">
   <div class="row">
      <div class="col-md-12">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-3 mr-3 ">
               <li class="breadcrumb-item "><a href="<?php echo base_url("admin-dashboard");?>" class="text-decoration-none">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
            </ol>
         </nav>
      </div>
   </div>
</div>
<div class="container-fluid">
   	<div class="row">

      	<div class="col-md-12 mt-5 form-main">
      		<div class="card  form-card">
	            <div id="success_message"></div>
				<span class="text-center text-info mb-2" id="susid"> <?php echo $this->session->flashdata('success');?></span>
				<span class="text-center text-white bg-danger mb-2" id="errid"> <?php  echo $this->session->flashdata('error');?></span>

             	<?php  if(empty($record_detail)) {$record_detail=array(); } ?>
	            <div class="x_content">
	            	<a href="<?php  echo base_url('admin/'.$segment2); ?>" class="btn btn-primary float-right"> <?=$right_heading?></a>
         	
	                <br>
	                <?php $attributes = array('class' => 'form-horizontal form-label-left', 'id' => 'myform1');?>
					
	                <?php echo form_open_multipart(current_url(),$attributes); ?>
						<div class="row">
							<div class="">
								<div class="row">
									<div class="col-md-6">
										<div>
											<label class="control-label">Name *</label>
											<input name="name" maxlength="50" type="text" value="<?php if(set_value('name')) { echo set_value('name');}else { echo (!empty($record_detail->name))?$record_detail->name:''; } ?>" required="required" class="form-control neo" placeholder="Enter first name">
											<?php echo form_error('name') ? '<span class="error">'.form_error('name').'</span>' : ''?>
										</div>
									</div>
									<div class="col-md-6">
									</div> 
									<div class="col-md-6">
										<div>
											<label class="control-label">Email </label>
											<?php $readonly= '';if($segment3 == 'edit'){$readonly = 'readonly';}?>
											<input name="email" <?=$readonly?> maxlength="50" type="text" value="<?php if(set_value('email')) { echo set_value('email');}else { echo (!empty($record_detail->email))?$record_detail->email:''; } ?>" class="form-control neo" placeholder="Enter Email">
											<?php echo form_error('email') ? '<span class="error">'.form_error('email').'</span>' : ''?>
										</div>
									</div>
									<div class="col-md-6">
										<!-- <div>
											<label class="control-label">Phone</label>
											<input name="phone" maxlength="20" type="text" value="<?php if(set_value('phone')) { echo set_value('phone');}else { echo (!empty($record_detail->phone))?$record_detail->phone:''; } ?>" class="form-control neo" placeholder="Enter phone">
										</div> -->
									</div>
									<div class="col-sm-6">
										<div>
											<label class="control-label">Password *</label>
											<input name="password" maxlength="20" type="password" value=""  class="form-control neo" placeholder="Enter password">
											<?php echo form_error('password') ? '<span class="error">'.form_error('password').'</span>' : ''?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2" style="display: none;">
								<?php $img =  'assets/images/no-image.jpg';?>
                              	<?php if(!empty($record_detail->profilephoto))  {?>
                                 	<?php 
	                                    $img1 =  'assets/images/vandor/'.$record_detail->profilephoto; 
	                                    if (file_exists($img1)) {
	                                         $img = $img1;
	                                    }
                                 	?>
                              	<?php } ?>
                              	

									<label class="control-label">Profile Photo</label>
									<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url($img)?>" class="img-thumbnail"class="img-thumbnail" style="width:100px; min-height:60px;"> 

									<input name="profilephoto" type="file"  style="width:110px;">
								 
							</div>
							<div class="clearfix"></div>
						</div>
						<div>
	                 	<?php $permision = unserialize($record_detail->permission);?>
							 	  
	                 	  
							<?php 	

								$arrayAll = array(
										//'Manage All CMS PAGES'=>array(),
										/*'Manage Slider'=>array('admin/slider'=>'Read','admin/slider/add'=>'Create','admin/slider/edit'=>'Update'),
										'Add Slide'=>array('admin/slides'=>'Read','admin/slides/add'=>'Create','admin/slides/edit'=>'Update','admin/slides/delete'=>'Delete'),
										'Add Zoom Text'=>array('admin/zoomtext'=>'Read','admin/zoomtext/add'=>'Create','admin/zoomtext/edit'=>'Update','admin/zoomtext/delete'=>'Delete'),
										'CMS Page'=>array('admin/cms-page'=>'Read','admin/cms-page/add'=>'Create','admin/cms-page/edit'=>'Update','admin/cms-page/delete'=>'Delete'),*/
										'Style Stories'=>array('admin/StyleStories'=>'Read','admin/StyleStories/add'=>'Create','admin/StyleStories/edit'=>'Update','admin/StyleStories/delete'=>'Delete'),
										'Blog Category'=>array('admin/blog-category'=>'Read','admin/blog-category/add'=>'Create','admin/blog-category/edit'=>'Update','admin/blog-category/delete'=>'Delete'),
										'Blog Comments'=>array('admin/story-blog-comment'=>'Read','admin/story-blog-comment/delete'=>'Delete'),
										//'Contact Us'=>array('admin/contact-us'=>'Read','admin/contact-us/delete'=>'Delete'),
										//'Our team'=>array('admin/ourteam'=>'Read','admin/ourteam/add'=>'Create','admin/ourteam/edit'=>'Update','admin/ourteam/delete'=>'Delete'),
										//'Faqs Category'=>array('admin/faqs_category'=>'Read','admin/faqs_category/add'=>'Create','admin/faqs_category/edit'=>'Update','admin/faqs_category/delete'=>'Delete'),
										/*'Faqs'=>array('admin/faqs'=>'Read','admin/faqs/add'=>'Create','admin/faqs/edit'=>'Update','admin/faqs/delete'=>'Delete'),
										'Website Setting'=>array('admin/site-setting'=>'Read','admin/site-setting/edit'=>'Update'),
										'Review'=>array('admin/review'=>'Read','admin/site-setting/edit'=>'Update','admin/review/delete'=>'Delete'),*/
									/*'Stylig Services'=>array(),

										'Occasion Stylist Category List'=>array('admin/occasionStylistCategories'=>'Read','admin/occasionStylistCategories/add'=>'Create','admin/occasionStylistCategories/edit'=>'Update','admin/occasionStylistCategories/delete'=>'Delete'),
										'Our Services List'=>array('admin/our-services'=>'Read','admin/our-services/add'=>'Create','admin/our-services/edit'=>'Update','admin/our-services/delete'=>'Delete'),
										'Stylist Expertis'=>array('admin/stylist-expertise-interests'=>'Read','admin/stylist-expertise-interests/add'=>'Create','admin/stylist-expertise-interests/edit'=>'Update','admin/stylist-expertise-interests/delete'=>'Delete'),
										'Stylist Expertise'=>array('admin/looking-stylist'=>'Read','admin/looking-stylist/add'=>'Create','admin/looking-stylist/edit'=>'Update','admin/looking-stylist/delete'=>'Delete'),
										'Styling Packages'=>array('admin/services'=>'Read','admin/services/add'=>'Create','admin/services/edit'=>'Update','admin/services/delete'=>'Delete'),
										'Subscription'=>array('admin/subscription'=>'Read','admin/subscription/add'=>'Create','admin/subscription/edit'=>'Update','admin/subscription/delete'=>'Delete'),
										'Plans Question'=>array('admin/consult_question'=>'Read','admin/consult_question/add'=>'Create','admin/consult_question/edit'=>'Update','admin/consult_question/delete'=>'Delete'),
										'Yearly Plans'=>array('admin/consultPlan'=>'Read','admin/consultPlan/add'=>'Create','admin/consultPlan/edit'=>'Update','admin/consultPlan/delete'=>'Delete'),
										'Yearly Plan Subscriptions'=>array('admin/consultOrder'=>'Read','admin/consultOrder/add'=>'Create','admin/consultOrder/edit'=>'Update','admin/consultOrder/delete'=>'Delete'),
										'Fashion Consulting'=>array('admin/fashion-consulting-services'=>'Read','admin/fashion-consulting-services/add'=>'Create','admin/fashion-consulting-services/edit'=>'Update','admin/fashion-consulting-services/delete'=>'Delete'),
										'Create new gift card'=>array('admin/gift'=>'Read','admin/gift/add'=>'Create','admin/gift/edit'=>'Update','admin/gift/delete'=>'Delete'),
										'Purchased gift cards'=>array('admin/gift_booking'=>'Read','admin/gift_booking/add'=>'Create','admin/gift_booking/edit'=>'Update','admin/gift_booking/delete'=>'Delete'),
										'All Stylist Video'=>array('admin/allvideos'=>'Read','admin/allvideos/add'=>'Create','admin/allvideos/edit'=>'Update','admin/allvideos/delete'=>'Delete'),
										'Youtube Video'=>array('admin/videos'=>'Read','admin/videos/add'=>'Create','admin/videos/edit'=>'Update','admin/videos/delete'=>'Delete'),
										'Styling Services - Purchased'=>array('admin/packagePurchasedUsers'=>'Read','admin/packagePurchasedUsers/add'=>'Create','admin/packagePurchasedUsers/edit'=>'Update'),
										'Package orders'=>array('admin/serviceorder'=>'Read','admin/serviceorder/add'=>'Create','admin/serviceorder/edit'=>'Update'),
										'Registered User'=>array('admin/register-user'=>'Read','admin/register-user/edit'=>'Update'),*/
									/*'Stylist Zone'=>array(),
										
										'Registered stylists'=>array('admin/register-vendors'=>'Read','admin/register-vendors/edit'=>'Edit','admin/register-vendors/view'=>'View'),
										'Jobs'=>array('admin/jobs'=>'Read','admin/jobs/edit'=>'Edit','admin/jobs/delete'=>'Delete'),
										'Boutiquer User'=>array('admin/register-boutique'=>'Read','admin/register-boutique/edit'=>'Edit','admin/register-boutique/delete'=>'Delete'),
										'Post Job  User'=>array('admin/register-postJobUser'=>'Read','admin/register-postJobUser/edit'=>'Edit','admin/register-postJobUser/delete'=>'Delete'),
										'Register User'=>array('admin/register-user'=>'Read','admin/register-user/edit'=>'Edit'),*/
									
									'Shop'=>array(),


										'Shop Slider'=>array('admin/shopslider'=>'Read','admin/shopslider/add'=>'Create','admin/shopslider/edit'=>'Update','admin/shopslider/sliderDelete'=>'Delete'),
										'Category'=>array('admin/category'=>'Read','admin/category/add'=>'Create','admin/category/edit'=>'Update','admin/category/delete'=>'Delete'),
										'Sizes'=>array('admin/sizes'=>'Read','admin/sizes/add'=>'Create','admin/sizes/edit'=>'Update','admin/sizes/delete'=>'Delete'),
										'Colors'=>array('admin/colors'=>'Read','admin/colors/add'=>'Create','admin/colors/edit'=>'Update','admin/colors/delete'=>'Delete'),
										'All Products'=>array('admin/allproducts'=>'Read','admin/allproducts/edit'=>'Update'),
										'Offers'=>array('admin/offers'=>'Read','admin/offers/add'=>'Create','admin/offers/edit'=>'Update','admin/offers/delete'=>'Delete'),
										'Brand'=>array('admin/brand'=>'Read','admin/brand/add'=>'Create','admin/brand/edit'=>'Update','admin/brand/delete'=>'Delete'),
										'Abandon Cart'=>array('admin/abandon_cart'=>'Read','admin/abandon_cart/add'=>'Create','admin/abandon_cart/edit'=>'Update','admin/abandon_cart/delete'=>'Delete'),
										'User order'=>array('admin/user-order'=>'Read'),
									/*'All Forms'=>array(),

										'Collaborate'=>array('admin/collaborate'=>'Read','admin/Dashboard/collaborateUsDelete'=>'Delete'),
										'RakhiLeads'=>array('admin/RakhiLeads'=>'Read','admin/RakhiLeads/delete'=>'Delete'),
										'DiwaliLeads'=>array('admin/DiwaliLeads'=>'Read','admin/DiwaliLeads/delete'=>'Delete'),
										'Fashion Expert Consultation '=>array('admin/fashionExpertConsultation'=>'Read','admin/fashionExpertConsultation/delete'=>'Delete'),
										'Survey Log'=>array('admin/survey_log'=>'Read','admin/survey_log/delete'=>'Delete'),
										'Ask for quote Log'=>array('admin/ask_for_quote_log'=>'Read','admin/ask_for_quote_log/delete'=>'Delete'),
										'Get started Log'=>array('admin/get_started'=>'Read','admin/get_started/delete'=>'Delete'),
										'Report an issue question Log'=>array('admin/report_an_issue_question'=>'Read','admin/report_an_issue_question/add'=>'Add','admin/report_an_issue_question/edit'=>'Edit','admin/report_an_issue_question/delete'=>'Delete'),
										'Report an issue Log'=>array('admin/report_an_issue'=>'Read','admin/report_an_issue/delete'=>'Delete'),*/
									'SB App'=>array(),

										'Home Screen Content'=>array('admin/appdashboard'=>'Read','admin/appdashboard/edit'=>'Update'),
										'App Home Slider'=>array('admin/slidesapp'=>'Read','admin/slidesapp/add'=>'Create','admin/slidesapp/edit'=>'Update','admin/slidesapp/delete'=>'Delete'),
										'Post Category'=>array('admin/posts_category'=>'Read','admin/posts_category/add'=>'Create','admin/posts_category/edit'=>'Update','admin/posts_category/delete'=>'Delete'),
										'Post Type'=>array('admin/posts_type'=>'Read','admin/posts_type/add'=>'Create','admin/posts_type/edit'=>'Update','admin/posts_type/delete'=>'Delete'),
										'All App Posts'=>array('admin/posts'=>'Read','admin/posts/edit'=>'Update','admin/posts/delete'=>'Delete'),
										'Activity log'=>array('admin/activity_log'=>'Read','admin/activity_log/delete'=>'Delete'),
										'Push Notification'=>array('admin/push_notification'=>'Read','admin/push_notification/send'=>'Send','admin/push_notification/delete'=>'Delete'),
										'User Activity Notification'=>array('admin/push_notification_log'=>'Read','admin/push_notification_log/delete'=>'Delete'),
										'Post Report'=>array('admin/posts_report'=>'Read','admin/posts_report/delete'=>'Delete'),
									/*'Corporate Zone'=>array(),

										'Corporate Leads'=>array('admin/corporate_leads'=>'Read'),
										'Corporate Company'=>array('admin/corporate_company'=>'Read','admin/corporate_company/add'=>'Create','admin/corporate_company/edit'=>'Update','admin/corporate_company/delete'=>'Delete'),
										'Domain'=>array('admin/domain'=>'Read','admin/domain/add'=>'Create','admin/domain/edit'=>'Update','admin/domain/delete'=>'Delete'),
										'Corporate Users'=>array('admin/corporate_user'=>'Read','admin/corporate_user/add'=>'Create','admin/corporate_user/edit'=>'Update','admin/corporate_user/delete'=>'Delete'),
										'Corporate Services'=>array('admin/ourcorporateservices'=>'Read','admin/ourcorporateservices/add'=>'Create','admin/ourcorporateservices/edit'=>'Update','admin/ourcorporateservices/delete'=>'Delete'),*/
									/*	
									'Others'=>array(),
										'Referral'=>array('admin/referral'=>'Read','admin/referral/add'=>'Create','admin/referral/edit'=>'Update','admin/referral/delete'=>'Delete'),
										'Lead Management '=>array('admin/leads'=>'Read','admin/leads/upload'=>'Create','admin/leads/edit'=>'Update','admin/leads/delete'=>'Delete'),
										'Check Lead Management '=>array('admin/check_availability'=>'Read','admin/check_availability/upload'=>'Create','admin/check_availability/edit'=>'Update','admin/check_availability/delete'=>'Delete'),
										'Admin Guide'=>array('admin/adminguide'=>'Read','admin/adminguide/upload'=>'Create','admin/adminguide/delete'=>'Delete'),*/
								);
							?>					
						<?php foreach($arrayAll as $key=>$array){?>
							<div class="user-right">
								<div class="row">
									<?php if(empty($array)){ ?>
										<div class="col-md-12"><h3 style="color:#E72EC1"><?=$key?></h3></div>
									<?php }else{ ?>
										<div class="col-md-12"><h3><?=$key?></h3></div>
									<?php } ?>
									<?php foreach($array as $k=>$v){?>
									<?php if(!empty($permision) && in_array($k,$permision)){$chk = 'checked';}else{$chk = '';}?>
										<div class="col-md-3 col-sm-12"> <input type="checkbox" name="permission[]" value="<?=$k;?>" <?=$chk;?>> <label><?=$v;?></label> </div>
									<?php } ?>
									<div class="col-md-12"></div>
								</div>
							</div> 
						<?php } ?>
						<div class="ln_solid"></div>
	                    <div class="row">
	                        <div class="col-md-12">
	                        	<br/><br/>
	                            <div class="stick">
	    							<button type="submit" class="btn btn-success">Submit</button>
	                            </div>
	                        </div>
	                    </div>

	                    </div>

	                <?php echo form_close(); ?>
	            </div>
        	</div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>
