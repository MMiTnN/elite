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
            'value' => 'โครงการปัจจุบัน',
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
    'posts_per_page' => 8,
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => '_pjt',
            'value' => 'โครงการที่ผ่านมา',
            'compare' => '=',
        ),
    )
);
/*
 * Query
 */
$posts_past = new WP_Query($args_past);
$projects_past = $posts_past->posts;
?>

<style>
    .hero-body.main-header{
        background-image: linear-gradient(rgba(0, 0, 0, 0.45),rgba(0, 0, 0, 0.45)), url("<?php echo get_template_directory_uri(); ?>/images/header.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 55% 55%;
    }
</style>
 <!-- Hero content: will be in the middle -->
  <div class="hero-body main-header" >
    <div class="container has-text-centered">
      <h1 class="title">
        MAC'N MOTION
      </h1>
      <h2 class="subtitle">
        IN AN INNOVATIVE ENVIRONMENT
      </h2>
    </div>
  </div>
 <section class="hero is-content section-box is-dark">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('ABOUT US') ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-three-fifths is-offset-one-fifth">
            <div class="columns ">
                <div class="column  has-text-centered box-content">
                    <article class="tile is-child notification is-primary block-content has-text-centered">
                       <p class="title"><?php _e('7 years', $domain); ?></p>
                       <div class="line-solid"></div>
                       <p class="subtitle"><?php _e('Creating for more than 7 years', $domain); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered">
                  <article class="tile is-child notification is-primary block-content has-text-centered">
                    <p class="title"><?php _e('Thai & Foreign', $domain); ?></p>
                    <div class="line-solid"></div>
                    <p class="subtitle"><?php _e('Professional team of Thai and Foreign nationals', $domain); ?></p>
                  </article>
                </div>
                <div class="column  has-text-centered">
                     <article class="tile is-child notification is-primary block-content has-text-centered">
                       <p class="title"><?php _e('Data analysis', $domain); ?></p>
                       <div class="line-solid"></div>
                       <p class="subtitle"><?php _e('Connecting business strategy, data analysis and digital development; Under this: Registered with DBD statement', $domain); ?></p>
                     </article>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
 
 
 
 <section class="hero is-content section-box is-primary">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('Top Main Area', $domain) ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-three-fifths is-offset-one-fifth">
            <div class="columns ">
                <div class="column  has-text-centered box-content blog-img no-padding margin-075em">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" >
                    <article class="tile is-child notification is-dark block-content has-text-centered">
                       <p class="title"><?php _e('App Development &Web Design', $domain); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered blog-img no-padding margin-075em">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/2.jpg" >
                  <article class="tile is-child notification is-dark block-content has-text-centered">
                    <p class="title"><?php _e('Break the Norm', $domain); ?></p>
                  </article>
                </div>
                <div class="column  has-text-centered blog-img no-padding margin-075em">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" >
                     <article class="tile is-child notification is-dark block-content has-text-centered">
                       <p class="title"><?php _e('Build the Tale', $domain); ?></p>
                     </article>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
 <section class="hero is-content section-box is-dark">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('โครงการที่ผ่านมา', $domain) ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-10 is-offset-1">
             <?php if(!empty($projects_past)): 
                   foreach($projects_past as $key => $pro): 
                    $post_id = $pro->ID;
                    /* Get post thumnail */
                    $image_id = get_post_thumbnail_id($post_id);
                    $image_arr = wp_get_attachment_image_src($image_id, "custom-size-600");
                    if (empty($image_arr)) {
                        $image = get_stylesheet_directory_uri() . '/images/1000x350.jpg';
                    } else {
                        $image = $image_arr[0];
                    }
                    if($key == 3): ?>
                        <div class="columns no-margin-bot">
                            <div class="column  has-text-centered box-content blog-img slide no-padding">
                                 <img src="<?php echo $image ?>" >
                                 <article class="tile is-child is-dark block-content has-text-centered">
                                    <p class="title"><?php echo $pro->post_title; ?></p>
                                  </article>
                             </div>
                        </div>
                    <?php endif; 
                    endforeach; 
                endif; ?>
          </div>
      </div>
    </div>
  </div>
</section>
 
 <section class="hero section-box is-primary">
  <div class="hero-body no-padding">
    <div class="container-fluid  no-padding">
      <div class="columns">
          <div class="column  has-text-centered">
              <h1 class="title-content"><?php _e('โครงการปัจจุบัน', $domain) ?></h1>
          </div>
      </div>
      <div class="columns ">
         <div class="column is-12 ">
            <div class="columns no-margin-bot">
                <div class="column  has-text-centered box-content blog-img slide no-padding">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" >
                    <article class="tile is-child is-dark block-content has-text-centered">
                       <p class="title"><?php _e('App Development &Web Design', $domain); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered blog-img slide no-padding">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/2.jpg" >
                  <article class="tile is-child is-dark block-content has-text-centered">
                    <p class="title"><?php _e('Break the Norm', $domain); ?></p>
                  </article>
                </div>
                <div class="column  has-text-centered blog-img slide no-padding">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" >
                     <article class="tile is-child  is-dark block-content has-text-centered">
                       <p class="title"><?php _e('Build the Tale', $domain); ?></p>
                     </article>
                </div>
                <div class="column  has-text-centered box-content blog-img slide no-padding">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/1.jpg" >
                    <article class="tile is-child is-dark block-content has-text-centered">
                       <p class="title"><?php _e('App Development &Web Design', $domain); ?></p>
                     </article>
                </div>
                 <div class="column  has-text-centered blog-img slide no-padding">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/3.jpg" >
                     <article class="tile is-child  is-dark block-content has-text-centered">
                       <p class="title"><?php _e('Build the Tale', $domain); ?></p>
                     </article>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
<?php contact_form(); ?>


<?php video_popup(); ?>


<?php
get_footer();
?>
