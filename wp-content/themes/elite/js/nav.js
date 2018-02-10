
(function($){
    $(document).ready(function(){
        $('#navbarMenuHeroA .navbar-end .navbar-item').mouseover(function(){
           if($(this).hasClass('has-dropdown')){
                $(this).addClass('is-active');
           }
         });
        $('#navbarMenuHeroA .navbar-end .navbar-item').mouseout(function(){
           if($(this).hasClass('has-dropdown')){
                $(this).removeClass('is-active');
           }
         });
     });
})(jQuery);