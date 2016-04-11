$(document).ready(function() {
    
    
    $(".error_login").hide();
    $(".error_email").hide();
    $(".error_pwd").hide();
    $(".error_pwd_confirm").hide();
    $(".error_user").hide();
    var error = $(".error").val();
    
    if($(".error").val() == " "){
       $(".error_login").hide();
    }
    
    
    $(".form_user").submit(function() {
        if($('#login').val().length===0 || $('#email').val().length===0 || $('#pwd').val().length===0 || $('#pwd_confirm').val().length===0){
            if($('#login').val().length===0){
                $('.error_login').show();

            }else{
                $('.error_login').hide();
            }

            if($('#email').val().length===0){
                $(".error_email").show();

            }else{
                $('.error_email').hide();
            }
            
            if($('#pwd').val().length===0){
                $(".error_pwd").show();

            }else{
                $('.error_pwd').hide();
            }
            
            if($('#pwd_confirm').val().length===0){
                $(".error_pwd_confirm").show();

            }else{
                $('.error_pwd_confirm').hide();
            }
        }
    });

    $(".form_user").submit(function() {
        if($('#login').val().length===0 || $('#email').val().length===0 || $('#pwd').val().length===0 || $('#pwd_confirm').val().length===0){
            return false;
        }else{
            return true;
        }
    });
   
});