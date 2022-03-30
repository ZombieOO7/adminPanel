(function ($) {
    $(document).find("#m_form_2").validate({
        errorClass:'text-danger',
        rules:{
            name: {
                required:true,
                email:true,
                maxlength:rule.input_max_length,
            },
            email: {
                required:true,
                email:true,
                maxlength:rule.input_max_length,
            },
            password:{
                minlength:rule.password_min_length,
                maxlength:rule.password_max_length,
            },
            confirm_password:{
                required:function(elment){
                    if($('#password').val().length > 0){
                        return true;
                    }
                    return false;
                },
                equalTo:'#password',
                minlength:rule.password_min_length,
                maxlength:rule.password_max_length,
            }
        },
    })
    // $("#m_form_1").on('submit',function(event){
    //     var url = this.action;
    //     event.preventDefault();
    //     if($("#m_form_1").valid()){
    //         var data = new FormData(this);
    //         $.ajax({
    //             url:url,
    //             method:'POST',
    //             data:data,
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             success:function(response){
    //                 responseAlert(response);
    //             }
    //         })
    //     }
    // })
})(jQuery);
