<?php $aboutUsRow = $this->db->get_where('cms_pages',['slug'=> 'about-us', 'status'=> 1 ])->row();?>
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
<?php if($this->uri->segment(1) != 'user'){ ?>
	<div class="top-footer"></div>        
	<footer>


		<div class="foot">

	      	<div class="container">

			    <div class="row">



			    	<div class="col-sm-12 text-center mb-3" style="display:none;">

						<h4>Follow daily styling tips on our social platforms</h4>

						 <div class="soical_m">





						        <a target="_blank" href="<?= $this->site->facebook ?>"><i class="fab fa-facebook-f"></i></a>





						        <a target="_blank" href="<?= $this->site->youtube ?>"><i class="fab fa-youtube"></i></a>





						        <a target="_blank" href="<?= $this->site->instagram ?>"><i class="fab fa-instagram"></i></a>





						        <a target="_blank" href="<?= $this->site->linkedin ?>"><i class="fab fa-linkedin-in"></i></a>





						    </div>

					</div>



			        <div class="col-lg-3 col-md-3 col-sm-3 col-6">





						<div class="fpp">

						    <h4>Services</h4>
	                        
						    <ul>
	                            <?php foreach ($our_services as $key => $value) { ?>

									<li><a href="<?=base_url('services/'.$value->slug)?>"><?=$value->title?></a></li> 

								<?php }?>
						    	<?php

						    		$expertises_list  =  $expertises_list  =  $this->common_model->get_all_details_query('area_expertise_looking','where status = 1 order by ui_order asc')->result();

						    	?>

						    	<?php if(!empty($expertises_list)) { $i=0;?>

							        <?php   foreach($expertises_list as $list) {  ?>

						    				<!--	<li><a href="<?=base_url('connect-with-stylists/'.$list->slug)?>"><?= $list->title_develop ?> </a></li>	 -->

											<?php  $i++;} ?>

						      <?php } ?> 
	                            	<li><a href="<?=base_url('services/pricing')?>">Pricing</a></li> 

						    </ul>





						</div>



			        </div>



			        <div class="col-lg-3 col-md-3 col-sm-2 col-6 left_b ">
			            	<div class="fpp padd_left20">
	                    <h4>Corporate</h4>
						<ul>
							<li><a href="<?=base_url('Services/corporate')?>">Corporate Services</a></li>
							<?php if (!$this->session->userdata('userType')) { ?>
								<li><a href="<?=base_url('corporate-registration')?>">Corporate Registration</a></li>
								<li><a href="<?=base_url('corporate-login')?>">Corporate Login</a></li>
							<?php } ?>
						</ul>
	                </div>
	                </div>



			        <div class="col-lg-3 col-md-3 col-sm-2 col-6 left_b ">





								<div class="fpp padd_left20">





								    <h4>Company</h4>





								    <ul>





								        <li><a href="<?=base_url()?>about-us">About Us</a></li>





								        <li><a href="<?=base_url()?>contact-us">Contact Us</a></li>

	 

								       

								        <li><a href="<?=base_url()?>report-an-issue">Report an Issue </a></li>
								         <li><a href="<?=base_url('faqs/index');?>"> FAQ</a></li>
								          <li><a href="<?=base_url()?>services">Services</a></li>
								           <li><a href="<?=base_url()?>page/browsejobs">Browse Jobs</a></li>
								    </ul>





								</div>



			        </div>



			        <div class="col-lg-3 col-md-3 col-sm-3  col-6 left_b  ">

						<div class="fpp padd_left20 ">

						    <h4>Important Links</h4>

						    <ul>
	                           
						    	<li><a href="<?=base_url()?>service-agreement">Service Agreement</a></li>

						        <li><a href="<?=base_url()?>privacy-policy">Privacy Policy</a></li>

						        <li><a href="<?=base_url()?>terms-of-use">Terms of Use</a></li>

						        <li><a href="<?=base_url()?>refund-and-cancellation-policy">Refund & Cancellation Policy</a></li>

						        <li><a href="<?= base_url('shipping-policy') ?>">Shipping Policy</a></li>

						        <!--<li><a href="<?= base_url('style-stories') ?>">All Stories</a></li>-->

						    </ul>

						</div>

			        </div>



			         
			    </div>
			    
			    
			     <div class="my_adss">

						<div class=" padd_left20">

						   
	                        <div class="row align-items-center text-center">
	                           
	                            <div class="col-md-4 col-lg-4">
	                                <p class="copyy text-left">Copyright © <script>document.write(new Date().getFullYear());</script> All rights StyleBuddy </p>
	                            </div>
	                            
	                            
	                            <div class="col-md-3 col-lg-2 p-0">
	                                <p class="text-left"><i class="fa fa-phone"></i> <?= strip_tags($this->site->mobile) ?><br/><i class="fa fa-envelope"></i> <?= strip_tags($this->site->email) ?></p>
	                            </div>
	                            
	                            <div class="col-md-5 col-lg-6">
	                                <p><i class="fa fa-map-marker-alt"></i> <?= ($this->site->address) ?></p>
	                            </div>
	                             
	                            
	                        </div>

						     
	                       

	                        

				    	</div>



			        </div>
			    

				<div class="foot_bottom">



					<div class="row m-0">



					    <div class="col-sm-12">



					        <div class="pay_m">





								<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/payments_ic.png" class="img-fluid mb-3 payments_ic"> <br>





								<!--<img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/app_andr_icon.png" class="img-fluid app_ci">





								 <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url()?>assets/images/app_ios_icon.png" class="img-fluid app_ci">-->



					        </div>



					    </div>



					</div>

		        </div>
		        
		        
		        

		        <?php



					$city = array(



				        array('id'=>605,'name'=>'Delhi'),



				        array('id'=>154,'name'=>'Gurgaon'),



				        array('id'=>606,'name'=>'Mumbai'),



				        array('id'=>337,'name'=>'Pune'),



				        array('id'=>283,'name'=>'Indore'),



				        array('id'=>595,'name'=>'Kolkata'),



				        array('id'=>125,'name'=>'Ahmedabad'),



				        array('id'=>450,'name'=>'Jaipur'),



				        array('id'=>469,'name'=>'Chennai'),



				        array('id'=>225,'name'=>'Banglore'),



				        array('id'=>9,'name'=>'Hyderabad'),



				        array('id'=>604,'name'=>'Chandigarh')



				    );

		        ?>

		        <hr/>

		        <?php $a = array('personal-shopper'=>'Personal Shopper','styling-for-weddings'=>'Personal Stylist','business-styling'=>'Fashion Designer');?>



		        <div class="city">

					

					<?php foreach($a as $k_a=>$v_a){ ?>

					    <p><b><?=$v_a?></b></p>

					    <ul>

					        <?php foreach($city as $k=>$v){ ?>

								<li><a href="<?php echo base_url('connect-with-stylists/'.$k_a.'/'.base64_encode($v['id']).'?expert_by_city='.base64_encode($v['id']))?>"><?=$v_a?> in <?=$v['name']?></a></li>

					        <?php } ?>

					    </ul>

					<?php } ?>

		        </div>



		        <div class="select_city">

		        	<?php foreach($a as $k_a=>$v_a){ ?>

		        		<select class="city_box" onchange="window.location.href=this.value">

		        			<optgroup label="<?=$v_a?>">

					        <?php foreach($city as $k=>$v){ ?>

								<option value="<?php echo base_url('connect-with-stylists/'.$k_a.'/'.base64_encode($v['id']).'?expert_by_city='.base64_encode($v['id']))?>"><?=$v_a?> in <?=$v['name']?></option>

					        <?php } ?>

					    

						</select>

					<?php } ?>



						

						

					</div>

		    </div>
		        <div class="row m-0">
					<div class="col-sm-12">
						<!--<div class="lang notranslate">
							<ul>
							CHANGE LANGUAGE:
								<li><a href="#" class="flag_link" data-lang="en">English</a></li>
								<li><a href="#" class="flag_link" data-lang="hi">हिंदी</a></li>
								 
							</ul>
						</div>-->
					</div>
				</div>
		</div>        
	</footer>    
	<div class="mobile_footer">

		<ul>

			<li><a href="<?=base_url('services')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Shop Now</a></li>

			<li><a href="<?=base_url('style-stories')?>"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Styling Tips</a></li>

			<li style="display:none"><a href="<?=base_url('shop')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Shop</a></li>

			<li><a href="https://wa.link/stfnoe" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> Contact us</a></li>

			<?php if ($this->session->userdata('userType')) { ?>
				<li>
						<?php  if($this->session->userdata('userType') == 2  ) {  ?>
		    			<a href="<?= base_url('stylist-zone/dashboard') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
		        <?php } else if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 6  ){ ?>
		        	<a href="<?= base_url('user/user-dashboard') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
		        <?php } else if($this->session->userdata('userType') == 4  ){ ?>
		        	<a href="<?= base_url('boutiques/dashboard') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
		        <?php } else if($this->session->userdata('userType') == 5  ){ ?>
		        	<a href="<?= base_url('postjob/index') ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
		        <?php }  ?>
		    </li>
			<?php } ?>
		</ul>

	</div>

<?php } ?>
<!--
<style>.chat { position: fixed; right: 24px; bottom: 20px; z-index:1;}  
.chat a { color: #3C806A; font-size: 48px; background: #fff; width: 60px; height: 60px; display: block; text-align: center; border-radius: 100px; line-height: 60px; }
</style>

<div class="chat">
	<a aria-label="" href="https://wa.me/<?= strip_tags(ltrim($this->site->mobile,'+')) ?>" target="_blank"> 
	    <i class="fa fa-whatsapp" aria-hidden="true"></i>
	</a>
</div>-->

<?php  $this->load->view('front/template/pop-up'); ?>

<script>

 		var base_url = '<?=base_url()?>';

</script>



	<script>
        
        function checkWord1(id,max_limit){
            var content = $("#"+id).val(); 
            var words = content.split(/\s+/); 
            var num_words = words.length;  
            console.log(num_words);
             
            if(num_words > max_limit){
                return true
            }
            else{
                return false
            }
            
        }
        
 		function ask_quote_lead(label,field1,field2){
            var phone = $('#'+field1).val();        
            var ask_question = $('#'+field2).val();        
            if(phone==''){          
                $('.'+label).html('<font color="red">Please enter phone</font>');                
                return false        
            } else if (phone.trim().length < 10) { 
    		    $('.'+label).html('<font color="red">Please enter 10 digit mobile number</font>');                
            	return false; 
    		}else if(ask_question==''){          
                $('.'+label).html('<font color="red">Please enter message</font>');                
                return false             
            } else if (!checkWord1(field2,20)) { 
    		    $('.'+label).html('<font color="red">Please enter minimum 20 words</font>');                
            	return false; 
    		}else{          
                $.ajax({                
                    type: 'POST',               
                    url: '<?=base_url()?>home/ask_quote_lead',                  
                    data: {'phone':phone,'message':ask_question},               
                    success: function(response){                    
                        $('.'+label).html('<font color="green" style="color:green">'+response+'</font>');
                        $('#'+field1).val('');  
                        $('#'+field2).val(''); 
                        $('.'+label).fadeOut(5000); 
                    }           
                });
            }
        }	 

		$(window).scroll(function(){

			if ($(window).scrollTop() >= 10) {

				$('header').addClass('my_header');

				$('.logo').addClass('smlogo');

			}

			else {

				$('.my_header').removeClass('my_header');

				$('.smlogo').removeClass('smlogo');

			}

		});



	</script>

	

	<script>

		$(document).ready(function() {

		  	$('#sidebar-btn').on('click', function() {

			$('#my_menu').toggleClass('visible');

		  	});

		  	$('#sidebar-close').on('click', function() {

				$('#my_menu').removeClass('visible');

		  	});

		});

	</script>



	<script>

	$(function(){

  var $ul   =   $('.sidebar-navigation > ul');

  

  $ul.find('li a').click(function(e){

    var $li = $(this).parent();

    

    if($li.find('ul').length > 0){

      e.preventDefault();

      

      if($li.hasClass('selected')){

        $li.removeClass('selected').find('li').removeClass('selected');

        $li.find('ul').slideUp(400);

        $li.find('a em').removeClass('mdi-flip-v');

      }else{

        

        if($li.parents('li.selected').length == 0){

          $ul.find('li').removeClass('selected');

          $ul.find('ul').slideUp(400);

          $ul.find('li a em').removeClass('mdi-flip-v');

        }else{

          $li.parent().find('li').removeClass('selected');

          $li.parent().find('> li ul').slideUp(400);

          $li.parent().find('> li a em').removeClass('mdi-flip-v');

        }

        

        $li.addClass('selected');

        $li.find('>ul').slideDown(400);

        $li.find('>a>em').addClass('mdi-flip-v');

      }

    }

  });

  

  

  $('.sidebar-navigation > ul ul').each(function(i){

    if($(this).find('>li>ul').length > 0){

      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');

      var pIntPLeft   = parseInt(paddingLeft);

      var result      = pIntPLeft + 5;

      

      $(this).find('>li>a').css('padding-left',result);

    }else{

      var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');

      var pIntPLeft   = parseInt(paddingLeft);

      var result      = pIntPLeft + 5;

      

      $(this).find('>li>a').css('padding-left',result).parent().addClass('selected--last');

    }

  });

  

  var t = ' li > ul ';

  for(var i=1;i<=5;i++){

    $('.sidebar-navigation > ul > ' + t.repeat(i)).addClass('subMenuColor' + i);

  }

  

  var activeLi = $('li.selected');

  if(activeLi.length){

    opener(activeLi);

  }

  

  function opener(li){

    var ul = li.closest('ul');

    if(ul.length){

      

        li.addClass('selected');

        ul.addClass('open');

        li.find('>a>em').addClass('mdi-flip-v');

      

      if(ul.closest('li').length){

        opener(ul.closest('li'));

      }else{

        return false;

      }

      

    }

  }

  

});

</script>



	<script type="text/javascript">



		$(".sub_child_menu").click(function() {

			$('.sub_child_menu').children("ul").removeClass('sub-show');

			$(this).children("ul").addClass('sub-show');

			

		});



		$(".sub_child").click(function() {

			$('.sub_child').children("ul").removeClass('sub-show');

			$(this).children("ul").addClass('sub-show');

		});

		

		

	</script>



	

	

	<script src="<?= base_url() ?>assets/js/slick.js"></script>	


	<script>

      $(document).ready(function(){

      $('.add_offer_slidre').slick({

        slidesToShow: 3,

        slidesToScroll: 1,

        autoplay: true,

        //autoplaySpeed: 5000,

        speed: 1000,

        arrows: true,

        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/back_black.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/next_black.png"></button>',

        cssEase: "linear",

        dots: false,

        pauseOnHover: true,

        responsive: [{

          breakpoint: 768,

          settings: {

            slidesToShow: 2

          }

        }, {

          breakpoint: 520,

          settings: {

            slidesToShow: 1

          }

          

        }]

        

      });

       

    });

</script>


	<script>

      $(document).ready(function(){

      $('.customer-logos5').slick({

        slidesToShow: 2,

        slidesToScroll: 1,

        autoplay: false,

        //autoplaySpeed: 5000,

        speed: 1000,

        arrows: true,

        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/back_black.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/next_black.png"></button>',

        cssEase: "linear",

        dots: false,

        pauseOnHover: true,

        responsive: [{

          breakpoint: 768,

          settings: {

            slidesToShow: 1

          }

        }, {

          breakpoint: 520,

          settings: {

            slidesToShow: 1

          }

          

        }]

        

      });

       

    });

</script>



	<script>

		$(document).ready(function(){

			$('.servives_sld').slick({

				slidesToShow: 3,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 3000,

				arrows: true,

				dots: false,

				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/back.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/next.png"></button>',

				pauseOnHover: false,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 2

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 1

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	<script>

		$(document).ready(function(){

			$('.blog_skd').slick({

				slidesToShow: 3,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 4000,

				arrows: true,

				dots: false,

				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/back.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/next.png"></button>',

				pauseOnHover: true,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 2

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 2

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	<script>

		$(document).ready(function(){

			$('.testimonial').slick({

				slidesToShow: 3,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 4000,

				arrows: true,

				dots: false,

				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/back.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/next.png"></button>',

				pauseOnHover: false,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 2

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 1

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	

	<script>

		$(document).ready(function(){

			$('.my_review_list').slick({

				slidesToShow: 4,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 4000,

				arrows: true,

				dots: false,

				prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="<" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/back.png"></button>',

                nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label=">" tabindex="0" role="button"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/next.png"></button>',

				pauseOnHover: false,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 3

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 1

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	

	<script>

		$(document).ready(function(){

			$('.tranding_style').slick({

				slidesToShow: 4,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 4000,

				arrows: true,

				dots: false,

				pauseOnHover: true,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 2

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 2

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	

	<script>

		$(document).ready(function(){

			$('.mobile_blog').slick({

				slidesToShow: 3,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 4000,

				arrows: true,

				dots: false,

				pauseOnHover: true,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 1

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 1

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>

	

	<script>

		$(document).ready(function(){

			$('.client_logo').slick({

				slidesToShow: 5,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 2000,

				arrows: false,

				dots: false,

				pauseOnHover: true,

				responsive: [{

					breakpoint: 900,

					settings: {

						slidesToShow: 3

					}

				}, {

					breakpoint: 520,

					settings: {

						slidesToShow: 2

					}

					

				}, {

					breakpoint: 200,

					settings: {

						slidesToShow: 1

					}

					

				}]

			});

		});

	</script>







	<script>

	    $(document).ready(function() {

	      $('.num-in span').click(function () {

	        var $input = $(this).parents('.num-block').find('input.in-num');

	        if($(this).hasClass('minus')) {

	          var count = parseFloat($input.val()) - 1;

	          count = count < 1 ? 1 : count;

	          if (count < 2) {

	            $(this).addClass('dis');

	          }

	          else {

	            $(this).removeClass('dis');

	          }

	          $input.val(count);

	        }

	        else {

	          var count = parseFloat($input.val()) + 1

	          $input.val(count);

	          if (count > 1) {

	            $(this).parents('.num-block').find(('.minus')).removeClass('dis');

	          }

	        }

	        $input.change();

	        return false;

	      });

	    });

	</script>



	

	<script type="text/javascript">

			function checkWord(id,count){

	    	var words= $('#'+id).val().length;

	      if (words > count) {

	        $('#'+id+'_err').html('');

	      }else{

	        $('#'+id+'_err').html('<span class="text-danger">' + (words + 1) + ' character. Please enter maximum '+count + ' character.</span>');

	         

	      }

	      

	  	}

			function validateAlphabet(value) {         

	        var regexp = /^[a-zA-Z ]*$/;         

	        return regexp.test(value);    

	    }   

	    function IsEmail(email) {     

	        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;       

	        return regex.test(email);   

	    } 

	    function ValidateEmail(e) {

	        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

	        return expr.test(e);

	    };

	    $('.onlyInteger').on('keypress', function(e) {

	      keys = ['0','1','2','3','4','5','6','7','8','9','.']

	      return keys.indexOf(event.key) > -1

	    }) 

    

	    $(document).on("blur","#email",function() {
	      	var checkEmail = $(this).val();
	        if(IsEmail(checkEmail)) { 
	            $.ajax({
	                type: 'POST',
	                url: '<?php echo base_url(); ?>login/emailcheck',
	                data: 'checkEmail='+checkEmail,
	                success: function(data) {
	                  if(data == 1) {
	                     $('#email_err').html('<span class="text-red">Your Email Id is already registered</span>');
	                     $('#email').focus();
	                     return false; 
	                  } else {
	                     $('#email_err').html(' '); 
	                  }
	               }
	            });    
	        }
	    });
	    

	    $('#send_product_review').on('click', function (e) {

	    		var rating = $('#input-21f').val();

	        var id = $('#product_id').val();

	        var name = $('#review_name').val();

	        var email = $('#review_email').val();

	        var title = $('#review_title').val();

	        var comment = $('#review_comment').val();

	        

	        if (name == '') {

	            $('#review_name').focus();

	            return;

	        }else if (email == '') {

	            $('#review_email').focus();

	            return;

	        }else if(!IsEmail(email)) {

	            $('#review_email').focus();

	            return;

	        }else if (comment == '') {

	            $('#review_comment').focus();

	            return;

	        }

	        $.ajax({

	            url: base_url + 'Shop/product_review',

	            type: "POST",

	            data: {id:id,name:name,email:email,title:title,comment:comment,rating:rating},

	            success: function (res) {

	            		console.log(res)

	                $('#reviewList').html(res);

		            	window.setTimeout(function(){location.reload()},2000)

	            }

	        })

	    });



	    $('#send_stylist_review').on('click', function (e) {

        

	        var rating = $('#input-21f').val();

	        var id = $('#user_id').val();

	        var name = $('#review_name').val();

	        var email = $('#review_email').val();

	        var title = $('#review_title').val();

	        var comment = $('#review_comment').val();

	        



	       

	        

	        if (name == '') {

	            $('#review_name').focus();

	            return;

	        }else if (email == '') {

	            $('#review_email').focus();

	            return;

	        }else if(!IsEmail(email)) {

	            $('#review_email').focus();

	            return;

	        }else if (comment == '') {

	            $('#review_comment').focus();

	            return;

	        }

	        $.ajax({

	            url: base_url + 'stylist/send_review',

	            type: "POST",

	            data: {id:id,name:name,email:email,title:title,comment:comment,rating:rating},

	            success: function (res) {

	            		console.log(res)

	                $('#reviewList').html(res);

		            	//$('#reviewList').fadeOut(4000);

	                window.setTimeout(function(){location.reload()},2000)

	            }

	        })

    	});



    	$(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");

        input = $(this).parent().find("input");

        if (input.attr("type") == "password") {

            input.attr("type", "text");

        } else {

            input.attr("type", "password");

        }

    	});

    	function checkCharector(id,count){

					var words= $('#'+id).val().length;

		    	if (words < count) {

		    		$('#'+id+'_err').html('');

		    	}else{

		    		$('#'+id+'_err').html('<span class="text-red">' + (words) + ' character. Please enter maximum '+count + ' character.</span>');

		    		 

		    	}

		  }



		  $("#short_area").on('keyup', function() {

		    var words = 0;

		    if ((this.value.match(/\S+/g)) != null) {

		      words = this.value.match(/\S+/g).length;

		    }

		    if (words > 50) {

		      var trimmed = $(this).val().split(/\s+/, 50).join(" ");

		      $(this).val(trimmed + " ");

		    }

		    else {

		      $('#short_message').text(words);

		      $('#short_left').text(50-words);

		    }

		});

		$("#long_area").on('keyup', function() {

		    var words = 0;

		    if ((this.value.match(/\S+/g)) != null) {

		      words = this.value.match(/\S+/g).length;

		    }

		    if (words > 180) {

		      var trimmed = $(this).val().split(/\s+/, 180).join(" ");

		      $(this).val(trimmed + " ");

		    }

		    else {

		      $('#long_message').text(words);

		      $('#long_left').text(180-words);

		    }

		});  

	    $("body").on("click",".remove_more",function(e) { 

	         e.preventDefault();

	        $(this).parents(".remove_row").remove();

	    });

	</script>

	<script type="text/javascript">

	 	$(document).ready(function() {

			var base_url = '<?=base_url();?>';

		 	$('.service_add').on('click',function() {

		 	 	

				let id = $(this).data("id");

				let qty = $(this).parents('.cart_qty_row').find("input[name='qtybutton']").val();

				let price = $(this).data("price");

				let mrpprice = $(this).data("mrp_price");

		        let url =  base_url+"Services/add_to_cart";

		        //alert(id);

				$.ajax({

					url:url,

					type:"POST",

					dataType:"json",

					data:{id:id,price:price,mrpprice:mrpprice, qty:qty},

					success:function(data){

						console.log(data);

						if(data.success) {

							//$('#cartModel').modal('show');

							window.location.href = base_url+"cart";

						}     

					}

				}); 

		        });

		});

	</script>



	<script>

	$(document).ready(function(){

	  $("#m_shopping").click(function(){

		$(".outfits_slider_men").show();

		$(".outfits_slider_women").hide();

		$("#m_shopping").addClass('men_women_active');

		$("#w_shopping").removeClass('men_women_active');

		

	  });

	  $("#w_shopping").click(function(){

		$(".outfits_slider_women").show();

		$(".outfits_slider_men").hide();

		$("#w_shopping").addClass('men_women_active');

		$("#m_shopping").removeClass('men_women_active');

		

		

	  });

	});

	</script>

	<script>

		$(document).ready(function(){

			$(".add_data").click(function(){

				let id = $(this).data("id");

				let qty = 1;

				//let qty = $(this).parents('.cart_qty_row').find("input[name='qtybutton']").val();

				let price = $(this).data("price");

				let mrpprice = $(this).data("mrp_price");

		        ajaxCall(id,price,mrpprice,qty);

		        $(this).parents('.qty').find('.add_qt').show(); 

				$(this).hide();

				$(".min_cart_bottom").show();

			});

		});



		function getPlanShow(id){

			//$('#planDiv'+id).css('display','block');

			console.log($('#planDiv'+id).data("visible"));

			//$("select#services_id option[value*='"+id+"']").prop('disabled',true);

			if($('#planDiv'+id).data("visible") == 'show'){

				$('#planDiv'+id).remove();

			}



			let url =  base_url+"Services/ajaxPlanFetach";

			$.ajax({

				url:url,

				type:"POST",

				data:{id:id},

				success:function(data){

					$('#allPlansDiv').prepend(data);

					//console.log(data);

				}

			});	

			 



			



		}

		function ajaxCall(id,price,mrpprice,qty,activity){

			$("#loader").modal('show');

			$(".modal-backdrop").css('background-color','rgb(0 0 0 / 0%)');

			let url =  base_url+"Services/add_to_cart";

			$.ajax({

				url:url,

				type:"POST",

				dataType:"json",

				data:{id:id,price:price,mrpprice:mrpprice, qty:qty,activity:activity},

				success:function(data){

					console.log(data);

					console.log(data.rowCount);

					$('#cart_qty_span').html(data.rowCount)

					$(".min_cart_bottom").html(data.pop_up_html);

					$(".data_summery").html(data.summary_html);

					if(data.success) {

						$("#loader").modal('hide'); 

						/*setTimeout(function(){

						   	window.location.reload(1);

						}, 1000);*/

						//window.location.href = base_url+"cart";

					}     

				}

			});

		}

</script>

	<?php

	$segmentArray = array('cart','checkout'); 

	$segment1 = $this->uri->segment(1);

	if (!in_array($segment1, $segmentArray)) {

		// code...

	 

  	$uID = $this->session->userdata('session_user_id_temp');

  	$c['user_id'] = $uID;

  	$cartRows = $this->common_model->get_all_details_field_query('*','user_cart','where user_id = "'.$uID.'" order by id desc')->result();

     

		$html = '';

		if ($cartRows) {

				$cart_qty = 0;

        $cart_price = 0;

        

        $service_cart_qty = 0;

        $service_cart_price = 0;

        foreach ($cartRows as $key => $value) {

            if($value->in_stock){

                $cart_price += $value->total;

                $cart_qty += $value->quantity;

            }

            if($value->cart_type == 'service'){

                $service_cart_price += $value->total;

                $service_cart_qty += $value->quantity;

            }

        }

        $html .= '<div class="add_you_item">My cart</div>';  

        

        $c  = array();

        $c['id'] = $cartRows[0]->id;

        //$cartRows = $this->common_model->get_all_details_field('*','user_cart',$c)->result();

        

        $total_qty = 0;

        $total_price = 0;



        foreach ($cartRows as $key => $value) {

        		$v = $value;

            $qty = $v->quantity;

        		$price = $qty * $v->price;



        		$total_qty += $qty;

        		$total_price += $price;

            //if($v->cart_type == 'service'){

                /*$name = $v->name;

                $html .= '<div class="other_daatt">';

                    $html .= '<span>'.$qty.' Items</span> | '.$name.' | <i class="fa fa-inr"></i> '.number_format($price).'';

                $html .= '</div>';*/

            //}

        }

        $html .= '<div class="other_daatt">';

            $html .= '<span>'.$total_qty.' Items</span> | <i class="fa fa-inr"></i> '.number_format($total_price).'  <a href="'.base_url('cart').'">View cart</a>';

        $html .= '</div>';



        ?>

        <script type="text/javascript">

        	$(document).ready(function(){

        		$(".min_cart_bottom").html('<?=$html?>');

        		$(".min_cart_bottom").show();

        		});

        </script>

        <?php

		}	

	}

	?>



<div class="min_cart_bottom"></div>

<!-- <script type="text/javascript" id="hs-script-loader" async defer src="//js-na1.hs-scripts.com/23443898.js"></script> -->


<div id="google_translate_element"></div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
    }
</script>
<style type="text/css">
    #google_translate_element{
      display: none;
    }
    body{
    	top: 0px!important;
    }
    .skiptranslate,.goog-gt-tt,.goog-gt-tt:hover{
    	display: none!important;
    }
</style>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script type="text/javascript">
    var flags = document.getElementsByClassName('flag_link'); 
    Array.prototype.forEach.call(flags, function(e){
        e.addEventListener('click', function(){
        	var elems = document.getElementsByClassName("flag_link");
			[].forEach.call(elems, function(el) {
			    el.classList.remove("currunt_lang");
			});
            var lang = e.getAttribute('data-lang'); 
            var languageSelect = document.querySelector("select.goog-te-combo");
            languageSelect.value = lang; 
            languageSelect.dispatchEvent(new Event("change"));
            e.classList.add("currunt_lang");
        }); 
    });

    function checkPasswordValidation(inputValue) {
        //To check a password between 7 to 16 characters which contain only characters, numeric digits, underscore and first character must be a
        //var passw =  /^[A-Za-z]\w{7,14}$/;

        //To check a password between 6 to 20 characters which contain at least one numeric digit, one uppercase and one lowercase letter
        //var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

        //To check a password between 7 to 15 characters which contain at least one numeric digit and a special character
        //var passw =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;

        //To check a password between 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character
        var passw =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

        if(inputValue.match(passw)) { 
            return true;
        } else { 
            return false;
        }
    }
    /*document.addEventListener('contextmenu', event => event.preventDefault());
    
    document.onkeydown = function (e) {

        // disable F12 key
        if(e.keyCode == 123) {
            return false;
        }
         
        // disable I key
        if(e.ctrlKey && e.shiftKey && e.keyCode == 73){
            return false;
        }

        // disable J key
        if(e.ctrlKey && e.shiftKey && e.keyCode == 74) {
            return false;
        }
        //"S" key
        if (e.ctrlKey && event.keyCode == 83) {
           return false;
        }
        // disable U key
        if(e.ctrlKey && e.keyCode == 85) {
            return false;
        }
        
    } */ 
    function IsAlphaNumeric(e,error) {
      	// alert(e.keyCode);
       	var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
       	var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (keyCode == 32));
       	console.log(ret);
       	document.getElementById(error).innerHTML = ret ? '' : '<span class="text-red">Please enter only alphanumeric and space</span>';
       	return ret;
   	}

  </script>
<script type="text/javascript">
		(function() {

	  var quotes = $(".quotes");
	  var quoteIndex = -1;

	  function showNextQuote() {
	    ++quoteIndex;
	    quotes.eq(quoteIndex % quotes.length)
	      .fadeIn(2000)
	      .delay(2000)
	      .fadeOut(2000, showNextQuote);
	  }

	  showNextQuote();

	})();
		
</script>
<script>
	function copyToClipboard(clsId,id) {
	    var range = document.createRange();
	    range.selectNode(document.getElementById(id));
	    window.getSelection().removeAllRanges(); 
	    window.getSelection().addRange(range);
	    document.execCommand("copy");
	    window.getSelection().removeAllRanges(); 
	    copybtn = document.querySelector("#"+clsId);
	    copybtn.textContent = "COPIED"; 
	}
</script>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
        var YOUR_GOOGLE_CLIENT_ID = '<?=YOUR_GOOGLE_CLIENT_ID?>';
         
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: YOUR_GOOGLE_CLIENT_ID,
            callback: handleCredentialResponse,
          });
          google.accounts.id.renderButton(
            document.getElementById("onSignin"),
            { theme: "filled_blue", shape: "rectangular" , text: "continue_with"}  // customization attributes
          );
          google.accounts.id.renderButton(
            document.getElementById("onSignup"),
            { theme: "filled_blue", shape: "rectangular" , text: "continue_with"}  // customization attributes
          );

         	pageLoad(); 
          //google.accounts.id.prompt(); // also display the One Tap dialog
        }
        function pageLoad(){
            $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
                console.log(data);
                result = $.parseJSON(data);
                $('#captImg').html(result.image);
                $('#captcha_v').val(result.word);
                
            });
        }
        function handleCredentialResponse(response) {
            console.log("Encoded JWT ID token: " + response.credential);
            const responsePayload = decodeJwtResponse(response.credential);
            console.log("response: " + JSON.stringify(responsePayload));
            console.log("ID: " + responsePayload.sub);
            console.log('Full Name: ' + responsePayload.name);
            console.log('Given Name: ' + responsePayload.given_name);
            console.log('Family Name: ' + responsePayload.family_name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);
            //window.location.reload();

            var social_id = responsePayload.sub;
            var name =  responsePayload.name;
            var fname =  responsePayload.given_name;
            var lname = responsePayload.family_name;
            var picture =  responsePayload.picture;
            var email = responsePayload.email;


            /*var data = new FormData();
			data.append('userEmail', email);
			data.append('name', name);
			data.append('social_id', social_id);
			data.append('fname', fname);
			data.append('lname', lname);
			data.append('picture', picture);
			

			var xhr = new XMLHttpRequest();
			xhr.open('POST', '<?php echo base_url(); ?>login/loginAjaxSocial', true);
			xhr.onload = function () {
			    console.log(this.responseText);
			};
			xhr.send(data);*/

			 

            $.ajax({
                type: 'POST',
                dataType:"json",
                url: '<?php echo base_url(); ?>login/loginAjaxSocial',
                data: {userEmail:email,name:name,social_id:social_id,fname:fname,lname:lname,picture:picture},
                success: function(data) {
                	console.log(data);
                	$('#response_msg').html(data.response);
                	if(data.status == 'success'){
                		$("#login_google_message").html(data.response);
                		$("#error_google_success").modal('show');
                		setTimeout(function () { location.reload(true); }, 1000);
                		//window.location.reload();
                	}else if(data.status == 'other'){
                		$("#login_google_message").html(data.response);
                		$("#error_google_success").modal('show');
                	}else{

                	}
	           	}
            });

        }
        function decodeJwtResponse(token) {
            var base64Url = token.split(".")[1];
            var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
            var jsonPayload = decodeURIComponent(
              atob(base64)
                .split("")
                .map(function (c) {
                  return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
                })
                .join("")
            );
        
            return JSON.parse(jsonPayload);
        }
        function onSignout() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://mail.google.com/mail/u/0/?logout&hl=en"; 
            document.getElementsByTagName("head")[0].appendChild(script);
            //document.querySelector('#test').innerHTML = '<h3>Please Wait...</h3>';
            //setTimeout(yes, 3000)
            setTimeout(function () { window.location.href='<?= base_url('logout') ?>'; }, 1000);
        }
        function show_login_status(network, status){
            if(status == false){
                document.getElementById('onSignout').style.display='none';
            }
            if(status == true){
                document.getElementById('onSignin').style.display='none';
            }
        }
        function yes() {
           location.reload(true);
        };
</script>
<?php 	if(empty($this->uri->segment(1))){ ?>
	<script type="text/javascript">
	    /*$(document).ready(function(){
	    	if (sessionStorage.getItem("offer_popup")) {
				sessionStorage.setItem("offer_popup", '2');
			}else{
				sessionStorage.setItem("offer_popup", '1');
			}
	    	if (sessionStorage.getItem("offer_popup") == 1) {
	    		$("#offer_popup").modal('show');
	    	}
			//$('#offer_popup').modal('show');
	    });*/
	</script>

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
<?php 	} ?>