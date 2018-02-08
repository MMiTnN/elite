<?php
get_header();
?>

<section class="header-section"  style="background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url(<?php echo get_template_directory_uri() ?>/images/homepage2.png)">);">
    <div>
        <p class='text-white header-title text-center'><?php echo 'Elite Engineer'; ?></p>
    </div>
</section>
 <!-- <div>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-3.jpg" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-3.jpg" alt=""/></a>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-4.jpg" data-lightbox="example-set" data-title="Or press the right arrow on your keyboard."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-4.jpg" alt="" /></a>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-5.jpg" data-lightbox="example-set" data-title="The next image in the set is preloaded as you're viewing."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-5.jpg" alt="" /></a>
      <a class="example-image-link" href="http://lokeshdhakar.com/projects/lightbox2/images/image-6.jpg" data-lightbox="example-set" data-title="Click anywhere outside the image or the X to the right to close."><img class="example-image" src="http://lokeshdhakar.com/projects/lightbox2/images/thumb-6.jpg" alt="" /></a>
    </div> -->
<section id="featured" class="padding-t-50">
    <div class="container-fluid">
        <div class="row padding-b-30">
            <div class="col-xs-12">
                <h1 class="intro">As featured in</h1>
            </div>
        </div>
       <div class="row">
            <div class="col-xs-6 col-sm-3 padding-b-35">
                  <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/bkk101.png" alt="">
            </div>
            <div class="col-xs-6 col-sm-3 padding-b-35">
                  <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/bkk101.png" alt="">
            </div>
            <div class="col-xs-6 col-sm-3 padding-b-35">
                  <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/bkk101.png" alt="">
            </div>
            <div class="col-xs-6 col-sm-3 padding-b-35">
                  <img class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/bkk101.png" alt="">
            </div>
        </div>
    </div>
</section>

<?php get_camps(8); ?>

<section class="block-about padding-t-60">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xs-12 img-about" style="<?php echo trim($image2) ? "background-image:url($image2)" : "" ?>">
                <span  data-embed='Sm6bdSKR5XA' class="play-video trigger-overlay"></span>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="block-about-content">
                    <div class="title-about">
                        <h2>About us</h2>
                    </div>
                    <div class="content-about">
                       <p> Camp Sunbear (previously known as Thailand Summer Camps) was founded by Merritt and Kat Gurley, American sisters who were raised in Thailand. Merritt moved to Bangkok with her parents in 1990 and her younger sister Kat was born here in 1993. </p>
                        <p>Merritt attended ISB, RIS and NIST, and Kat graduated from NIST in 2011, so they know all the ins and outs of being international-school kids living in Bangkok. They both loved growing up in a big city but they missed the outdoors, especially on school breaks. </p>

                    </div>
                     <a href="javascript:void(0)" data-embed='Sm6bdSKR5XA' class="btn btn-border-gold margin-b-15 trigger-overlay">watch our video <span class="glyphicon glyphicon-triangle-right"></span></a>
                </div>
            </div>
        </div>
    </div>
    
</section>

<?php get_tesimonials(); ?>

<section class="about-camp">
    <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 padding-b-35">
                <div class="block">
                  <img width="100" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/map.png" alt="">
                </div>
                <div class="about-camp-content">
                    Wide range of outdoor activity programs throughout Thailand 
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 padding-b-35">
                <div class="block">
                  <img width="200" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/assessed.png" alt="">
                </div>
                <div class="about-camp-content">
                    Our activity provider has an outstanding safety record  
                </div>
            </div>
            <div class="clearfix visible-sm"></div>
            <div class="col-xs-12 col-sm-6 col-md-3 padding-b-35">
                <div class="block">
                  <img width="150" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/family.png" alt="">
                </div>
                <div class="about-camp-content">
                    Camp Sunbear is a family run business   
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 padding-b-35">
                <div class="block">
                  <img width="150" class="img-responsive" src="<?php echo get_template_directory_uri() ?>/images/icon/camp.png" alt="">
                </div>
                <div class="about-camp-content">
                    Wide range of outdoor activities and skills 
                </div>
            </div>

        </div>
    </div>    
</section><!--  -->
<script type="text/javascript">

    jQuery(document).ready(function ($) {
        $('#search-camp').on('click', function(){
            var age = $('#filter_age').val();
            var act = $('#filter_act').val();
            var date = $('#filter_date').val();
            var url = "<?php echo get_site_url().'/find-a-camp?'?>";
            window.location.href = url+'filter_age='+age+'&filter_activity='+act+'&filter_date='+date;
        });
         $('.chosen').chosen();
    });

    
</script>
<?php contact_form(); ?>


<?php video_popup(); ?>


<?php
get_footer();
?>
