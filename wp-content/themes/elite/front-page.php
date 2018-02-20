<?php
get_header();

$args_now = array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => '_pjt',
            'value' => __('โครงการปัจจุบัน','elite'),
            'compare' => '=',
        ),
    )
);
/*
 * Query
 */
$posts_now = new WP_Query($args_now);
$projects_now = $posts_now->posts;

$args_past = array(
    'post_type' => 'projects',
    'post_status' => 'publish',
    'posts_per_page' => 7,
    'orderby' => 'rand',
    'meta_query' => array(
        array(
            'key' => '_pjt',
            'value' => __('โครงการที่ผ่านมา','elite'),
            'compare' => '=',
        ),
    )
);
/*
 * Query
 */
$posts_past = new WP_Query($args_past);
$projects_past = $posts_past->posts;
$homepage = get_page_by_title('Homepage');
$profile = get_post_meta($homepage->ID, 'profile', $single);
$profile_title = '';
$profile_content = '';
$profile_img =  '';
if(!empty($profile[0])){
    $profile_title = $profile[0]['profile_title'];
    $profile_content = $profile[0]['profile_content'];
    $profile_img =  $profile[0]['profile_img'];
    $profile_img_src = wp_get_attachment_image_src($profile_img, 'full');
}
?>
<style type="text/css">
    @media (max-width: 1023px){
      .main-header{
          background-image: linear-gradient(rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.25)), url("<?php echo get_template_directory_uri(); ?>/images/tower5.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 55% 55%;
      }
    }
</style>
 <!-- Hero content: will be in the middle -->
  <div class="hero-body main-header parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri(); ?>/images/tower5.jpeg" >
    <div class="container has-text-centered">
      <div class="font-main-header white">
        <h1 class="title">
          ELITE 
        </h1>
        <h2 class="subtitle">
          ENGINEER
        </h2>
      </div>
    </div>
  </div>
 <section class="hero is-content section-box is-dark">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('เกี่ยวกับเรา', 'elite') ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-12 is-three-fifths-widescreen is-offset-one-fifth-widescreen">
            <div class="columns ">
                <div class="column  has-text-centered box-content">
                    <article class="tile is-child notification is-primary block-content has-text-centered">
                       <p class="title"><?php _e('ความสามารถสูง', 'elite'); ?></p>
                       <div class="line-solid"></div>
                       <p class="subtitle"><?php _e('ทีมงานวิศวกรของเรามีความสามารถสูง', 'elite'); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered">
                  <article class="tile is-child notification is-primary block-content has-text-centered">
                    <p class="title"><?php _e('ประเภทธุรกิจ', 'elite'); ?></p>
                    <div class="line-solid"></div>
                    <p class="subtitle"><?php _e('การก่อสร้าง, เครื่องจักรกล, ระบบไฟฟ้า', 'elite'); ?></p>
                  </article>
                </div>
                <div class="column  has-text-centered">
                     <article class="tile is-child notification is-primary block-content has-text-centered">
                       <p class="title"><?php _e('ความเชี่ยวชาญ', 'elite'); ?></p>
                       <div class="line-solid"></div>
                       <p class="subtitle"><?php _e('เรามีความเชี่ยวชาญในโครงการแบบครบวงจร', 'elite'); ?></p>
                     </article>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
  <section class="block-about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xs-12 img-about" style="<?php echo trim($profile_img_src[0]) ? "background-image:url($profile_img_src[0])" : "" ?>">
                </div>
                <div class="col-sm-6 col-xs-12 <?php echo $css_pull; ?> ">
                    <div class="block-about-content">
                        <div class="title-about">
                            <h3><?php echo $profile_title; ?></h3>
                        </div>
                        <div class="content-about">
                           <p> <?php echo $profile_content; ?> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
 
 <!-- <section class="hero is-content section-box is-primary">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('160+ พนักงาน', 'elite') ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-three-fifths is-offset-one-fifth">
            <div class="columns ">
                <div class="column  has-text-centered box-content blog-img no-padding margin-075em">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" >
                    <article class="tile is-child notification is-dark block-content has-text-centered">
                       <p class="title"><?php _e('Enginerr : 50', 'elite'); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered blog-img no-padding margin-075em">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/2.jpg" >
                  <article class="tile is-child notification is-dark block-content has-text-centered">
                    <p class="title"><?php _e('Forman: 88', 'elite'); ?></p>
                  </article>
                </div>
                <div class="column  has-text-centered blog-img no-padding margin-075em">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" >
                     <article class="tile is-child notification is-dark block-content has-text-centered">
                       <p class="title"><?php _e('Admin : 40', 'elite'); ?></p>
                     </article>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
 </section> -->
<?php if(!empty($projects_now)): ?>
   <section class="hero is-content section-box is-dark">
  <div class="hero-body">
    <div class="container">
      <div class="columns ">
          <div class="column  has-text-centered">
              <h1 class="title"><?php _e('โครงการปัจจุบัน', 'elite') ?></h1>
          </div>
      </div>
      <div class="columns is-12 is-multiline jus-cen">
         <?php  
               foreach($projects_now as $key => $pro): 
                $post_id = $pro->ID;
                /* Get post thumnail */
                $image_id = get_post_thumbnail_id($post_id);
                $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                if (empty($image_arr)) {
                    $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                } else {
                    $image = $image_arr[0];
                }?>
                  <div class="column is-one-third is-12-mobile has-text-centered box-content blog-img slide">
                      <a class="link-blog-pro" href="<?php echo get_permalink($post_id); ?>">
                          <div class="blog-pro">
                              <img src="<?php echo $image ?>" >
                                <article class="tile is-child is-dark is-nowpro has-text-centered">
                                   <p class="title"><?php echo $pro->post_title; ?></p>
                                 </article>
                          </div>
                      </a>
                  </div>
                <?php 
                endforeach; 
           ?>
      </div>
    </div>
  </div>
</section>
 <!-- <section class="hero is-content section-box is-primary is-hidden-touch">
  <div class="hero-body">
    <div class="container">
      <div class="columns ">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('โครงการปัจจุบัน', 'elite') ?></h1>
          </div>
      </div>
      <div class="columns is-12">
         <?php  
               foreach($projects_now as $key => $pro): 
                $post_id = $pro->ID;
                /* Get post thumnail */
                $image_id = get_post_thumbnail_id($post_id);
                $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                if (empty($image_arr)) {
                    $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                } else {
                    $image = $image_arr[0];
                }?>
                  <div class="column has-text-centered box-content blog-img slide no-padding">
                      <a href="<?php echo get_permalink($post_id); ?>">
                         <img src="<?php echo $image ?>" >
                         <article class="tile is-child is-dark block-content has-text-centered">
                            <p class="title"><?php echo $pro->post_title; ?></p>
                          </article>
                      </a>
                  </div>
                <?php 
                endforeach; 
           ?>
      </div>
    </div>
  </div>
 </section>
 <section class="hero is-content section-box is-primary is-hidden-desktop">
  <div class="hero-body">
    <div class="container">
      <div class="columns ">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('โครงการปัจจุบัน', 'elite') ?></h1>
          </div>
      </div>
      <div class="columns is-12 is-tablet is-multiline jus-cen">
         <?php  
               foreach($projects_now as $key => $pro): 
                $post_id = $pro->ID;
                /* Get post thumnail */
                $image_id = get_post_thumbnail_id($post_id);
                $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                if (empty($image_arr)) {
                    $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                } else {
                    $image = $image_arr[0];
                }?>
                  <div class="column is-4-tablet has-text-centered box-content blog-img slide no-padding">
                      <a href="<?php echo get_permalink($post_id); ?>">
                         <img src="<?php echo $image ?>" >
                         <article class="tile is-dark block-content-touch has-text-centered">
                            <p class="title"><?php echo $pro->post_title; ?></p>
                          </article>
                      </a>
                  </div>
                <?php 
                endforeach; 
           ?>
      </div>
    </div>
  </div>
 </section> -->
<?php endif; ?>

 <?php if(!empty($projects_past)): ?>
 <section class="hero section-box is-light margin-t-1point3  is-hidden-touch">
  <div class="hero-body no-padding">
    <div class="container-fluid no-padding">
      <div class="columns is-multiline is-12">
          
             <div class="column is-2 has-text-centered box-content blog-img slide no-padding box-center-text"> 
               <a href="<?php echo get_site_url().'/projects/?pjt='.__('โครงการที่ผ่านมา','elite') ?>" style="width:100%;">
                 <article class="tile is-child is-dark has-text-centered is-title-past">
                    <p class="title"><?php _e('โครงการที่ผ่านมา','elite'); ?></p>
                  </article>
                </a>
             </div>
             <?php foreach($projects_past as $key => $pro): 
              $post_id = $pro->ID;
              /* Get post thumnail */
              $image_id = get_post_thumbnail_id($post_id);
              $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
              if (empty($image_arr)) {
                  $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
              } else {
                  $image = $image_arr[0];
              }?>
              <?php if($key == 0 || $key == 4){
                 $css_column = 'is-4';
              }else if($key == 6) {
                $css_column = 'is-2';
              }else{
                $css_column = 'is-3';
              }
               ?>
                <div class="column <?php echo $css_column;  ?> is-mobile has-text-centered box-content blog-img slide no-padding">
                   <a href="<?php echo get_permalink($post_id); ?>">
                     <img  src="<?php echo $image ?>" >
                     <article class="tile is-child is-dark block-content has-text-centered">
                        <p class="title"><?php echo $pro->post_title; ?></p>
                      </article>
                    </a>
                 </div>
             <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<section class="hero section-box is-light margin-t-8  is-hidden-desktop">
  <div class="hero-body ">
    <div class="container">
      <div class="columns is-multiline is-12">
             <div class="column is-2 has-text-centered box-content blog-img slide"> 
               <a href="<?php echo get_site_url().'/projects/?pjt='.__('โครงการที่ผ่านมา','elite') ?>" style="width:100%;">
                 <article class="tile is-child is-dark has-text-centered">
                    <p class="title"><?php _e('โครงการที่ผ่านมา','elite'); ?></p>
                  </article>
                </a>
             </div>
             <?php foreach($projects_past as $key => $pro): 
              $post_id = $pro->ID;
              /* Get post thumnail */
              $image_id = get_post_thumbnail_id($post_id);
              $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
              if (empty($image_arr)) {
                  $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
              } else {
                  $image = $image_arr[0];
              }?>
              <?php if($key == 0 || $key == 4){
                 $css_column = 'is-4';
              }else if($key == 6) {
                $css_column = 'is-2';
              }else{
                $css_column = 'is-3';
              }
               ?>
                <div class="column <?php echo $css_column;  ?> is-mobile has-text-centered box-content blog-img slide no-padding">
                   <a href="<?php echo get_permalink($post_id); ?>">
                     <img  src="<?php echo $image ?>" >
                     <article class="tile is-dark block-content-touch has-text-centered">
                        <p class="title"><?php echo $pro->post_title; ?></p>
                      </article>
                    </a>
                 </div>
             <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif;  ?>


<?php video_popup(); ?>
<?php
get_footer();
?>
