(function($) {
    $(function() {
        $('a.close').click(function(e) {
            e.preventDefault();
            $(this).parents('.message').hide('fast');
            return false;
        });
    });
})(jQuery);