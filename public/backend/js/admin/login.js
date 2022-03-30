(function ($) {
    $(document).find("#sign_in_form").validate({
        errorClass:'text-danger',
        rules:{
            email: {
                required:true,
                email:true,
                maxlength:rule.email_length,
            },
            password:{
                required:true,
                minlength:rule.password_min_length,
                maxlength:rule.password_max_length,
            },
        },
    })
    $("#sign_in_form").on('submit',function(event){
        event.preventDefault();
        if($("#sign_in_form").valid()){
            var data = $("#sign_in_form").serialize();
            $.ajax({
                url:loginUrl,
                method:'POST',
                data:data,
                success:function(response){
                    responseAlert(response);
                }
            })
        }
    })
})(jQuery);
