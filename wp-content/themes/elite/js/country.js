  var $ = jQuery;
        $(document).ready(function () {
            $("img.js-image-background").each(function (i, elem) {
                var img = $(elem);
                var div = $(img).parent(".product-block").css({
                    background: "url(" + img.attr("src") + ") no-repeat center center",
                    "background-size": "cover",
                    height: "500px"
                });
                img.remove();
            });
            
            mapInit();

            $(window).resize(function(event) {
                mapInit();
            });

        function mapInit(){
            var screen_w = $(window).width();
            var row_height = $('.img-country-map').parents("div.row").height();
       
            if ( screen_w >= 768 ){
                
                $('.img-country-map').css({
                    height:row_height+380,
                    position: 'absolute',
                    top: '-180px',
                    right:'0',
                    left:'0',
                    margin:'auto',
                    display:'block'
                });
            }else{
                $('.img-country-map').css({
                    height:'auto',
                    position: 'relative',
                    top: '0',
                    right:'0',
                    left:'0',
                    margin:'auto',
                    'max-width':'100%',
                    display:'block'
                });
            }
        }
        });