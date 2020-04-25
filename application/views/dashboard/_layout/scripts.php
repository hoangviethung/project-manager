<script>
    $(document).ready(function() {
        activeDropdownAsideMenu();
        $(".project-possible-user").on("click", (function(e) {
            let emailListValue = $(this).parents('.block-form').find('.form-group-email').find('textarea[name="email"]').val();
            let value = $(this).find('.project-possible-user-email').val();
            emailListValue = emailListValue + value + ' , ';
            $(this).parents('.block-form').find('.form-group-email').find('textarea[name="email"]').val(emailListValue);
        }));
        $('.alert[role="alert"]').delay(2000).fadeOut();
        $('.header-breadcrumb').hide();
        setTimeout(function() {
            asideWidth = $('aside').width();
            $('.header-breadcrumb').fadeIn();
            $('.header-breadcrumb').css('margin-left', asideWidth + 20);
        }, 200);
    });

    function activeDropdownAsideMenu() {
        $('.link.active').parent('.list-link-level--1').css('display', 'block');
        $('.link.active').parent('.list-link-level--1').prev('.name-link-level--1').addClass('active');
    }
    Dropzone.options.dropzoneTest = {
        paramName: "image[]", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: "test",
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        }
    };
</script>