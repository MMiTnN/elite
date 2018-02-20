<?php
/*
 * Template Name: Contact us
 */
?>
<?php get_header(); 
the_post();
$post_id = get_the_ID();
$image_id = get_post_thumbnail_id($post_id);
$image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
$image = '';
    if (!empty($image_arr)) {
        $image = $image_arr[0];
    } 
?>
<style type="text/css">
    @media (max-width: 1023px){
      .main-header{
          background-image: linear-gradient(rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.25)), url("<?php echo get_template_directory_uri(); ?>/images/tower6.jpeg ?>");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 55% 55%;
      }
    }
</style>
<div class="hero-body main-header parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/images/tower6.jpeg" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          <?php echo get_the_title(); ?>
        </h1>
      </div>
    </div>
  </div>
   <section class="hero is-light">
          <div class="hero-body">
            <div class="containe">
                 <div class="columns map">
                  <div class="column">
                      <div class="columns">
                          <div class="column">
                            <a class="example-image-link img-pro" data-lightbox="example-set" data-title="Click the right half of the image to move forward." href="<?php echo get_template_directory_uri(); ?>/images/map2.jpg?>">
                             <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/map2.jpg" >
                            </a>
                          </div>
                          <div class="column content">
                            <h3><strong style="color: #337ab7"><?php _e('บริษัท เอลีท เอ็นจิเนียร์ส จำกัด', 'elite') ?></strong></h3>
                                <br/>
                                <h5><?php _e('เลขที่ 184/44 อาคารฟอรั่มทาวเวอร์ ชั้น 14', 'elite') ?> </h5>
                                <h5><?php _e(' ถนนรัชดาภิเษก แขวงห้วยขวาง เขตห้วยขวาง', 'elite') ?> </h5>
                                <h5><?php _e('เกรุงเทพฯ 10310', 'elite') ?> </h5>
                                <br/>
                                <h5><?php _e('โทร : 0-2645-3671-4', 'elite') ?> </h5>
                                <h5><?php _e('แฟกซ์ : 0-2645-3670', 'elite') ?> </h5>
                                <h5><?php _e('อีเมล : eliteength@yahoo.com', 'elite') ?> </h5>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </section>

<?php contact_form(); ?>

<?php get_footer(); ?>