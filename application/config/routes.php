<?php

defined('BASEPATH') OR exit('No direct script access allowed');





//$route['default_controller'] = 'Vendor/vendorRegistration';

$route['default_controller'] = 'Home/index';

//$route['404_override'] = '';
$route['404_override'] = 'home/_404';
$route['translate_uri_dashes'] = FALSE;






/********************************** 

        ADMIN ROUTE 

***********************************/

$route['res'] = 'Vendor/vendorRegistrationRes';

$route['stylebuddy-admin'] = 'admin/Login';
$route['desk-login'] = 'admin/Login/desk_login';
$route['admin-dashboard'] = 'admin/Dashboard';



$route['admin/category'] = 'admin/Dashboard/category';

$route['admin/add-category'] = 'admin/Dashboard/categoryForm';

$route['admin/edit-category/(:num)'] = 'admin/Dashboard/categoryEdit/$1';

$route['admin/update-category'] = 'admin/Dashboard/categoryUpdate';

$route['admin/delete-category/(:num)'] = 'admin/Dashboard/categoryDelete/$1';

$route['update_category_status'] = 'admin/Dashboard/categoryStatusUpdate';



$route['subcategory'] = 'admin/Dashboard/subcategory';

$route['add-subcategory'] = 'admin/Dashboard/subcategoryForm';

$route['edit-subcategory/(:num)'] = 'admin/Dashboard/subcategoryEdit/$1';

$route['update-subcategory'] = 'admin/Dashboard/subcategoryUpdate';

$route['delete-subcategory/(:num)'] = 'admin/Dashboard/subcategoryDelete/$1';

$route['update_subcategory_status'] = 'admin/Dashboard/subcategoryStatusUpdate';



$route['admin/child-subcategory'] = 'admin/Dashboard/childSubcategory';

$route['admin/add-child-subcategory'] = 'admin/Dashboard/childSubcategoryForm';

$route['admin/edit-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryEdit/$1';

$route['admin/update-child-subcategory'] = 'admin/Dashboard/childSubcategoryUpdate';

$route['delete-child-subcategory/(:num)'] = 'admin/Dashboard/childSubcategoryDelete/$1';

$route['update_child_subcategory_status'] = 'admin/Dashboard/childSubcategoryStatusUpdate';


/*
$route['admin/add-slider'] = 'admin/Slider/sliderForm';

$route['admin/slider'] = 'admin/Slider/slider';

$route['admin/edit-slider/(:num)'] = 'admin/Slider/sliderEdit/$1';

$route['admin/update-slider'] = 'admin/Slider/sliderUpdate';

$route['admin/delete-slider/(:num)'] = 'admin/Slider/sliderDelete/$1';

$route['admin/update_slider_status'] = 'admin/Slider/sliderStatusUpdate';*/





$route['admin/add-our-services'] = 'admin/FasishonServices/serviceForm';

$route['admin/our-services'] = 'admin/FasishonServices/service';

$route['admin/edit-our-services/(:num)'] = 'admin/FasishonServices/serviceEdit/$1';

$route['admin/update-our-services'] = 'admin/FasishonServices/serviceUpdate';

$route['admin/delete-our-services/(:num)'] = 'admin/FasishonServices/serviceDelete/$1';

$route['admin/update_our_services_status'] = 'admin/FasishonServices/serviceStatusUpdate';                    





// mangae stylist location

$route['admin/add-personal-stylist'] = 'admin/FasishonServices/personalStylistForm';

$route['admin/personal-stylist'] = 'admin/FasishonServices/personalStylist';

$route['admin/edit-personal-stylist/(:num)'] = 'admin/FasishonServices/personalStylistEdit/$1';

$route['admin/update-personal-stylist'] = 'admin/FasishonServices/personalStylistUpdate';

$route['admin/delete-personal-stylist/(:num)'] = 'admin/FasishonServices/personalStylistDelete/$1';

$route['admin/update_personal_stylist_status'] = 'admin/FasishonServices/personalStylistStatusUpdate';





$route['admin/add-fashion-services'] = 'admin/FasishonServices/fasihonForm';

$route['admin/fashion-services'] = 'admin/FasishonServices/fasihon';

$route['admin/edit-fashion-services/(:num)'] = 'admin/FasishonServices/fasihonEdit/$1';

$route['admin/update-fashion-services'] = 'admin/FasishonServices/fasihonUpdate';

$route['admin/delete-fashion-services/(:num)'] = 'admin/FasishonServices/fasihonDelete/$1';

$route['admin/update_fashion_services_status'] = 'admin/FasishonServices/fasihonStatusUpdate';





$route['admin/add-fashion-consulting-services'] = 'admin/FasishonServices/consultingForm';

$route['admin/fashion-consulting-services'] = 'admin/FasishonServices/consulting';

$route['admin/edit-fashion-consulting-services/(:num)'] = 'admin/FasishonServices/consultingEdit/$1';

$route['admin/update-fashion-consulting-services'] = 'admin/FasishonServices/consultingUpdate';

$route['admin/delete-fashion-consulting-services/(:num)'] = 'admin/FasishonServices/consultingDelete/$1';

$route['admin/update_fashion_consulting_services_status'] = 'admin/FasishonServices/consultingStatusUpdate';





$route['admin/add-stylist-expertise-interests'] = 'admin/FasishonServices/stylistForm';

$route['admin/stylist-expertise-interests'] = 'admin/FasishonServices/stylist';

$route['admin/edit-stylist-expertise-interests/(:num)'] = 'admin/FasishonServices/stylistEdit/$1';

$route['admin/update-stylist-expertise-interests'] = 'admin/FasishonServices/stylistUpdate';

$route['admin/delete-stylist-expertise-interests/(:num)'] = 'admin/FasishonServices/stylistDelete/$1';

$route['admin/update_stylist_expertise_interests_status'] = 'admin/FasishonServices/stylistStatusUpdate';





$route['admin/looking-stylist'] = 'admin/FasishonServices/looking_stylist';

$route['admin/looking-stylist/add'] = 'admin/FasishonServices/looking_stylist_add';

$route['admin/looking-stylist/edit/(:num)'] = 'admin/FasishonServices/looking_stylist_edit/$1';

$route['admin/looking-stylist/delete/(:num)'] = 'admin/FasishonServices/looking_stylist_delete/$1';

$route['admin/looking-stylist_status'] = 'admin/FasishonServices/looking_stylist_delete_status';


$route['admin/looking-stylist-city'] = 'admin/FasishonServices/looking_stylist_city';

$route['admin/looking-stylist-city/add'] = 'admin/FasishonServices/looking_stylist_city_add';

$route['admin/looking-stylist-city/edit/(:num)'] = 'admin/FasishonServices/looking_stylist_city_edit/$1';

$route['admin/looking-stylist-city/delete/(:num)'] = 'admin/FasishonServices/looking_stylist_city_delete/$1';

$route['admin/looking-stylist-city_status'] = 'admin/FasishonServices/looking_stylist_delete_city_status';





$route['admin/add-theme'] = 'admin/FasishonServices/addTheme';

$route['admin/manage-theme'] = 'admin/FasishonServices/manageTheme';

$route['admin/edit-theme/(:num)'] = 'admin/FasishonServices/editTheme/$1';

$route['admin/update-theme'] = 'admin/FasishonServices/updateTheme';

$route['admin/delete-theme/(:num)'] = 'admin/FasishonServices/deleteTheme/$1';

$route['admin/update_theme_status'] = 'admin/FasishonServices/updateThemeStatus';





$route['all-category'] = 'admin/Dashboard/productAll';



// testmonial _/\_ 

$route['admin/add-testimonial'] = 'admin/Testimonials/testimonialForm';

$route['admin/testimonial'] = 'admin/Testimonials/testimonial';

$route['admin/edit-testimonial/(:num)'] = 'admin/Testimonials/testimonialEdit/$1';

$route['admin/update-testimonial'] = 'admin/Testimonials/testimonialUpdate';

$route['admin/delete-testimonial/(:num)'] = 'admin/Testimonials/testimonialDelete/$1';

$route['admin/update_testimonial_status'] = 'admin/Testimonials/testimonialStatusUpdate';



$route['admin/policy'] = 'admin/PolicyTerm/policy';

$route['admin/add-policy'] = 'admin/PolicyTerm/policyForm';

$route['admin/edit-policy/(:num)'] = 'admin/PolicyTerm/policyEdit/$1';

$route['admin/update-policy'] = 'admin/PolicyTerm/policyUpdate';

$route['admin/delete-policy/(:num)'] = 'admin/PolicyTerm/policyDelete/$1';

$route['admin/update_policy_status'] = 'admin/PolicyTerm/policyStatusUpdate';





// career

$route['admin/career'] = 'admin/Career/careers';

$route['admin/add-career'] = 'admin/Career/careersForm';

$route['admin/edit-career/(:num)'] = 'admin/Career/careersEdit/$1';

$route['admin/update-career'] = 'admin/Career/careersUpdate';

$route['admin/delete-career/(:num)'] = 'admin/Career/careersDelete/$1';

$route['admin/update_careers_status'] = 'admin/Career/careersStatusUpdate';





$route['admin/cms-page'] = 'admin/AboutUs/about';

$route['admin/add-cms-page'] = 'admin/AboutUs/aboutForm';

$route['admin/edit-cms-page/(:num)'] = 'admin/AboutUs/aboutEdit/$1';

$route['admin/update-cms-page'] = 'admin/AboutUs/aboutUpdate';

$route['admin/delete-cms-page/(:num)'] = 'admin/AboutUs/aboutDelete/$1';

$route['admin/update_cmspage_status'] = 'admin/AboutUs/aboutStatusUpdate';



$route['admin/site-setting'] = 'admin/SiteSetting/setting';

$route['admin/edit-site-setting/(:num)'] = 'admin/SiteSetting/settingEdit/$1';

$route['admin/update-site-setting'] = 'admin/SiteSetting/settingUpdate';



$route['admin/blog-category'] = 'admin/Blog/blogCategory';

$route['admin/add-blog-category'] = 'admin/Blog/blogCategoryForm';

$route['admin/edit-blog-category/(:num)'] = 'admin/Blog/blogCategoryEdit/$1';

$route['admin/update-blog-category'] = 'admin/Blog/blogCategoryUpdate';

$route['admin/delete-blog-category/(:num)'] = 'admin/Blog/blogCategoryDelete/$1';

$route['admin/update_blog_category_status'] = 'admin/Blog/blogCategoryStatusUpdate';





$route['admin/all-products'] = 'admin/Vender/allProducts';

$route['admin/register-vendors'] = 'admin/Vender/venderDetails';

$route['admin/register-vendors/(:num)'] = 'admin/Vender/venderDetails/$1';

$route['admin/register-vendors/vendor-details/(:num)'] = 'admin/Vender/venderDetail/$1';

$route['admin/register-vendors/vendor-protfolio/(:num)'] = 'admin/Vender/venderProtfolio/$1';

$route['admin/update_vender_status']  = 'admin/Vender/venderStatusUpdate';

$route['admin/all-style-stories'] = 'admin/Vender/blogs';



$route['admin/user-order'] = 'admin/Vender/userOrder';

$route['orderAction'] = 'admin/Vender/orderAction';

$route['admin/user-order-details/(:num)'] = 'admin/Vender/userOrderDetails/$1';



$route['admin/blog'] = 'admin/Blog/blogs';

$route['admin/add-blog'] = 'admin/Blog/blogsForm';

$route['admin/edit-blog/(:num)'] = 'admin/Blog/blogsEdit/$1';

$route['admin/update-blog'] = 'admin/Blog/blogsUpdate';

$route['admin/delete-blog/(:num)'] = 'admin/Blog/blogsDelete/$1';

$route['admin/update_blogs_status'] = 'admin/Blog/blogsStatusUpdate';



$route['admin/contact-us'] = 'admin/Dashboard/contactUs';
$route['admin/story-blog-comment'] = 'admin/Dashboard/storyblogcomment';

$route['admin/collaborate'] = 'admin/Dashboard/collaborateUs';
$route['admin/ask-quote-form'] = 'admin/Dashboard/askQuote';

$route['admin/register-user'] = 'admin/vender/registerUser';
$route['admin/register-user/(:num)'] = 'admin/Vender/registerUser/$1';

$route['admin/update_registeruser_status'] = 'admin/vender/userStatusUpdate';
$route['admin/register-boutique'] = 'admin/vender/boutiqueUser';
$route['admin/register-postJobUser'] = 'admin/vender/postJobUser';



/********************************** 

        FRONT ROUTE

***********************************/



$route[''] = 'page';





$route['forgot-password'] = 'Login/vendorForgotPass';

$route['reset-password'] = 'Login/resetPass';

$route['city-data'] = 'Vendor/fetchCity';



$route['vendor'] = 'Vendor/dashboard';

$route['stylist-zone/dashboard'] = 'Vendor/dashboard';
$route['stylist-zone/my-dashboard'] = 'Vendor/mydashboard';



$route['stylist-zone/manage-profile'] = 'Vendor/profile';

$route['stylist-zone/profile-update'] = 'Vendor/profileUpdate';

$route['stylist-zone/my-profile'] = 'Vendor/myProfile';

$route['stylist-zone/my-profile-update'] = 'Vendor/myProfileUpdate';

$route['stylist-zone/setting'] = 'Vendor/setting';

$route['stylist-zone/update-password'] = 'Vendor/updatePassword';



$route['stylist-zone/manage-style-stories'] = 'Vendor/manageStories';

$route['stylist-zone/add-style-stories'] = 'Vendor/addStories';

$route['stylist-zone/edit-style-stories/(:num)'] = 'Vendor/editStories/$1';

$route['stylist-zone/update-style-stories'] = 'Vendor/updateStories/';

$route['stylist-zone/delete-style-stories/(:num)'] = 'Vendor/deleteStories/$1';





$route['stylist-zone/manage-tags'] = 'Vendor/manageTags';

$route['stylist-zone/add-tags'] = 'Vendor/addTags';

$route['stylist-zone/edit-tags/(:num)'] = 'Vendor/editTags/$1';

$route['stylist-zone/update-tags'] = 'Vendor/updateTags/';

$route['stylist-zone/delete-tags/(:num)'] = 'Vendor/deleteTags/$1';





$route['stylist-zone/add-ideas-test'] = 'Vendor/addIdeasTest';



$route['stylist-zone/manage-portfolio'] = 'Vendor/manageIdeas';

$route['stylist-zone/add-ideas'] = 'Vendor/addIdeas';

$route['stylist-zone/edit-ideas/(:num)'] = 'Vendor/editIdeas/$1';

$route['stylist-zone/update-ideas'] = 'Vendor/updateIdeas/';

$route['stylist-zone/delete-ideas/(:num)'] = 'Vendor/deleteIdeas/$1';





$route['stylist-zone/manage-video'] = 'Vendor/manageVideo';

$route['stylist-zone/add-video'] = 'Vendor/addVideo';

$route['stylist-zone/edit-video/(:num)'] = 'Vendor/editVideo/$1';

$route['stylist-zone/update-video'] = 'Vendor/updateVideo/';

$route['stylist-zone/delete-video/(:num)'] = 'Vendor/deleteVideo/$1';



$route['stylist-zone/user-orders'] = 'Vendor/myorders';

$route['stylist-zone/user-orders/(:any)'] = 'Vendor/myorders/$1';

$route['stylist-zone/user-wishlist'] = 'Vendor/wishlist';

$route['stylist-zone/user-address'] = 'Vendor/address';

$route['stylist-zone/available-dates'] = 'Vendor/available_dates';

$route['stylist-zone/capture-video'] = 'Vendor/capture_video';
$route['stylist-zone/capture-video-add'] = 'Vendor/capture_video_add';

$route['stylist-zone/youtube-video'] = 'Vendor/youtube_video';
$route['stylist-zone/youtube-video-add'] = 'Vendor/youtube_video_add';






// $route['vendor/manage-ideas'] = 'Vendor/manageIdeas';

// $route['vendor/add-ideas'] = 'Vendor/addIdeas';

// $route['vendor/edit-ideas/(:num)'] = 'Vendor/editIdeas/$1';

// $route['vendor/update-ideas'] = 'Vendor/updateIdeas/';



$route['stylist-zone/explore-detail'] = 'Vendor/explore_detail';
$route['stylist-zone/manage-products'] = 'Vendor/manageProducts';

$route['stylist-zone/add-products'] = 'Vendor/addProducts';

$route['stylist-zone/edit-products/(:num)'] = 'Vendor/editProducts/$1';

$route['stylist-zone/update-products'] = 'Vendor/updateProducts/';

$route['stylist-zone/delete-products/(:num)'] = 'Vendor/deleteProducts/$1';



$route['stylist-zone/orders'] = 'Vendor/orders';
$route['stylist-zone/orders/view-order/(:any)'] = 'Vendor/ordersdetails/$1';

$route['stylist-zone/orders/view-order'] = 'Vendor/ordersDetails';
$route['stylist-zone/leads'] = 'Vendor/leads';
$route['stylist-zone/lead-detail/(:any)'] = 'Vendor/lead_detail/$1';



$route['contact-us'] = 'page/contact';
$route['contact-us-develop'] = 'page/contact_develop';

$route['collaborate-with-us'] = 'page/collaborate';

$route['form-process'] = 'page/process';



/*

$route['fashiongram'] = 'page/fashiongram'; 
$route['fashiongram'] = 'page/fashiongram';
$route['fashiongram/(:num)'] = 'page/fashiongram/$1';
$route['stylist-zone/fashiongram-detail'] = 'page/fashiongram_detail';
$route['stylist-zone/fashiongram-detail/(:any)'] = 'page/fashiongram_detail/$1';
$route['stylist-zone/fashiongram-detail/(:any)/(:any)'] = 'page/fashiongram_detail/$1/$2';

$route['fashiongram-video'] = 'page/fashiongram_video';
$route['fashiongram-video/(:num)'] = 'page/fashiongram_video/$1';

$route['stylist-zone/fashiongram-video-detail'] = 'page/fashiongram_video_detail';
$route['stylist-zone/fashiongram-video-detail/(:any)'] = 'page/fashiongram_video_detail/$1';
$route['stylist-zone/fashiongram-video-detail/(:any)/(:any)'] = 'page/fashiongram_video_detail/$1/$2';
*/



/*
$route['fashion-services'] = 'page/fashionService';




$route['connect-with-stylists-develop']                                    = 'page/expertise_develop';
$route['connect-with-stylists-develop/(:any)']                             = 'page/stylistExpert_develop/$1';
$route['connect-with-stylists-develop/(:any)/(:any)']                      = 'page/stylistExpert_develop/$1/$2';
$route['connect-with-stylists-develop/(:any)/(:any)/(:any)']               = 'page/stylistExpert_develop/$1/$2/$3';
$route['connect-with-stylists-develop/(:any)/(:any)/(:any)/(:any)']        = 'page/stylistExpert_develop/$1/$2/$3/$4';


*/


/*$route['stylist-and-expert']                                    = 'page/stylistExpert';

$route['stylist-and-expert/(:any)']                             = 'page/stylistExpert/$1';

$route['stylist-and-expert/(:any)/(:any)']                      = 'page/stylistExpert/$1/$2';

$route['stylist-and-expert/(:any)/(:any)/(:any)']               = 'page/stylistExpert/$1/$2/$3';

$route['stylist-and-expert/(:any)/(:any)/(:any)/(:any)']        = 'page/stylistExpert/$1/$2/$3/$4';

*/

/*



$route['styling-and-image-management-services'] = 'page/styleingService';

$route['stylistSearch'] = 'page/stylistSearch';

//https://dndtestserver.com/stylebuddy2/dev/page/cities

$route['page/cities']   = 'page/cities';

$route['page/search_stylist_by_city']   = 'page/search_stylist_by_city';

$route['page/search_stylist_by_name']   = 'page/search_stylist_by_name';

$route['page/search_stylist_by_state']  = 'page/search_stylist_by_state';





$route['stylist-by-state'] = 'page/stylistExpertByState';

$route['stylist-by-state/(:any)'] = 'page/stylistExpertByState/$1';

$route['stylist-search'] = 'page/stylistSearchPage';

$route['stylist-search/(:any)'] = 'page/stylistSearchPage/$1';

$route['styling-and-image-management-services/(:num)'] = 'page/styleingService/$1';

$route['stylist-profile'] = 'page/profile/';

$route['stylist-profile/(:any)'] = 'page/profile/$1';

$route['stylist-ideas/(:any)'] = 'page/stylistIdea/$1';


$route['stylists-develop/(:any)'] = 'page/profile_develop/$1';
$route['stylists-develop/(:any)/(:any)'] = 'page/profile_develop/$1/$2';





// new page

$route['buy-styling-packages'] = 'page/stylistFormBookHome';  

$route['ask-for-quote'] = 'page/stylistForm';  

$route['ask-for-quote/(:any)'] = 'page/stylistForm/$1';  

$route['styling-services'] = 'page/stylistService';

$route['services-detail'] = 'page/serviceDetails';

 




$route['checkout-stylist-book'] = 'page/checkout_stylist_book';

$route['address-process'] = 'page/addressProcess';

$route['thanks-page'] = 'page/thanksPage';


 



$route['job-board'] = 'page/job'; 

$route['job-board/(:any)'] = 'page/jobDetails/$1';





// new page

$route['how-it-works'] = 'page/howItWork'; 

$route['book-online'] = 'page/bookOnline';

$route['book-now/(:any)'] = 'page/bookNows/$1';

$route['book-now-process'] = 'page/bookNowsPrecess';

$route['booking-form'] = 'page/bookForm';

$route['booking-process'] = 'page/bookProcess';

$route['booking-checkout'] = 'page/bookCheckout';





$route['theme'] = 'page/theme'; 



$route['initial-booking-form'] = 'page/servicesForm';

$route['initial-booking-form/(:any)'] = 'page/servicesForm/$1';



$route['team'] = 'page/team';

$route['team/team-details'] = 'page/teamDetails';

$route['team/team-details/(:any)'] = 'page/teamDetails/$1';





// new pages

$route['loyalty'] = 'page/loyalty';

$route['gift-card'] = 'page/giftCard'; 

$route['personal-styling-locations'] = 'page/personalStyleLocation';

$route['personal-stylist/(:any)'] = 'page/personalStyleLocationdetails/$1';

*/




//UI

//

/*
$route['user/registration-process'] = 'page/registerProcess';

$route['user/forgot-password'] = 'page/forgotPassword';

$route['user/forgot-process'] = 'page/forgotProcess';

$route['login/reset_password'] = 'page/reset_password';

$route['user/login'] = 'page/login'; 

$route['user/login-process'] = 'page/userLogin';

*/
$route['logout'] = 'login/logout';

//user
$route['user/user-dashboard'] = 'User/userDashboard';
$route['user/user-profile'] = 'User/profile';
$route['user/profile-update'] = 'User/profileUpdate';
$route['user/user-orders'] = 'User/orders';
$route['user/user-orders/(:any)'] = 'User/orders/$1';
$route['user/user-wishlist'] = 'User/wishlist';
$route['user/user-address'] = 'User/address';
$route['user/user-setting'] = 'User/setting';




$route['vendor/user-orders'] = 'Vendor/myorders';
$route['vendor/user-orders/(:any)'] = 'Vendor/myorders/$1';
$route['vendor/user-wishlist'] = 'Vendor/wishlist';
$route['vendor/user-address'] = 'Vendor/address';


$route['login'] = 'Login/vendorLogin';
$route['login-process'] = 'Login/vendorLoginProcess';
$route['user/registration'] = 'Login/register';
$route['stylist-zone/registration'] = 'Login/vendorRegistration';
$route['login/reset_password'] = 'Login/reset_password';
$route['corporate-registration'] = 'Login/corporateRegistration';
$route['corporate-login'] = 'Login/corporateLogin';
$route['corporate-styling-services']                                    = 'services/corporate';
 

$route['connect-with-stylists']                                    = 'services/expertise';
$route['connect-with-stylists/(:any)']                             = 'services/stylistExpert/$1';
$route['connect-with-stylists/(:any)/(:any)']                      = 'services/stylistExpert/$1/$2';
$route['connect-with-stylists/(:any)/(:any)/(:any)']               = 'services/stylistExpert/$1/$2/$3';
$route['connect-with-stylists/(:any)/(:any)/(:any)/(:any)']        = 'services/stylistExpert/$1/$2/$3/$4';


$route['shop'] = 'shop/index';
$route['shop-category/(:any)'] = 'shop/shopcategory/$1';
$route['shop/(:any)'] = 'shop/shopcategory/$1';
$route['shop/(:any)/(:num)'] = 'shop/shopcategory/$1/$2';
$route['shop/(:any)/(:any)'] = 'shop/productDetailsnew/$1/$2';
$route['cart'] = 'shop/cart';
$route['cart-process'] = 'shop/cartProcess';
$route['checkout'] = 'shop/checkout';

$route['services'] = 'services/index';
$route['services/pricing'] = 'Services/plans';
$route['services/(:any)'] = 'services/servicesDetails/$1';


//stylist
$route['stylists/(:any)'] = 'stylist/profile/$1';
$route['stylists/(:any)/(:any)'] = 'stylist/profile/$1/$2';
$route['stylist/send_review']              = 'stylist/send_review';



//Story
$route['style-stories'] = 'stories/styleStory/';
$route['style-stories/(:any)'] = 'stories/styleStory/$1';
$route['style-stories/category/(:any)'] = 'stories/styleStoryCat/$1';  
$route['style-stories/tag/(:any)'] = 'stories/styleStoryTag/$1';
$route['style-stories/(:any)/(:any)'] = 'stories/styleStoryArchive/$1/$2';


$route['personal-styling-session-gift-cards'] = 'page/giftcard';
$route['jobs/(:any)'] = 'page/browsejobdetail/$1';
$route['post/jobs'] = 'post/jobs';
$route['(:any)'] = 'page/cms/$1';



