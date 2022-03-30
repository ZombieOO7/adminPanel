(function ($) {
    $(document).find("#m_form_1").validate({
        errorClass:'text-danger',
        rules:{
            password: {
                required:true,
                minlength:rule.password_min_length,
                maxlength:rule.password_max_length,
            },
            confirm_password:{
                required:true,
                equalTo:'#password',
                minlength:rule.password_min_length,
                maxlength:rule.password_max_length,
            }
        },
    })
    $("#m_form_1").on('submit',function(event){
        event.preventDefault();
        if($("#m_form_1").valid()){
            var data = $("#m_form_1").serialize();
            $.ajax({
                url:forgotPasswordUrl,
                method:'POST',
                data:data,
                success:function(response){
                    responseAlert(response);
                }
            })
        }
    })
})(jQuery);
