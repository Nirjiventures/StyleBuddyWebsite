    //$('.show').zoomImage();
    //var base_url = 'https://dndtestserver.com/stylebuddy-newsite2/beta/';
    var base_url = 'https://www.stylebuddy.in/';

    $('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
    $('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')



    var small_img_roll_1 = 5;
    var small_img_roll_2 = 4;
    var small_img_roll_3 = 3;
    var small_img_roll_4 = 5;

    $('.show-small-img').click(function () {
        $('#show-img').attr('src', $(this).attr('src'))
        $('#big-img').attr('src', $(this).attr('src'))
        $(this).attr('alt', 'now').siblings().removeAttr('alt')
        $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
        if ($('#small-img-roll').children().length > small_img_roll_1) {
            if ($(this).index() >= small_img_roll_2 && $(this).index() < $('#small-img-roll').children().length - 1){
                $('#small-img-roll').css('left', -($(this).index() - small_img_roll_3) * 76 + 'px')
            } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
                $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')
            } else {
                $('#small-img-roll').css('left', '0')
            }
        }
    })

     
    $('#next-img').click(function (){
        $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
        $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
        $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
        $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
        if ($('#small-img-roll').children().length > small_img_roll_1) {
            if ($(".show-small-img[alt='now']").index() >= small_img_roll_2 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
                $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - small_img_roll_3) * 76 + 'px')
            } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
                $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')
            } else {
                $('#small-img-roll').css('left', '0')
            }
        }
    })

     
    $('#prev-img').click(function (){
        $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
        $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
        $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
        $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
        if ($('#small-img-roll').children().length > small_img_roll_1) {
            if ($(".show-small-img[alt='now']").index() >= small_img_roll_2 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
                $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - small_img_roll_3) * 76 + 'px')
            } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
              $('#small-img-roll').css('left', -($('#small-img-roll').children().length - small_img_roll_4) * 76 + 'px')
            } else {
              $('#small-img-roll').css('left', '0')
            }
        }
    })






    $(document).ready(function() {
        $('#country').on('change',function(){
            var country_id = $(this).val();
            console.log(country_id);
            if(country_id) {
              $.ajax({
                    type:'POST',
                    url:base_url+'Vendor/getstate',
                    data:'country_id='+country_id,
                    success:function(html){
                        $('#state').html(html);
                    }
                }); 
            } else {
              $('#state').html('<option value="">Select state first</option>');
            } 
        });
        $('#state').on('change',function(){
            var state_id = $(this).val();
            if(state_id) {
              $.ajax({
                    type:'POST',
                    url:base_url+'city-data',
                    data:'state_id='+state_id,
                    success:function(html){
                        console.log(html);
                        $('#city').html(html);
                    }
                }); 
            } else {
              $('#city').html('<option value="">Select state first</option>');
            } 
        });
        $('#contact-form').on('submit',function(e){
           //alert('test');
           e.preventDefault();
            var formData = new FormData(this);                                           
            $.ajax({   
                url: base_url+"form-process",         
                cache: false,
                dataType: "json",
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function(data){
                      if(data.error) {
                          if(data.name_err !== '') {
                            $('#name_err').html(data.name_err);
                            } else {
                            $('#name_err').html('');
                            }
                            if(data.email_err !== '') {
                            $('#email_err').html(data.email_err);
                            } else {
                            $('#email_err').html('');
                            }
                      }
                      if(data.success){
                             $('#success_msg').html(data.success);
                             $('#success_msg').fadeOut(4000);
                             $('#name_err,#email_err').html('');
                             $('#contact-form')[0].reset();
                            }
                     }
            });  
        });
            // id qty price name [size,]
        $('.cart').on('click',function() {
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
            let color = $("input[name='color']:checked").val();
            let colorarray = $(this).data("colorarray");

            var check = true;
            if (sizearray != 'none') {
                if (typeof size  === "undefined") {
                    check = false;
                    $('#size-err').html('<span class="text-danger">Please choose size</span>');
                } else {
                    $('#size-err').html('');
                    $('#size-err').delay(500).fadeOut('slow');
                }
            }
            if (colorarray != 'none') {
                if (typeof color  === "undefined") {
                    check = false;
                    $('#color-err').html('<span class="text-danger">Please choose color</span>');
                } else {
                    $('#color-err').html('');
                    $('#color-err').delay(500).fadeOut('slow');
                }
            }

            if (check) {
                  let url =  base_url+"cart-process";
                  $.ajax({
                     url:url,
                     type:"POST",
                     dataType:"json",
                     data:{id:id,product_id:product_id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size,color:color },
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
        $('.cart2').on('click',function() {
            console.log($(this).data("price"));
            console.log($(this).data("discountprice"));
            let id = $(this).data("id");
            let qty = $("input[name='qtybutton']").val();
            let price = $(this).data("price");
            let mrpprice = $(this).data("mrpprice");
            let name = $(this).data("name");
            let image = $(this).data("image");
            let catId = $(this).data("catid");
            let discount = $(this).data("discount");
            let discountPrice = $(this).data("discountprice");
            let venderId = $(this).data("venderid");
            let size = $("input[name='size']:checked").val();
            let sizearray = $(this).data("sizearray");
            let color = $("input[name='color']:checked").val();
            let colorarray = $(this).data("colorarray");

            var check = true;
            if (sizearray != 'none') {
                if (typeof size  === "undefined") {
                    check = false;
                    $('#size-err').html('<span class="text-danger">Please choose size</span>');
                } else {
                    $('#size-err').html('');
                    $('#size-err').delay(500).fadeOut('slow');
                }
            }
            if (colorarray != 'none') {
                if (typeof color  === "undefined") {
                    check = false;
                    $('#color-err').html('<span class="text-danger">Please choose color</span>');
                } else {
                    $('#color-err').html('');
                    $('#color-err').delay(500).fadeOut('slow');
                }
            }

            if (check) {

                let url =  base_url+"cart-process";

                $.ajax({

                    url:url,

                    type:"POST",

                    dataType:"json",

                    data:{id:id, name:name, price:price,mrpprice:mrpprice, qty:qty, image:image,catId:catId,discount:discount,discountPrice:discountPrice,venderId:venderId,size:size,color:color },
                    success:function(data){
                        if(data.success) {
                            console.log(data.rowCount);
                            $('#add_to_bag_pop_up').attr("src",data.src);
                            $('#cart_qty_span').attr("data-qty",data.rowCount);
                            $('#cart_qty_span').html(data.rowCount);
                            $('#cartModel').modal('show');
                            $(".modal-backdrop").css('background-color','rgb(0 0 0 / 0%)');
                            setTimeout(function(){
                                $('#cartModel').modal('hide')
                            }, 5000);

                            //window.location.reload();
                            //window.location.href = base_url+"cart";
                        }     
                    }
                });   

            } else {

                // window.location.reload();

            }

           // console.log(size);

        });
        $('.btn_wish').click(function() {
            
            let id = $(this).data("id");
            let catId = $(this).data("catid");
            let venderId = $(this).data("venderid");
            let loggedid = $(this).data("loggedid");
            console.log(id);
            console.log(catId);
            console.log(venderId);
            console.log(loggedid);
            console.log(base_url+"user/wishlistadd");
                $.ajax({
                     url:base_url+"user/wishlistadd",
                     type:"POST", 
                     //dataType:"json",
                     data:{id:id,catId:catId,venderId:venderId,loggedid:loggedid},
                     success:function(data){
                            console.log(data);
                            ss = $.parseJSON(data);
                            if(ss.status == 1) {
                                $('#btn_wish_'+id+'').removeClass('fa-heart-o');
                                $('#btn_wish_'+id+'').addClass('fa-heart');
                                //window.location.reload();
                            }else{
                                $('#btn_wish_'+id+'').removeClass('fa-heart');
                                $('#btn_wish_'+id+'').addClass('fa-heart-o'); 
                            } 
                            /*console.log($(this).find('i'));
                            console.log($(this).children('i'));
                            if(ss.status == 1) {
                                $(this).find('i').removeClass('fa-heart-o');
                                $(this).find('i').addClass('fa-heart');
                                //window.location.reload();
                            }else{
                                $(this).find('i').removeClass('fa-heart');
                                $(this).find('i').addClass('fa-heart-o'); 
                            }    */    
                       }
               });   
       });
        $('.removecart').click(function() {
    	      console.log('removecart');
    	      var row_id = $(this).attr("id");
    	      //console.log(row_id);
              if(row_id) {
                  $.ajax({
                    url:"Shop/cartRemove",
                    method:"POST",
                    data:{row_id:row_id},
                    success:function(data){
                        $('#'+row_id).hide();
                       window.location.reload();
                    }
                  });
              }  
    	  });
       
        $('#booking-form').on('submit',function(e){
         e.preventDefault();
         console.log('booking-form');
         var formData = new FormData(this);                                           
         $.ajax({   
            url: "booking-process",         
            cache: false,
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function(data) {
                 if(data.status == true) {
                     window.location.href = data.redirect;
                 }
            }
         });  
         
     });  

        $('#titleDisplay').hide();
         
        $('#expert').on('keyup',function(){
            var stylist = $(this).val();
            //console.log(stylist);
            if(stylist) {
                $.ajax({
                    type: "POST",
                    url: base_url+'stylistSearch',
                    data: {'stylist':stylist }, 
                    dataType: "html",
                    success: function(msg) {
                       // console.log(msg)
                     $('#titleDisplay').show();
                     $('#titleDisplay').html(msg);
                    }
                });
            } else { $('#titleDisplay').hide();  } 
        });
    });
    function selectTitle(val) {
        $("#expert").val(val);
        $("#titleDisplay").hide();
        document.getElementById('FormStylist').submit();
    }

    function updateproduct(rowid) {
            var qty = $('.qty'+rowid).val();
            var price = $('.price'+rowid).text();
            price =   price.replace('₹','');
            price =   price.replace(',','');
            
            var mrpprice = $('.mrpprice'+rowid).text();
            mrpprice =   mrpprice.replace('₹','');
            mrpprice =   mrpprice.replace(',','');
            
             
            $.ajax({
                url:"Shop/cartUpdate",
                type:'POST',
                data:{rowid:rowid, qty:qty, price:price, mrpprice:mrpprice},
                success:function(res){
                    console.log(res);
                    window.location.reload();
                    // setTimeout(function(){$('.min_cart').show(); },500); 
                    // $("#min_cart_data").modal({backdrop: 'static', keyboard: false });
                }
            });
         
         
    }
    
    function ajax_couponapply(currency,inputID,id){
        $('#view_more_cop').modal('hide');
        $("#loader").modal('show');

        $('.cart_div_').css('display','none');
        $('#cart_div_'+id).css('display','block');


        var form_data = new FormData(); 
        coupon_code = $('#'+inputID+id).val();
        price =  $('#price').val();
        form_data.append('coupon_code',coupon_code);
        form_data.append('price',price);
        redeemPointFlag = $('#redeemPointFlag').val();
        if(redeemPointFlag == 0){
            $('#redeemAfterCouponModal').modal('show');;
            return false;
        }
        console.log(coupon_code);
        $.ajax({
            type: 'POST',
            url: base_url+'cart/ajax_couponapply',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                console.log(response);
                var p = $.parseJSON(response);
                if(p.status == 'success'){
                    discount = p.result.coupon_price;
                    $('#discount_span_name').html(' ( '+p.result.coupon_code + ' ) ');
                    $('#coupon_id').val(p.result.id);
                    $('#totalPoint').html(p.totalPoint);

                    $('#view_more_cop_div'+id).css('display','none');
                    $('#view_offer_button_apply'+id).css('display','none');
                    $('#view_offer_button_remove'+id).css('display','block');
                    $('#applyIcon'+id).css('display','contents');
                }else{
                    //$('#discount_html').css('display','none');
                    $('#coupon_id').val(0);
                    $('#totalPoint').html($('#totalPointValue').val());
                    
                    $('#applyIcon'+id).css('display','none');
                    $('#view_offer_button_remove'+id).css('display','none');
                    $('#view_offer_button_apply'+id).css('display','block');
                    $('#view_more_cop_div'+id).css('display','block');
                }
                p_total = p.total;
                p_discount = p.discount;
                
                $('#discount_span_price_html').html('- ' + p.discount);
                
                console.log(p_total);
                console.log(p_discount);
            
                $('#final_price').val(p.total);
                if(p.status == 'success'){
                    $('#p_discount_html').css('display','block');
                    $('#discount_html').html(p_discount);
                }else{
                   $('#p_discount_html').css('display','none'); 
                }
                $('#applyCouponMessage').html('<b>'+p.message+'</b>');
                
                $('#price_html').html('<b>'+p.total + '</b>');
                ajax_update_cart_after_coupon(inputID+id);
                $("#loader").modal('hide');
                

            }
        }); 
    }
    function ajax_update_cart_after_coupon(inputID){
        var form_data = new FormData(); 
        
        price =  $('#price').val();
        coupon_id = $('#coupon_id').val();
        coupon_code = $('#'+inputID).val();
        coupon_price = $('#discount').val();
        total = $('#final_price').val();
        
        form_data.append('price',price);
        form_data.append('coupon_id',coupon_id);
        form_data.append('coupon_code',coupon_code);
        form_data.append('coupon_price',coupon_price);
        form_data.append('total',total);
        
        $.ajax({
            type: 'POST',
            url: base_url+'cart/ajax_update_cart_after_coupon',
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(response){
                console.log(response);
                //$('#'+inputID).val('');
             }
        }); 
    }
    
