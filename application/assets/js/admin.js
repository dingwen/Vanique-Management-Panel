(function($) {
    $(function() {
        $('a.close').click(function(e) {
            e.preventDefault();
            $(this).parents('.message').hide('fast');
            return false;
        });
        confirm_popup();
    });
    
    function confirm_popup() {
        $('a.confirm').click(function() {
            return confirm("Are you sure to delete these items?");
        });
    }
})(jQuery);