<div class="sidebar" id="mySidenav">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>




<div class="uskk "> 
<?php if($profile->image) { ?>
<a target="_blank"  href="<?=base_url('stylists/'.base64_encode($profile->id).'/'.$profile->fname.'.'.$profile->lname)?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('/assets/images/vandor/').$profile->image ?>" class="img-fluid"></a>
<?php } else { ?>
<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url() ?>assets/images/no-image.jpg" class="img-fluid">
<?php } ?>
	
<h4><?= strtoupper($profile->fname.' '.$profile->lname) ?></h4>
<p>Email id : <?= $profile->email ?></p>
<a href="<?= base_url() ?>"class="btn btn-info ">Go to Website</a>

</div>
<ul>
	<li><a href="<?= base_url('stylist-zone/dashboard') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard </a></li>
	<li><a href="<?= base_url('stylist-zone/manage-profile') ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
	<li><a href="<?= base_url('stylist-zone/available-dates') ?>"><i class="fa fa-user" aria-hidden="true"></i>Stylist Calendar </a></li>
	<!--<li><a href="<?= base_url('stylist-zone/capture-video') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Upload Videos</a></li>-->

	 <li>
    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link  align-middle">
        <i class="fa fa-video-camera" aria-hidden="true"></i> <span class="ms-1 d-none d-sm-inline">Videos</span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>

        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
	        <!-- <li class="w-100">
	            <a href="#" class="nav-link "> <span class="d-none d-sm-inline">Start Recording</span></a>
	        </li> -->
	        <li>
	            <a class="nav-link" href="<?= base_url('stylist-zone/capture-video-add') ?>"> <span class="d-none d-sm-inline">Record Video</span></a>
	        </li>
	        <li>
	        	<a class="nav-link" href="<?= base_url('stylist-zone/add-video') ?>"><span class="d-none d-sm-inline"> Upload Video</span></a>
	        </li>
	        <li>
	        	<a class="nav-link" href="<?= base_url('stylist-zone/manage-video') ?>"><span class="d-none d-sm-inline"> Manage Videos</span></a>
	        </li>
	        <!-- <li>
	        	<a class="nav-link" href="<?= base_url('stylist-zone/youtube-video') ?>"><span class="d-none d-sm-inline"> Youtube Videos</span></a>
	        </li> -->
	        <!-- <li>
	            <a href="#" class="nav-link "> <span class="d-none d-sm-inline">Youtube Videos</span></a>
	        </li> -->
        
    	</ul>
	</li>

	
	<li><a href="<?= base_url('stylist-zone/manage-portfolio') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Manage Portfolio</a></li>

	<li><a href="<?= base_url('stylist-zone/manage-style-stories') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Manage Stories</a></li>
	<li><a href="<?= base_url('stylist-zone/manage-products') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Manage Products</a></li>
	<li><a href="<?= base_url('stylist-zone/orders') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i>Manage Orders</a></li>

	<li><a href="<?= base_url('stylist-zone/user-orders') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> My Orders</a></li>
	<li><a href="<?= base_url('stylist-zone/user-wishlist') ?>"><i class="fa fa-heart" aria-hidden="true"></i> My Wishlist</a></li>
	<!--<li><a href="<?= base_url('stylist-zone/user-address') ?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> Address</a></li>-->

	<li><a href="<?= base_url('stylist-zone/setting') ?>"><i class="fa fa-cog" aria-hidden="true"></i> Update Password</a></li>
	<li><a target="_blank"  href="<?= base_url('service-provider-agreement') ?>"><i class="fa fa-list-ol" aria-hidden="true"></i> Service Provider Agreement</a></li>
	<li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>





</ul>

	</div>



<style type="text/css">
	.nav-link:focus, .nav-link:hover {
    color: #f7f3da!important;
}
ul#submenu3 {
    padding-left: 50px;
}
</style>