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
<div class="hero-body main-header parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/images/tower6.jpeg" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          <?php echo get_the_title(); ?>
        </h1>
      </div>
    </div>
  </div>
<section class="map">
    <div class="container">
        <div class="row">
            <div class="flex-map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15500.356097710164!2d100.5734959!3d13.7735047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcf6d901f04f0e3cf!2z4Lia4Lij4Li04Lip4Lix4LiXIOC5gOC4reC4peC4teC4lyDguYDguK3guYfguJnguIjguLTguYDguJnguLXguKLguKPguYzguKog4LiI4Liz4LiB4Lix4LiU!5e0!3m2!1sen!2sth!4v1518107864551" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                <div class="block content">
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
</section>

<?php contact_form(); ?>

<?php get_footer(); ?>