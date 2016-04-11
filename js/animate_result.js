$(document).ready(function() {
    

    $(".error_question").hide();
    $(".error_result").hide();
    $(".error_captcha").hide();
    var captch = jQuery('#g-recaptcha-response').val();

    $(".form").submit(function() {
        if($('#new_question').val().length===0 || $('#new_result').val().length===0){
            if($('#new_question').val().length===0){
                $('.error_question').show();

            }else{
                $('.error_question').hide();
            }

             if($('#new_result').val().length===0){
                $(".error_result").show();

            }else{
                $('.error_result').hide();
            }
        }
    });
    
    

    $(".form").submit(function() {
        if($('#new_question').val().length===0 || $('#new_result').val().length===0){
            return false;
        }else{
            return true;
        }
    });
});