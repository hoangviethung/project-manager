<script>
    $(document).ready(function() {
        activeDropdownAsideMenu();
    });

    function activeDropdownAsideMenu()
    {
        $('.link.active').parent('.list-link-level--1').css('display','block');
        $('.link.active').parent('.list-link-level--1').prev('.name-link-level--1').addClass('active');
    }
</script>