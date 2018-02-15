
(function($){
    $(document).ready(function(){
        console.log("navjs");
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

        // Open or Close mobile & tablet menu
        $('#navbar-burger').click(function () {
          if($(this).hasClass('is-active')){
            $(this).removeClass('is-active');
            $('#navbarMenuHeroA').removeClass('is-active');
          }else {
            $(this).addClass('is-active');
            $('#navbarMenuHeroA').addClass('is-active');
          }
        });

     });
})(jQuery);