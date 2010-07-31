(function($) {
    $(function() {
        tr_hover();
        
        var sub_table = $('#sub').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "aoColumns" : [
                {"sWidth": "40%", "sClass": "center"},
                {"sWidth": "40%", "sClass": "center"},
                {"sWidth": "20%", "bSortable" : false, "bSearchable" : false, "sClass": "center"}],
            "fnDrawCallback" : function() {}
        }).fnSetFilteringDelay();

        $('#main').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "aoColumns" : [
                {"sWidth": "40%", "sClass": "center"},
                {"sWidth": "40%", "sClass": "center"},
                {"sWidth": "20%", "bSortable" : false, "bSearchable" : false, "sClass": "center"}],
            "fnDrawCallback" : function() {},
            "fnInitComplete" : function() {
                $('#main tbody tr:first').addClass('highlight');
            }
        }).fnSetFilteringDelay();

        $('#main tbody tr').click(function() {
            if(!$(this).hasClass('highlight')) {
                $('#main tbody tr').removeClass('highlight');
                $(this).removeClass('hover');
                $(this).addClass('highlight');
                $.post(BASE_URL + 'admin/categories/get_sub', {'id': $(this).attr('id')}, function(data) {
                    sub_table.fnClearTable();
                    sub_table.fnAddData(data);
                    tr_hover();
                }, 'json');
            }
        });

        function tr_hover() { $('.datatable tbody tr').hover(function() { $(this).addClass('hover'); }, function() { $(this).removeClass('hover'); }); }
    });
})(jQuery);