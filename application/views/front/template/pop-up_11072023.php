<script type="text/javascript">
        $(document).ready(function(){
            //$("#error_google_success").modal('show');
            $(".modal-backdrop").css('zoom','100');
        }); 
    </script>
     
    <div class="modal" id="error_google_success" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                <div class="modal-body text-center">
                    
                    <div id="login_google_message">You already have an account as stylist. </div>
                </div>
            </div>
        </div>
    </div>

<style type="text/css">
    .loading-image {
      top: 50%;
      left: 50%;
      z-index: 10;
    }
     
</style>
<div class="modal" id="loader" data-bs-keyboard="false" data-bs-backdrop="static" style="background-color: rgb(0 0 0 / 0%)">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="background:none;border: none;">
            <center>
               <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  class="loading-image" src="<?=base_url('assets/images/loading-gif.gif')?>" alt="loading..">
            </center>
        </div>
    </div>
</div>

<?php   if(($this->session->flashdata('pop_same_page_success') || $this->session->flashdata('gift_booking_success')) || ($this->session->flashdata('pop_same_page_success') || $this->session->flashdata('gift_booking_success'))) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#pop_same_page_success").modal('show');
            $(".modal-backdrop").css('zoom','100');
        }); 
    </script>
     
    <div class="modal" id="pop_same_page_success" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                <div class="modal-body ">
                    
                    <div class="">

                        <?php echo $this->session->flashdata('pop_same_page_success')?>
                        
                        <?php echo $this->session->flashdata('gift_booking_success')?>
                    </div>
                </div>
            </div>
        </div>
    </div>  


<?php   } ?>

<?php if($this->uri->segment(1) == 'shop' && !empty($this->uri->segment(2))){ ?>    
    <script type="text/javascript">        
        $(document).ready(function(){
            window.setTimeout(function () {
                //$("#askQuoteFormPopup").modal('show');
            }, 5000);        
        });    
    </script>    
    <div class="modal shop_wala_p" id="askQuoteFormPopup">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <button type="button" class="btn-close close_btn " data-bs-dismiss="modal"></button>
                <div class="modal-body grpp">
                    <div class="text-center">
                        <div class="row m-0 align-items-center">
                            <div class="col-sm-6"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?php echo base_url(); ?>assets/images/girl_right.png" class="img-fluid gk_rl"></div>
                            <div class="col-sm-6">
                                <div class="side_pnel">
                                    <h1>Do you <span class="pinkkk">need help</span> in selecting <span>right outfit?</span></h1>
                                    <div class="my_survey_message">
                                        <a class="popup_button" style="font-size: 18px;"  target="_blank" href="https://wa.me/<?= strip_tags(ltrim($this->site->mobile,'+')) ?>">Talk to our Stylist now<br> to get expert advice<br/><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?=base_url('assets/images/whatsapp.png')?>" style="width:160px"/></a>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php   if($this->session->flashdata('message_success_redirect_login') || $this->session->flashdata('message_success_redirect_login')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#message_success_redirect_login").modal('show');
        }); 
    </script>
    <style type="text/css">
        #message_success_redirect_login .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="message_success_redirect_login" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <div class=""><h4 class="modal-title">Response</h4></div>
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>-->
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                
                <div class="modal-body ">
                    <div class="">
                        <?php echo $this->session->flashdata('message_success_redirect_login')?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>

<?php   if($this->session->flashdata('message_success_redirect_login_corporate') || $this->session->flashdata('message_success_redirect_login_corporate')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#message_success_redirect_login_corporate").modal('show');
        }); 
    </script>
    <style type="text/css">
        #message_success_redirect_login_corporate .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="message_success_redirect_login_corporate" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                 <div class="modal-header">
                <div class=""><h4 class="modal-title">Welcome to stylebuddy corporate zone</h4></div>
                <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body ">
                    <div class="">
                        <?php echo $this->session->flashdata('message_success_redirect_login_corporate')?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>

<?php   if($this->session->flashdata('message_success_redirect_home') || $this->session->flashdata('message_success_redirect_home')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#message_success_redirect_home").modal('show');
             setTimeout(function() { window.location.href = "<?=base_url()?>" },3000);
        }); 
    </script>
    <style type="text/css">
        #message_success_redirect_home .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="message_success_redirect_home" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <div class=""><h4 class="modal-title">Response</h4></div>
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>-->
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                
                <div class="modal-body ">
                    <div class="">
                        <?php echo $this->session->flashdata('message_success_redirect_home')?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>

<?php   if($this->session->flashdata('message_success_redirect_home_corporate') || $this->session->flashdata('message_success_redirect_home_corporate')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#message_success_redirect_home_corporate").modal('show');
        }); 
    </script>
    <style type="text/css">
        #message_success_redirect_home_corporate .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="message_success_redirect_home_corporate" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <div class=""><h4 class="modal-title">Response</h4></div>
                </div>-->
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                
                <div class="modal-body ">
                    <?php echo $this->session->flashdata('message_success_redirect_home_corporate')?>
                    <!--<hr>
                    <div class="text-center col-sm-12">
                         <a href="<?=base_url('services')?>" class="action_bt_2">Explore Styling Services</a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>

<?php   if($this->session->flashdata('register_message_success') || $this->session->flashdata('register_message_success')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#registerMessage____").modal('show');
             setTimeout(function() { window.location.href = "<?=base_url('login')?>" },5000);
        }); 
    </script>
    <style type="text/css">
        #registerMessage____ .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="registerMessage____" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <div class=""><h4 class="modal-title">Response</h4></div>
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>-->
                <div class="modal-header">
                    <button type="button" class="btn-close" style="position: absolute;right: 0;padding: 16px;" data-bs-dismiss="modal"></button>
                </div>
                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                
                <div class="modal-body ">
                    <div class="">
                        <?php echo $this->session->flashdata('register_message_success')?>
                    </div>
                </div>
            </div>
        </div>
    </div>  

<?php   } ?>


<div class="modal fade" id="cartModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background: none;">

    <div class="modal-dialog modal-dialog-right" role="document">

        <div class="modal-content modal-sm">

            <div class="add_to_bag_pop_up">

                <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="" class="img-responsive" id="add_to_bag_pop_up">

                <h3 class="add_to_bag_h3">Added to Bag</h3>

            </div>

        </div>

    </div>

</div> 

<div class="modal fade bd-example-modal-sm" id="wishlistModel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <h3>This is wishlist modal</h3>
    </div>
    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<div id="mySidenav_shop" class="sidenav_shop">
    <div class="hello_sidebar">
        <div class="row m-0">
           <div class="col-sm-7 p-0">
                <div class="pro_field" id="pro_field">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="rtc">
                    <div class="pro_disi">
                        <div class="clcl">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
                        </div>
                        <small id="popUp_designby">Designer by: SHAGUN MEHTA</small>
                        <h4  id="popUp_productName">Baby Blue Co-Ord Set</h4>
                        <div class="price_side___"  id="popUp_producPrice">
                            <i class="fa fa-inr" aria-hidden="true"></i> <span></span>
                        </div>
                        <p>PRICE INCLUSIVE OF ALL TAXES</p>
                        <hr>
                        <div id="popUp_productSizeFull"  >
                            <p>Size </p>
                            <div class="swatches"  >
                                <div id="size_err_sidebar"></div>
                                <div class="swatch clearfix" data-option-index="0" id="popUp_productSize">
                                </div>
                            </div>
                        </div>
                        <div class="cebter">
                            <?php $review = $productDetails->review;?>
                            <div class="hidden_star_pointer ratingss my_star">
                                <input value="<?php echo $review->rating?>" type="hidden" class="rating"  id="rating" style="pointer-events:none" data-min=0 data-max=5 data-step=0.2>
                            </div>
                        </div>
                        <div class="adc">
                            <div class="num-block skin-2">
                                <div class="num-in">
                                    <span class="minus dis"></span>
                                    <input type="text" class="in-num" name="qtybutton" value="1" readonly="">
                                    <span class="plus"></span>
                                </div>
                            </div>
                        </div>
                        <div class="add_to_bag" id="add_to_bag"><a href="#" id="cart1"class="cart1">Add to Bag</a></div>
                        <p><a href="" class="see_full" id="see_full"><span>SEE FULL DETAILS</span></a></p>
                    </div>

                    <script type="text/javascript">
                        function closeNav2() {
                            document.getElementById("mySidenav_shop").style.width = "0";
                        }
                        $('#cart1').on('click',function() {

                            console.log($(this).data("price"));

                            console.log($(this).data("discountprice"));

                             let id = $(this).data("id");

                             let qty = $("input[name='qtybutton']").val();

                             let price = $(this).data("price");

                             let mrpprice = $(this).data("mrpprice");

                             let name = $(this).data("name");

                             let product_id = $(this).data("product_id");

                             

                             let image = $(this).data("image");

                             let catId = $(this).data("catid");

                             let discount = $(this).data("discount");

                             let discountPrice = $(this).data("discountprice");

                             let venderId = $(this).data("venderid");

                             

                             

                             let size = $("input[name='size']:checked").val();

                             let sizearray = $(this).data("sizearray");

                            console.log('sizearray');

                            if(sizearray == 'none'){

                                

                            }

                            

                            if (typeof size  === "undefined") {

                                $('#size_err_sidebar').html('<span class="text-danger">Please choose size</span>');

                            } else {

                                $('#size_err_sidebar').html('');

                                $('#size_err_sidebar').delay(500).fadeOut('slow');

                            }

                            if (typeof size  !== "undefined" || sizearray == 'none') {

                                  let url =  base_url+"cart-process";

                                  $.ajax({

                                     url:url,

                                     type:"POST",

                                     dataType:"json",

                                     data:{id:id,product_id:product_id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size },

                                     success:function(data){

                                        console.log(data);

                                           if(data.success) {

                                              //  $('#cartModel').modal('show');

                                              window.location.href = base_url+"cart";

                                           }     

                                       }

                                  });   

                             } else {

                                // window.location.reload();

                             }

                           // console.log(size);

                                

                          });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.sidenav_open').on('click',function() {

        document.getElementById("mySidenav_shop").style.width = "70%"; 

        console.log('vijay');

        let product_id = $(this).data("id");

        let gallaryimage = $(this).data("gallaryimage");

        let discountprice = $(this).data("discountprice");

        let discount = $(this).data("discount");

        let price = $(this).data("price");

        let mrpprice = $(this).data("mrpprice");

        let venderid = $(this).data("venderid");

        let catid = $(this).data("catid");

        let image = $(this).data("image");

        let id = $(this).data("id");

        let name = $(this).data("name");

        let slug = $(this).data("slug");

        let seefullurl = $(this).data("seefullurl");

        let designby = $(this).data("designby");

        let sizes = $(this).data("sizes");

        let rating = $(this).data("rating");

         
        console.log(sizes);

        

        console.log(image);

        

        var str = '';

         

        str += '<li><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="'+image+' " class="img-fluid" alt=""></li>';

        

        gallaryimage.forEach((value, index) => {

            console.log(value.gallery_image);

            

        });



        $('#pro_field').html(str);

        var str = '';

        sizes.forEach((value, index) => {

            str += '<div data-value="'+value.size_name+'" class="swatch-element plain s available">';

                str += '<input id="swatch-0-'+value.size_name+'" type="radio" name="size" value="'+value.size_name+'">';

                str += '<label for="swatch-0-'+value.size_name+'"> '+value.size_name+' </label>';

            str += '</div>';

        });

        if(str == ''){

            $('#popUp_productSizeFull').css('display','none');

        }else{

            $('#popUp_productSizeFull').css('display','block');

            $('#popUp_productSize').html(str);

        }

    

        

        $('#see_full').attr('href',seefullurl);

        



        $('#popUp_designby').html('Designer by: '+designby);

        $('#popUp_productName').html(name);

        $('#rating').val(rating);

        $('.filled-stars').css('width',rating*20+'%');

        $('.rating-stars').attr('title','('+rating+')');

        $('.badge-secondary').html('('+rating+')');

         



        

        if (discount!=0) {

            $('#popUp_producPrice').html('<del><?= $this->site->currency?>'+mrpprice+'</del>&nbsp; &nbsp;<span><b><?= $this->site->currency?>'+price+' </b></span> <small>('+discount+'% OFF)</small>');

        }else{

            $('#popUp_producPrice').html('<span><?= $this->site->currency?>'+price+' </span>');

        }

        $('#cart1').attr('data-discountprice',discountprice);

        $('#cart1').attr('data-discount',discount);

        $('#cart1').attr('data-price',price);

        $('#cart1').attr('data-mrpprice',mrpprice);

        $('#cart1').attr('data-venderid',venderid);

        $('#cart1').attr('data-catid',catid);

        $('#cart1').attr('data-image',image);

        $('#cart1').attr('data-name',name);

        $('#cart1').attr('data-id',id);

        $('#cart1').attr('data-name',slug);

        if(str == ''){

            $('#cart1').attr('data-sizearray','none');

        }else{

             $('#cart1').removeAttr('data-sizearray');

        }

    });
    $( document ).ready(function() {
        $('.shop-filter-active , .filter-close').on('click', function(e) {

            e.preventDefault();

            $('.product-filter-wrapper').slideToggle();

        })
        var shopFiltericon = $('.shop-filter-active , .filter-close');
        shopFiltericon.on('click', function() {
            $('.shop-filter-active').toggleClass('active');
        })
    });
</script>
<div class="modal" id="size_guide">

    <div class="modal-dialog modal-dialog-centered modal-lg">

      <div class="modal-content">

      

        <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title">Size Guide</h4>

          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

          

            <div class="chrt-box" id="style-3">

               <ul class="nav nav-pills" role="tablist">

                    <li class="nav-item">

                      <a class="nav-link active" data-bs-toggle="pill" href="#women_inch">Inch</a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" data-bs-toggle="pill" href="#women_cm">CM</a>

                    </li>

                </ul>

                <div class="tab-content">

                    <div id="women_inch" class="tab-pane active">

                      <p>We have provided the body measurement to help you decide which size to buy. For dresses, tops, uppers, kurtas etc.</p>

                      <div class="table-responsive">

                          <table class="table table-light border text-center table-striped">

                            <thead>

                              <tr>

                                <th>Size </th>

                                <th>Bust </th>

                                <th>Waist </th>

                                <th>Hip </th>

                                <th>US SIZE</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td>XS</td>

                                <td>30-32 </td>

                                <td>24-26</td>

                                <td>33-35</td>

                                <td>XS(0-2)</td>

                              </tr>

                              <tr>

                                <td>S</td>

                                <td>32-35</td>

                                <td>26-38</td>

                                <td>36-38</td>

                                <td>S(4-6)</td>

                              </tr>

                              <tr>

                                <td>M</td>

                                <td>35-37</td>

                                <td>28-31</td>

                                <td>38-40</td>

                                <td>M(8-10)</td>

                              </tr>

                              <tr>

                                <td>L</td>

                                <td>37-40</td>

                                <td>31-34</td>

                                <td>40-43</td>

                                <td>L(12-14)</td>

                              </tr>

                              <tr>

                                <td>XL</td>

                                <td>40-44</td>

                                <td>34-38</td>

                                <td>43-47</td>

                                <td>XL(16-18)</td>

                              </tr>

                              <tr>

                                <td>2XL</td>

                                <td>44-47</td>

                                <td>38-42</td>

                                <td>47-50</td>

                                <td>XXL(20-22)</td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                        <div class="text-center">

                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/size.png">

                        </div>

                        <div class="sp-box">

                            <h6>1. Bust</h6>

                            <p>Measure under your arms around the fullest and widest point of your bust. Stay horizontal, all around your body.</p>

                        </div>

                        <div class="sp-box">

                            <h6>2. Waist</h6>

                            <p>Make sure the measuring tape fits comfortably as you measure around the narrowest point of your body, higher than belly and below your ribcage.</p>

                        </div>

                        <div class="sp-box">

                            <h6>3. Hips</h6>

                            <p> Measure around the widest part of your hips, make sure to stay with your feet together with level of crotch area.</p>

                        </div>

                    </div>

                    <div id="women_cm" class="tab-pane fade">

                      <p>We have provided the body measurement to help you decide which size to buy. For dresses, tops, uppers, kurtas etc.</p>

                      <div class="table-responsive">

                          <table class="table table-light border text-center table-striped">

                            <thead>

                              <tr>

                                <th>Size </th>

                                <th>Bust </th>

                                <th>Waist </th>

                                <th>Hip </th>

                                <th>US SIZE</th>

                              </tr>

                            </thead>

                            <tbody>

                              <tr>

                                <td>XS</td>

                                <td>81.3</td>

                                <td>66</td>

                                <td>91.4</td>

                                <td>XS(0-2)</td>

                              </tr>

                              <tr>

                                <td>S</td>

                                <td>86.4</td>

                                <td>71.1</td>

                                <td>96.5</td>

                                <td>S(4-6)</td>

                              </tr>

                              <tr>

                                <td>M</td>

                                <td>91.4</td>

                                <td>76.2</td>

                                <td>101.6</td>

                                <td>M(8-10)</td>

                              </tr>

                              <tr>

                                <td>L</td>

                                <td>96.5</td>

                                <td>81.3</td>

                                <td>106.7</td>

                                <td>L(12-14)</td>

                              </tr>

                              <tr>

                                <td>XL</td>

                                <td>101.6</td>

                                <td>86.4</td>

                                <td>111.8</td>

                                <td>XL(16-18)</td>

                              </tr>

                              <tr>

                                <td>2XL</td>

                                <td>106.7</td>

                                <td>91.4</td>

                                <td>116.8</td>

                                <td>XXL(20-22)</td>

                              </tr>

                              <tr>

                                <td>3XL</td>

                                <td>111.8</td>

                                <td>96.5</td>

                                <td>121.9</td>

                                <td>&nbsp;</td>

                              </tr>

                            </tbody>

                          </table>

                        </div>

                        <div class="text-center">

                            <img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="https://www.stylebuddy.in/assets/images/size.png">

                        </div>

                        <div class="sp-box">

                            <h6>1. Bust</h6>

                            <p>Measure under your arms around the fullest and widest point of your bust. Stay horizontal, all around your body.</p>

                        </div>

                        <div class="sp-box">

                            <h6>2. Waist</h6>

                            <p>Make sure the measuring tape fits comfortably as you measure around the narrowest point of your body, higher than belly and below your ribcage.</p>

                        </div>

                        <div class="sp-box">

                            <h6>3. Hips</h6>

                            <p> Measure around the widest part of your hips, make sure to stay with your feet together with level of crotch area.</p>

                        </div>

                    </div>

                </div> 

            </div>



        </div>

        

       

      </div>

    </div>

  </div>






<?php if($this->session->flashdata('check_availability_success') || $this->session->flashdata('check_availability_success')) { ?>
                    
    <script type="text/javascript">
        $(document).ready(function(){
            $("#check_availability_pop").modal('show');
            $(".modal-backdrop").css('zoom','100');
        }); 
    </script>
    <div class="modal" id="check_availability_pop" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="pop_logo"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid"></a></div>
                <div class="modal-body">
               
                    <?=$this->session->flashdata('check_availability_success');?>
                    <hr>

                    <div class="text-center col-sm-12">
                         <a href="<?=base_url()?>#action_bt_2" class="action_bt_2">Explore Styling Services</a>
                         <a href="<?=base_url()?>#read_styling" class="action_bt_2">Read Styling Tips</a>
                    </div>
                </div>

            

            </div>
        </div>
    </div>
<?php } ?>
<?php   if($this->session->flashdata('login_message_shop_page') || $this->session->flashdata('login_message_shop_page')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#shopMessage").modal('show');
             //setTimeout(function() { window.location.href = "<?=base_url('shop')?>" },3000);
        }); 
    </script>
    <div class="modal" id="shopMessage" aria-modal="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header text-center ">
                    <h4 class="modal-title" style="width:100%"><a href="<?=base_url()?>"><img alt="Personal Styling | StyleBuddy"  alt="StyleBuddy"  src="<?= base_url('assets/images/'.$this->site->logo) ?>" class="img-fluid" style="width: 240px;"></a></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body ">
                    <div class="mt-3 mb-3">
                        <?php echo $this->session->flashdata('login_message_shop_page')?>
                    </div>
                    <hr>
                    <div class="text-center col-sm-12">
                         <a href="<?=base_url()?>" class="action_bt_2">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>
<div class="modal" id="get_free" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background: transparent;border: 0px; color: #fff;">
            <button type="button" class="btn-close get_close" data-bs-dismiss="modal"></button>
            <div class="modal-body" style="padding: 0px;">
            <a href="<?php echo base_url('user/registration'); ?>"><img src="<?php echo base_url(); ?>assets/images/stylebuddy-popup2.jpg" class="img-fluid"></a>
            <small>*Terms and conditions apply.</small> 
            </div>
        </div>
    </div>
</div>

<?php   if($this->session->flashdata('message_success_corporate_lead') || $this->session->flashdata('message_success_corporate_lead')) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#message_success_corporate_lead").modal('show');
        }); 
    </script>
    <style type="text/css">
        #message_success_redirect_home_corporate .modal-content {
            background: #fff;
            text-align: center;
        }
    </style>
    <div class="modal" id="message_success_corporate_lead" aria-modal="true" >
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Corporate Services</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body ">
                    <?php echo $this->session->flashdata('message_success_corporate_lead')?>
                     
                </div>
            </div>
        </div>
    </div>  
<?php   } ?>
<!-- The discount home page popup -->
<div class="modal" id="offer_popup">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            <div class="modal-body">
                <div class="off_design">
                    <div class="row">
                        <div class="col-sm-6"><img src="<?php echo base_url(); ?>assets/images/off_girl.png" class="img-fluid off_girl"> </div>
                        <div class="col-sm-6 white_c">
                            <div class="off_detyails">
                                <h2>Sign up and get <span>20% off.</span></h2>
                                <hr>
                                <p>Try a Personal Styling Service to solve your styling problems</p>
                                <?php if (!$this->session->userdata('userType')) { ?>
                                    <a href="<?php echo base_url(); ?>user/registration" class="action_bt_2 mt-3">Register Now</a>
                                    <div class="mt-3 paddleft" style="margin: 0 auto">
                                        <div id="onSignup" class="mt-3"></div>
                                    </div>
                                <?php } ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- All offers popup cart page-->

<div class="modal" id="view_more_cop">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

      <!-- Modal body -->
      <div class="modal-body">
       
        <div class="best_coupn">
            <p><b>Best Coupon</b></p>

            <div class="row">
                <?php if ($couponRow) { ?>
                    <?php foreach ($couponRow as $key => $value) { ?>
                        <div class="col-lg-6">
                            <div class="cp_box">
                                <div class="off_silde"><?php echo $value['name'];?> Off</div>
                               
                                <div class="coupon_ka_nam">
                                    <div class="row">
                                        <div class="col-9 col-lg-9">
                                            <div class="cou_name">
                                                <h4><?php echo $value['gift_code'];?></h4>
                                                <p class="save_b">Save <i class="fa fa-inr"></i> <?php echo $value['coupon_code_price'];?> on this service</p>
                                            </div>
                                        </div>
                                        <div class="col-3 col-lg-3">
                                            <div class="view_ooff">
                                                <input name="coupan" id="coupon_code___<?php echo $value['id'];?>" type="hidden" class="coup" value="<?php echo $value['gift_code'];?>">
                                                <a style="cursor:pointer" onclick="ajax_couponapply('<?=$currentCurrency;?>','coupon_code___',<?php echo $value['id'];?>)">Apply</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="cp_dehing"><p>Use code <?php echo $value['gift_code'];?> & get <?php echo $value['name'];?> off on <?php echo ($value['services']['title']);?></p></div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                   

             </div>


        </div>

      </div>


    </div>
  </div>
</div>