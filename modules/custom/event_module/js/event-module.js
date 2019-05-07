(function ($) {
    $('.event-subscribe-checkbox').on('click', function(){

       
       if ($(this).prop('checked') == true) {
           var checked = 1;
       } else {
           var checked = 2;
       }
        $.ajax({
            type: "POST",
            url: "/ajax-subscribe",
            data: { event_id : $(this).val(), checked : checked  },
            success: function(data){
            }
        });
    });
})(jQuery);