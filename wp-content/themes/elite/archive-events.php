<?php
get_header();

$args = array(
    'post_type' => 'events',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'DESC',
);
/*
 * Query
 */
$posts = new WP_Query($args);
$events = $posts->posts;
?>
<style type="text/css">
    @media (max-width: 1023px){
      .main-header{
          background-image: linear-gradient(rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.25)), url("<?php echo get_template_directory_uri(); ?>/images/tower8.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 55% 55%;
      }
    }
</style>
<div class="hero-body main-header parallax-window normal" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/images/tower8.jpeg" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          <?php echo __('ข่าวสารและกิจกรรม', 'elite'); ?>
        </h1>
      </div>
    </div>
  </div>
<div class="print-header">
    <div class="container-fulid has-text-centered">
     <img src="<?php echo get_template_directory_uri(); ?>/images/tower8.jpeg" />
      <div class="font-main-header white">
        <h1 class="title">
           <?php _e('ข่าวสารและกิจกรรม', 'elite'); ?>
        </h1>
      </div>
    </div>
  </div>

<?php
     if(!empty($events)): ?>
       <section class="hero section-box is-light projects-pic-list events">
          <div class="">
            <div class="container">
              <div class="columns is-multiline is-12">
                   <?php 
                        $count = 1;
                        foreach($events as $pro): 
                        $post_id = $pro->ID;
                        /* Get post thumnail */
                        $image_id = get_post_thumbnail_id($post_id);
                        $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                        if (empty($image_arr)) {
                            $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                        } else {
                            $image = $image_arr[0];
                        }
                        ?>
                        <div class="column is-4 is-4-desktop is-3-widescreen is-mobile has-text-centered box-content blog-img pro">
                          <a class="img-pro" href="<?php echo get_permalink($post_id); ?>">
                                <img class="block black"  src='<?php echo $image ?>' >
                                <h5> <?php echo $pro->post_title; ?></h5>
                              </a>
                         </div>
                     <?php  if(($count%3==0)): ?>
                              <div class="clearfix visible-sm"></div>
                            <?php endif; ?>
                            <?php if(($count%4==0)): ?>
                              <div class="clearfix visible-md visible-lg"></div>
                            <?php endif; ?>
                            <?php $count++;
                     endforeach; ?>
              </div>
            </div>
          </div>
        </section>
   <?php endif; ?>
<!--END Search filters-->

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var prefixUrl = "<?php echo multi_lang_url("/events") ?>";
    });
</script>
<?php
get_footer();
?>


