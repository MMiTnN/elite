(function ($) {
    'use strict';

    $(function () {
        function set_height_block(){
            var list_camp = $('.camp-item .item-camp'); 
            $.each(list_camp, function(i, v){
                var left_block = $(v).find('.left').height();
                var right_block = $(v).find('.right').height();
                if(left_block > right_block){
                    $(v).find('.right .block').css('height', left_block);
                }else{
                    $(v).find('.left .block').css('height', right_block);
                }
            });
            
        }
        set_height_block();
        $( window ).resize(function() {
            set_height_block();
        });
       
    });

})(jQuery);
