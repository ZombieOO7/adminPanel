(function ($) {
    $(document).on('click','.imgRemove', function(){
        var backgroundImage = $(document).find('.imageSrc').css('background-image');
        backgroundImage = backgroundImage.replace('url(','').replace(')','').replace(/\"/gi, "");
        $('.imagePreview').attr('src',backgroundImage);
    });

    $('#customFile').change(function () {
        if (this.files) {
            var filesAmount = this.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $(document).find('.imageSrc').attr('src',event.target.result);
                }
                reader.readAsDataURL(this.files[i]);
            }
        }
    });
    $(document).find("#m_form_1").validate({
        errorClass:'text-danger',
        rules:{
            email: {
                required:true,
                email:true,
                maxlength:rule.input_max_length,
            },
            title: {
                required:true,
                maxlength:rule.input_max_length,
            },
            copyright:{
                required:true,
                maxlength:rule.input_max_length,
            },
        },
    })
})(jQuery);