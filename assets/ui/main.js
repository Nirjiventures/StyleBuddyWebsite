var base_url = 'https://dndtestserver.com/stylebuddy-newsite2/beta/';
$(document).ready(function(){
    $('#state').on('change',function() {
        var state_id = $(this).val();
        if(state_id) {
            $.ajax({

                type:'POST',

                url:base_url+"city-data",

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
});
$(document).on("blur","#email",function() {
    var checkEmail = $(this).val();
    if(IsEmail(checkEmail)) { 
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>vendor/emailcheck',
            data: 'checkEmail='+checkEmail,
            success: function(data) {
              if(data == 1) {
                 $('#email_Err').html('your email address is registered');
                 $('#email').focus();
                 return false; 
              } else {
                 $('#email_Err').html(' '); 
              }
           }
        });    
    }
});
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
$(document).ready(function(){
    $('.onlyInteger').on('keypress', function(e) {
      keys = ['0','1','2','3','4','5','6','7','8','9','.']
      return keys.indexOf(event.key) > -1
    }) 
}) 



 