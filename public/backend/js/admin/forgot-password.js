(function ($) {
    $(document).find("#m_form_1").validate({
        errorClass:'text-danger',
        rules:{
            email: {
                required:true,
                email:true,
                maxlength:rule.input_max_length,
            },
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
